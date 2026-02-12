<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class QuantifyController extends Controller
{
    // Core Trust Algorithm (Universal)
    public function calculateTrustScore($behavior, $delay, $transparency, $daysSinceLastFeedback = 7)
    {
        // Weights (customizable per category)
        $w1 = 0.40; // Behavior weight
        $w2 = 0.35; // Delay weight
        $w3 = 0.25; // Transparency weight
        
        // Calculate weighted sum (convert 1-10 scale to 0-100)
        $weightedSum = (($behavior * $w1) + ($delay * $w2) + ($transparency * $w3)) * 10;
        
        // Decay factor (λ = 0.05)
        $lambda = 0.05;
        $decayFactor = exp(-$lambda * $daysSinceLastFeedback);
        
        // Final score (0-100)
        $score = $weightedSum * $decayFactor;
        
        return round(max(0, min(100, $score)), 2);
    }

    // Get all active modules/categories
    public function getModules()
    {
        $modules = DB::table('categories')
            ->select('id', 'name', 'display_name', 'description', 'icon', 'is_active')
            ->where('is_active', true)
            ->orderBy('display_order')
            ->get();
        
        return response()->json([
            'success' => true,
            'modules' => $modules,
            'current_module' => 'carpool' // Default for prototype
        ]);
    }

    // Get services by category/module
    public function getServices(Request $request)
    {
        $category = $request->get('category', 'carpool');
        
        $services = DB::table('services as s')
            ->join('categories as c', 's.category_id', '=', 'c.id')
            ->select(
                's.id',
                's.name',
                's.description',
                's.trust_score',
                's.feedback_count',
                's.last_feedback_at',
                'c.name as category',
                'c.display_name as category_display',
                'c.icon as category_icon'
            )
            ->where('c.name', $category)
            ->where('s.is_active', true)
            ->orderBy('s.trust_score', 'desc')
            ->get();
        
        return response()->json([
            'success' => true,
            'category' => $category,
            'services' => $services,
            'timestamp' => now()->toISOString()
        ]);
    }

    // Submit anonymous feedback
    public function submitFeedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|integer|exists:services,id',
            'behavior_score' => 'required|integer|between:1,10',
            'delay_score' => 'required|integer|between:1,10',
            'transparency_score' => 'required|integer|between:1,10',
            'session_token' => 'required|string|size:64'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Rate limiting: 3 submissions per session per hour
        $recentSubmissions = DB::table('feedback')
            ->where('session_token', $request->session_token)
            ->where('created_at', '>', now()->subHour())
            ->count();

        if ($recentSubmissions >= 3) {
            return response()->json([
                'success' => false,
                'message' => 'Rate limit exceeded. Please try again later.'
            ], 429);
        }

        DB::beginTransaction();

        try {
            // Get service details
            $service = DB::table('services')
                ->where('id', $request->service_id)
                ->first();

            // Get last feedback time
            $lastFeedback = DB::table('feedback')
                ->where('service_id', $request->service_id)
                ->orderBy('created_at', 'desc')
                ->first();

            $daysSinceLastFeedback = $lastFeedback 
                ? Carbon::parse($lastFeedback->created_at)->diffInDays(now())
                : 7;

            // Calculate trust score
            $score = $this->calculateTrustScore(
                $request->behavior_score,
                $request->delay_score,
                $request->transparency_score,
                $daysSinceLastFeedback
            );

            // Insert feedback
            DB::table('feedback')->insert([
                'service_id' => $request->service_id,
                'behavior_score' => $request->behavior_score,
                'delay_score' => $request->delay_score,
                'transparency_score' => $request->transparency_score,
                'session_token' => $request->session_token,
                'calculated_score' => $score,
                'created_at' => now()
            ]);

            // Update service trust score (weighted average)
            $newTrustScore = ($service->trust_score * $service->feedback_count + $score) 
                           / ($service->feedback_count + 1);

            DB::table('services')
                ->where('id', $request->service_id)
                ->update([
                    'trust_score' => round($newTrustScore, 2),
                    'feedback_count' => $service->feedback_count + 1,
                    'last_feedback_at' => now(),
                    'updated_at' => now()
                ]);

            // Record in history
            DB::table('score_history')->insert([
                'service_id' => $request->service_id,
                'trust_score' => round($newTrustScore, 2),
                'feedback_count' => $service->feedback_count + 1,
                'calculated_at' => now()
            ]);

            DB::commit();

            // Get updated service list
            $updatedServices = DB::table('services')
                ->where('category_id', $service->category_id)
                ->where('is_active', true)
                ->orderBy('trust_score', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Feedback submitted anonymously',
                'score_impact' => $score,
                'new_trust_score' => round($newTrustScore, 2),
                'services' => $updatedServices
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get analytics dashboard data
    public function getAnalytics(Request $request)
    {
        $category = $request->get('category', 'carpool');
        
        $analytics = DB::table('services as s')
            ->join('categories as c', 's.category_id', '=', 'c.id')
            ->select([
                's.id',
                's.name',
                's.trust_score',
                's.feedback_count',
                's.last_feedback_at',
                'c.name as category',
                'c.icon as icon',
                DB::raw('COALESCE(AVG(f.behavior_score), 0) as avg_behavior'),
                DB::raw('COALESCE(AVG(f.delay_score), 0) as avg_delay'),
                DB::raw('COALESCE(AVG(f.transparency_score), 0) as avg_transparency'),
                DB::raw('(SELECT trust_score FROM score_history WHERE service_id = s.id ORDER BY calculated_at DESC LIMIT 1,1) as previous_score')
            ])
            ->leftJoin('feedback as f', 's.id', '=', 'f.service_id')
            ->where('c.name', $category)
            ->where('s.is_active', true)
            ->groupBy('s.id', 's.name', 's.trust_score', 's.feedback_count', 's.last_feedback_at', 'c.name', 'c.icon')
            ->orderBy('s.trust_score', 'desc')
            ->get();

        // Calculate trends and status
        foreach ($analytics as $item) {
            $item->trend = $item->previous_score 
                ? round($item->trust_score - $item->previous_score, 2)
                : 0;
            
            $item->trend_percentage = $item->previous_score && $item->previous_score > 0
                ? round(($item->trust_score - $item->previous_score) / $item->previous_score * 100, 2)
                : 0;
            
            $item->status = match(true) {
                $item->trust_score >= 80 => 'excellent',
                $item->trust_score >= 70 => 'good',
                $item->trust_score >= 60 => 'fair',
                $item->trust_score >= 50 => 'poor',
                default => 'critical'
            };
        }

        // Overall statistics
        $stats = [
            'total_services' => $analytics->count(),
            'average_trust_score' => round($analytics->avg('trust_score'), 2),
            'total_feedback' => $analytics->sum('feedback_count'),
            'highest_score' => $analytics->sortByDesc('trust_score')->first(),
            'lowest_score' => $analytics->sortBy('trust_score')->first(),
            'most_rated' => $analytics->sortByDesc('feedback_count')->first()
        ];

        return response()->json([
            'success' => true,
            'category' => $category,
            'analytics' => $analytics,
            'statistics' => $stats,
            'last_updated' => now()->toISOString()
        ]);
    }

    // Generate session token for rate limiting
    public function generateSessionToken()
    {
        $token = hash('sha256', uniqid('quantify_', true) . microtime(true) . rand());
        
        return response()->json([
            'success' => true,
            'session_token' => $token,
            'expires_in' => '3600 seconds',
            'platform' => 'Quantify Trust Intelligence'
        ]);
    }
}