<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
        <div class="text-3xl font-bold text-blue-600">{{ $postCount }}</div>
        <div class="mt-2 text-gray-600">Toplam Yazı</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
        <div class="text-3xl font-bold text-green-600">{{ $categoryCount }}</div>
        <div class="mt-2 text-gray-600">Toplam Kategori</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
        <div class="text-3xl font-bold text-yellow-600">{{ $commentCount }}</div>
        <div class="mt-2 text-gray-600">Toplam Yorum</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
        <div class="text-3xl font-bold text-purple-600">{{ $userCount }}</div>
        <div class="mt-2 text-gray-600">Toplam Kullanıcı</div>
    </div>
</div> 