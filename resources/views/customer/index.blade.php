<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Lapangan Olahraga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 font-sans">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Sistem Reservasi Lapangan</h1>
            <p class="text-gray-500 text-sm mt-1">Pilih lapangan, tanggal, dan jam pemesanan Anda</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 text-center font-semibold">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 text-center font-semibold">{{ session('error') }}</div>
        @endif

        <form action="{{ route('customer.checkout') }}" method="POST">
            @csrf
            <!-- 1. Data Pemesan & Tanggal -->
            <div class="bg-white p-6 rounded-xl shadow-sm border mb-6">
                <h2 class="text-lg font-bold text-gray-700 mb-4 pb-2 border-b">1. Informasi Pemesan & Tanggal</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Lengkap</label>
                        <input type="text" name="customer_name" required placeholder="Masukkan nama Anda" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Nomor WhatsApp/HP</label>
                        <input type="text" name="customer_phone" required placeholder="Contoh: 08123456789" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Tanggal Main</label>
                        <input type="date" name="booking_date" required class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>
            </div>

            <!-- 2. Pilih Lapangan & Jam -->
            <h2 class="text-lg font-bold text-gray-700 mb-4">2. Pilih Lapangan & Waktu</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                @foreach($courts as $court)
                    <div class="bg-white rounded-xl shadow-sm border overflow-hidden p-4 flex flex-col justify-between">
                        <div>
                            @if($court->image)
                                <img src="{{ asset('storage/' . $court->image) }}" class="w-full h-40 object-cover rounded-lg mb-3">
                            @else
                                <div class="bg-gray-200 h-40 flex items-center justify-center text-gray-400 font-medium rounded-lg mb-3">Tanpa Gambar</div>
                            @endif
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs bg-blue-100 text-blue-700 font-semibold px-2.5 py-0.5 rounded">{{ $court->type }}</span>
                                <span class="font-bold text-green-600">Rp {{ number_format($court->price_per_hour) }}/Jam</span>
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg">{{ $court->name }}</h3>
                            <p class="text-xs text-gray-500 mt-1 mb-4">{{ $court->description }}</p>
                        </div>
                        
                        <div class="border-t pt-3 bg-gray-50 rounded-lg p-3">
                            <label class="flex items-center gap-2 mb-2 font-semibold text-sm cursor-pointer">
                                <input type="radio" name="court_id" value="{{ $court->id }}" required class="w-4 h-4 text-blue-600">
                                Pilih Lapangan Ini
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- 3. Jam Operasional & Durasi -->
            <div class="bg-white p-6 rounded-xl shadow-sm border mb-6">
                <h2 class="text-lg font-bold text-gray-700 mb-4 pb-2 border-b">3. Durasi & Jam Mulai</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Jam Mulai</label>
                        <input type="time" name="start_time" required class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Durasi (Jam)</label>
                        <input type="number" name="duration_hours" min="1" value="1" required class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>
            </div>

            <div class="mt-8 text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-xl shadow-md transition">Kirim Pengajuan Reservasi</button>
            </div>
        </form>
    </div>
</body>
</html>