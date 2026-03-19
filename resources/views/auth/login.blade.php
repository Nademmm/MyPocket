<x-guest-layout>
<div class="auth-container">

    <div class="auth-card">
        <!-- Logo -->
        <div class="auth-logo">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        
        <h1 class="auth-title">Welcome Back</h1>
        <p class="auth-subtitle">Sign in to continue</p>

        @if (session('status'))
            <div style="background: rgba(197, 216, 157, 0.2); color: #6b7854; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                    class="form-input" placeholder="your@email.com">
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label class="form-label">Password</label>
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot?</a>
                </div>
                <input type="password" name="password" required 
                    class="form-input" placeholder="••••••••">
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-checkbox">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn-primary">Sign In</button>
        </form>

        <div class="auth-footer">
            Don't have an account? <a href="{{ route('register') }}">Create one</a>
        </div>
    </div>
</div>
</x-guest-layout>
