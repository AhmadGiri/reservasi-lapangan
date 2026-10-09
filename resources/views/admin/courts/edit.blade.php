<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-slate-800">
                Tambah Lapangan
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Tambahkan data lapangan olahraga baru.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            <a href="{{ route('admin.courts.index') }}"
               class="mb-6 inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-emerald-600">
                ← Kembali ke Data Lapangan
            </a>

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <p class="mb-2 font-semibold">
                        Periksa kembali data berikut:
                    </p>

                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-6 py-5">
                    <h3 class="font-bold text-slate-800">
                        Informasi Lapangan
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Isi informasi lapangan dengan lengkap.
                    </p>
                </div>

                <form
                    action="{{ route('admin.courts.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-6 p-6"
                >
                    @csrf

                    {{-- Nama --}}
                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Lapangan
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: Lapangan Futsal 1"
                            required
                            class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tipe --}}
                    <div>
                        <label for="type" class="mb-2 block text-sm font-semibold text-slate-700">
                            Tipe Lapangan
                        </label>

                        <select
                            id="type"
                            name="type"
                            required
                            class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                            <option value="">Pilih tipe lapangan</option>

                            <option value="Futsal" @selected(old('type') === 'Futsal')>
                                Futsal
                            </option>

                            <option value="Badminton" @selected(old('type') === 'Badminton')>
                                Badminton
                            </option>

                            <option value="Basket" @selected(old('type') === 'Basket')>
                                Basket
                            </option>
                        </select>

                        @error('type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div>
                        <label for="price_per_hour" class="mb-2 block text-sm font-semibold text-slate-700">
                            Harga per Jam (Rp)
                        </label>

                        <input
                            type="number"
                            id="price_per_hour"
                            name="price_per_hour"
                            value="{{ old('price_per_hour') }}"
                            min="0"
                            placeholder="100000"
                            required
                            class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >

                        @error('price_per_hour')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label for="description" class="mb-2 block text-sm font-semibold text-slate-700">
                            Deskripsi
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Jelaskan fasilitas dan kondisi lapangan..."
                            required
                            class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Gambar --}}
                    <div>
                        <label for="image" class="mb-2 block text-sm font-semibold text-slate-700">
                            Gambar Lapangan
                        </label>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                            class="block w-full cursor-pointer rounded-xl border border-slate-200 text-sm text-slate-600 file:mr-4 file:border-0 file:bg-emerald-50 file:px-4 file:py-3 file:font-semibold file:text-emerald-700 hover:file:bg-emerald-100"
                        >

                        <p class="mt-2 text-xs text-slate-500">
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </p>

                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('admin.courts.index') }}"
                            class="rounded-xl border border-slate-200 px-5 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700"
                        >
                            Simpan Lapangan
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>