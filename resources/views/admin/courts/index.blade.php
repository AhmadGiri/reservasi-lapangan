<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Master Data Lapangan</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('courts.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block font-semibold">+ Tambah Lapangan</a>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <table class="w-full bg-white border mt-4 shadow-sm rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-100 border-b text-gray-600 text-sm">
                    <th class="p-3">Gambar</th>
                    <th class="p-3">Nama Lapangan</th>
                    <th class="p-3">Jenis</th>
                    <th class="p-3">Harga / Jam</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courts as $court)
                <tr class="border-b text-center text-sm">
                    <td class="p-3">
                        @if($court->image)
                            <img src="{{ asset('storage/' . $court->image) }}" class="w-16 h-16 object-cover mx-auto rounded">
                        @else
                            <span class="text-gray-400 text-xs">Tanpa Gambar</span>
                        @endif
                    </td>
                    <td class="p-3 font-semibold">{{ $court->name }}</td>
                    <td class="p-3">{{ $court->type }}</td>
                    <td class="p-3 font-bold text-green-600">Rp {{ number_format($court->price_per_hour) }}</td>
                    <td class="p-3">
                        <a href="{{ route('courts.edit', $court->id) }}" class="text-blue-600 hover:underline mr-3 font-semibold">Edit</a>
                        <form action="{{ route('courts.destroy', $court->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')" class="text-red-600 hover:underline font-semibold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">{{ $courts->links() }}</div>
    </div>
</x-app-layout>