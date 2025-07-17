<x-guest-layout>
    <style>
        body {
            background: linear-gradient(135deg, #8fd3fe 0%, #19223a 100%);
            min-height: 100vh;
        }
        .muk-card {
            background: rgba(255,255,255,0.10);
            backdrop-filter: blur(8px);
            border-radius: 24px;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            padding: 2.5rem 2rem 2rem 2rem;
            max-width: 400px;
            margin: 3rem auto 0 auto;
            animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1.000);
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .muk-title {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            text-align: center;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
        }
        .muk-input {
            width: 100%;
            padding: 0.9rem 1.1rem;
            border-radius: 12px;
            border: none;
            background: rgba(255,255,255,0.18);
            color: #fff;
            font-size: 1.1rem;
            margin-bottom: 1.1rem;
            transition: box-shadow 0.2s, background 0.2s;
        }
        .muk-input:focus {
            outline: none;
            background: #eaf6fb;
            color: #222e4a;
            box-shadow: 0 0 0 2px #8fd3fe;
        }
        .muk-btn {
            width: 100%;
            padding: 0.9rem 0;
            border-radius: 12px;
            background: linear-gradient(90deg, #8fd3fe 0%, #6ec1f6 100%);
            color: #222e4a;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
            transition: background 0.2s, color 0.2s, transform 0.15s;
        }
        .muk-btn:hover {
            background: linear-gradient(90deg, #6ec1f6 0%, #8fd3fe 100%);
            color: #19223a;
            transform: translateY(-2px) scale(1.03);
        }
        .muk-link {
            color: #8fd3fe;
            text-decoration: underline;
            font-size: 1rem;
            transition: color 0.2s;
        }
        .muk-link:hover {
            color: #fff;
        }
        .muk-switch {
            text-align: center;
            margin-top: 1.2rem;
            color: #b6c6e3;
        }
        .muk-switch a {
            color: #8fd3fe;
            font-weight: 600;
            text-decoration: underline;
            transition: color 0.2s;
        }
        .muk-switch a:hover {
            color: #fff;
        }
        .muk-label {
            color: #eaf6fb;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 0.3rem;
            display: block;
        }
        .muk-switch-btn {
            padding: 0.7rem 1.7rem;
            border-radius: 12px;
            background: rgba(255,255,255,0.13);
            color: #eaf6fb;
            font-weight: 700;
            font-size: 1.08rem;
            border: none;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
            transition: background 0.22s, color 0.22s, transform 0.18s;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            display: inline-block;
        }
        .muk-switch-btn.active, .muk-switch-btn:hover {
            background: linear-gradient(90deg, #8fd3fe 0%, #6ec1f6 100%);
            color: #222e4a;
            transform: translateY(-2px) scale(1.04);
        }
    </style>
    <div class="muk-card">
        <!-- Butonlar kaldırıldı -->
        <div class="muk-title">Giriş Yap</div>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label class="muk-label" for="email">Email</label>
            <input id="email" class="muk-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mb-2" />
            <label class="muk-label" for="password">Şifre</label>
            <input id="password" class="muk-input" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mb-2" />
            <div class="flex items-center justify-between mb-2">
                <label class="inline-flex items-center text-sm text-gray-200">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2">Beni Hatırla</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="muk-link" href="{{ route('password.request') }}">Şifremi Unuttum</a>
                @endif
            </div>
            <button type="submit" class="muk-btn">Giriş Yap</button>
        </form>
        <div class="muk-switch">
            Hesabın yok mu? <a href="{{ route('register') }}">Kayıt Ol</a>
        </div>
    </div>
</x-guest-layout>
