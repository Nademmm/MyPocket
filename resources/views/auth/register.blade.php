<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Akun - MyPocket</title>
    
    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- THEME COLORS --- */
        :root {
            --primary: #e8f0e3;
            --primary-dark: #556b2f;
            --secondary: #3d4a26;
            --accent: #f4f1ea;
            --background: #fdfbf7;
            --text-primary: #2c2e2a;
            --text-secondary: #5a5c58;
            --surface: #ffffff;
            --danger: #c17b7b;
            --success: #9cab84;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Figtree', sans-serif; 
            line-height: 1.6; 
            color: var(--text-primary); 
            background-color: var(--background);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        /* Background Decoration */
        .bg-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            opacity: 0.5;
        }
        .shape-1 { width: 400px; height: 400px; background: #e2e8d8; top: -100px; right: -100px; }
        .shape-2 { width: 300px; height: 300px; background: #e8e4d8; bottom: -50px; left: -50px; }

        /* --- REGISTER CONTAINER --- */
        .register-container {
            width: 100%;
            max-width: 500px;
            background: var(--surface);
            border-radius: 32px;
            box-shadow: 0 20px 50px rgba(85, 107, 47, 0.08);
            overflow: hidden;
            position: relative;
            z-index: 1;
            border: 1px solid #eeebe3;
            animation: slideUp 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- REGISTER HEADER --- */
        .register-header {
            background: var(--primary-dark);
            padding: 3rem 2rem 2.5rem;
            text-align: center;
            color: white;
            position: relative;
        }

        .register-header .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            font-size: 2rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .register-header .logo i { color: var(--primary); }
        .register-header p { opacity: 0.9; font-size: 0.95rem; font-weight: 500; }

        /* --- REGISTER FORM --- */
        .register-form { padding: 2.5rem 2.5rem 3rem; }
        
        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: 0.3s;
        }
        .back-home:hover { color: var(--primary-dark); transform: translateX(-4px); }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .form-group-full { grid-column: span 2; }

        .form-group { margin-bottom: 1.25rem; position: relative; }
        .form-group label {
            display: block;
            margin-bottom: 0.6rem;
            font-weight: 800;
            color: var(--text-primary);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .form-control {
            width: 100%;
            padding: 1.1rem 1.25rem;
            padding-right: 3.5rem; /* Add padding for the eye icon */
            border: 2px solid #f0ede4;
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s;
            background: #fdfbf7;
            font-family: inherit;
        }
        .pw-toggle {
            position: absolute;
            right: 1.25rem;
            bottom: 1.1rem;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 1.1rem;
            transition: 0.3s;
            background: none;
            border: none;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .pw-toggle:hover { color: var(--primary-dark); }
        .form-control:focus {
            outline: none;
            border-color: var(--primary-dark);
            background: white;
            box-shadow: 0 0 0 4px rgba(85, 107, 47, 0.05);
        }
        .form-control.error { border-color: var(--danger); }

        /* --- REGISTER BUTTON --- */
        .btn-register {
            width: 100%;
            padding: 1.1rem;
            background: var(--primary-dark);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            box-shadow: 0 10px 25px rgba(85, 107, 47, 0.2);
            margin-top: 1rem;
        }
        .btn-register:hover {
            background: var(--secondary);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(85, 107, 47, 0.3);
        }

        /* --- ALERT BOX --- */
        .alert {
            padding: 1.1rem 1.25rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .alert-success { background: #f1f8f1; color: #3d5a3d; border: 1px solid #d1e7d1; }
        .alert-error { background: #fdf2f2; color: #8b4141; border: 1px solid #f8d7d7; }
        .alert i { font-size: 1.1rem; margin-top: 0.1rem; }

        /* --- LOGIN LINK --- */
        .login-link {
            text-align: center;
            padding-top: 1.5rem;
            margin-top: 2rem;
            border-top: 1px solid #f0ede4;
            color: var(--text-secondary);
            font-size: 0.95rem;
            font-weight: 500;
        }
        .login-link a {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 800;
        }
        .login-link a:hover { text-decoration: underline; }

        @media (max-width: 600px) {
            body { padding: 1rem; }
            .register-container { border-radius: 24px; }
            .register-form { padding: 2rem 1.5rem 2.5rem; }
            .form-grid { grid-template-columns: 1fr; }
            .form-group-full { grid-column: span 1; }
        }
    </style>
</head>
<body>

    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>

    <div class="register-container">
        <!-- Header -->
        <div class="register-header">
            <div class="logo">
                <i class="fas fa-wallet"></i>
                MyPocket
            </div>
            <p>Bergabunglah dan mulai menabung hari ini.</p>
        </div>

        <!-- Form -->
        <form class="register-form" method="POST" action="{{ route('register') }}">
            @csrf
            
            <a href="{{ url('/') }}" class="back-home">
                <i class="fas fa-arrow-left"></i> Beranda
            </a>

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="form-grid">
                <div class="form-group form-group-full">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="John Doe" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="form-group form-group-full">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                    <button type="button" class="pw-toggle" onclick="togglePassword('password', this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                    <button type="button" class="pw-toggle" onclick="togglePassword('password_confirmation', this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-register">
                Buat Akun <i class="fas fa-user-plus"></i>
            </button>

            <script>
                function togglePassword(inputId, btn) {
                    const input = document.getElementById(inputId);
                    const icon = btn.querySelector('i');
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.replace('fa-eye', 'fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.replace('fa-eye-slash', 'fa-eye');
                    }
                }
            </script>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk Disini</a>
            </div>
        </form>
    </div>

</body>
</html>
