<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Lapangan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="max-w-6xl mx-auto px-6 py-8">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold">Data Lapangan</h1>
                <p class="text-gray-500">Kelola data lapangan olahraga.</p>
            </div>

            <a href="{{ route('admin.courts.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                + Tambah Lapangan
            </a>
        </div>

        @if(session('success'))
            <div class="mb-5 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4">Lapangan</th>
                            <th class="px-6 py-4">Tipe</th>
                            <th class="px-6 py-4">Harga/Jam</th>
                            <th class="px-6 py-4">Gambar</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse($courts as $court)
                            <tr>
                                <td class="px-6 py-4 font-medium">
                                    {{ $court->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $court->type }}
                                </td>

                                <td class="px-6 py-4">
                                    Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($court->image)
                                        <img
                                            src="{{ asset('storage/' . $court->image) }}"
                                            class="w-16 h-12 object-cover rounded-lg"
                                            alt="{{ $court->name }}"
                                        >
                                    @else
                                        <span class="text-gray-400">Tidak ada</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex gap-2">

                                        <a href="{{ route('admin.courts.edit', $court) }}"
                                           class="bg-yellow-500 text-white px-3 py-1.5 rounded-lg text-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.courts.destroy', $court) }}"
                                              method="POST"
                                              onsubmit="return confirm('Hapus lapangan ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="bg-red-600 text-white px-3 py-1.5 rounded-lg text-sm">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada data lapangan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</body>
</html>