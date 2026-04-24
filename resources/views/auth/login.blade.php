<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - MyPocket</title>
    
    {{-- Fonts & Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* --- RESET & BASE --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Inter', sans-serif; 
            line-height: 1.6; 
            color: #333; 
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        /* --- LOGIN CONTAINER --- */
        .login-container {
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: slideUp 0.4s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- LOGIN HEADER --- */
        .login-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            color: white;
        }

        .login-header .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-header .logo i { color: #93c5fd; }
        .login-header p { color: #bfdbfe; font-size: 0.95rem; }

        /* --- LOGIN FORM --- */
        .login-form { padding: 2rem 2.5rem 2.5rem; }
        .form-group { margin-bottom: 1.5rem; position: relative; }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #1f2937;
            font-size: 0.95rem;
        }
        .form-control {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
            background: #f9fafb;
        }
        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        .form-control.error { border-color: #ef4444; }
        .input-icon {
            position: absolute;
            right: 1rem;
            top: 42px;
            color: #9ca3af;
            cursor: pointer;
        }
        .input-icon:hover { color: #3b82f6; }
        .error-message {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.35rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .error-message i { font-size: 0.8rem; }

        /* --- FORM OPTIONS --- */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        .remember-me input {
            width: 1rem;
            height: 1rem;
            accent-color: #3b82f6;
            cursor: pointer;
        }
        .remember-me span { font-size: 0.9rem; color: #4b5563; }

        /* --- LOGIN BUTTON --- */
        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.4);
        }
        .btn-login:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

        /* --- ALERT BOX --- */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.95rem;
        }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
        .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fca5a5; }
        .alert i { font-size: 1.1rem; margin-top: 0.1rem; }
        .alert ul { margin: 0; padding-left: 1.25rem; }
        .alert li { margin-bottom: 0.25rem; }

        /* --- BACK TO HOME --- */
        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #6b7280;
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }
        .back-home:hover { color: #3b82f6; }

        /* --- REGISTER LINK --- */
        .register-link {
            text-align: center;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 0.95rem;
        }
        .register-link a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
        }
        .register-link a:hover { color: #1d4ed8; text-decoration: underline; }

        /* --- RESPONSIVE --- */
        @media (max-width: 480px) {
            body { padding: 1rem; }
            .login-container { border-radius: 20px; }
            .login-header { padding: 2rem 1.5rem 1.5rem; }
            .login-form { padding: 1.5rem 1.5rem 2rem; }
            .form-options { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>

    <div class="login-container">
        
        <!-- Header -->
        <div class="login-header">
            <div class="logo">
                <i class="fas fa-wallet"></i>
                MyPocket
            </div>
            <p>Selamat datang kembali! Silakan login.</p>
        </div>

        <!-- Form -->
        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            
            <!-- Alert Messages -->
            @if(session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Back to Home -->
            <a href="{{ url('/') }}" class="back-home">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Beranda
            </a>

            <!-- Email Input -->
            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control @error('email') error @enderror" 
                    value="{{ old('email') }}" 
                    placeholder="nama@contoh.com"
                    required
                    autofocus
                >
                @error('email')
                    <span class="error-message">
                        <i class="fas fa-circle-exclamation"></i> {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control @error('password') error @enderror" 
                    placeholder="••••••••"
                    required
                >
                <i class="fas fa-eye input-icon" id="togglePassword" onclick="togglePassword()"></i>
                @error('password')
                    <span class="error-message">
                        <i class="fas fa-circle-exclamation"></i> {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    <span>Ingat saya</span>
                </label>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i>
                Masuk
            </button>

            <!-- Register Link -->
            <div class="register-link">
                Belum punya akun? 
                <a href="{{ route('register') }}">Daftar sekarang</a>
            </div>
        </form>
    </div>

    {{-- JavaScript --}}
    <script>
        // Toggle Password Visibility
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('togglePassword');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Clear error on input
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('error');
            });
        });


    </script>

</body>
</html>
