<a href="/admin" class="muk-admin-logo flex items-center gap-2 select-none" style="text-decoration: none;">
    <span class="inline-block animate-gradient-x bg-gradient-to-r from-blue-400 via-fuchsia-500 to-emerald-400 bg-clip-text text-transparent font-extrabold text-2xl tracking-tight drop-shadow-lg">
        <svg class="inline-block w-8 h-8 mr-1 align-middle animate-spin-slow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <defs>
                <linearGradient id="muk-logo-gradient" x1="0" y1="0" x2="1" y2="1">
                    <stop offset="0%" stop-color="#60a5fa" />
                    <stop offset="50%" stop-color="#a21caf" />
                    <stop offset="100%" stop-color="#34d399" />
                </linearGradient>
            </defs>
            <circle cx="12" cy="12" r="10" stroke="url(#muk-logo-gradient)" stroke-width="3" fill="none" />
            <path d="M12 6v6l4 2" stroke="url(#muk-logo-gradient)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        Admin Panel
    </span>
</a>
<style>
@keyframes gradient-x {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}
.animate-gradient-x {
    background-size: 200% 200%;
    animation: gradient-x 3s ease-in-out infinite;
}
.animate-spin-slow {
    animation: spin 2.5s linear infinite;
}
@keyframes spin {
    100% { transform: rotate(360deg); }
}
</style> 