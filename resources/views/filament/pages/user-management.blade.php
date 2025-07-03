<x-filament::page>
    <div class="text-2xl font-bold mb-8">Kullanıcı Yönetimi</div>
    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <form method="GET" action="" class="flex flex-col md:flex-row gap-4 items-center mb-6">
            <input type="text" name="search" value="{{ $search }}" placeholder="İsim veya e-posta ile ara..." class="w-full md:w-72 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Ara</button>
        </form>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">İsim</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">E-posta</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kayıt Tarihi</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">İşlem</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">
                                @if($user->isAdmin())
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Admin</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">Kullanıcı</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $user->created_at->format('d.m.Y H:i') }}</td>
                            <td class="px-4 py-2">
                                @if(!$user->isAdmin())
                                    <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" onsubmit="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?');" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-black px-3 py-1 rounded text-xs font-semibold">Sil</button>
                                    </form>
                                    <span class="mx-1">|</span>
                                    <form action="{{ route('admin.makeAdmin', $user->id) }}" method="POST" onsubmit="return confirm('Bu kullanıcıya admin yetkisi vermek istediğinize emin misiniz?');" style="display:inline">
                                        @csrf
                                        <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-xs font-semibold">Admin Yap</button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center text-gray-400">Kullanıcı bulunamadı.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-filament::page> 