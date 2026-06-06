<x-app-layout title="Dashboard">

    @php
        $initials = substr(Auth::user()->name, 0, 1);
        if ($spacePos = strpos(Auth::user()->name, ' ')) {
            $initials .= substr(Auth::user()->name, $spacePos + 1, 1);
        }
        $totalSaved = Auth::user()->total_saved ?? 0;
    @endphp

    {{-- Stats Cards --}}
    <div class="stats-grid">
        <div class="stat-card income-card">
            <div class="stat-card-inner">
                <div class="stat-info">
                    <span class="stat-label">Total Pendapatan</span>
                    <h2 class="stat-value">Rp {{ number_format($income, 0, ',', '.') }}</h2>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-chart-line mr-1"></i> <span>Bulan ini</span>
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
                    <span class="stat-label">Total Pengeluaran</span>
                    <h2 class="stat-value">Rp {{ number_format($expense, 0, ',', '.') }}</h2>
                    <div class="stat-trend trend-down">
                        <i class="fas fa-chart-line mr-1"></i> <span>Bulan ini</span>
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
                    <span class="stat-label">Saldo Aktif</span>
                    <h2 class="stat-value">Rp {{ number_format($balance, 0, ',', '.') }}</h2>
                    <div class="stat-trend {{ $balance >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="fas fa-{{ $balance >= 0 ? 'shield-check' : 'triangle-exclamation' }} mr-1"></i> 
                        <span>{{ $balance >= 0 ? 'Dompet Aman' : 'Defisit' }}</span>
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
                    <span class="stat-label">Total Tabungan</span>
                    <h2 class="stat-value">Rp {{ number_format($totalSaved, 0, ',', '.') }}</h2>
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
                    <h3 class="card-title-premium">Transaksi Terakhir</h3>
                </div>
                <a href="{{ route('transactions.index') }}" class="btn-link">
                    Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
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
                        <p>Belum ada transaksi</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Targets & Reminders --}}
        <div class="glass-card">
            <div class="card-header-premium">
                <div class="card-title-group">
                    <div class="card-icon-main"><i class="fas fa-bullseye text-theme"></i></div>
                    <h3 class="card-title-premium">Target Tabungan</h3>
                </div>
                <a href="{{ route('targets.create') }}" class="btn-icon-only" title="Tambah Target">
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
                        <p>Belum ada target</p>
                    </div>
                @endif

                <div class="divider-premium"></div>

                <div class="reminders-section">
                    <div class="card-header-premium p-0 mb-4">
                        <div class="card-title-group">
                            <div class="card-icon-main"><i class="fas fa-bell text-theme"></i></div>
                            <h3 class="card-title-premium">Pengingat</h3>
                        </div>
                    </div>

                    @if($reminders->count())
                        <div class="reminder-list-premium">
                            @foreach($reminders as $reminder)
                            <div class="reminder-item-premium {{ $reminder->is_active && now()->diffInDays($reminder->remind_date, false) <= 1 ? 'urgent' : '' }}">
                                <div class="reminder-icon-box">
                                    <i class="fas fa-{{ $reminder->is_active && now()->diffInDays($reminder->remind_date, false) <= 1 ? 'exclamation-circle' : 'clock' }}"></i>
                                </div>
                                <div class="reminder-details-premium">
                                    <h4 class="reminder-title-premium">{{ $reminder->title }}</h4>
                                    <span class="reminder-date-premium">{{ $reminder->remind_date->format('d M Y') }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state-mini">
                            <p>Tidak ada pengingat</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
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
            --shadow-btn: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Hero Section Refined */
        .welcome-hero {
            background: linear-gradient(135deg, #ffffff 0%, #fdfdfa 100%);
            border-radius: var(--radius-xl);
            padding: 2.5rem 3rem;
            margin-bottom: 2.5rem;
            box-shadow: var(--shadow-soft);
            border: 1px solid #f1f5f9;
            position: relative;
            overflow: hidden;
        }

        .welcome-hero::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, #c5d89d1a 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 3rem;
            position: relative;
            z-index: 2;
        }

        .date-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.6rem 1.25rem;
            background: var(--theme-green-light);
            color: var(--theme-green-dark);
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            border: 1px solid #c5d89d33;
            letter-spacing: 0.02em;
        }

        .hero-greeting {
            font-size: 2.75rem;
            font-weight: 800;
            color: var(--theme-charcoal);
            margin-bottom: 1rem;
            letter-spacing: -0.03em;
            line-height: 1.1;
        }

        .text-theme { color: var(--theme-green-dark); }

        .hero-subtitle {
            color: var(--theme-slate);
            font-size: 1.15rem;
            max-width: 550px;
            line-height: 1.7;
            margin-bottom: 2.5rem;
        }

        .highlight {
            color: var(--theme-charcoal);
            font-weight: 800;
            background: linear-gradient(to bottom, transparent 60%, #c5d89d4d 60%);
        }

        /* Premium Buttons */
        .quick-actions {
            display: flex;
            gap: 1.25rem;
        }

        .btn-action {
            padding: 0.9rem 1.75rem;
            border-radius: 16px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            font-size: 1rem;
            border: 1px solid transparent;
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
            background: var(--theme-charcoal);
            color: white;
            box-shadow: var(--shadow-btn);
        }

        .btn-primary-theme:hover {
            background: #000;
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 12px 24px rgba(0,0,0,0.2);
        }

        .btn-secondary-theme {
            background: white;
            color: var(--theme-charcoal);
            border-color: #e2e8f0;
        }

        .btn-secondary-theme:hover {
            background: #fafafa;
            border-color: var(--theme-green);
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.05);
        }

        /* Profile Card Hero */
        .user-profile-card {
            background: white;
            padding: 1.5rem 2rem;
            border-radius: var(--radius-lg);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.25rem;
            border: 1px solid #f1f5f9;
            width: 240px;
            text-align: center;
        }

        .avatar-container {
            position: relative;
        }

        .hero-avatar {
            width: 80px;
            height: 80px;
            border-radius: 24px;
            background: linear-gradient(135deg, var(--theme-green), var(--theme-green-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--theme-charcoal);
            font-weight: 900;
            font-size: 2rem;
            box-shadow: 0 8px 20px rgba(197, 216, 157, 0.5);
        }

        .status-indicator {
            position: absolute;
            bottom: -5px;
            right: -5px;
            width: 20px;
            height: 20px;
            background: var(--theme-emerald);
            border: 4px solid white;
            border-radius: 50%;
        }

        .badge-theme {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.85rem;
            background: var(--theme-green-light);
            color: var(--theme-green-dark);
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-top: 0.5rem;
        }

        /* Stats Cards Redesign */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 1.75rem;
            box-shadow: var(--shadow-soft);
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.06);
        }

        .stat-card-inner {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            position: relative;
            z-index: 2;
        }

        .stat-label {
            color: var(--theme-slate);
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: block;
            margin-bottom: 0.75rem;
        }

        .stat-value {
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--theme-charcoal);
            letter-spacing: -0.02em;
            margin-bottom: 0.75rem;
        }

        .stat-trend {
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.6rem;
            border-radius: 8px;
        }

        .trend-up { background: #ecfdf5; color: var(--theme-emerald); }
        .trend-down { background: #fff1f2; color: var(--theme-rose); }
        .trend-neutral { background: var(--theme-green-light); color: var(--theme-green-dark); }

        .stat-icon-box {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .stat-card:hover .stat-icon-box {
            transform: rotate(10deg) scale(1.1);
        }

        /* Content Grid & Glass Cards */
        .content-grid {
            display: grid;
            grid-template-columns: 1.8fr 1.2fr;
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .glass-card {
            background: white;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-soft);
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
            background: var(--theme-green-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .card-title-premium {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--theme-charcoal);
            letter-spacing: -0.02em;
        }

        .btn-link {
            color: var(--theme-slate);
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }

        .btn-link:hover {
            color: var(--theme-charcoal);
            transform: translateX(5px);
        }

        .btn-icon-only {
            width: 38px;
            height: 38px;
            background: var(--theme-green-light);
            color: var(--theme-green-dark);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .btn-icon-only:hover {
            background: var(--theme-green);
            color: var(--theme-charcoal);
            transform: scale(1.1);
        }

        .card-body-premium {
            padding: 1.5rem 2rem 2rem;
        }

        /* Transactions Premium */
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
            border-radius: var(--radius-lg);
            border: 1px solid #f8fafc;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .transaction-item-premium:hover {
            background: #fafafa;
            border-color: #e2e8f0;
            transform: scale(1.01);
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
        }

        .item-left {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .icon-wrapper {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .icon-wrapper.income { background: #ecfdf5; color: var(--theme-emerald); }
        .icon-wrapper.expense { background: #fff1f2; color: var(--theme-rose); }

        .item-title {
            font-weight: 700;
            color: var(--theme-charcoal);
            font-size: 1.05rem;
            margin-bottom: 0.25rem;
        }

        .item-date {
            font-size: 0.85rem;
            color: var(--theme-slate);
            font-weight: 500;
        }

        .item-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .item-amount {
            font-weight: 800;
            font-size: 1.15rem;
        }

        .item-amount.income { color: var(--theme-emerald); }
        .item-amount.expense { color: var(--theme-rose); }

        .arrow-icon {
            color: #cbd5e1;
            font-size: 0.8rem;
            transition: all 0.3s;
        }

        .transaction-item-premium:hover .arrow-icon {
            color: var(--theme-charcoal);
            transform: translateX(3px);
        }

        /* Targets Premium */
        .target-list-premium {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .target-info-premium {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 1rem;
        }

        .target-name-premium {
            font-weight: 700;
            color: var(--theme-charcoal);
            font-size: 1.1rem;
        }

        .target-pct-premium {
            font-weight: 800;
            color: var(--theme-green-dark);
            font-size: 1.1rem;
        }

        .progress-track-premium {
            height: 14px;
            background: #f1f5f9;
            border-radius: 50px;
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
        }

        .progress-bar-premium {
            height: 100%;
            border-radius: 50px;
            transition: width 1s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .bg-success { background: linear-gradient(90deg, #10b981, #34d399); }
        .bg-info { background: linear-gradient(90deg, #0ea5e9, #38bdf8); }
        .bg-warning { background: linear-gradient(90deg, #f59e0b, #fbbf24); }

        .target-footer-premium {
            margin-top: 0.75rem;
            display: flex;
            justify-content: flex-end;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .current-amount { color: var(--theme-charcoal); }
        .target-amount { color: var(--theme-slate); }

        .divider-premium {
            height: 1px;
            background: #f1f5f9;
            margin: 2.5rem 0;
        }

        /* Reminders Premium */
        .reminder-list-premium {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .reminder-item-premium {
            display: flex;
            align-items: center;
            padding: 1.25rem;
            background: var(--theme-green-light);
            border-radius: var(--radius-lg);
            border: 1px solid #c5d89d33;
            transition: all 0.3s;
        }

        .reminder-item-premium.urgent {
            background: #fff1f2;
            border-color: #fecaca;
        }

        .reminder-icon-box {
            width: 44px;
            height: 44px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.25rem;
            font-size: 1.1rem;
            color: var(--theme-green-dark);
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        .reminder-item-premium.urgent .reminder-icon-box {
            color: var(--theme-rose);
        }

        .reminder-title-premium {
            font-weight: 700;
            color: var(--theme-charcoal);
            font-size: 1rem;
            margin-bottom: 0.15rem;
        }

        .reminder-date-premium {
            font-size: 0.8rem;
            color: var(--theme-slate);
            font-weight: 600;
        }

        /* Empty States */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #94a3b8;
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            opacity: 0.3;
        }

        .empty-state-mini {
            text-align: center;
            padding: 1.5rem;
            color: #94a3b8;
            background: #f8fafc;
            border-radius: 16px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .content-grid { grid-template-columns: 1fr; }
            .hero-greeting { font-size: 2.25rem; }
        }
        
        @media (max-width: 768px) {
            .welcome-hero { padding: 2rem; }
            .hero-content { flex-direction: column-reverse; text-align: center; }
            .hero-subtitle { margin: 0 auto 2rem; }
            .quick-actions { justify-content: center; }
            .user-profile-card { width: 100%; max-width: 300px; }
            .stats-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 480px) {
            .quick-actions { flex-direction: column; }
            .hero-greeting { font-size: 1.85rem; }
            .btn-action { width: 100%; justify-content: center; }
        }
    </style>

</x-app-layout>
