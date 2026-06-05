<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MyPocket - Kelola Keuanganmu dengan Mudah</title>
    
    {{-- Fonts & Icons --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    {{-- Vite Assets (opsional, hapus jika tidak pakai Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* --- CSS DASAR --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; line-height: 1.6; color: #333; overflow-x: hidden; }

        /* Navigation */
        nav { display: flex; justify-content: space-between; align-items: center; padding: 1.5rem 8%; background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 1000; }
        .logo { display: flex; align-items: center; gap: 0.5rem; font-size: 1.5rem; font-weight: 700; color: #1e40af; }
        .logo i { color: #3b82f6; }
        .nav-links { display: flex; gap: 2.5rem; list-style: none; }
        .nav-links a { text-decoration: none; color: #4b5563; font-weight: 500; transition: color 0.3s; }
        .nav-links a:hover { color: #1e40af; }
        .auth-links { display: flex; gap: 1rem; align-items: center; }
        .auth-links a { text-decoration: none; font-weight: 500; font-size: 0.95rem; }
        .auth-links .btn-login { color: #4b5563; }
        .auth-links .btn-register { 
            padding: 0.5rem 1.5rem; 
            background: #2563eb; 
            color: white; 
            border-radius: 50px; 
            transition: all 0.3s; 
        }
        .auth-links .btn-register:hover { background: #1d4ed8; transform: translateY(-2px); }
        .mobile-toggle { display: none; background: none; border: none; font-size: 1.5rem; color: #1e40af; cursor: pointer; }

        /* Hero Section */
        .hero { background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); padding: 5rem 8%; display: flex; align-items: center; justify-content: space-between; min-height: 90vh; gap: 4rem; }
        .hero-content { flex: 1; max-width: 600px; }
        .hero h1 { font-size: 3.5rem; font-weight: 800; color: #1e3a8a; line-height: 1.2; margin-bottom: 1.5rem; }
        .hero p { font-size: 1.25rem; color: #4b5563; margin-bottom: 2.5rem; line-height: 1.8; }
        .hero-buttons { display: flex; gap: 1rem; }
        .btn { padding: 1rem 2.5rem; border-radius: 50px; font-weight: 600; text-decoration: none; transition: all 0.3s; display: inline-block; font-size: 1rem; cursor: pointer; }
        .btn-primary { background: #2563eb; color: white; border: 2px solid #2563eb; }
        .btn-primary:hover { background: #1d4ed8; transform: translateY(-2px); box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3); }
        .btn-secondary { background: transparent; color: #2563eb; border: 2px solid #2563eb; }
        .btn-secondary:hover { background: #2563eb; color: white; transform: translateY(-2px); }

        /* Hero Image Mockup */
        .hero-image { flex: 1; display: flex; justify-content: center; align-items: center; }
        .phone-mockup { position: relative; width: 350px; height: 700px; background: #1f2937; border-radius: 50px; padding: 15px; box-shadow: 0 25px 100px rgba(0,0,0,0.2); transform: rotate(-5deg); transition: transform 0.3s; }
        .phone-mockup:hover { transform: rotate(0deg) scale(1.02); }
        .phone-screen { width: 100%; height: 100%; background: linear-gradient(135deg, #ffffff 0%, #f3f4f6 100%); border-radius: 40px; overflow: hidden; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; }
        .phone-screen .app-header { width: 100%; background: #3b82f6; color: white; padding: 1.5rem; border-radius: 20px; margin-bottom: 2rem; text-align: center; }
        .phone-screen .chart { width: 200px; height: 200px; border-radius: 50%; background: conic-gradient(#3b82f6 0deg 240deg, #dbeafe 240deg 360deg); display: flex; align-items: center; justify-content: center; margin: 2rem 0; position: relative; }
        .phone-screen .chart::before { content: ''; width: 150px; height: 150px; background: white; border-radius: 50%; position: absolute; }
        .phone-screen .chart span { position: relative; z-index: 1; font-weight: 700; color: #1e40af; }
        .phone-screen .features { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; width: 100%; }
        .phone-screen .feature-item { background: #f3f4f6; padding: 1rem; border-radius: 15px; text-align: center; font-size: 0.875rem; }
        .phone-screen .feature-item i { font-size: 1.5rem; color: #3b82f6; margin-bottom: 0.5rem; display: block; }

        /* Features Section */
        .features { padding: 6rem 8%; background: #f9fafb; }
        .section-title { text-align: center; margin-bottom: 3rem; }
        .section-title h2 { font-size: 2.5rem; color: #1e3a8a; margin-bottom: 1rem; font-weight: 800; }
        .section-title p { color: #6b7280; font-size: 1.125rem; max-width: 600px; margin: 0 auto; }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; max-width: 1200px; margin: 0 auto; }
        .feature-card { background: white; padding: 2.5rem 2rem; border-radius: 20px; text-align: left; transition: all 0.3s; border: 1px solid #e5e7eb; display: flex; gap: 1.5rem; align-items: flex-start; }
        .feature-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); border-color: #3b82f6; }
        .feature-icon { width: 70px; height: 70px; flex-shrink: 0; background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; color: #3b82f6; }
        .feature-content h3 { font-size: 1.25rem; color: #1f2937; margin-bottom: 0.5rem; font-weight: 700; }
        .feature-content p { color: #6b7280; font-size: 0.95rem; line-height: 1.6; }
        .feature-content .subtitle { font-size: 0.875rem; color: #3b82f6; font-weight: 600; margin-top: 0.5rem; display: block; }

        /* About Us Section */
        .about-us { padding: 6rem 8%; background: #ffffff; display: flex; align-items: center; justify-content: space-between; gap: 4rem; }
        .about-content { flex: 1; }
        .about-badge { display: inline-block; background: #dbeafe; color: #1e40af; padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.875rem; font-weight: 600; margin-bottom: 1rem; }
        .about-content h2 { font-size: 2.5rem; color: #1e3a8a; margin-bottom: 1.5rem; line-height: 1.2; }
        .about-content p { color: #4b5563; margin-bottom: 1.5rem; font-size: 1.1rem; }
        .about-visual { flex: 1; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        .visual-box { background: #f8fafc; padding: 2rem; border-radius: 20px; text-align: center; border: 1px solid #e2e8f0; transition: transform 0.3s; }
        .visual-box:hover { transform: translateY(-5px); border-color: #3b82f6; }
        .visual-box i { font-size: 2.5rem; color: #3b82f6; margin-bottom: 1rem; }
        .visual-box h4 { color: #1e293b; margin-bottom: 0.5rem; }
        .visual-box p { font-size: 0.875rem; color: #64748b; }
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e5e7eb; }
        .stat-item h4 { font-size: 2rem; color: #2563eb; font-weight: 800; }
        .stat-item span { font-size: 0.875rem; color: #6b7280; }

        /* Technologies Section */
        .technologies { padding: 4rem 8%; background: #0f172a; color: white; }
        .technologies h2 { text-align: center; font-size: 2rem; margin-bottom: 3rem; color: white; }
        .tech-grid { display: flex; justify-content: center; align-items: center; gap: 3rem; flex-wrap: wrap; max-width: 1000px; margin: 0 auto; }
        .tech-item { display: flex; flex-direction: column; align-items: center; gap: 0.75rem; padding: 1.5rem 2rem; background: rgba(59, 130, 246, 0.1); border-radius: 15px; border: 1px solid rgba(59, 130, 246, 0.3); transition: all 0.3s; }
        .tech-item:hover { transform: translateY(-5px); background: rgba(59, 130, 246, 0.2); border-color: #3b82f6; }
        .tech-item i { font-size: 2.5rem; color: #60a5fa; }
        .tech-item span { font-size: 0.95rem; font-weight: 600; color: #e2e8f0; }

        /* Footer */
        footer { background: #1e3a8a; color: white; padding: 4rem 8% 2rem; }
        .footer-content { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 3rem; max-width: 1200px; margin: 0 auto 3rem; }
        .footer-section h4 { font-size: 1.125rem; margin-bottom: 1.5rem; font-weight: 600; }
        .footer-section ul { list-style: none; }
        .footer-section ul li { margin-bottom: 0.75rem; }
        .footer-section a { color: #bfdbfe; text-decoration: none; transition: color 0.3s; }
        .footer-section a:hover { color: white; }
        .footer-bottom { text-align: center; padding-top: 2rem; border-top: 1px solid #3b82f6; color: #93c5fd; font-size: 0.875rem; }

        /* Responsive */
        @media (max-width: 968px) {
            .hero, .about-us { flex-direction: column; text-align: center; padding-top: 3rem; }
            .hero h1, .about-content h2 { font-size: 2.5rem; }
            .hero-buttons { justify-content: center; }
            .phone-mockup { width: 280px; height: 560px; }
            .nav-links { display: none; }
            .auth-links { gap: 0.5rem; }
            .stats-grid { text-align: center; }
            .about-visual { width: 100%; }
            .feature-card { text-align: left; }
            .mobile-toggle { display: block; }
        }

        @media (max-width: 640px) {
            .hero h1, .about-content h2 { font-size: 2rem; }
            .hero-buttons { flex-direction: column; }
            .btn { width: 100%; text-align: center; }
            .phone-mockup { width: 250px; height: 500px; }
            .about-visual { grid-template-columns: 1fr; }
            .features-grid { grid-template-columns: 1fr; }
            .tech-grid { gap: 1.5rem; }
            .auth-links { flex-direction: column; width: 100%; }
            .auth-links .btn-register { width: 100%; text-align: center; }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav>
        <div class="logo">
            <i class="fas fa-wallet"></i>
            MyPocket
        </div>
        <ul class="nav-links">
            <li><a href="#features">Features</a></li>
            <li><a href="#about">Tentang Kami</a></li>
            <li><a href="/">Home</a></li>
        </ul>
        <div class="auth-links">
            @guest
                <a href="{{ route('login') }}" class="btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn-register">Register</a>
            @else
                <span>Halo, {{ Auth::user()->name ?? 'User' }}!</span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:#bfdbfe;cursor:pointer;font-weight:500;">Logout</button>
                </form>
            @endguest
        </div>
        <button class="mobile-toggle" aria-label="Toggle menu">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Kelola Keuanganmu dengan Mudah</h1>
            <p>Lacak, atur, dan capai tujuan keuanganmu—semua dalam satu aplikasi</p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">Get Started Free</a>
                <a href="#" class="btn btn-secondary" onclick="showDemo(event)">View Demo</a>
            </div>
        </div>
        <div class="hero-image">
            <div class="phone-mockup">
                <div class="phone-screen">
                    <div class="app-header">
                        <h3>MyPocket</h3>
                        <p>Total Balance</p>
                    </div>
                    <div class="chart">
                        <span>Rp 12.5Jt</span>
                    </div>
                    <div class="features">
                        <div class="feature-item">
                            <i class="fas fa-chart-line"></i>
                            <div>Budget</div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-receipt"></i>
                            <div>Expense</div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-piggy-bank"></i>
                            <div>Savings</div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-cog"></i>
                            <div>More</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="section-title">
            <h2>Fitur & Modul</h2>
            <p>Semua yang Anda butuhkan untuk mengelola keuangan pribadi dengan lebih baik</p>
        </div>
        <div class="features-grid">
            @php
                $features = [
                    ['icon' => 'fa-chart-line', 'title' => 'Dashboard', 'subtitle' => 'Balance, Statistics', 'desc' => 'Pantau saldo dan statistik keuangan Anda secara real-time dengan visualisasi yang mudah dipahami.'],
                    ['icon' => 'fa-exchange-alt', 'title' => 'Transactions', 'subtitle' => 'Income & Expense', 'desc' => 'Catat dan kelola semua transaksi pemasukan dan pengeluaran Anda dengan mudah dan terorganisir.'],
                    ['icon' => 'fa-folder-open', 'title' => 'Categories', 'subtitle' => 'Income / Expense', 'desc' => 'Kategorikan transaksi Anda untuk analisis yang lebih mendalam dan pengelolaan anggaran yang lebih baik.'],
                    ['icon' => 'fa-bullseye', 'title' => 'Savings Goals', 'subtitle' => 'Target & Progress', 'desc' => 'Tetapkan target tabungan dan pantau progres Anda menuju tujuan finansial yang ingin dicapai.'],
                    ['icon' => 'fa-bell', 'title' => 'Reminders', 'subtitle' => 'Payment Alerts', 'desc' => 'Dapatkan pengingat otomatis untuk pembayaran tagihan dan transaksi penting agar tidak terlewat.'],
                    ['icon' => 'fa-book-open', 'title' => 'Diaries', 'subtitle' => 'Financial Notes', 'desc' => 'Catat pemikiran, rencana, dan refleksi keuangan Anda dalam buku harian finansial pribadi.'],
                ];
            @endphp
            
            @foreach($features as $feature)
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas {{ $feature['icon'] }}"></i>
                </div>
                <div class="feature-content">
                    <h3>{{ $feature['title'] }}</h3>
                    <span class="subtitle">{{ $feature['subtitle'] }}</span>
                    <p>{{ $feature['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section class="about-us" id="about">
        <div class="about-content">
            <span class="about-badge">Tentang Kami</span>
            <h2>Misi Kami Membantu Anda Mencapai Kebebasan Finansial</h2>
            <p>MyPocket didirikan pada tahun 2024 dengan satu tujuan sederhana: membuat manajemen keuangan pribadi menjadi mudah dan dapat diakses oleh semua orang.</p>
            <p>Kami percaya bahwa dengan alat yang tepat, siapa pun dapat mengontrol masa depan finansial mereka. Tim kami terdiri dari ahli keuangan dan pengembang teknologi yang berdedikasi.</p>
            
            <div class="stats-grid">
                <div class="stat-item">
                    <h4>50k+</h4>
                    <span>Pengguna Aktif</span>
                </div>
                <div class="stat-item">
                    <h4>100%</h4>
                    <span>Aman & Terpercaya</span>
                </div>
                <div class="stat-item">
                    <h4>24/7</h4>
                    <span>Dukungan Pelanggan</span>
                </div>
            </div>
        </div>

        <div class="about-visual">
            @php
                $visuals = [
                    ['icon' => 'fa-shield-alt', 'title' => 'Keamanan', 'desc' => 'Data Anda dienkripsi dengan standar perbankan.'],
                    ['icon' => 'fa-users', 'title' => 'Komunitas', 'desc' => 'Bergabung dengan ribuan pengguna lainnya.'],
                    ['icon' => 'fa-chart-pie', 'title' => 'Analisis', 'desc' => 'Insight mendalam tentang pola belanja Anda.'],
                    ['icon' => 'fa-mobile', 'title' => 'Aksesibilitas', 'desc' => 'Gunakan di mana saja, kapan saja.'],
                ];
            @endphp
            
            @foreach($visuals as $visual)
            <div class="visual-box">
                <i class="fas {{ $visual['icon'] }}"></i>
                <h4>{{ $visual['title'] }}</h4>
                <p>{{ $visual['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Technologies Section -->
    

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Product</h4>
                <ul>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#">Roadmap</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Resources</h4>
                <ul>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">API Docs</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Company</h4>
                <ul>
                    <li><a href="#about">About</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Legal</h4>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                </ul>
            </div>
        </div>

    </footer>

    {{-- Scripts --}}
    <script>
        // Smooth scroll untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href.startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });
        });
        
        // Demo button handler
        function showDemo(e) {
            e.preventDefault();
            alert('🎬 Demo akan segera hadir!');
        }
        
        // Mobile toggle (jika diperlukan)
        document.querySelector('.mobile-toggle')?.addEventListener('click', function() {
            document.querySelector('.nav-links')?.classList.toggle('active');
        });
    </script>
    
</body>
</html>