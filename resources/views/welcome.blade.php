<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MyPocket - Kelola Keuanganmu dengan Mudah</title>
    
    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* --- THEME COLORS --- */
        :root {
            --primary: #e8f0e3; /* Warm Light Green */
            --primary-dark: #556b2f; /* Olive Green */
            --secondary: #3d4a26; 
            --accent: #f4f1ea; /* Bone White Accent */
            --background: #fdfbf7; /* Bone White / Putih Tulang */
            --text-primary: #2c2e2a; 
            --text-secondary: #5a5c58; 
            --surface: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; line-height: 1.6; color: var(--text-primary); background-color: var(--background); overflow-x: hidden; }

        /* Navigation */
        nav { display: flex; justify-content: space-between; align-items: center; padding: 1.5rem 10%; background: #fdfbf7; border-bottom: 1px solid #eeebe3; position: sticky; top: 0; z-index: 1000; }
        .logo { display: flex; align-items: center; gap: 0.75rem; font-size: 1.5rem; font-weight: 800; color: var(--primary-dark); }
        .logo i { color: var(--primary-dark); font-size: 1.75rem; }
        .nav-links { display: flex; gap: 2.5rem; list-style: none; }
        .nav-links a { text-decoration: none; color: var(--text-secondary); font-weight: 600; transition: all 0.3s; font-size: 0.95rem; }
        .nav-links a:hover { color: var(--primary-dark); transform: translateY(-1px); }
        
        .auth-links { display: flex; gap: 1.25rem; align-items: center; }
        .auth-links a { text-decoration: none; font-weight: 700; font-size: 0.9rem; transition: all 0.3s; }
        .auth-links .btn-login { color: var(--text-secondary); }
        .auth-links .btn-login:hover { color: var(--primary-dark); }
        .auth-links .btn-register { 
            padding: 0.65rem 1.5rem; 
            background: var(--primary-dark); 
            color: white; 
            border-radius: 12px; 
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2); 
        }
        .auth-links .btn-register:hover { background: var(--secondary); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(46, 125, 50, 0.3); }

        /* Hero Section - Warm & Elegant */
        .hero {
            background: linear-gradient(135deg, #f4f1ea 0%, #fdfbf7 50%, #f0f4e8 100%);
            padding: 8rem 10% 10rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 85vh;
            gap: 6rem;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        /* Dynamic Floating Shapes (Warm Tones) */
        .hero-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            z-index: 0;
            opacity: 0.5;
            animation: float 15s infinite alternate ease-in-out;
        }
        .shape-1 { width: 500px; height: 500px; background: #e2e8d8; top: -150px; right: -100px; animation-delay: 0s; }
        .shape-2 { width: 400px; height: 400px; background: #e8e4d8; bottom: -100px; left: -100px; animation-delay: -5s; }
        .shape-3 { width: 300px; height: 300px; background: #fdf6e3; top: 20%; left: 10%; opacity: 0.4; animation-delay: -2s; }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(40px, 60px) rotate(15deg); }
        }
        
        /* Hilangkan semua overlay gelap dari CSS lain */
        .hero::before, .hero::after {
            display: none !important;
            content: none !important;
        }

        .hero-content { flex: 1.2; max-width: 650px; position: relative; z-index: 10; }
        .hero h1 { 
            font-size: 4.8rem; 
            font-weight: 900; 
            color: #000000; 
            line-height: 1.05; 
            margin-bottom: 2rem; 
            letter-spacing: -0.04em; 
        }
        .hero p { 
            font-size: 1.35rem; 
            color: #444444; 
            margin-bottom: 3.5rem; 
            line-height: 1.7; 
            font-weight: 500;
            max-width: 550px;
        }
        .hero-buttons { display: flex; gap: 1rem; }
        .btn { padding: 1.1rem 2.25rem; border-radius: 16px; font-weight: 700; text-decoration: none; transition: all 0.3s; display: inline-block; font-size: 1rem; cursor: pointer; text-align: center; }
        .btn-primary { background: var(--primary-dark); color: white; border: none; box-shadow: 0 10px 25px rgba(124, 144, 112, 0.25); }
        .btn-primary:hover { background: var(--secondary); transform: translateY(-3px); box-shadow: 0 15px 35px rgba(124, 144, 112, 0.35); }
        .btn-secondary { background: white; color: var(--primary-dark); border: 2px solid var(--primary); box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
        .btn-secondary:hover { background: var(--accent); transform: translateY(-3px); border-color: var(--primary-dark); }

        /* Hero Image Mockup */
        .hero-image { flex: 0.8; display: flex; justify-content: center; align-items: center; position: relative; z-index: 1; }
        .phone-mockup { position: relative; width: 300px; height: 600px; background: #121411; border-radius: 40px; padding: 10px; box-shadow: 0 50px 100px rgba(0,0,0,0.15); transform: perspective(1000px) rotateY(-15deg) rotateX(5deg); transition: all 0.6s cubic-bezier(0.2, 0.8, 0.2, 1); }
        .phone-mockup:hover { transform: perspective(1000px) rotateY(0deg) rotateX(0deg) scale(1.05); }
        .phone-screen { width: 100%; height: 100%; background: #fdfdfd; border-radius: 32px; overflow: hidden; display: flex; flex-direction: column; }
        .app-header { background: var(--primary-dark); color: white; padding: 2.25rem 1.5rem; text-align: center; }
        .app-header h3 { font-size: 1.15rem; font-weight: 800; margin-bottom: 0.25rem; letter-spacing: 0.02em; }
        .app-header p { font-size: 0.75rem; opacity: 0.85; font-weight: 600; text-transform: uppercase; }
        .app-balance { padding: 2rem 1.5rem; text-align: center; flex: 1; }
        .app-balance .amount { font-size: 1.85rem; font-weight: 900; color: var(--text-primary); margin-bottom: 1.5rem; letter-spacing: -0.01em; }
        .app-chart-circle { width: 150px; height: 150px; margin: 0 auto; border-radius: 50%; border: 12px solid #f0f4e8; border-top-color: var(--primary-dark); border-right-color: var(--primary); position: relative; display: flex; align-items: center; justify-content: center; }
        .app-chart-circle::after { content: '75%'; font-weight: 800; color: var(--primary-dark); font-size: 1.25rem; }
        .app-features { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; padding: 1.5rem; background: #fafafa; }
        .app-feature-item { background: white; padding: 1rem 0.5rem; border-radius: 18px; text-align: center; font-size: 0.7rem; font-weight: 800; color: var(--text-secondary); box-shadow: 0 4px 10px rgba(0,0,0,0.02); }
        .app-feature-item i { font-size: 1.1rem; margin-bottom: 0.5rem; display: block; color: var(--primary-dark); }

        /* Features Section */
        .features { padding: 8rem 8%; background: #ffffff; position: relative; border-top: 1px solid #f0ede4; }
        .section-title { text-align: center; margin-bottom: 5rem; }
        .section-title h2 { font-size: 3.5rem; color: var(--text-primary); margin-bottom: 1.25rem; font-weight: 900; letter-spacing: -0.03em; }
        .section-title p { color: var(--text-secondary); font-size: 1.25rem; max-width: 650px; margin: 0 auto; font-weight: 500; }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem; max-width: 1300px; margin: 0 auto; }
        .feature-card { background: #fdfbf7; padding: 3.5rem 2.5rem; border-radius: 32px; text-align: left; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); border: 1px solid #f0ede4; display: flex; flex-direction: column; gap: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
        .feature-card:hover { transform: translateY(-12px); border-color: var(--primary); box-shadow: 0 20px 40px rgba(85, 107, 47, 0.1); }
        .feature-icon { width: 72px; height: 72px; background: #ffffff; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--primary-dark); transition: all 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
        .feature-card:hover .feature-icon { background: var(--primary-dark); color: #ffffff; transform: rotate(-5deg); }
        .feature-content h3 { font-size: 1.6rem; color: var(--text-primary); margin-bottom: 0.75rem; font-weight: 800; letter-spacing: -0.01em; }
        .feature-content p { color: var(--text-secondary); font-size: 1.1rem; line-height: 1.7; font-weight: 500; }
        .feature-content .subtitle { font-size: 0.8rem; color: var(--primary-dark); font-weight: 800; margin-bottom: 0.5rem; display: block; text-transform: uppercase; letter-spacing: 0.1em; }

        /* About Us Section */
        .about-us { padding: 8rem 8%; background: #f4f1ea; display: flex; align-items: center; justify-content: space-between; gap: 6rem; border-top: 1px solid #eeebe3; }
        .about-content { flex: 1; }
        .about-badge { display: inline-block; background: white; color: var(--secondary); padding: 0.6rem 1.2rem; border-radius: 50px; font-size: 0.9rem; font-weight: 800; margin-bottom: 1.5rem; box-shadow: 0 4px 12px rgba(137, 152, 109, 0.1); }
        .about-content h2 { font-size: 3.25rem; color: var(--text-primary); margin-bottom: 2rem; line-height: 1.1; font-weight: 900; letter-spacing: -0.02em; }
        .about-content p { color: var(--text-secondary); margin-bottom: 2rem; font-size: 1.15rem; line-height: 1.7; font-weight: 500; }
        
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-top: 3rem; padding-top: 3rem; border-top: 2px solid var(--primary); }
        .stat-item h4 { font-size: 2.5rem; color: var(--secondary); font-weight: 900; margin-bottom: 0.25rem; }
        .stat-item span { font-size: 0.95rem; color: var(--text-secondary); font-weight: 600; }

        /* Footer */
        footer { background: var(--text-primary); color: white; padding: 6rem 8% 3rem; }
        .footer-content { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 4rem; max-width: 1200px; margin: 0 auto 4rem; }
        .footer-section h4 { font-size: 1.25rem; margin-bottom: 2rem; font-weight: 800; color: var(--primary); }
        .footer-section ul { list-style: none; }
        .footer-section ul li { margin-bottom: 1rem; }
        .footer-section a { color: #e2e8f0; text-decoration: none; transition: all 0.3s; font-weight: 500; opacity: 0.8; }
        .footer-section a:hover { color: var(--primary); opacity: 1; padding-left: 5px; }
        .footer-bottom { text-align: center; padding-top: 3rem; border-top: 1px solid rgba(255,255,255,0.1); color: #94a3b8; font-size: 0.95rem; font-weight: 500; }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero, .about-us { flex-direction: column; text-align: center; gap: 4rem; }
            .hero h1, .about-content h2 { font-size: 3rem; }
            .hero-buttons { justify-content: center; }
            .phone-mockup { width: 280px; height: 560px; margin: 0 auto; }
            .nav-links { display: none; }
        }

        @media (max-width: 640px) {
            .hero h1, .about-content h2 { font-size: 2.5rem; }
            .hero-buttons { flex-direction: column; }
            .btn { width: 100%; }
            .stats-grid { grid-template-columns: 1fr; gap: 2rem; }
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
            <li><a href="#features">Fitur</a></li>
            <li><a href="#about">Tentang Kami</a></li>
            <li><a href="/">Beranda</a></li>
        </ul>
        <div class="auth-links">
            @guest
                <a href="{{ route('login') }}" class="btn-login">Masuk</a>
                <a href="{{ route('register') }}" class="btn-register">Daftar Sekarang</a>
            @else
                <span class="font-bold text-secondary-dark">Halo, {{ Auth::user()->name }}!</span>
                <a href="{{ route('dashboard') }}" class="btn-register">Dashboard</a>
            @endguest
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-shape shape-1"></div>
        <div class="hero-shape shape-2"></div>
        <div class="hero-shape shape-3"></div>
        <div class="hero-content">
            <h1>Kelola Keuanganmu dengan Lebih Bijak</h1>
            <p>Lacak pengeluaran, atur anggaran, dan capai tujuan finansialmu dalam satu aplikasi yang cantik dan mudah digunakan.</p>
            <div class="hero-buttons">
                <a href="{{ route('register') }}" class="btn btn-primary">Mulai Gratis Sekarang</a>
                <a href="#" class="btn btn-secondary" onclick="showDemo(event)">Lihat Demo</a>
            </div>
        </div>
        <div class="hero-image">
            <div class="phone-mockup">
                <div class="phone-screen">
                    <div class="app-header">
                        <h3>MyPocket</h3>
                        <p>Total Saldo Anda</p>
                    </div>
                    <div class="app-balance">
                        <div class="amount">Rp 12.500.000</div>
                        <div class="app-chart-circle"></div>
                    </div>
                    <div class="app-features">
                        <div class="app-feature-item">
                            <i class="fas fa-chart-line"></i>
                            Statistik
                        </div>
                        <div class="app-feature-item">
                            <i class="fas fa-receipt"></i>
                            Transaksi
                        </div>
                        <div class="app-feature-item">
                            <i class="fas fa-piggy-bank"></i>
                            Tabungan
                        </div>
                        <div class="app-feature-item">
                            <i class="fas fa-bell"></i>
                            Pengingat
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="section-title">
            <h2>Segala yang Anda Butuhkan</h2>
            <p>Fitur lengkap untuk membantu Anda menguasai manajemen keuangan pribadi tanpa pusing.</p>
        </div>
        <div class="features-grid">
            @php
                $features = [
                    ['icon' => 'fa-chart-line', 'title' => 'Dashboard Pintar', 'subtitle' => 'Visualisasi Data', 'desc' => 'Pantau kesehatan finansial Anda secara real-time dengan grafik yang interaktif dan informatif.'],
                    ['icon' => 'fa-exchange-alt', 'title' => 'Manajemen Transaksi', 'subtitle' => 'Pemasukan & Pengeluaran', 'desc' => 'Catat setiap sen yang keluar dan masuk dengan kategori yang dapat disesuaikan sepenuhnya.'],
                    ['icon' => 'fa-bullseye', 'title' => 'Target Tabungan', 'subtitle' => 'Financial Goals', 'desc' => 'Tetapkan impian Anda dan biarkan MyPocket membantu Anda melacak progres tabungan setiap harinya.'],
                    ['icon' => 'fa-bell', 'title' => 'Sistem Pengingat', 'subtitle' => 'Tepat Waktu', 'desc' => 'Jangan pernah melewatkan pembayaran tagihan lagi dengan notifikasi pengingat yang cerdas.'],
                    ['icon' => 'fa-book-open', 'title' => 'Buku Harian Finansial', 'subtitle' => 'Catatan Pribadi', 'desc' => 'Refleksikan kebiasaan belanja Anda dan buat rencana masa depan yang lebih matang.'],
                    ['icon' => 'fa-shield-alt', 'title' => 'Keamanan Maksimal', 'subtitle' => 'Data Terenkripsi', 'desc' => 'Privasi Anda adalah prioritas kami. Semua data transaksi Anda aman dan terenkripsi.'],
                ];
            @endphp
            
            @foreach($features as $feature)
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas {{ $feature['icon'] }}"></i>
                </div>
                <div class="feature-content">
                    <span class="subtitle">{{ $feature['subtitle'] }}</span>
                    <h3>{{ $feature['title'] }}</h3>
                    <p>{{ $feature['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section class="about-us" id="about">
        <div class="about-content">
            <span class="about-badge">Tentang MyPocket</span>
            <h2>Misi Kami Adalah Memberdayakan Finansial Anda</h2>
            <p>Kami percaya bahwa kebebasan finansial dimulai dari kesadaran akan setiap pengeluaran. MyPocket hadir sebagai sahabat yang membantu Anda membangun kebiasaan keuangan yang sehat.</p>
            
            <div class="stats-grid">
                <div class="stat-item">
                    <h4>10rb+</h4>
                    <span>Pengguna Aktif</span>
                </div>
                <div class="stat-item">
                    <h4>Rp 1M+</h4>
                    <span>Dana Terkelola</span>
                </div>
                <div class="stat-item">
                    <h4>4.9/5</h4>
                    <span>Rating Kepuasan</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Produk</h4>
                <ul>
                    <li><a href="#features">Fitur Utama</a></li>
                    <li><a href="#">Keamanan</a></li>
                    <li><a href="#">Pembaruan</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Perusahaan</h4>
                <ul>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Dukungan</h4>
                <ul>
                    <li><a href="#">Pusat Bantuan</a></li>
                    <li><a href="#">Panduan Pengguna</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Legal</h4>
                <ul>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2024 MyPocket. Dibuat dengan ❤️ untuk masa depan finansial yang lebih baik.
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
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });
        });
        
        function showDemo(e) {
            e.preventDefault();
            alert('🎬 Demo interaktif akan segera hadir! Silakan daftar untuk mencoba langsung.');
        }
    </script>
    
</body>
</html>
