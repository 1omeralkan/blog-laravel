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
        .avatar-effect {
            display: inline-block;
            border-radius: 50%;
            box-shadow: 0 2px 12px 0 rgba(31,38,135,0.18), 0 0 0 3px #8fd3fe44;
            transition: box-shadow 0.25s, transform 0.18s;
            padding: 2px;
            background: linear-gradient(120deg, #e0e7ef 0%, #8fd3fe 100%);
            position: relative;
        }
        .avatar-effect:hover {
            box-shadow: 0 4px 24px 0 #6ec1f6cc, 0 0 0 5px #8fd3fe99;
            transform: scale(1.08);
        }
        .avatar-img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2.5px solid #fff;
            box-shadow: 0 1px 4px 0 rgba(31,38,135,0.10);
            background: #f3f6fa;
            transition: border 0.22s;
        }
    </style>
    <div class="muk-navbar-inner">
        <!-- Sol: Logo -->
        <a href="{{ route('dashboard') }}" class="muk-navbar-logo">My Blog</a>
        <!-- Orta: Menü -->
        <div class="muk-navbar-menu">
            <a href="{{ route('dashboard') }}" class="muk-navbar-btn{{ request()->routeIs('dashboard') ? ' active' : '' }}">Dashboard</a>
            @auth
            <a href="{{ route('home') }}" class="muk-navbar-btn{{ request()->routeIs('home') ? ' active' : '' }}">Anasayfa</a>
            @if(Auth::user() && Auth::user()->isAdmin())
                <a href="/admin" class="muk-navbar-btn" style="background: linear-gradient(90deg, #fbbf24 0%, #f59e42 100%); color: #222e4a; font-weight:700;">Admin Panel</a>
            @endif
            @endauth
        </div>
        <!-- Sağ: Profil ve Çıkış veya Giriş/Kayıt -->
        <div class="muk-navbar-menu">
            @auth
                <a href="{{ route('profile.edit') }}" class="flex items-center" style="padding: 0; background: none; box-shadow: none;">
                    <span class="avatar-effect">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="Profil" class="avatar-img" />
                    </span>
                    <span class="sr-only">{{ Auth::user()->name }}</span>
                </a>
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
