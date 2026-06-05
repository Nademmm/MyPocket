<x-app-layout title="Dashboard">

    @php
        $initials = substr(Auth::user()->name, 0, 1);
        if ($spacePos = strpos(Auth::user()->name, ' ')) {
            $initials .= substr(Auth::user()->name, $spacePos + 1, 1);
        }
        $totalSaved = Auth::user()->total_saved ?? 0;
    @endphp

    {{-- Header --}}
    <div class="header">
        <div>
            <h1 class="text-3xl font-bold text-blue-900 mb-1">Dashboard</h1>
            <p style="color: #64748b;">Selamat datang kembali, {{ Auth::user()->name }}! Berikut ringkasan keuangan Anda.</p>
        </div>
        <div class="user-info">
            <div style="text-align: right;">
                <div style="font-weight: 600;">{{ Auth::user()->name }}</div>
                <div style="font-size: 0.85rem; color: #64748b;">{{ ucfirst(Auth::user()->role) }} Member</div>
            </div>
            <div class="user-avatar">{{ $initials }}</div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="stats-grid">
        <div class="stat-card income">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Total Pendapatan</div>
                    <div class="stat-value">Rp {{ number_format($income, 0, ',', '.') }}</div>
                    <div class="stat-change positive"><i class="fas fa-arrow-down"></i> Pendapatan masuk</div>
                </div>
                <div class="stat-icon"><i class="fas fa-arrow-down"></i></div>
            </div>
        </div>
        <div class="stat-card expense">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Total Pengeluaran</div>
                    <div class="stat-value">Rp {{ number_format($expense, 0, ',', '.') }}</div>
                    <div class="stat-change negative"><i class="fas fa-arrow-up"></i> Pengeluaran keluar</div>
                </div>
                <div class="stat-icon"><i class="fas fa-arrow-up"></i></div>
            </div>
        </div>
        <div class="stat-card balance">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Saldo</div>
                    <div class="stat-value">Rp {{ number_format($balance, 0, ',', '.') }}</div>
                    <div class="stat-change {{ $balance >= 0 ? 'positive' : 'negative' }}"><i class="fas fa-check"></i> {{ $balance >= 0 ? 'Sehat' : 'Defisit' }}</div>
                </div>
                <div class="stat-icon"><i class="fas fa-wallet"></i></div>
            </div>
        </div>
        <div class="stat-card savings">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Total Tabungan</div>
                    <div class="stat-value">Rp {{ number_format($totalSaved, 0, ',', '.') }}</div>
                    <div class="stat-change positive"><i class="fas fa-piggy-bank"></i> Level {{ Auth::user()->level }}</div>
                </div>
                <div class="stat-icon"><i class="fas fa-piggy-bank"></i></div>
            </div>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="content-grid">
        {{-- Recent Transactions --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Transaksi Terakhir</h3>
                <a href="{{ route('transactions.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
            </div>

            @if($recentTransactions->count())
                <ul class="transaction-list">
                    @foreach($recentTransactions as $t)
                    <li class="transaction-item">
                        <div class="transaction-icon {{ $t->type }}"><i class="fas fa-{{ $t->type == 'income' ? 'arrow-down' : 'shopping-cart' }}"></i></div>
                        <div class="transaction-details">
                            <div class="transaction-title">{{ $t->description ?: ucfirst($t->type) }}</div>
                            <div class="transaction-date">{{ $t->transaction_date->format('d M Y, H:i') }}</div>
                        </div>
                        <div class="transaction-amount {{ $t->type }}">{{ $t->type == 'income' ? '+' : '-' }}Rp {{ number_format($t->amount, 0, ',', '.') }}</div>
                    </li>
                    @endforeach
                </ul>
            @else
                <div style="text-align: center; padding: 2rem; color: #94a3b8;">
                    <i class="fas fa-exchange-alt" style="font-size: 2rem; margin-bottom: 0.5rem; display: block;"></i>
                    Belum ada transaksi
                </div>
            @endif
        </div>

        {{-- Targets & Reminders --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Target Tabungan</h3>
                <a href="{{ route('targets.index') }}" class="btn btn-primary btn-sm">+ Tambah</a>
            </div>

            @if($targets->count())
                <ul class="target-list">
                    @foreach($targets as $target)
                    @php $pct = $target->target_amount > 0 ? min(100, ($target->current_amount / $target->target_amount) * 100) : 0; @endphp
                    <li class="target-item">
                        <div class="target-header">
                            <span class="target-name">{{ $target->title }}</span>
                            <span class="target-progress">Rp {{ number_format($target->current_amount, 0, ',', '.') }} / Rp {{ number_format($target->target_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill {{ $pct >= 100 ? 'green' : ($pct >= 50 ? 'blue' : 'orange') }}" style="width: {{ $pct }}%"></div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            @else
                <div style="text-align: center; padding: 2rem; color: #94a3b8;">
                    <i class="fas fa-bullseye" style="font-size: 2rem; margin-bottom: 0.5rem; display: block;"></i>
                    Belum ada target
                </div>
            @endif

            <div style="margin-top: 2rem;">
                <h3 class="card-title" style="margin-bottom: 1rem;">Pengingat</h3>
                @if($reminders->count())
                    <ul class="reminder-list">
                        @foreach($reminders as $reminder)
                        <li class="reminder-item @if($reminder->is_active && now()->diffInDays($reminder->remind_date, false) <= 1) urgent @endif">
                            <i class="fas fa-{{ $reminder->is_active && now()->diffInDays($reminder->remind_date, false) <= 1 ? 'exclamation-triangle' : 'bell' }} reminder-icon"></i>
                            <div class="reminder-content">
                                <div class="reminder-title">{{ $reminder->title }}</div>
                                <div class="reminder-time">{{ $reminder->remind_date->format('d M Y') }}</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <div style="text-align: center; padding: 1rem; color: #94a3b8;">
                        <i class="fas fa-bell" style="font-size: 1.5rem; margin-bottom: 0.5rem; display: block;"></i>
                        Tidak ada pengingat
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: white;
            padding: 1.5rem 2rem;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #1e3a8a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card.income { border-left: 4px solid #10b981; }
        .stat-card.expense { border-left: 4px solid #ef4444; }
        .stat-card.balance { border-left: 4px solid #3b82f6; }
        .stat-card.savings { border-left: 4px solid #f59e0b; }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-card.income .stat-icon { background: #d1fae5; color: #10b981; }
        .stat-card.expense .stat-icon { background: #fee2e2; color: #ef4444; }
        .stat-card.balance .stat-icon { background: #dbeafe; color: #3b82f6; }
        .stat-card.savings .stat-icon { background: #fef3c7; color: #f59e0b; }

        .stat-label {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #1e293b;
        }

        .stat-change {
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .stat-change.positive { color: #10b981; }
        .stat-change.negative { color: #ef4444; }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.2rem;
            color: #1e293b;
            font-weight: 600;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary { background: #3b82f6; color: white; }
        .btn-primary:hover { background: #2563eb; }
        .btn-sm { padding: 0.4rem 0.8rem; font-size: 0.85rem; }

        .transaction-list { list-style: none; }

        .transaction-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.3s;
        }

        .transaction-item:hover {
            background: #f8fafc;
            border-radius: 8px;
        }

        .transaction-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .transaction-icon.income { background: #d1fae5; color: #10b981; }
        .transaction-icon.expense { background: #fee2e2; color: #ef4444; }

        .transaction-details { flex: 1; }

        .transaction-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .transaction-date { font-size: 0.85rem; color: #64748b; }

        .transaction-amount { font-weight: bold; font-size: 1.1rem; }
        .transaction-amount.income { color: #10b981; }
        .transaction-amount.expense { color: #ef4444; }

        .target-list { list-style: none; }

        .target-item { margin-bottom: 1.5rem; }

        .target-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .target-name { font-weight: 600; color: #1e293b; }
        .target-progress { font-size: 0.9rem; color: #64748b; }

        .progress-bar {
            height: 10px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        .progress-fill.green { background: linear-gradient(90deg, #10b981, #34d399); }
        .progress-fill.blue { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
        .progress-fill.orange { background: linear-gradient(90deg, #f59e0b, #fbbf24); }

        .reminder-list { list-style: none; }

        .reminder-item {
            display: flex;
            align-items: flex-start;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 10px;
            margin-bottom: 0.75rem;
            border-left: 4px solid #f59e0b;
        }

        .reminder-item.urgent {
            border-left-color: #ef4444;
            background: #fef2f2;
        }

        .reminder-icon { margin-right: 1rem; font-size: 1.2rem; color: #f59e0b; }
        .reminder-item.urgent .reminder-icon { color: #ef4444; }

        .reminder-content { flex: 1; }

        .reminder-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .reminder-time { font-size: 0.85rem; color: #64748b; }

        @media (max-width: 768px) {
            .content-grid { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>

</x-app-layout>
