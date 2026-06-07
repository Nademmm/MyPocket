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
</head>
<body class="landing-body">

    <!-- Navigation -->
    <nav class="landing-nav">
        <div class="landing-logo">
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
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('transactions.index') }}">Manajemen Transaksi</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Fitur Unggulan</h4>
                <ul>
                    <li><a href="{{ route('targets.index') }}">Target Tabungan</a></li>
                    <li><a href="{{ route('reminders.index') }}">Pengingat Tagihan</a></li>
                    <li><a href="{{ route('diaries.index') }}">Buku Harian</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Akses Cepat</h4>
                <ul>
                    <li><a href="{{ route('login') }}">Masuk</a></li>
                    <li><a href="{{ route('register') }}">Daftar Baru</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Bantuan</h4>
                <ul>
                    <li><a href="mailto:support@mypocket.id">Hubungi Kami</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} MyPocket. Dibuat dengan ❤️ untuk masa depan finansial yang lebih baik.
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
