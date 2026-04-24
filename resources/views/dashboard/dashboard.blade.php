<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - MyPocket</title>
    
    {{-- Fonts & Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* --- RESET & BASE --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; line-height: 1.6; color: #333; background: #f8fafc; }
        a { text-decoration: none; }
        ul { list-style: none; }

        /* ==================== LAYOUT ==================== */
        .dashboard-wrapper { display: flex; min-height: 100vh; }

        /* ==================== SIDEBAR ==================== */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1e40af 0%, #1e3a8a 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-header .logo {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-header .logo i { color: #93c5fd; }

        .sidebar-menu { padding: 1.5rem 1rem; }
        .sidebar-menu .menu-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #93c5fd;
            margin-bottom: 0.75rem;
            padding-left: 0.75rem;
        }

        .sidebar-menu ul { margin-bottom: 1.5rem; }
        .sidebar-menu li { margin-bottom: 0.25rem; }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #bfdbfe;
            border-radius: 12px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .sidebar-menu a i { width: 20px; text-align: center; }

        .sidebar-menu a .badge {
            margin-left: auto;
            background: #ef4444;
            color: white;
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 50px;
        }

        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: auto;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .user-details h4 { font-size: 0.95rem; font-weight: 600; }
        .user-details p { font-size: 0.8rem; color: #93c5fd; }

        .btn-logout {
            width: 100%;
            padding: 0.75rem;
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.3);
            color: white;
        }

        /* ==================== MAIN CONTENT ==================== */
        .main-content {
            flex: 1;
            margin-left: 280px;
            transition: margin-left 0.3s ease;
        }

        /* ==================== TOP HEADER ==================== */
        .top-header {
            background: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-left { display: flex; align-items: center; gap: 1rem; }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #1e40af;
            cursor: pointer;
        }

        .page-title h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e3a8a;
        }

        .page-title p {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .header-right { display: flex; align-items: center; gap: 1rem; }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.9rem;
            width: 250px;
            transition: all 0.3s;
            background: #f9fafb;
        }

        .search-box input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .notification-btn {
            position: relative;
            background: #f3f4f6;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-btn:hover { background: #e5e7eb; }
        .notification-btn i { font-size: 1.2rem; color: #6b7280; }

        .notification-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 10px;
            height: 10px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid white;
        }

        /* ==================== DASHBOARD CONTENT ==================== */
        .dashboard-content { padding: 2rem; }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
        }

        .stat-card.balance::before { background: #3b82f6; }
        .stat-card.income::before { background: #10b981; }
        .stat-card.expense::before { background: #ef4444; }
        .stat-card.savings::before { background: #f59e0b; }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .stat-card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-card.balance .stat-card-icon { background: #dbeafe; color: #3b82f6; }
        .stat-card.income .stat-card-icon { background: #d1fae5; color: #10b981; }
        .stat-card.expense .stat-card-icon { background: #fee2e2; color: #ef4444; }
        .stat-card.savings .stat-card-icon { background: #fef3c7; color: #f59e0b; }

        .stat-card-trend {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .stat-card-trend.up { color: #10b981; }
        .stat-card-trend.down { color: #ef4444; }

        .stat-card-label {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .stat-card-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e3a8a;
        }

        /* Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .chart-card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .chart-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e3a8a;
        }

        .chart-actions {
            display: flex;
            gap: 0.5rem;
        }

        .chart-actions button {
            padding: 0.4rem 0.75rem;
            border: 1px solid #e5e7eb;
            background: white;
            border-radius: 8px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .chart-actions button.active,
        .chart-actions button:hover {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .chart-placeholder {
            height: 250px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
        }

        /* Transactions Table */
        .transactions-card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .transactions-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .transactions-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e3a8a;
        }

        .btn-view-all {
            color: #3b82f6;
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .btn-view-all:hover { color: #1d4ed8; }

        .transaction-table {
            width: 100%;
            border-collapse: collapse;
        }

        .transaction-table th {
            text-align: left;
            padding: 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            border-bottom: 2px solid #e5e7eb;
        }

        .transaction-table td {
            padding: 1rem;
            border-bottom: 1px solid #f3f4f6;
            font-size: 0.9rem;
        }

        .transaction-table tr:hover { background: #f9fafb; }

        .transaction-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .transaction-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .transaction-icon.food { background: #fef3c7; color: #f59e0b; }
        .transaction-icon.transport { background: #dbeafe; color: #3b82f6; }
        .transaction-icon.shopping { background: #fce7f3; color: #ec4899; }
        .transaction-icon.salary { background: #d1fae5; color: #10b981; }
        .transaction-icon.entertainment { background: #e0e7ff; color: #6366f1; }

        .transaction-details h4 {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.25rem;
        }

        .transaction-details p {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .transaction-amount {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .transaction-amount.income { color: #10b981; }
        .transaction-amount.expense { color: #ef4444; }

        .transaction-status {
            padding: 0.3rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .transaction-status.completed { background: #d1fae5; color: #10b981; }
        .transaction-status.pending { background: #fef3c7; color: #f59e0b; }
        .transaction-status.failed { background: #fee2e2; color: #ef4444; }

        /* Savings Goals */
        .savings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .savings-card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .savings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .savings-header h4 {
            font-size: 1rem;
            font-weight: 600;
            color: #1e3a8a;
        }

        .savings-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .savings-icon.house { background: #dbeafe; color: #3b82f6; }
        .savings-icon.car { background: #fef3c7; color: #f59e0b; }
        .savings-icon.travel { background: #d1fae5; color: #10b981; }

        .savings-progress {
            margin-bottom: 1rem;
        }

        .progress-bar {
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .progress-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .progress-fill.blue { background: linear-gradient(90deg, #3b82f6, #2563eb); }
        .progress-fill.yellow { background: linear-gradient(90deg, #f59e0b, #d97706); }
        .progress-fill.green { background: linear-gradient(90deg, #10b981, #059669); }

        .savings-amounts {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
        }

        .savings-amounts span { color: #6b7280; }
        .savings-amounts strong { color: #1e3a8a; }

        .savings-percentage {
            text-align: right;
            font-size: 0.85rem;
            font-weight: 600;
            color: #3b82f6;
        }

        /* Quick Actions */
        .quick-actions {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .quick-actions h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e3a8a;
            margin-bottom: 1.5rem;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .action-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            padding: 1.25rem;
            background: #f8fafc;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .action-btn:hover {
            border-color: #3b82f6;
            background: #eff6ff;
            transform: translateY(-3px);
        }

        .action-btn i {
            font-size: 1.75rem;
            color: #3b82f6;
        }

        .action-btn span {
            font-size: 0.875rem;
            font-weight: 500;
            color: #4b5563;
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 1024px) {
            .charts-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .menu-toggle { display: block; }
            .search-box { display: none; }
            .stats-grid { grid-template-columns: 1fr; }
            .dashboard-content { padding: 1rem; }
            .transaction-table { font-size: 0.85rem; }
            .transaction-table th, .transaction-table td { padding: 0.75rem 0.5rem; }
            .transaction-info { gap: 0.5rem; }
            .transaction-icon { width: 35px; height: 35px; font-size: 1rem; }
        }

        @media (max-width: 480px) {
            .top-header { padding: 1rem; }
            .page-title h1 { font-size: 1.2rem; }
            .stat-card-value { font-size: 1.5rem; }
            .actions-grid { grid-template-columns: repeat(2, 1fr); }
            .savings-grid { grid-template-columns: 1fr; }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        .sidebar-overlay.active { display: block; }
    </style>
</head>
<body>

    <div class="dashboard-wrapper">
        
        <!-- Sidebar Overlay (Mobile) -->
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-wallet"></i>
                    MyPocket
                </div>
            </div>

            <nav class="sidebar-menu">
                <div class="menu-label">Main Menu</div>
                <ul>
                    <li>
                        <a href="#" class="active">
                            <i class="fas fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-chart-line"></i>
                            <span>Transactions</span>
                            <span class="badge">12</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-wallet"></i>
                            <span>Budget</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-piggy-bank"></i>
                            <span>Savings Goals</span>
                        </a>
                    </li>
                </ul>

                <div class="menu-label">Analysis</div>
                <ul>
                    <li>
                        <a href="#">
                            <i class="fas fa-chart-pie"></i>
                            <span>Reports</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-folder-open"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Calendar</span>
                        </a>
                    </li>
                </ul>

                <div class="menu-label">Settings</div>
                <ul>
                    <li>
                        <a href="#">
                            <i class="fas fa-user"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-question-circle"></i>
                            <span>Help Center</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div class="user-details">
                        <h4>{{ Auth::user()->name ?? 'User' }}</h4>
                        <p>{{ Auth::user()->email ?? 'user@email.com' }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            
            <!-- Top Header -->
            <header class="top-header">
                <div class="header-left">
                    <button class="menu-toggle" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="page-title">
                        <h1>Dashboard</h1>
                        <p>Selamat datang kembali, {{ Auth::user()->name ?? 'User' }}!</p>
                    </div>
                </div>
                <div class="header-right">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Cari transaksi...">
                    </div>
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge"></span>
                    </button>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                
                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card balance">
                        <div class="stat-card-header">
                            <div>
                                <p class="stat-card-label">Total Saldo</p>
                                <h2 class="stat-card-value">Rp 12.500.000</h2>
                            </div>
                            <div class="stat-card-icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                        <div class="stat-card-trend up">
                            <i class="fas fa-arrow-up"></i>
                            <span>+12.5% dari bulan lalu</span>
                        </div>
                    </div>

                    <div class="stat-card income">
                        <div class="stat-card-header">
                            <div>
                                <p class="stat-card-label">Pemasukan</p>
                                <h2 class="stat-card-value">Rp 8.200.000</h2>
                            </div>
                            <div class="stat-card-icon">
                                <i class="fas fa-arrow-down"></i>
                            </div>
                        </div>
                        <div class="stat-card-trend up">
                            <i class="fas fa-arrow-up"></i>
                            <span>+8.2% dari bulan lalu</span>
                        </div>
                    </div>

                    <div class="stat-card expense">
                        <div class="stat-card-header">
                            <div>
                                <p class="stat-card-label">Pengeluaran</p>
                                <h2 class="stat-card-value">Rp 4.300.000</h2>
                            </div>
                            <div class="stat-card-icon">
                                <i class="fas fa-arrow-up"></i>
                            </div>
                        </div>
                        <div class="stat-card-trend down">
                            <i class="fas fa-arrow-down"></i>
                            <span>-3.1% dari bulan lalu</span>
                        </div>
                    </div>

                    <div class="stat-card savings">
                        <div class="stat-card-header">
                            <div>
                                <p class="stat-card-label">Tabungan</p>
                                <h2 class="stat-card-value">Rp 3.900.000</h2>
                            </div>
                            <div class="stat-card-icon">
                                <i class="fas fa-piggy-bank"></i>
                            </div>
                        </div>
                        <div class="stat-card-trend up">
                            <i class="fas fa-arrow-up"></i>
                            <span>+15.3% dari bulan lalu</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <h3>Aksi Cepat</h3>
                    <div class="actions-grid">
                        <a href="#" class="action-btn">
                            <i class="fas fa-plus-circle"></i>
                            <span>Tambah Transaksi</span>
                        </a>
                        <a href="#" class="action-btn">
                            <i class="fas fa-file-invoice"></i>
                            <span>Buat Laporan</span>
                        </a>
                        <a href="#" class="action-btn">
                            <i class="fas fa-bullseye"></i>
                            <span>Target Baru</span>
                        </a>
                        <a href="#" class="action-btn">
                            <i class="fas fa-bell"></i>
                            <span>Pengingat</span>
                        </a>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="charts-grid">
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3>Grafik Keuangan</h3>
                            <div class="chart-actions">
                                <button class="active">Minggu</button>
                                <button>Bulan</button>
                                <button>Tahun</button>
                            </div>
                        </div>
                        <div class="chart-placeholder">
                            <div style="text-align: center;">
                                <i class="fas fa-chart-area" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                                <p>Integrasi Chart.js / ApexCharts disini</p>
                            </div>
                        </div>
                    </div>

                    <div class="chart-card">
                        <div class="chart-header">
                            <h3>Kategori Pengeluaran</h3>
                        </div>
                        <div class="chart-placeholder">
                            <div style="text-align: center;">
                                <i class="fas fa-chart-pie" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                                <p>Integrasi Pie Chart disini</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="transactions-card">
                    <div class="transactions-header">
                        <h3>Transaksi Terbaru</h3>
                        <a href="#" class="btn-view-all">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <table class="transaction-table">
                        <thead>
                            <tr>
                                <th>Transaksi</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $transactions = [
                                    ['icon' => 'fa-utensils', 'class' => 'food', 'name' => 'Restaurant ABC', 'category' => 'Makanan', 'date' => 'Hari ini, 14:30', 'status' => 'completed', 'amount' => '- Rp 150.000', 'type' => 'expense'],
                                    ['icon' => 'fa-briefcase', 'class' => 'salary', 'name' => 'Gaji Bulanan', 'category' => 'Gaji', 'date' => 'Hari ini, 09:00', 'status' => 'completed', 'amount' => '+ Rp 8.000.000', 'type' => 'income'],
                                    ['icon' => 'fa-car', 'class' => 'transport', 'name' => 'Bensin', 'category' => 'Transport', 'date' => 'Kemarin, 18:45', 'status' => 'completed', 'amount' => '- Rp 200.000', 'type' => 'expense'],
                                    ['icon' => 'fa-shopping-bag', 'class' => 'shopping', 'name' => 'Supermarket', 'category' => 'Belanja', 'date' => 'Kemarin, 15:20', 'status' => 'pending', 'amount' => '- Rp 450.000', 'type' => 'expense'],
                                    ['icon' => 'fa-film', 'class' => 'entertainment', 'name' => 'Bioskop', 'category' => 'Hiburan', 'date' => '2 hari lalu', 'status' => 'completed', 'amount' => '- Rp 100.000', 'type' => 'expense'],
                                ];
                            @endphp
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>
                                    <div class="transaction-info">
                                        <div class="transaction-icon {{ $transaction['class'] }}">
                                            <i class="fas {{ $transaction['icon'] }}"></i>
                                        </div>
                                        <div class="transaction-details">
                                            <h4>{{ $transaction['name'] }}</h4>
                                            <p>{{ $transaction['category'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $transaction['category'] }}</td>
                                <td>{{ $transaction['date'] }}</td>
                                <td>
                                    <span class="transaction-status {{ $transaction['status'] }}">
                                        {{ ucfirst($transaction['status']) }}
                                    </span>
                                </td>
                                <td class="transaction-amount {{ $transaction['type'] }}">
                                    {{ $transaction['amount'] }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Savings Goals -->
                <div class="savings-grid">
                    <div class="savings-card">
                        <div class="savings-header">
                            <h4>Tabungan Rumah</h4>
                            <div class="savings-icon house">
                                <i class="fas fa-home"></i>
                            </div>
                        </div>
                        <div class="savings-progress">
                            <div class="progress-bar">
                                <div class="progress-fill blue" style="width: 45%;"></div>
                            </div>
                            <div class="savings-amounts">
                                <span>Rp 45.000.000</span>
                                <strong>Rp 100.000.000</strong>
                            </div>
                            <p class="savings-percentage">45% tercapai</p>
                        </div>
                    </div>

                    <div class="savings-card">
                        <div class="savings-header">
                            <h4>Tabungan Mobil</h4>
                            <div class="savings-icon car">
                                <i class="fas fa-car"></i>
                            </div>
                        </div>
                        <div class="savings-progress">
                            <div class="progress-bar">
                                <div class="progress-fill yellow" style="width: 30%;"></div>
                            </div>
                            <div class="savings-amounts">
                                <span>Rp 30.000.000</span>
                                <strong>Rp 100.000.000</strong>
                            </div>
                            <p class="savings-percentage">30% tercapai</p>
                        </div>
                    </div>

                    <div class="savings-card">
                        <div class="savings-header">
                            <h4>Liburan Jepang</h4>
                            <div class="savings-icon travel">
                                <i class="fas fa-plane"></i>
                            </div>
                        </div>
                        <div class="savings-progress">
                            <div class="progress-bar">
                                <div class="progress-fill green" style="width: 70%;"></div>
                            </div>
                            <div class="savings-amounts">
                                <span>Rp 21.000.000</span>
                                <strong>Rp 30.000.000</strong>
                            </div>
                            <p class="savings-percentage">70% tercapai</p>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    {{-- JavaScript --}}
    <script>
        // Toggle Sidebar (Mobile)
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const menuToggle = document.querySelector('.menu-toggle');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            }
        });

        // Chart actions button toggle
        document.querySelectorAll('.chart-actions button').forEach(btn => {
            btn.addEventListener('click', function() {
                this.parentElement.querySelectorAll('button').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Search functionality (placeholder)
        const searchInput = document.querySelector('.search-box input');
        searchInput?.addEventListener('input', function(e) {
            console.log('Searching for:', e.target.value);
            // Implement search logic here
        });

        // Notification click (placeholder)
        document.querySelector('.notification-btn')?.addEventListener('click', function() {
            alert('🔔 Anda memiliki 3 notifikasi baru!');
        });

        // Quick action buttons
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const action = this.querySelector('span').textContent;
                console.log('Quick action clicked:', action);
                // Implement action logic here
            });
        });

        // Add animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            console.log('✅ MyPocket Dashboard Loaded Successfully');
            console.log('👤 User:', '{{ Auth::user()->name ?? "Guest" }}');
            console.log('📅 Date:', new Date().toLocaleDateString('id-ID'));
        });

        // Add keyboard shortcut for search (Ctrl+K)
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                searchInput?.focus();
            }
        });

        // Add tooltip functionality (optional enhancement)
        function showTooltip(element, message) {
            // Implement tooltip logic here
        }

        // Auto-refresh data every 5 minutes (optional)
        setInterval(function() {
            console.log('Auto-refreshing dashboard data...');
            // Implement data refresh logic here
        }, 300000);

        // Add loading state for actions
        function setLoading(element, isLoading) {
            if (isLoading) {
                element.style.opacity = '0.7';
                element.style.pointerEvents = 'none';
            } else {
                element.style.opacity = '1';
                element.style.pointerEvents = 'auto';
            }
        }

        // Export functionality (placeholder)
        function exportData(format) {
            console.log('Exporting data as:', format);
            alert('📥 Fitur export akan segera hadir!');
        }

        // Print dashboard
        function printDashboard() {
            window.print();
        }

        // Add print styles
        const printStyle = document.createElement('style');
        printStyle.textContent = `
            @media print {
                .sidebar, .top-header, .quick-actions, .notification-btn { display: none !important; }
                .main-content { margin-left: 0 !important; }
                .dashboard-content { padding: 0 !important; }
            }
        `;
        document.head.appendChild(printStyle);

        // Track page view (analytics placeholder)
        function trackPageView() {
            console.log('📊 Dashboard page viewed');
            // Implement analytics tracking here
        }
        trackPageView();

        // Add session timeout warning
        let sessionTimeout;
        function resetSessionTimeout() {
            clearTimeout(sessionTimeout);
            sessionTimeout = setTimeout(function() {
                console.log('⚠️ Session timeout warning');
                // Implement session timeout logic here
            }, 1800000); // 30 minutes
        }

        // Reset timeout on user activity
        ['mousemove', 'keydown', 'click', 'scroll'].forEach(event => {
            document.addEventListener(event, resetSessionTimeout, true);
        });
        resetSessionTimeout();

        // Add dark mode toggle (optional future feature)
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            console.log('Dark mode toggled');
        }

        // Check for updates (placeholder)
        function checkForUpdates() {
            console.log('Checking for updates...');
            // Implement update check logic here
        }
        setTimeout(checkForUpdates, 5000);

        // Add error boundary for JavaScript errors
        window.addEventListener('error', function(e) {
            console.error('Dashboard JavaScript error:', e.error);
        });

        // Add unhandled promise rejection handler
        window.addEventListener('unhandledrejection', function(e) {
            console.error('Unhandled promise rejection:', e.reason);
        });

        console.log('🚀 MyPocket Dashboard Ready!');
        console.log('💡 Tip: Press Ctrl+K to quick search');
    </script>

</body>
</html>