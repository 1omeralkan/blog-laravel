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
        }
        .muk-admin-section-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #8fd3fe;
            margin-bottom: 1.1rem;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 8px #19223a44;
        }
        .muk-admin-table {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
        }
        .muk-admin-table th, .muk-admin-table td {
            padding: 0.7rem 1rem;
            text-align: left;
        }
        .muk-admin-table th {
            color: #3b82f6;
            font-size: 1.08rem;
            font-weight: 800;
            background: rgba(143,211,254,0.13);
            letter-spacing: 0.5px;
            text-shadow: 0 1px 4px #19223a22;
        }
        .muk-admin-table td {
            color: #fff;
            font-size: 1.07rem;
            background: rgba(255,255,255,0.07);
            font-weight: 500;
            text-shadow: 0 1px 4px #19223a22;
        }
        .muk-admin-table tr {
            border-bottom: 1px solid #8fd3fe33;
        }
        .muk-admin-table tr:last-child {
            border-bottom: none;
        }
        .muk-btn-edit {
            color: #fbbf24;
            background: transparent;
            font-weight: 700;
            border: none;
            padding: 0.2rem 0.7rem;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: color 0.15s, background 0.15s;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        .muk-btn-edit:hover {
            color: #fff;
            background: #fbbf24;
        }
        .muk-search {
            border-radius: 12px;
            border: none;
            background: rgba(255,255,255,0.13);
            color: #fff;
            font-size: 1.05rem;
            padding: 0.7rem 1.1rem;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
            margin-bottom: 1.2rem;
            width: 100%;
            outline: none;
        }
        .muk-search::placeholder {
            color: #b6c6e3;
        }
        .muk-btn-new {
            background: linear-gradient(90deg, #3b82f6 0%, #fbbf24 100%);
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
        }
        .muk-btn-new:hover {
            background: linear-gradient(90deg, #2563eb 0%, #f59e42 100%);
            color: #fff;
            box-shadow: 0 4px 16px 0 rgba(31,38,135,0.18);
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
    <div class="muk-admin-card">
        <div class="flex items-center justify-between mb-4">
            <h2 class="muk-admin-section-title">Kategoriler</h2>
            <a href="{{ route('filament.admin.resources.categories.create') }}" class="muk-btn-new">+ Yeni Kategori</a>
        </div>
        <form method="GET" action="" class="flex flex-col md:flex-row gap-4 items-center mb-6">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Kategori ara..." class="muk-search">
        </form>
        <div class="overflow-x-auto">
            <table class="muk-admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Üst Kategori</th>
                        <th>Created</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->getTableRecords() as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->parent?->name ?? '-' }}</td>
                            <td>{{ $category->created_at?->format('d.m.Y') }}</td>
                            <td>
                                <a href="{{ route('filament.admin.resources.categories.edit', $category->id) }}" class="muk-btn-edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13h3l8-8a2.828 2.828 0 10-4-4l-8 8v3h3z" /></svg>
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center" style="color:#b6c6e3;">Kategori bulunamadı.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-filament::page> 