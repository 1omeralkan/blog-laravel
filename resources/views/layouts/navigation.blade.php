<nav class="muk-navbar">
    <style>
        .muk-navbar {
            background: rgba(31,38,135,0.85);
            backdrop-filter: blur(8px);
            box-shadow: 0 4px 24px 0 rgba(31,38,135,0.10);
            border-bottom: 1.5px solid #2e3a5e44;
            padding: 0;
            z-index: 50;
        }
        .muk-navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 68px;
        }
        .muk-navbar-logo {
            font-size: 2.1rem;
            font-weight: 900;
            background: linear-gradient(90deg, #8fd3fe 0%, #6ec1f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
            letter-spacing: 1px;
            user-select: none;
            transition: transform 0.18s;
            position: relative;
            overflow: hidden;
        }
        .muk-navbar-logo::after {
            content: '';
            position: absolute;
            top: 0; left: -75%;
            width: 60%; height: 100%;
            background: linear-gradient(120deg, rgba(255,255,255,0.0) 0%, rgba(255,255,255,0.45) 50%, rgba(255,255,255,0.0) 100%);
            pointer-events: none;
            animation: shimmer 2.8s infinite;
        }
        @keyframes shimmer {
            0% { left: -75%; }
            60% { left: 110%; }
            100% { left: 110%; }
        }
        .muk-navbar-logo:hover {
            transform: scale(1.07) rotate(-2deg);
        }
        .muk-navbar-menu {
            display: flex;
            gap: 1.1rem;
        }
        .muk-navbar-btn {
            padding: 0.65rem 1.5rem;
            border-radius: 12px;
            background: rgba(255,255,255,0.10);
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
        .muk-navbar-btn.active, .muk-navbar-btn:hover {
            background: linear-gradient(90deg, #8fd3fe 0%, #6ec1f6 100%);
            color: #222e4a;
            transform: translateY(-2px) scale(1.04);
        }
        .muk-navbar-btn.logout:hover {
            background: linear-gradient(90deg, #f87171 0%, #fbbf24 100%);
            color: #222e4a;
        }
    </style>
    <div class="muk-navbar-inner">
        <!-- Sol: Logo -->
        <a href="{{ route('dashboard') }}" class="muk-navbar-logo">Admin Panel</a>
        <!-- Orta: Menü -->
        <div class="muk-navbar-menu">
            <a href="{{ route('dashboard') }}" class="muk-navbar-btn{{ request()->routeIs('dashboard') ? ' active' : '' }}">Dashboard</a>
            @auth
            <a href="{{ route('home') }}" class="muk-navbar-btn{{ request()->routeIs('home') ? ' active' : '' }}">Anasayfa</a>
            @endauth
        </div>
        <!-- Sağ: Profil ve Çıkış veya Giriş/Kayıt -->
        <div class="muk-navbar-menu">
            @auth
                <a href="{{ route('profile.edit') }}" class="muk-navbar-btn{{ request()->routeIs('profile.edit') ? ' active' : '' }}">Profil</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="muk-navbar-btn logout">Çıkış</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="muk-navbar-btn{{ request()->routeIs('login') ? ' active' : '' }}">Giriş Yap</a>
                <a href="{{ route('register') }}" class="muk-navbar-btn{{ request()->routeIs('register') ? ' active' : '' }}">Kayıt Ol</a>
            @endauth
        </div>
    </div>
</nav>
