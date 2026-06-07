<x-app-layout title="Dashboard">

    @php
        $initials = substr(Auth::user()->name, 0, 1);
        if ($spacePos = strpos(Auth::user()->name, ' ')) {
            $initials .= substr(Auth::user()->name, $spacePos + 1, 1);
        }
    @endphp

    <div class="welcome-hero" style="background: linear-gradient(135deg, #ffffff 0%, #fdfdfa 100%) !important; border-radius: 24px !important; padding: 3rem !important; margin-bottom: 2.5rem !important; border: 1px solid #f1f5f9 !important; position: relative !important; overflow: hidden !important; text-align: left !important; display: block !important;">
        <div class="hero-content" style="display: flex !important; flex-direction: row !important; flex-wrap: wrap !important; align-items: center !important; justify-content: flex-start !important; gap: 4rem !important; position: relative !important; z-index: 2 !important; text-align: left !important; width: 100% !important;">
            <div class="hero-text" style="flex: 1 1 500px !important; text-align: left !important; display: flex !important; flex-direction: column !important; align-items: flex-start !important;">
                <div class="date-badge" style="display: inline-flex !important; align-items: center !important; padding: 0.5rem 1.25rem !important; background: #faf8ed !important; color: #89986d !important; border-radius: 50px !important; font-size: 0.85rem !important; font-weight: 800 !important; margin-bottom: 2rem !important; border: 1px solid rgba(197, 216, 157, 0.3) !important; box-sizing: content-box !important;">
                    <i class="far fa-calendar-alt" style="margin-left: 10px !important; margin-right: 10px !important; padding-left: 0 !important; padding-right: 0 !important;"></i> {{ now()->format('l, d F Y') }}
                </div>
                <h1 class="hero-greeting" style="font-size: 3.5rem !important; font-weight: 900 !important; color: #2d2d2d !important; margin-bottom: 1.5rem !important; letter-spacing: -0.05em !important; line-height: 1.1 !important; text-align: left !important;">
                    Welcome back, <br>
                    <span style="color: #89986d !important;">{{ Auth::user()->name }}</span>
                </h1>
                <p class="hero-subtitle" style="color: #64748b !important; font-size: 1.15rem !important; line-height: 1.7 !important; margin-bottom: 3rem !important; text-align: left !important; max-width: 500px !important;">
                    Ready to manage your <span style="color: #2d2d2d !important; font-weight: 800 !important; background: linear-gradient(to bottom, transparent 60%, rgba(197, 216, 157, 0.3) 60%) !important;">finances</span> today? 
                    Keep track of your goals and maintain a healthy balance.
                </p>
                <div class="quick-actions" style="display: flex !important; gap: 1.5rem !important; justify-content: flex-start !important; width: 100% !important; margin-left: 0 !important;">
                    <a href="{{ route('transactions.create') }}" class="btn-action" style="padding: 1rem 2rem !important; border-radius: 18px !important; font-weight: 800 !important; display: inline-flex !important; align-items: center !important; gap: 1rem !important; background: #2d2d2d !important; color: white !important; text-decoration: none !important; box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;">
                        <div style="width: 24px; height: 24px; display: flex !important; align-items: center !important; justify-content: center !important; background: rgba(255,255,255,0.2) !important; border-radius: 6px !important;"><i class="fas fa-plus"></i></div>
                        Add Transaction
                    </a>
                    <a href="{{ route('diaries.create') }}" class="btn-action" style="padding: 1rem 2rem !important; border-radius: 18px !important; font-weight: 800 !important; display: inline-flex !important; align-items: center !important; gap: 1rem !important; background: white !important; color: #2d2d2d !important; border: 2px solid #f1f5f9 !important; text-decoration: none !important; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;">
                        <div style="width: 24px; height: 24px; display: flex !important; align-items: center !important; justify-content: center !important; background: #faf8ed !important; border-radius: 6px !important; color: #89986d !important;"><i class="fas fa-pen-fancy"></i></div>
                        Write Diary
                    </a>
                </div>
            </div>

            <div class="hero-illustration hidden lg:flex">
                <div class="illustration-container">
                    <div class="floating-icon icon-1"><i class="fas fa-wallet"></i></div>
                    <div class="floating-icon icon-2"><i class="fas fa-chart-pie"></i></div>
                    <div class="floating-icon icon-3"><i class="fas fa-piggy-bank"></i></div>
                    <div class="main-illustration">
                        <div class="circle-bg"></div>
                        <img src="{{ asset('images/fallkoin.jpg') }}" alt="Illustration" class="hero-img">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="stats-grid">
        <div class="stat-card income-card">
            <div class="stat-card-inner">
                <div class="stat-info">
                    <span class="stat-label">Total Income</span>
                    <h2 class="stat-value">Rp {{ number_format($income, 0, ',', '.') }}</h2>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-chart-line mr-1"></i> <span>This month</span>
                    </div>
                </div>
                <div class="stat-icon-box bg-emerald-100 text-emerald-600">
                    <i class="fas fa-arrow-trend-up"></i>
                </div>
            </div>
        </div>

        <div class="stat-card expense-card">
            <div class="stat-card-inner">
                <div class="stat-info">
                    <span class="stat-label">Total Expenses</span>
                    <h2 class="stat-value">Rp {{ number_format($expense, 0, ',', '.') }}</h2>
                    <div class="stat-trend trend-down">
                        <i class="fas fa-chart-line mr-1"></i> <span>This month</span>
                    </div>
                </div>
                <div class="stat-icon-box bg-rose-100 text-rose-600">
                    <i class="fas fa-arrow-trend-down"></i>
                </div>
            </div>
        </div>

        <div class="stat-card balance-card">
            <div class="stat-card-inner">
                <div class="stat-info">
                    <span class="stat-label">Active Balance</span>
                    <h2 class="stat-value">Rp {{ number_format($balance, 0, ',', '.') }}</h2>
                    <div class="stat-trend {{ $balance >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="fas fa-{{ $balance >= 0 ? 'shield-check' : 'triangle-exclamation' }} mr-1"></i> 
                        <span>{{ $balance >= 0 ? 'Wallet Safe' : 'Deficit' }}</span>
                    </div>
                </div>
                <div class="stat-icon-box bg-sky-100 text-sky-600">
                    <i class="fas fa-wallet"></i>
                </div>
            </div>
        </div>

        <div class="stat-card savings-card">
            <div class="stat-card-inner">
                <div class="stat-info">
                    <span class="stat-label">Total Savings</span>
                    <h2 class="stat-value">Rp {{ number_format($totalSavings, 0, ',', '.') }}</h2>
                    <div class="stat-trend trend-neutral">
                        <i class="fas fa-star text-amber-400 mr-1"></i> <span>Level {{ Auth::user()->level }}</span>
                    </div>
                </div>
                <div class="stat-icon-box bg-[#faf8ed] text-[#89986d]">
                    <i class="fas fa-piggy-bank"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="content-grid">
        {{-- Recent Transactions --}}
        <div class="glass-card">
            <div class="card-header-premium">
                <div class="card-title-group">
                    <div class="card-icon-main"><i class="fas fa-history text-theme"></i></div>
                    <h3 class="card-title-premium">Recent Transactions</h3>
                </div>
                <a href="{{ route('transactions.index') }}" class="btn-link">
                    View All <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="card-body-premium">
                @if($recentTransactions->count())
                    <div class="transaction-list-premium">
                        @foreach($recentTransactions as $t)
                        <div class="transaction-item-premium group">
                            <div class="item-left">
                                <div class="icon-wrapper {{ $t->type }}">
                                    <i class="fas fa-{{ $t->type == 'income' ? 'plus' : 'minus' }}"></i>
                                </div>
                                <div class="item-details">
                                    <h4 class="item-title">{{ $t->description ?: ucfirst($t->type) }}</h4>
                                    <span class="item-date">{{ $t->transaction_date->format('d M Y') }}</span>
                                </div>
                            </div>
                            <div class="item-right">
                                <span class="item-amount {{ $t->type }}">
                                    {{ $t->type == 'income' ? '+' : '-' }}Rp {{ number_format($t->amount, 0, ',', '.') }}
                                </span>
                                <i class="fas fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fas fa-receipt"></i></div>
                        <p>No transactions yet</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Targets & Reminders --}}
        <div class="glass-card">
            <div class="card-header-premium">
                <div class="card-title-group">
                    <div class="card-icon-main"><i class="fas fa-bullseye text-theme"></i></div>
                    <h3 class="card-title-premium">Savings Targets</h3>
                </div>
                <a href="{{ route('targets.create') }}" class="btn-icon-only" title="Add Target">
                    <i class="fas fa-plus"></i>
                </a>
            </div>

            <div class="card-body-premium">
                @if($targets->count())
                    <div class="target-list-premium">
                        @foreach($targets as $target)
                        @php $pct = $target->target_amount > 0 ? min(100, ($target->current_amount / $target->target_amount) * 100) : 0; @endphp
                        <div class="target-item-premium">
                            <div class="target-info-premium">
                                <span class="target-name-premium">{{ $target->title }}</span>
                                <span class="target-pct-premium">{{ round($pct) }}%</span>
                            </div>
                            <div class="progress-container-premium">
                                <div class="progress-track-premium">
                                    <div class="progress-bar-premium {{ $pct >= 100 ? 'bg-success' : ($pct >= 50 ? 'bg-info' : 'bg-warning') }}" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                            <div class="target-footer-premium">
                                <span class="current-amount">Rp {{ number_format($target->current_amount, 0, ',', '.') }}</span>
                                <span class="target-amount">/ Rp {{ number_format($target->target_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fas fa-bullseye"></i></div>
                        <p>No targets yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        /* Global Theme Variables */
        :root {
            --theme-green: #c5d89d;
            --theme-green-dark: #89986d;
            --theme-green-light: #faf8ed;
            --theme-charcoal: #2d2d2d;
            --theme-slate: #64748b;
            --theme-emerald: #10b981;
            --theme-rose: #f43f5e;
            --theme-sky: #0ea5e9;
            --radius-xl: 24px;
            --radius-lg: 18px;
            --shadow-soft: 0 10px 30px rgba(0,0,0,0.03);
        }

        /* Dashboard Premium Theme Styles */
        .welcome-hero {
            background: linear-gradient(135deg, #ffffff 0%, #fdfdfa 100%) !important;
            border-radius: 24px !important;
            padding: 4rem !important;
            margin-bottom: 2.5rem !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03) !important;
            border: 1px solid #f1f5f9 !important;
            position: relative !important;
            overflow: hidden !important;
            display: block !important;
            text-align: left !important;
        }

        .hero-content {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            gap: 4rem !important;
            position: relative !important;
            z-index: 2 !important;
            text-align: left !important;
            width: 100% !important;
        }

        .hero-text {
            text-align: left !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            flex: 1 !important;
            max-width: 650px !important;
        }

        .date-badge {
            display: inline-flex !important;
            align-items: center !important;
            padding: 0.6rem 1.25rem !important;
            background: #faf8ed !important;
            color: #89986d !important;
            border-radius: 50px !important;
            font-size: 0.85rem !important;
            font-weight: 800 !important;
            margin-bottom: 2rem !important;
            border: 1px solid rgba(197, 216, 157, 0.3) !important;
            letter-spacing: 0.02em !important;
            margin-left: 0 !important;
            margin-right: auto !important;
        }

        .hero-greeting {
            font-size: 3.5rem !important;
            font-weight: 900 !important;
            color: #2d2d2d !important;
            margin-bottom: 1.5rem !important;
            letter-spacing: -0.05em !important;
            line-height: 1.1 !important;
            text-align: left !important;
        }

        .hero-subtitle {
            color: #64748b !important;
            font-size: 1.15rem !important;
            max-width: 500px !important; 
            line-height: 1.7 !important;
            margin-bottom: 3rem !important;
            text-align: left !important;
        }

        .highlight {
            color: #2d2d2d !important;
            font-weight: 800 !important;
            background: linear-gradient(to bottom, transparent 60%, rgba(197, 216, 157, 0.3) 60%) !important;
        }

        .quick-actions {
            display: flex !important;
            gap: 1.5rem !important;
            justify-content: flex-start !important;
            width: 100% !important;
        }

        .btn-action {
            padding: 1.1rem 2.25rem !important;
            border-radius: 20px !important;
            font-weight: 800 !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 1rem !important;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
            text-decoration: none !important;
            font-size: 1.05rem !important;
            border: 1px solid transparent !important;
        }

        .btn-action:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
            filter: brightness(1.1);
        }

        .btn-action:active {
            transform: translateY(-2px) scale(0.98);
        }

        .btn-icon {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.2);
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .btn-primary-theme {
            background: #2d2d2d;
            color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-secondary-theme {
            background: white;
            color: #2d2d2d;
            border-color: #e2e8f0;
        }

        /* Illustration Styles */
        .hero-illustration {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: relative;
        }

        .illustration-container {
            position: relative;
            width: 300px;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-illustration {
            position: relative;
            z-index: 5;
        }

        .circle-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 280px;
            height: 280px;
            background: linear-gradient(135deg, #faf8ed 0%, #ffffff 100%);
            border-radius: 50%;
            z-index: -1;
            border: 1px solid rgba(197, 216, 157, 0.2);
        }

        .hero-img {
            width: 220px;
            height: 220px;
            object-fit: cover;
            border-radius: 40px;
            box-shadow: 20px 20px 60px rgba(0,0,0,0.05);
            transform: rotate(5deg);
            transition: all 0.5s ease;
        }

        .hero-img:hover {
            transform: rotate(0deg) scale(1.05);
        }

        .floating-icon {
            position: absolute;
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            color: #89986d;
            font-size: 1.2rem;
            z-index: 10;
            animation: float 4s ease-in-out infinite;
        }

        .icon-1 { top: 10%; right: 10%; animation-delay: 0s; }
        .icon-2 { bottom: 20%; left: 0%; animation-delay: 1s; }
        .icon-3 { top: 40%; left: -10%; animation-delay: 2s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0); }
            50% { transform: translateY(-15px) rotate(10deg); }
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 18px;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.06);
        }

        .stat-card-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            display: block;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.6rem;
            font-weight: 800;
            color: #2d2d2d;
            margin-bottom: 0.5rem;
        }

        .stat-trend {
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.6rem;
            border-radius: 8px;
        }

        .trend-up { background: #ecfdf5; color: #10b981; }
        .trend-down { background: #fff1f2; color: #f43f5e; }
        .trend-neutral { background: #faf8ed; color: #89986d; }

        .stat-icon-box {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* Content Grid & Glass Cards */
        .content-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .glass-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border: 1px solid #f1f5f9;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .card-header-premium {
            padding: 1.75rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f1f5f9;
        }

        .card-title-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .card-icon-main {
            width: 42px;
            height: 42px;
            background: #faf8ed;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #89986d;
        }

        .card-title-premium {
            font-size: 1.35rem;
            font-weight: 800;
            color: #2d2d2d;
        }

        .btn-link {
            color: #64748b;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }

        .btn-link:hover {
            color: #2d2d2d;
            transform: translateX(5px);
        }

        .btn-icon-only {
            width: 38px;
            height: 38px;
            background: #faf8ed;
            color: #89986d;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .btn-icon-only:hover {
            background: #c5d89d;
            color: white;
            transform: scale(1.1);
        }

        .card-body-premium {
            padding: 1.5rem 2rem 2rem;
        }

        /* Transactions Styles */
        .transaction-list-premium {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .transaction-item-premium {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem;
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid #f8fafc;
            transition: all 0.3s ease;
        }

        .transaction-item-premium:hover {
            background: #fafafa;
            border-color: #e2e8f0;
            transform: scale(1.01);
        }

        .item-left {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .icon-wrapper.income { background: #ecfdf5; color: #10b981; }
        .icon-wrapper.expense { background: #fff1f2; color: #f43f5e; }

        .item-title {
            font-weight: 700;
            color: #2d2d2d;
            font-size: 1.05rem;
            margin-bottom: 0.15rem;
        }

        .item-date {
            font-size: 0.85rem;
            color: #64748b;
        }

        .item-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .item-amount {
            font-weight: 800;
            font-size: 1.1rem;
        }

        .item-amount.income { color: #10b981; }
        .item-amount.expense { color: #f43f5e; }

        .arrow-icon {
            color: #cbd5e1;
            font-size: 0.8rem;
        }

        /* Targets Styles */
        .target-list-premium {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .target-info-premium {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 0.75rem;
        }

        .target-name-premium {
            font-weight: 700;
            color: #2d2d2d;
        }

        .target-pct-premium {
            font-weight: 800;
            color: #89986d;
        }

        .progress-track-premium {
            height: 10px;
            background: #f1f5f9;
            border-radius: 50px;
            overflow: hidden;
        }

        .progress-bar-premium {
            height: 100%;
            border-radius: 50px;
            transition: width 1s ease;
        }

        .bg-success { background: #10b981; }
        .bg-info { background: #0ea5e9; }
        .bg-warning { background: #f59e0b; }

        .target-footer-premium {
            margin-top: 0.5rem;
            display: flex;
            justify-content: flex-end;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .current-amount { color: #2d2d2d; }
        .target-amount { color: #64748b; }

        /* Empty States */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #94a3b8;
        }

        .empty-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .content-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .welcome-hero { padding: 2rem; }
            .hero-content { flex-direction: column; text-align: left; align-items: flex-start; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>

</x-app-layout>
