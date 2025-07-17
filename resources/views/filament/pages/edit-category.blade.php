<x-filament::page :heading="false">
    <style>
        .muk-admin-card {
            background: linear-gradient(135deg, #8fd3fe 0%, #19223a 100%);
            border-radius: 22px;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            padding: 2.2rem 2rem 2rem 2rem;
            color: #fff;
            margin-bottom: 2.2rem;
            animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1.000);
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
        }
        .muk-admin-title {
            font-size: 2.1rem;
            font-weight: 900;
            color: #fff;
            margin-bottom: 0.7rem;
            letter-spacing: 1px;
            text-shadow: 0 2px 12px #19223a55;
        }
        .muk-admin-desc {
            color: #b6c6e3;
            font-size: 1.13rem;
            margin-bottom: 2.2rem;
            font-weight: 500;
            text-shadow: 0 1px 8px #19223a33;
        }
        .muk-admin-form {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem 2.5rem;
        }
        .muk-admin-form .fi-fo-field {
            flex: 1 1 350px;
            min-width: 250px;
        }
        .muk-admin-form label {
            color: #8fd3fe;
            font-weight: 700;
            font-size: 1.08rem;
            margin-bottom: 0.3rem;
            letter-spacing: 0.2px;
        }
        .muk-admin-form input,
        .muk-admin-form textarea,
        .muk-admin-form select {
            background: rgba(255,255,255,0.13);
            color: #111 !important;
            border: none;
            border-radius: 10px;
            padding: 0.8rem 1.1rem;
            font-size: 1.08rem;
            margin-bottom: 0.7rem;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
            transition: background 0.18s, color 0.18s;
        }
        .muk-admin-form input:focus,
        .muk-admin-form textarea:focus,
        .muk-admin-form select:focus {
            background: rgba(143,211,254,0.18);
            color: #111 !important;
            outline: none;
        }
        .muk-admin-form .fi-fo-error {
            color: #f87171;
            font-size: 0.98rem;
            margin-top: -0.5rem;
            margin-bottom: 0.5rem;
        }
        .muk-btn-save {
            background: linear-gradient(90deg, #3b82f6 0%, #34d399 100%);
            color: #fff;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 0.7rem 1.6rem;
            font-size: 1.08rem;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
            transition: background 0.18s, color 0.18s, box-shadow 0.18s;
            text-decoration: none;
            display: inline-block;
            margin-right: 1rem;
        }
        .muk-btn-save:hover {
            background: linear-gradient(90deg, #2563eb 0%, #059669 100%);
            color: #fff;
            box-shadow: 0 4px 16px 0 rgba(31,38,135,0.18);
        }
        .muk-btn-cancel {
            background: rgba(255,255,255,0.13);
            color: #b6c6e3;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 0.7rem 1.6rem;
            font-size: 1.08rem;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
            transition: background 0.18s, color 0.18s, box-shadow 0.18s;
            text-decoration: none;
            display: inline-block;
        }
        .muk-btn-cancel:hover {
            background: rgba(143,211,254,0.18);
            color: #fff;
        }
        .muk-btn-delete {
            position: absolute;
            top: 2.2rem;
            right: 2rem;
            background: linear-gradient(90deg, #f87171 0%, #fbbf24 100%);
            color: #fff;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 0.7rem 1.6rem;
            font-size: 1.08rem;
            box-shadow: 0 2px 8px 0 rgba(251,191,36,0.10);
            transition: background 0.18s, color 0.18s, box-shadow 0.18s;
            text-decoration: none;
            display: inline-block;
            z-index: 10;
        }
        .muk-btn-delete:hover {
            background: linear-gradient(90deg, #dc2626 0%, #fbbf24 100%);
            color: #fff;
            box-shadow: 0 4px 16px 0 rgba(251,191,36,0.18);
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
    <div class="muk-admin-card">
        <form wire:submit.prevent="save" class="muk-admin-form">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.2rem;">
                <span class="muk-admin-title" style="margin: 0;">Kategori Düzenle</span>
                <a href="/dashboard" class="muk-dash-btn" style="background: linear-gradient(90deg, #8fd3fe 0%, #3b82f6 100%); color: #222e4a; font-weight:700; padding: 0.5rem 1.2rem; border-radius: 10px; display: inline-block; box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);">← Geri Dön</a>
            </div>
            <div class="muk-admin-desc">Kategori bilgilerini güncelleyin veya silin. Tüm alanlar okunaklı ve kullanıcı dostu şekilde tasarlanmıştır.</div>
            {{ $this->form }}
            <div class="w-full flex flex-wrap gap-3 mt-6">
                <button type="submit" class="muk-btn-save">Kaydet</button>
                <button type="button" onclick="window.history.back()" class="muk-btn-cancel">İptal</button>
            </div>
        </form>
    </div>
</x-filament::page> 