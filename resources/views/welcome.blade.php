<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MyPocket - Master Your Financial Journey</title>
    
    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #c5d89d;
            --primary-dark: #89986d;
            --primary-light: #faf8ed;
            --secondary: #2d2d2d;
            --text-muted: #64748b;
            --white: #ffffff;
            --shadow: 0 20px 40px rgba(0,0,0,0.06);
            --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body.landing-body {
            background-color: var(--white);
            color: var(--secondary);
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Navigation */
        .landing-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 8%;
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            z-index: 1000;
            border-bottom: 1px solid rgba(197, 216, 157, 0.15);
            transition: var(--transition);
        }

        .landing-logo {
            font-size: 1.6rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: var(--secondary);
            letter-spacing: -0.02em;
        }

        .landing-logo i {
            color: var(--primary-dark);
            font-size: 1.8rem;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 3rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--secondary);
            font-weight: 600;
            font-size: 0.95rem;
            transition: var(--transition);
            opacity: 0.8;
        }

        .nav-links a:hover {
            color: var(--primary-dark);
            opacity: 1;
        }

        .auth-links {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .btn-login {
            text-decoration: none;
            color: var(--secondary);
            font-weight: 700;
            font-size: 0.95rem;
            padding: 0.75rem 1.25rem;
            transition: var(--transition);
        }

        .btn-login:hover {
            color: var(--primary-dark);
        }

        .btn-register {
            text-decoration: none;
            background: var(--secondary);
            color: var(--white);
            padding: 0.85rem 1.75rem;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: var(--transition);
            box-shadow: 0 10px 20px rgba(45, 45, 45, 0.15);
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(45, 45, 45, 0.2);
            background: #1a1a1a;
        }

        /* Hero Section */
        .hero {
            padding: 12rem  8rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 100vh;
            position: relative;
            background-color: white !important;
            text-align: left !important;
        }

        .hero-content {
            flex: 1;
            max-width: 650px;
            position: relative;
            z-index: 1;
            display: flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            text-align: left !important;
        }

        .hero-content h1 {
            font-size: 4.2rem;
            font-weight: 900;
            line-height: 1.05;
            margin-bottom: 1.75rem;
            letter-spacing: -0.05em;
            color: var(--secondary);
            text-align: left !important;
            width: 100%;
        }

        .hero-content h1 span {
            color: var(--primary-dark);
            background: linear-gradient(to right, var(--primary-dark), #6b7854);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-content p {
            font-size: 1.25rem;
            color: #e5e5e5ff;
            line-height: 1.7;
            margin-bottom: 3rem;
            max-width: 550px;
            text-align: left !important;
            margin-left: 0 !important;
        }

        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            justify-content: flex-start !important;
            width: 100%;
        }

        .btn-hero-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: var(--secondary);
            color: var(--white);
            padding: 1.2rem 2.5rem;
            border-radius: 18px;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.1rem;
            transition: var(--transition);
            box-shadow: 0 20px 40px rgba(45, 45, 45, 0.15);
        }

        .btn-hero-primary:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(45, 45, 45, 0.2);
            background: #000;
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            position: relative;
            z-index: 1;
        }

        /* Phone Mockup */
        .phone-mockup {
            width: 340px;
            height: 680px;
            background: #1a1a1a;
            border-radius: 50px;
            padding: 14px;
            box-shadow: 40px 40px 80px rgba(0,0,0,0.15);
            position: relative;
            border: 4px solid #333;
        }

        .phone-screen {
            width: 100%;
            height: 100%;
            background: #fdfdfa;
            border-radius: 38px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .phone-screen::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 25px;
            background: #1a1a1a;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            z-index: 10;
        }

        .app-header {
            background: var(--primary-dark);
            color: var(--white);
            padding: 3.5rem 1.75rem 2rem;
        }

        .app-header h3 { font-size: 1.4rem; font-weight: 800; margin-bottom: 0.5rem; }
        .app-header p { font-size: 0.85rem; opacity: 0.7; font-weight: 500; }

        .app-balance {
            padding: 1.75rem;
            background: var(--white);
            margin: -1.5rem 1.25rem 0;
            border-radius: 24px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .app-balance .amount { font-weight: 900; font-size: 1.2rem; color: var(--secondary); }

        .app-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            padding: 2.5rem 1.75rem;
        }

        .app-feature-item {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 20px;
            text-align: center;
            font-size: 0.85rem;
            font-weight: 700;
            box-shadow: 0 10px 20px rgba(0,0,0,0.03);
            border: 1px solid #f1f5f9;
        }

        .app-feature-item i {
            display: block;
            font-size: 1.5rem;
            color: var(--primary-dark);
            margin-bottom: 0.8rem;
        }

        /* Features Section */
        .features {
            padding: 10rem 8%;
            background: #ffffff;
        }

        .section-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 6rem;
        }

        .section-header .tag {
            color: var(--primary-dark);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-size: 0.85rem;
            margin-bottom: 1rem;
            display: block;
        }

        .section-header h2 {
            font-size: 3.2rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            letter-spacing: -0.04em;
        }

        .section-header p {
            color: var(--text-muted);
            font-size: 1.2rem;
            line-height: 1.7;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2.5rem;
        }

        .feature-card {
            background: var(--white);
            padding: 3.5rem 3rem;
            border-radius: 32px;
            border: 1px solid #f1f5f9;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow);
            border-color: var(--primary);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: var(--primary-light);
            color: var(--primary-dark);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 2.5rem;
            transition: var(--transition);
        }

        .feature-card:hover .feature-icon {
            background: var(--primary-dark);
            color: white;
            transform: rotate(10deg);
        }

        .feature-content h3 {
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 1.25rem;
            letter-spacing: -0.02em;
        }

        .feature-content p {
            color: var(--text-muted);
            line-height: 1.8;
            font-size: 1.05rem;
        }

        /* Stats Section */
        .stats-section {
            padding: 10rem 8%;
            background: var(--secondary);
            color: var(--white);
            border-radius: 60px;
            margin: 0 4rem;
            display: flex;
            align-items: center;
            gap: 6rem;
        }

        .stats-text { flex: 1; }
        .stats-text h2 { font-size: 3.5rem; font-weight: 900; margin-bottom: 2rem; line-height: 1.1; letter-spacing: -0.04em; }
        .stats-text p { font-size: 1.25rem; opacity: 0.7; line-height: 1.8; margin-bottom: 3rem; }

        .stats-numbers {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
        }

        .stat-box h4 {
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            color: var(--primary);
            letter-spacing: -0.02em;
        }

        .stat-box span {
            font-size: 1.1rem;
            font-weight: 600;
            opacity: 0.6;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Footer */
        footer {
            padding: 10rem 8% 4rem;
            background: #fdfdfa;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
            gap: 5rem;
            margin-bottom: 6rem;
        }

        .footer-brand h2 { font-size: 1.8rem; font-weight: 900; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; }
        .footer-brand p { color: var(--text-muted); line-height: 1.7; margin-bottom: 2rem; max-width: 300px; }

        .social-links { display: flex; gap: 1rem; }
        .social-links a {
            width: 45px;
            height: 45px;
            background: white;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
            text-decoration: none;
            transition: var(--transition);
        }

        .social-links a:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-5px);
        }

        .footer-column h4 { font-size: 1.1rem; font-weight: 800; margin-bottom: 2rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .footer-column ul { list-style: none; }
        .footer-column ul li { margin-bottom: 1.25rem; }
        .footer-column ul a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            transition: var(--transition);
        }

        .footer-column ul a:hover { color: var(--primary-dark); padding-left: 5px; }

        .footer-bottom {
            padding-top: 3rem;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* Responsive */
        @media (max-width: 1280px) {
            .hero-content h1 { font-size: 3.5rem; }
            .stats-section { flex-direction: column; text-align: center; gap: 4rem; margin: 0 2rem; }
        }

        @media (max-width: 1024px) {
            .hero { flex-direction: column; text-align: center; padding-top: 10rem; }
            .hero-content { margin-bottom: 6rem; max-width: 100%; }
            .hero-content p { margin: 0 auto 3rem; }
            .hero-buttons { justify-content: center; }
            .hero-image { justify-content: center; width: 100%; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 4rem; }
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .hero-content h1 { font-size: 2.8rem; }
            .stats-numbers { grid-template-columns: 1fr; gap: 3rem; }
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; gap: 1.5rem; text-align: center; }
        }
    </style>
