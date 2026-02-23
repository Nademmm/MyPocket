<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPocket - Manage Your Money</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <style>
        /* Custom Theme - Minimal Cream, Better Contrast */
        :root {
            --bg-cream: #f6f0d7;
            --bg-white: #ffffff;
            --bg-sage: #e8edc2;
            --border-sage: #c5d89d;
            --text-dark: #2d2d2d;
            --text-olive: #6b7854;
            --text-muted: #89986d;
            --accent-sage: #9cab84;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Hero Background - Darker overlay to show image */
        .hero-bg {
            background: url('/images/fallkoin.jpg') center/cover no-repeat;
            position: relative;
        }

        .hero-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(45, 45, 45, 0.75) 0%, rgba(45, 45, 45, 0.6) 100%);
        }

        /* Navbar - Semi-transparent dark */
        .navbar {
            backdrop-filter: blur(14px);
            background: rgba(45, 45, 45, 0.85);
            border-bottom: 1px solid rgba(197, 216, 157, 0.3);
        }

        .nav-link {
            position: relative;
            transition: 0.3s;
            color: #c5d89d;
            font-weight: 500;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            background: #c5d89d;
            transition: 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: #f6f0d7;
        }

        /* Cards - White with sage accents */
        .card {
            background: #ffffff;
            border: 1px solid rgba(197, 216, 157, 0.5);
            transition: 0.35s;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .card:hover {
            transform: translateY(-8px);
            border-color: #c5d89d;
            box-shadow: 0 20px 40px rgba(137, 152, 109, 0.25);
        }

        /* Body base styles */
        body.landing-page {
            background: #ffffff;
            color: #2d2d2d;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Button styles */
        .btn-primary {
            background: linear-gradient(135deg, #c5d89d 0%, #9cab84 100%);
            color: #2d2d2d;
            border: none;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #b5cc7d 0%, #89986d 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(137, 152, 109, 0.4);
        }

        /* Section backgrounds */
        .section-cream {
            background: linear-gradient(180deg, #f6f0d7 0%, #e8edc2 100%);
        }

        .section-white {
            background: #ffffff;
        }

        .section-sage {
            background: linear-gradient(180deg, #e8edc2 0%, #d4dcb0 100%);
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .hero-bg {
                min-height: 45vh;
                padding: 2rem 1rem;
            }

            .card {
                margin: 0.75rem 0;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0.5rem 1rem;
            }

            .nav-link {
                display: inline-block;
                padding: 0.5rem 0.75rem;
                font-size: 0.95rem;
            }

            .hero-bg {
                min-height: 35vh;
                padding: 1.5rem 0.75rem;
            }

            .card {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 0.25rem 0.75rem;
            }

            .nav-link {
                font-size: 0.9rem;
                padding: 0.5rem 0.5rem;
            }

            .hero-bg {
                min-height: 25vh;
                padding: 1rem 0.5rem;
            }

            .card {
                padding: 0.75rem;
            }
        }
    </style>
</head>

<body class="antialiased landing-page">

<!-- NAVBAR -->
<nav class="navbar fixed top-0 w-full z-50 py-4">
    <div class="max-w-6xl mx-auto flex items-center justify-between px-2">

        <div class="flex gap-6 text-sm">
            <a href="#" class="nav-link">Home</a>
            <a href="#features" class="nav-link">Features</a>
        </div>

        <h1 class="text-2xl font-bold tracking-widest text-white">
            MYPOCKET
        </h1>

        <div class="flex gap-6 text-sm">
            <a href="#about" class="nav-link">About</a>
            <a href="{{ route('login') }}" class="nav-link">Login</a>
        </div>

    </div>
</nav>

<!-- HERO SECTION - Dark with visible background image -->
<section class="hero-bg h-screen flex items-center justify-center text-center relative">
    <div class="relative z-10 max-w-3xl px-6">

        <h1 class="text-5xl font-bold mb-6 leading-tight text-white drop-shadow-lg">
            Manage Your Money<br>
            With Clarity and Control
        </h1>

        <p class="text-gray-200 mb-8 text-lg font-medium drop-shadow-md">
            MyPocket is a modern financial tracking platform designed to help users
            monitor savings, manage expenses, and understand spending behavior
            through a simple yet powerful digital experience.
        </p>

        <a href="{{ route('register') }}" class="btn-primary px-8 py-3 rounded-xl font-semibold inline-block shadow-lg">
            Get Started
        </a>

    </div>
</section>

<!-- FEATURES - White background -->
<section id="features" class="py-24 section-white">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-14 text-[#2d2d2d]">Features</h2>
        <div class="grid md:grid-cols-3 gap-8">

            <div class="card p-8 rounded-2xl">
                <div class="w-16 h-16 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-2xl flex items-center justify-center mx-auto mb-6 border-2 border-[#c5d89d]/50 shadow-lg">
                    <svg class="w-8 h-8 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-4 text-[#2d2d2d]">Financial Tracking</h3>
                <p class="text-[#6b7854]">
                    Record daily income and expenses efficiently. Every transaction
                    is stored as structured data to help users stay aware of their
                    financial activity.
                </p>
            </div>

            <div class="card p-8 rounded-2xl">
                <div class="w-16 h-16 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-2xl flex items-center justify-center mx-auto mb-6 border-2 border-[#c5d89d]/50 shadow-lg">
                    <svg class="w-8 h-8 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-4 text-[#2d2d2d]">Savings Monitoring</h3>
                <p class="text-[#6b7854]">
                    Track personal savings growth over time. MyPocket works as a
                    digital saving journal that helps build consistent financial habits.
                </p>
            </div>

            <div class="card p-8 rounded-2xl">
                <div class="w-16 h-16 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-2xl flex items-center justify-center mx-auto mb-6 border-2 border-[#c5d89d]/50 shadow-lg">
                    <svg class="w-8 h-8 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-4 text-[#2d2d2d]">Smart Financial Overview</h3>
                <p class="text-[#6b7854]">
                    View summarized financial insights that help users understand
                    spending patterns and maintain better financial decisions.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- ABOUT - Sage gradient background -->
<section id="about" class="py-24 section-sage">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6 text-[#2d2d2d]">About MyPocket</h2>
        <p class="text-[#6b7854] text-lg leading-relaxed">
            MyPocket is a modern personal finance tracking platform designed to help you 
            manage your money with clarity and control. We believe that financial wellness 
            starts with understanding your spending habits and saving consistently.
            <br><br>
            Whether you're tracking daily expenses, setting savings targets, or monitoring 
            your financial growth, MyPocket provides the tools you need to achieve your 
            financial goals.
        </p>
        <br>
    </div>
</section>

<!-- FOOTER - Dark with sage accents -->
<footer class="py-10 text-center bg-[#2d2d2d] border-t border-[#c5d89d]/30">
    <p class="text-white font-medium">©2026 MyPocket All rights reserved.</p>
    <p class="mt-2 text-sm text-[#c5d89d]">Modern personal finance tracking platform.</p>
</footer>

</body>
</html>
