<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Sol: Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <span class="text-2xl font-extrabold bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 bg-clip-text text-transparent drop-shadow-lg select-none transition-all duration-300 hover:scale-105">MyBlog</span>
                </a>
            </div>
            <!-- Orta: Dashboard ve Anasayfa -->
            <div class="hidden sm:flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg text-lg font-semibold text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-600 transition">Dashboard</a>
                @auth
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-lg font-semibold text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-600 transition">Anasayfa</a>
                @endauth
            </div>
            <!-- Sağ: Profil ve Çıkış veya Giriş/Kayıt -->
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded-lg text-lg font-semibold text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-600 transition">Profil</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-lg text-lg font-semibold text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 hover:bg-red-600 hover:text-white dark:hover:bg-red-600 transition border-none">Çıkış</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-lg font-semibold text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-600 transition">Giriş Yap</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg text-lg font-semibold text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 hover:bg-green-600 hover:text-white dark:hover:bg-green-600 transition">Kayıt Ol</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
