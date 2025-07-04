<div class="news-marquee-wrapper" style="position: fixed; bottom: 0; left: 0; width: 100%; z-index: 9999; background: #222e4a; color: #eaf6fb;">
    <div class="news-marquee" style="white-space: nowrap; overflow: hidden;">
        <div style="display: inline-block; padding-left: 100%; animation: marquee 90s linear infinite;">
            @if(count($headlines) > 0)
                @foreach($headlines as $headline)
                    <span style="margin-right: 3rem; font-weight: 600;">{{ $headline }}</span>
                @endforeach
            @else
                <span style="margin-left: 1rem;">Şu anda haber verisi alınamıyor.</span>
            @endif
        </div>
    </div>
    <style>
        @keyframes marquee {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }
    </style>
</div> 