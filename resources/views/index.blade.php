<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quantify - Trust Intelligence Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0f;
            color: white;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s ease;
        }
        .glass-card:hover {
            border-color: #6366f1;
            background: rgba(255, 255, 255, 0.05);
        }
        .score-bar {
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            overflow: hidden;
        }
        .score-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s ease;
        }
        .excellent { background: linear-gradient(90deg, #10b981, #34d399); }
        .good { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
        .fair { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
        .poor { background: linear-gradient(90deg, #f97316, #fb923c); }
        .critical { background: linear-gradient(90deg, #ef4444, #f87171); }
        .module-active {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
        }
        .animate-slide-in {
            animation: slideIn 0.3s ease;
        }
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body class="bg-[#0a0a0f] antialiased">

    <!-- Header -->
    <header class="fixed top-0 w-full z-50 bg-[#0a0a0f]/80 backdrop-blur-lg border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">Q</span>
                    </div>
                    <div>
                        <span class="font-bold text-2xl tracking-tight text-white">Quantify</span>
                        <span class="ml-2 text-xs bg-white/10 px-2 py-1 rounded-full text-white/70">Trust Intelligence</span>
                    </div>
                </div>

                <!-- Module Selector -->
                <div class="hidden md:flex items-center space-x-2 bg-white/5 p-1 rounded-xl">
                    <button class="module-btn px-4 py-2 rounded-lg text-sm font-medium transition-all" data-module="carpool">
                        🚗 Carpool
                    </button>
                    <button class="module-btn px-4 py-2 rounded-lg text-sm font-medium text-white/50 hover:text-white transition-all" data-module="ecommerce" disabled>
                        🛒 E-Commerce
                        <span class="ml-2 text-[10px] bg-white/10 px-1.5 py-0.5 rounded">Soon</span>
                    </button>
                    <button class="module-btn px-4 py-2 rounded-lg text-sm font-medium text-white/50 hover:text-white transition-all" data-module="institutions" disabled>
                        🏛️ Institutions
                        <span class="ml-2 text-[10px] bg-white/10 px-1.5 py-0.5 rounded">Soon</span>
                    </button>
                    <button class="module-btn px-4 py-2 rounded-lg text-sm font-medium text-white/50 hover:text-white transition-all" data-module="financial" disabled>
                        💳 Financial
                        <span class="ml-2 text-[10px] bg-white/10 px-1.5 py-0.5 rounded">Soon</span>
                    </button>
                </div>

                <!-- Status -->
                <div class="text-xs font-medium text-[#6366f1] border border-[#6366f1]/30 px-3 py-1.5 rounded-full">
                    🟢 Carpool Module • Live Demo
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-24 pb-16 px-6">
        <div class="max-w-7xl mx-auto">

            <!-- Hero Section -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center space-x-2 bg-white/5 px-4 py-2 rounded-full mb-6">
                    <span class="w-2 h-2 bg-[#6366f1] rounded-full animate-pulse"></span>
                    <span class="text-sm font-medium text-white/70">Phase 1: Carpool Module</span>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-white/70 bg-clip-text text-transparent">
                    Trust, <span class="bg-gradient-to-r from-[#6366f1] to-[#8b5cf6] bg-clip-text text-transparent">Quantified.</span>
                </h1>
                <p class="text-xl text-white/60 max-w-3xl mx-auto">
                    Real-time trust scores for Pakistan's ride-hailing services. 
                    <span class="text-white font-medium">One standard. Every service. Neutral intelligence.</span>
                </p>
            </div>

            <!-- Module Info Banner -->
            <div class="glass-card rounded-2xl p-6 mb-12 border-l-4 border-l-[#6366f1]">
                <div class="flex items-start justify-between">
                    <div class="flex items-start space-x-4">
                        <div class="text-4xl">🚗</div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Carpool Module (Prototype)</h3>
                            <p class="text-white/60 text-sm max-w-2xl">
                                This is Module 1 of 4. Same trust engine powers E-Commerce, Institutions, and Financial services. 
                                Select different modules above to see our expansion roadmap.
                            </p>
                        </div>
                    </div>
                    <div class="bg-white/5 px-4 py-2 rounded-lg">
                        <span class="text-xs font-medium text-white/70">Next: 🛒 E-Commerce</span>
                    </div>
                </div>
            </div>

            <!-- Live Trust Dashboard -->
            <div class="grid lg:grid-cols-3 gap-8 mb-12">
                <!-- Main Dashboard Card -->
                <div class="lg:col-span-2 glass-card rounded-3xl p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Live Trust Scores</h2>
                        <div class="flex items-center space-x-2 text-sm bg-white/5 px-3 py-1.5 rounded-full">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            <span class="text-white/70">Updating live</span>
                        </div>
                    </div>

                    <!-- Services Table -->
                    <div class="space-y-4" id="services-container">
                        <!-- Dynamically populated by JavaScript -->
                    </div>

                    <!-- Last Updated -->
                    <div class="mt-6 text-xs text-white/40 flex justify-between items-center">
                        <span id="last-updated">Updating...</span>
                        <span class="font-mono">Quantify v1.0.0</span>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="glass-card rounded-3xl p-8">
                    <h3 class="text-lg font-bold mb-6">Module Statistics</h3>
                    <div class="space-y-6">
                        <div>
                            <div class="text-3xl font-bold text-white" id="total-feedback">0</div>
                            <div class="text-sm text-white/50 mt-1">Total Ratings</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-white" id="avg-score">0.0</div>
                            <div class="text-sm text-white/50 mt-1">Average Trust Score</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-[#10b981]" id="highest-score">0.0</div>
                            <div class="text-sm text-white/50 mt-1">Highest Score</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-[#ef4444]" id="lowest-score">0.0</div>
                            <div class="text-sm text-white/50 mt-1">Lowest Score</div>
                        </div>
                    </div>

                    <!-- Module Expansion -->
                    <div class="mt-8 pt-6 border-t border-white/10">
                        <h4 class="text-sm font-medium text-white/70 mb-3">Coming Next</h4>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-sm">
                                <span>🛒 E-Commerce</span>
                                <span class="text-white/40">Q2 2024</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span>🏛️ Institutions</span>
                                <span class="text-white/40">Q3 2024</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span>💳 Financial</span>
                                <span class="text-white/40">Q4 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feedback Form & Analytics Row -->
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Feedback Form -->
                <div class="glass-card rounded-3xl p-8">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-[#6366f1]/20 rounded-lg flex items-center justify-center">
                            <span class="text-[#6366f1] text-xl">📝</span>
                        </div>
                        <h3 class="text-xl font-bold">Rate Your Ride</h3>
                    </div>

                    <form id="feedbackForm">
                        <!-- Service Selection -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-white/70 mb-2">
                                Select Service
                            </label>
                            <select id="serviceSelect" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#6366f1] transition-colors">
                                <option value="">Loading services...</option>
                            </select>
                            <div id="serviceInfo" class="hidden mt-3 p-3 bg-white/5 rounded-lg">
                                <div class="flex justify-between text-sm">
                                    <span class="text-white/70">Current Trust:</span>
                                    <span id="currentScore" class="font-bold text-white"></span>
                                </div>
                                <div class="flex justify-between text-sm mt-1">
                                    <span class="text-white/70">Total Ratings:</span>
                                    <span id="feedbackCount" class="font-bold text-white"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Behavior Score -->
                        <div class="mb-6">
                            <div class="flex justify-between mb-2">
                                <label class="text-sm font-medium text-white">🧑‍✈️ Driver Behavior</label>
                                <span id="behaviorValue" class="text-[#6366f1] font-bold">5/10</span>
                            </div>
                            <input type="range" id="behaviorScore" min="1" max="10" value="5" 
                                class="w-full h-2 bg-white/10 rounded-lg appearance-none cursor-pointer accent-[#6366f1]">
                            <div class="flex justify-between text-xs text-white/40 mt-1">
                                <span>Poor</span>
                                <span>Excellent</span>
                            </div>
                        </div>

                        <!-- Delay Score -->
                        <div class="mb-6">
                            <div class="flex justify-between mb-2">
                                <label class="text-sm font-medium text-white">⏱️ Wait Time</label>
                                <span id="delayValue" class="text-[#6366f1] font-bold">5/10</span>
                            </div>
                            <input type="range" id="delayScore" min="1" max="10" value="5" 
                                class="w-full h-2 bg-white/10 rounded-lg appearance-none cursor-pointer accent-[#6366f1]">
                            <div class="flex justify-between text-xs text-white/40 mt-1">
                                <span>Very Slow</span>
                                <span>Very Fast</span>
                            </div>
                        </div>

                        <!-- Transparency Score -->
                        <div class="mb-6">
                            <div class="flex justify-between mb-2">
                                <label class="text-sm font-medium text-white">💰 Fare Transparency</label>
                                <span id="transparencyValue" class="text-[#6366f1] font-bold">5/10</span>
                            </div>
                            <input type="range" id="transparencyScore" min="1" max="10" value="5" 
                                class="w-full h-2 bg-white/10 rounded-lg appearance-none cursor-pointer accent-[#6366f1]">
                            <div class="flex justify-between text-xs text-white/40 mt-1">
                                <span>Hidden Fees</span>
                                <span>Clear Pricing</span>
                            </div>
                        </div>

                        <!-- Score Preview -->
                        <div class="mb-6 p-4 bg-white/5 rounded-xl">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-white/70">Trust Impact Preview</span>
                                <span id="scorePreview" class="text-2xl font-bold text-[#6366f1]">50</span>
                            </div>
                            <div class="score-bar">
                                <div id="previewBar" class="score-fill fair" style="width: 50%"></div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-[#6366f1] to-[#8b5cf6] text-white font-bold py-4 rounded-xl hover:opacity-90 transition-opacity disabled:opacity-50 disabled:cursor-not-allowed">
                            <span id="submitText">Submit Anonymous Rating →</span>
                            <span id="submitLoading" class="hidden">Processing...</span>
                        </button>

                        <p class="mt-4 text-xs text-center text-white/40">
                            🔒 No personal data stored • Rate limited to 3/hour • Anonymous session
                        </p>
                    </form>
                </div>

                <!-- Analytics & Recent Activity -->
                <div class="space-y-8">
                    <!-- Trust Trend Chart -->
                    <div class="glass-card rounded-3xl p-8">
                        <h3 class="text-lg font-bold mb-6">Trust Distribution</h3>
                        <canvas id="trustChart" height="200"></canvas>
                    </div>

                    <!-- Recent Activity -->
                    <div class="glass-card rounded-3xl p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold">Recent Activity</h3>
                            <span class="text-xs text-white/40">Live feed</span>
                        </div>
                        <div id="recentActivity" class="space-y-3">
                            <div class="flex items-center space-x-3 p-3 bg-white/5 rounded-lg">
                                <div class="w-2 h-2 bg-[#6366f1] rounded-full animate-pulse"></div>
                                <div class="text-sm">System initialized. Ready for feedback.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Platform Vision -->
                    <div class="bg-gradient-to-r from-[#6366f1]/10 to-[#8b5cf6]/10 rounded-3xl p-8 border border-[#6366f1]/20">
                        <div class="flex items-start space-x-4">
                            <div class="text-3xl">🎯</div>
                            <div>
                                <h4 class="font-bold mb-1">One Platform. Every Service.</h4>
                                <p class="text-sm text-white/60">
                                    Carpool is Module 1 of 4. Same trust engine, 
                                    different categories. E-Commerce launches Q2 2024.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        class Quantify {
            constructor() {
                this.sessionToken = null;
                this.currentModule = 'carpool';
                this.chart = null;
                this.initialize();
            }

            async initialize() {
                await this.generateSessionToken();
                await this.loadServices();
                await this.loadAnalytics();
                this.setupEventListeners();
                this.startLiveUpdates();
                this.addActivity('Quantify Carpool Module initialized');
            }

            async generateSessionToken() {
                try {
                    const response = await fetch('/api/session-token');
                    const data = await response.json();
                    this.sessionToken = data.session_token;
                } catch (error) {
                    console.error('Session error:', error);
                }
            }

            async loadServices() {
                try {
                    const response = await fetch(`/api/services?category=${this.currentModule}`);
                    const data = await response.json();
                    
                    if (data.success) {
                        this.renderServices(data.services);
                        this.updateServiceSelect(data.services);
                    }
                } catch (error) {
                    console.error('Error loading services:', error);
                }
            }

            async loadAnalytics() {
                try {
                    const response = await fetch(`/api/analytics?category=${this.currentModule}`);
                    const data = await response.json();
                    
                    if (data.success) {
                        this.updateStats(data.statistics);
                        this.updateChart(data.analytics);
                    }
                } catch (error) {
                    console.error('Error loading analytics:', error);
                }
            }

            renderServices(services) {
                const container = document.getElementById('services-container');
                container.innerHTML = '';

                services.forEach(service => {
                    const scoreClass = this.getScoreClass(service.trust_score);
                    const statusText = this.getStatusText(service.trust_score);
                    
                    const el = document.createElement('div');
                    el.className = 'flex items-center justify-between p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-colors';
                    el.innerHTML = `
                        <div class="flex items-center space-x-4">
                            <div class="text-2xl">🚗</div>
                            <div>
                                <div class="font-bold">${service.name}</div>
                                <div class="text-xs text-white/40">${service.feedback_count} ratings</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold ${this.getScoreColor(service.trust_score)}">${service.trust_score}</div>
                            <div class="text-xs text-white/40">${statusText}</div>
                        </div>
                    `;
                    container.appendChild(el);
                });

                document.getElementById('last-updated').innerHTML = `Last updated: ${new Date().toLocaleTimeString()}`;
            }

            updateServiceSelect(services) {
                const select = document.getElementById('serviceSelect');
                select.innerHTML = '<option value="">Select a service...</option>';
                
                services.forEach(service => {
                    const option = document.createElement('option');
                    option.value = service.id;
                    option.textContent = `${service.name} (${service.trust_score})`;
                    option.dataset.score = service.trust_score;
                    option.dataset.count = service.feedback_count;
                    select.appendChild(option);
                });
            }

            updateStats(stats) {
                document.getElementById('total-feedback').textContent = stats.total_feedback || 0;
                document.getElementById('avg-score').textContent = stats.average_trust_score || '0.0';
                document.getElementById('highest-score').textContent = stats.highest_score?.trust_score || '0.0';
                document.getElementById('lowest-score').textContent = stats.lowest_score?.trust_score || '0.0';
            }

            updateChart(analytics) {
                const ctx = document.getElementById('trustChart').getContext('2d');
                
                if (this.chart) {
                    this.chart.destroy();
                }

                this.chart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: analytics.map(a => a.name),
                        datasets: [{
                            data: analytics.map(a => a.trust_score),
                            backgroundColor: analytics.map(a => {
                                if (a.trust_score >= 80) return '#10b981';
                                if (a.trust_score >= 70) return '#3b82f6';
                                if (a.trust_score >= 60) return '#f59e0b';
                                if (a.trust_score >= 50) return '#f97316';
                                return '#ef4444';
                            }),
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { color: '#94a3b8' }
                            }
                        }
                    }
                });
            }

            setupEventListeners() {
                // Score sliders
                ['behavior', 'delay', 'transparency'].forEach(type => {
                    const slider = document.getElementById(`${type}Score`);
                    const value = document.getElementById(`${type}Value`);
                    
                    slider.addEventListener('input', (e) => {
                        value.textContent = `${e.target.value}/10`;
                        this.updateScorePreview();
                    });
                });

                // Service selection
                document.getElementById('serviceSelect').addEventListener('change', (e) => {
                    const selected = e.target.options[e.target.selectedIndex];
                    const info = document.getElementById('serviceInfo');
                    
                    if (selected.value) {
                        info.classList.remove('hidden');
                        document.getElementById('currentScore').textContent = selected.dataset.score;
                        document.getElementById('feedbackCount').textContent = selected.dataset.count;
                    } else {
                        info.classList.add('hidden');
                    }
                    
                    this.updateScorePreview();
                });

                // Form submission
                document.getElementById('feedbackForm').addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.submitFeedback();
                });

                // Module switching
                document.querySelectorAll('.module-btn').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        if (btn.disabled) return;
                        
                        document.querySelectorAll('.module-btn').forEach(b => {
                            b.classList.remove('module-active', 'bg-gradient-to-r', 'from-[#6366f1]', 'to-[#8b5cf6]', 'text-white');
                            b.classList.add('text-white/50');
                        });
                        
                        btn.classList.add('module-active', 'bg-gradient-to-r', 'from-[#6366f1]', 'to-[#8b5cf6]', 'text-white');
                        btn.classList.remove('text-white/50');
                        
                        this.currentModule = btn.dataset.module;
                        this.loadServices();
                        this.loadAnalytics();
                        this.addActivity(`Switched to ${btn.textContent.trim()} module`);
                    });
                });
            }

            updateScorePreview() {
                const behavior = parseInt(document.getElementById('behaviorScore').value);
                const delay = parseInt(document.getElementById('delayScore').value);
                const transparency = parseInt(document.getElementById('transparencyScore').value);
                
                const preview = Math.round((behavior * 0.4 + delay * 0.35 + transparency * 0.25) * 10);
                document.getElementById('scorePreview').textContent = preview;
                
                const bar = document.getElementById('previewBar');
                bar.style.width = `${preview}%`;
                bar.className = `score-fill ${this.getScoreClass(preview)}`;
            }

            async submitFeedback() {
                const serviceId = document.getElementById('serviceSelect').value;
                
                if (!serviceId) {
                    alert('Please select a service');
                    return;
                }

                const submitBtn = document.querySelector('#feedbackForm button[type="submit"]');
                const submitText = document.getElementById('submitText');
                const submitLoading = document.getElementById('submitLoading');
                
                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                submitLoading.classList.remove('hidden');

                try {
                    const response = await fetch('/api/feedback', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        body: JSON.stringify({
                            service_id: parseInt(serviceId),
                            behavior_score: parseInt(document.getElementById('behaviorScore').value),
                            delay_score: parseInt(document.getElementById('delayScore').value),
                            transparency_score: parseInt(document.getElementById('transparencyScore').value),
                            session_token: this.sessionToken
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        this.addActivity(`⭐ New rating submitted - Impact: ${data.score_impact}`);
                        this.showNotification('Rating submitted successfully!', 'success');
                        
                        // Reset form
                        document.getElementById('behaviorScore').value = 5;
                        document.getElementById('delayScore').value = 5;
                        document.getElementById('transparencyScore').value = 5;
                        document.getElementById('behaviorValue').textContent = '5/10';
                        document.getElementById('delayValue').textContent = '5/10';
                        document.getElementById('transparencyValue').textContent = '5/10';
                        document.getElementById('serviceSelect').value = '';
                        document.getElementById('serviceInfo').classList.add('hidden');
                        
                        // Refresh data
                        await this.loadServices();
                        await this.loadAnalytics();
                        this.updateScorePreview();
                    } else {
                        throw new Error(data.message || 'Submission failed');
                    }
                } catch (error) {
                    this.showNotification(error.message, 'error');
                    this.addActivity(`❌ Submission failed: ${error.message}`);
                } finally {
                    submitBtn.disabled = false;
                    submitText.classList.remove('hidden');
                    submitLoading.classList.add('hidden');
                }
            }

            addActivity(message) {
                const container = document.getElementById('recentActivity');
                const activity = document.createElement('div');
                activity.className = 'flex items-center space-x-3 p-3 bg-white/5 rounded-lg animate-slide-in';
                activity.innerHTML = `
                    <div class="w-2 h-2 bg-[#6366f1] rounded-full"></div>
                    <div class="text-sm flex-1">${message}</div>
                    <div class="text-xs text-white/40">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                `;
                
                container.insertBefore(activity, container.firstChild);
                
                while (container.children.length > 5) {
                    container.removeChild(container.lastChild);
                }
            }

            showNotification(message, type) {
                const notification = document.createElement('div');
                notification.className = `fixed top-24 right-6 glass-card p-4 rounded-xl border z-50 animate-slide-in ${
                    type === 'success' ? 'border-green-500/30 bg-green-500/10' : 'border-red-500/30 bg-red-500/10'
                }`;
                notification.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full ${type === 'success' ? 'bg-green-500/20' : 'bg-red-500/20'} flex items-center justify-center">
                            <span class="${type === 'success' ? 'text-green-400' : 'text-red-400'}">
                                ${type === 'success' ? '✓' : '✗'}
                            </span>
                        </div>
                        <div>
                            <div class="font-bold">${type === 'success' ? 'Success' : 'Error'}</div>
                            <div class="text-xs text-white/60">${message}</div>
                        </div>
                    </div>
                `;
                
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.remove();
                }, 5000);
            }

            startLiveUpdates() {
                setInterval(() => {
                    this.loadServices();
                    this.loadAnalytics();
                    this.addActivity('Dashboard auto-refreshed');
                }, 30000);
            }

            getScoreClass(score) {
                if (score >= 80) return 'excellent';
                if (score >= 70) return 'good';
                if (score >= 60) return 'fair';
                if (score >= 50) return 'poor';
                return 'critical';
            }

            getScoreColor(score) {
                if (score >= 80) return 'text-[#10b981]';
                if (score >= 70) return 'text-[#3b82f6]';
                if (score >= 60) return 'text-[#f59e0b]';
                if (score >= 50) return 'text-[#f97316]';
                return 'text-[#ef4444]';
            }

            getStatusText(score) {
                if (score >= 80) return 'Excellent';
                if (score >= 70) return 'Good';
                if (score >= 60) return 'Fair';
                if (score >= 50) return 'Poor';
                return 'Critical';
            }
        }

        // Initialize Quantify
        document.addEventListener('DOMContentLoaded', () => {
            window.quantify = new Quantify();
        });
    </script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>
</html>