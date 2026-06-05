<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar - MyPocket</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            color: #333;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 2rem 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 0 1.5rem 2rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 1rem;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: bold;
            gap: 0.75rem;
        }

        .sidebar-brand i {
            font-size: 2rem;
            color: #fbbf24;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0 1rem;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        .sidebar-menu a i {
            width: 24px;
            font-size: 1.2rem;
        }

        .sidebar-menu a.active {
            background: rgba(255,255,255,0.25);
            font-weight: 600;
        }

        /* ========== MAIN CONTENT (placeholder) ========== */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .placeholder {
            text-align: center;
            color: #94a3b8;
        }

        .placeholder i {
            font-size: 4rem;
            margin-bottom: 1rem;
            display: block;
        }

        /* ========== MOBILE TOGGLE ========== */
        .menu-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: #3b82f6;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
        <!-- ========== SIDEBAR ========== -->
       <aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-brand">
            <i class="fas fa-wallet"></i>
            <span>MyPocket</span>
        </div>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard') }}" 
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('transactions.index') }}" 
               class="{{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                <i class="fas fa-exchange-alt"></i>
                <span>Transactions</span>
            </a>
        </li>
        <li>
            <a href="{{ route('targets.index') }}" 
               class="{{ request()->routeIs('targets.*') ? 'active' : '' }}">
                <i class="fas fa-bullseye"></i>
                <span>Targets</span>
            </a>
        </li>
        <li>
            <a href="{{ route('reminders.index') }}" 
               class="{{ request()->routeIs('reminders.*') ? 'active' : '' }}">
                <i class="fas fa-bell"></i>
                <span>Reminders</span>
            </a>
        </li>
        <li>
            <a href="{{ route('badges.index') }}" 
               class="{{ request()->routeIs('badges.*') ? 'active' : '' }}">
                <i class="fas fa-award"></i>
                <span>Badges</span>
            </a>
        </li>
        <li style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </li>
    </ul>
</aside>

      
      
    </div>

    <script>
        // Toggle sidebar on mobile
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

        // Set active menu item
        function setActive(el) {
            document.querySelectorAll('.sidebar-menu a').forEach(a => a.classList.remove('active'));
            el.classList.add('active');

            // Close sidebar on mobile after click
            if (window.innerWidth <= 768) {
                document.getElementById('sidebar').classList.remove('active');
            }
        }
    </script>

</body>
</html>