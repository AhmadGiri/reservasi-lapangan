<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lapangan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="max-w-2xl mx-auto px-6 py-8">

        <div class="mb-6">
            <a href="{{ route('admin.courts.index') }}"
               class="text-blue-600">
                ← Kembali
            </a>

            <h1 class="text-2xl font-bold mt-3">
                Edit Lapangan
            </h1>
        </div>

        @if($errors->any())
            <div class="mb-5 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.courts.update', $court) }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white p-6 rounded-xl shadow space-y-5"
        >

            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-2">
                    Nama Lapangan
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $court->name) }}"
                    class="w-full border rounded-lg px-4 py-2"
                    required
                >
            </div>

            <div>
                <label class="block font-medium mb-2">
                    Tipe Lapangan
                </label>

                <select
                    name="type"
                    class="w-full border rounded-lg px-4 py-2"
                    required
                >
                    <option value="Futsal" @selected(old('type', $court->type) === 'Futsal')>
                        Futsal
                    </option>

                    <option value="Badminton" @selected(old('type', $court->type) === 'Badminton')>
                        Badminton
                    </option>

                    <option value="Basket" @selected(old('type', $court->type) === 'Basket')>
                        Basket
                    </option>
                </select>
            </div>

            <div>
                <label class="block font-medium mb-2">
                    Harga per Jam
                </label>

                <input
                    type="number"
                    name="price_per_hour"
                    value="{{ old('price_per_hour', $court->price_per_hour) }}"
                    class="w-full border rounded-lg px-4 py-2"
                    min="0"
                    required
                >
            </div>

            <div>
                <label class="block font-medium mb-2">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full border rounded-lg px-4 py-2"
                    required
                >{{ old('description', $court->description) }}</textarea>
            </div>

            <div>
                <label class="block font-medium mb-2">
                    Gambar Baru
                </label>

                @if($court->image)
                    <img
                        src="{{ asset('storage/' . $court->image) }}"
                        class="w-32 h-24 object-cover rounded-lg mb-3"
                        alt="{{ $court->name }}"
                    >
                @endif

                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    class="w-full border rounded-lg px-4 py-2"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2.5 rounded-lg hover:bg-blue-700"
            >
                Simpan Perubahan
            </button>

        </form>

    </div>

</body>
</html>