<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Lapangan Baru</h2>
    </x-slot>

    <div class="py-12 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('courts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-sm border">
            @csrf
            <div class="mb-4">
                <label class="block font-medium mb-1">Nama Lapangan</label>
                <input type="text" name="name" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Jenis Olahraga</label>
                <select name="type" class="w-full border rounded p-2" required>
                    <option value="Futsal">Futsal</option>
                    <option value="Badminton">Badminton</option>
                    <option value="Basket">Basket</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Harga Per Jam (Rp)</label>
                <input type="number" name="price_per_hour" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Deskripsi Lapangan</label>
                <textarea name="description" class="w-full border rounded p-2" rows="3" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Gambar Lapangan</label>
                <input type="file" name="image" class="w-full border rounded p-2">
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded font-semibold">Simpan Data</button>
        </form>
    </div>
</x-app-layout>