</head>
<body class="landing-body">

    <!-- Navigation -->
    <nav class="landing-nav">
        <div class="landing-logo">
            <i class="fas fa-wallet"></i>
            MyPocket
        </div>
        <ul class="nav-links">
            <li><a href="#features">Features</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="/">Home</a></li>
        </ul>
        <div class="auth-links">
            @guest
                <a href="{{ route('login') }}" class="btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn-register">Get Started</a>
            @else
                <span class="font-bold text-secondary-dark">Hi, {{ explode(' ', Auth::user()->name)[0] }}!</span>
                <a href="{{ route('dashboard') }}" class="btn-register">Dashboard</a>
            @endguest
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Master Your <span>Financial</span> Journey with Ease</h1>
            <p>Track expenses, set smart budgets, and achieve your financial goals in one beautiful, intuitive workspace designed for you.</p>
            <div class="hero-buttons">
                <a href="{{ route('register') }}" class="btn-hero-primary">
                    Start for Free <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        
        <div class="hero-image">
            <div class="phone-mockup">
                <div class="phone-screen">
                    <div class="app-header">
                        <h3>MyPocket</h3>
                        <p>Total Balance</p>
                    </div>
                    <div class="app-balance">
                        <div class="amount">Rp 12.500.000</div>
                        <div class="w-10 h-10 rounded-full border-4 border-emerald-400 border-t-transparent animate-spin"></div>
                    </div>
                    <div class="app-features">
                        <div class="app-feature-item">
                            <i class="fas fa-chart-line"></i>
                            Analytics
                        </div>
                        <div class="app-feature-item">
                            <i class="fas fa-receipt"></i>
                            History
                        </div>
                        <div class="app-feature-item">
                            <i class="fas fa-piggy-bank"></i>
                            Savings
                        </div>
                        <div class="app-feature-item">
                            <i class="fas fa-bell"></i>
                            Reminders
                        </div>
                    </div>
                    <div class="px-6 py-2">
                        <div class="w-full h-24 bg-slate-100 rounded-2xl border-2 border-dashed border-slate-200 flex items-center justify-center text-slate-400 text-xs font-bold">
                            Transaction Preview
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="section-header">
            <span class="tag">Powerful Features</span>
            <h2>Everything You Need to Succeed</h2>
            <p>Comprehensive tools designed to help you master your personal finance management without the headache.</p>
        </div>
        
        <div class="features-grid">
            @php
                $features = [
                    ['icon' => 'fa-chart-pie', 'title' => 'Smart Dashboard', 'desc' => 'Monitor your financial health in real-time with interactive charts and insightful analytics.'],
                    ['icon' => 'fa-wallet', 'title' => 'Transaction Manager', 'desc' => 'Track every penny with ease. Categorize income and expenses to understand where your money goes.'],
                    ['icon' => 'fa-bullseye', 'title' => 'Savings Goals', 'desc' => 'Set your dreams in motion. MyPocket helps you track your daily savings progress towards your goals.'],
                    ['icon' => 'fa-bell', 'title' => 'Smart Reminders', 'desc' => 'Never miss a bill payment again. Get intelligent notifications before your deadlines arrive.'],
                    ['icon' => 'fa-pen-nib', 'title' => 'Financial Diary', 'desc' => 'Reflect on your spending habits and plan a better financial future with personal notes.'],
                    ['icon' => 'fa-shield-halved', 'title' => 'Military Security', 'desc' => 'Your privacy is our priority. All your transaction data is fully encrypted and stored securely.'],
                ];
            @endphp
            
            @foreach($features as $feature)
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas {{ $feature['icon'] }}"></i>
                </div>
                <div class="feature-content">
                    <h3>{{ $feature['title'] }}</h3>
                    <p>{{ $feature['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section" id="about">
        <div class="stats-text">
            <h2>Our Mission is to Empower Your Finances</h2>
            <p>We believe financial freedom starts with awareness. MyPocket is built to be your companion in building healthy financial habits and a secure future.</p>
            <a href="{{ route('register') }}" class="btn-register" style="padding: 1rem 2.5rem; font-size: 1.1rem;">Join MyPocket Today</a>
        </div>
        
        <div class="stats-numbers">
            <div class="stat-box">
                <h4>15k+</h4>
                <span>Active Users</span>
            </div>
            <div class="stat-box">
                <h4>$2M+</h4>
                <span>Managed Funds</span>
            </div>
            <div class="stat-box">
                <h4>4.9/5</h4>
                <span>User Rating</span>
            </div>
            <div class="stat-box">
                <h4>100%</h4>
                <span>Secure Data</span>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <h2><i class="fas fa-wallet text-theme"></i> MyPocket</h2>
                <p>Your ultimate personal financial companion. Simple, beautiful, and powerful.</p>
                <div class="social-links">
                    <a href="https://github.com/Nademmm" class="w-8 h-8 rounded-lg bg-[#faf8ed] border border-[#c5d89d]/30 flex items-center justify-center text-[#89986d] hover:bg-[#c5d89d] hover:text-white transition-all duration-300">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="https://www.instagram.com/nademazing/" class="w-8 h-8 rounded-lg bg-[#faf8ed] border border-[#c5d89d]/30 flex items-center justify-center text-[#89986d] hover:bg-[#c5d89d] hover:text-white transition-all duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/6281252060878" class="w-8 h-8 rounded-lg bg-[#faf8ed] border border-[#c5d89d]/30 flex items-center justify-center text-[#89986d] hover:bg-[#c5d89d] hover:text-white transition-all duration-300">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
            
            <div class="footer-column">
                <h4>Product</h4>
                <ul>
                    <li><a href="#features">Key Features</a></li>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('transactions.index') }}">Transactions</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4>Company</h4>
                <ul>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4>Support</h4>
                <ul>
                    <li><a href="mailto:support@mypocket.id">Contact Us</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} MyPocket. Crafted for your financial better future.</p>
            <div class="flex gap-8">
                <span class="flex items-center gap-2"><i class="fas fa-shield-check text-emerald-500"></i> Verified Secure</span>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href.startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        const offset = 100;
                        const bodyRect = document.body.getBoundingClientRect().top;
                        const elementRect = target.getBoundingClientRect().top;
                        const elementPosition = elementRect - bodyRect;
                        const offsetPosition = elementPosition - offset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('.landing-nav');
            if (window.scrollY > 50) {
                nav.style.padding = '0.8rem 8%';
                nav.style.boxShadow = '0 10px 30px rgba(0,0,0,0.05)';
            } else {
                nav.style.padding = '1.25rem 8%';
                nav.style.boxShadow = 'none';
            }
        });
    </script>
</body>
</html>
