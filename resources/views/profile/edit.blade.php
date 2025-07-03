<x-app-layout>
    <style>
        body {
            background: linear-gradient(135deg, #8fd3fe 0%, #19223a 100%);
            min-height: 100vh;
        }
        .muk-profile-outer {
            min-height: 80vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding-top: 3rem;
        }
        .muk-profile-stack {
            width: 100%;
            max-width: 540px;
            display: flex;
            flex-direction: column;
            gap: 2.2rem;
        }
        .muk-profile-card {
            background: rgba(255,255,255,0.13);
            backdrop-filter: blur(10px);
            border-radius: 28px;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            padding: 2.2rem 2.2rem 1.7rem 2.2rem;
            animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1.000);
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .muk-profile-card h2 {
            font-size: 1.35rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.2rem;
        }
        .muk-profile-card p {
            color: #b6c6e3;
            font-size: 1.01rem;
            margin-bottom: 1.2rem;
        }
        .muk-profile-card form, .muk-profile-card section > form {
            margin-top: 0.7rem;
        }
        .muk-profile-card input[type="text"],
        .muk-profile-card input[type="email"],
        .muk-profile-card input[type="password"] {
            width: 100%;
            padding: 0.9rem 1.1rem;
            border-radius: 12px;
            border: none;
            background: rgba(255,255,255,0.18);
            color: #fff;
            font-size: 1.08rem;
            margin-bottom: 1.1rem;
            transition: box-shadow 0.2s, background 0.2s;
        }
        .muk-profile-card input:focus {
            outline: none;
            background: #eaf6fb;
            color: #222e4a;
            box-shadow: 0 0 0 2px #8fd3fe;
        }
        .muk-profile-card button, .muk-profile-card .btn, .muk-profile-card .x-primary-button, .muk-profile-card .x-danger-button, .muk-profile-card .x-secondary-button {
            padding: 0.8rem 1.7rem;
            border-radius: 12px;
            background: linear-gradient(90deg, #8fd3fe 0%, #6ec1f6 100%);
            color: #222e4a;
            font-weight: 700;
            font-size: 1.05rem;
            border: none;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
            transition: background 0.2s, color 0.2s, transform 0.15s;
        }
        .muk-profile-card button:hover, .muk-profile-card .btn:hover, .muk-profile-card .x-primary-button:hover, .muk-profile-card .x-danger-button:hover, .muk-profile-card .x-secondary-button:hover {
            background: linear-gradient(90deg, #6ec1f6 0%, #8fd3fe 100%);
            color: #19223a;
            transform: translateY(-2px) scale(1.03);
        }
        .muk-profile-card .flex.items-center.gap-4 {
            gap: 1.2rem;
        }
    </style>
    <div class="muk-profile-outer">
        <div class="muk-profile-stack">
            <div class="muk-profile-card">
                @include('profile.partials.update-profile-information-form')
            </div>
            <div class="muk-profile-card">
                @include('profile.partials.update-password-form')
            </div>
            <div class="muk-profile-card">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
