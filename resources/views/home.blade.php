<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Judul Halaman --}}
    <title>Ayam Pangkep - Lacak Rantai Pasok & Harga Pasar</title>

    {{-- Deskripsi untuk SEO --}}
    <meta name="description"
        content="Lacak asal-usul telur, lihat transparansi harga pasar, dan dapatkan informasi edukasi seputar telur dengan sistem rantai pasok Telur Pangkep.">

    {{-- Memuat Aset (CSS & JS) yang dikompilasi oleh Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    {{-- ===== HEADER ===== --}}
    <header class="bg-white/80 backdrop-blur-lg sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="text-2xl" role="img" aria-label="egg">🐔</span>
                <span class="text-xl font-bold text-gray-900">Ayam Pangkep</span>
            </a>
            <nav class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-green-600 font-medium">Beranda</a>
                <a href="/admin"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-5 rounded-lg transition-colors">
                    Masuk
                </a>
            </nav>
        </div>
    </header>

    {{-- ===== BAGIAN UTAMA ===== --}}
    <main>
        {{-- Section Hero (Pelacakan) --}}
        <section class="py-20 md:py-28 text-center bg-white">
            <div class="container mx-auto px-6">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">
                    Lacak Asal-usul Ayam Anda
                </h1>
                <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                    Masukkan kode unik pada kemasan untuk melihat riwayat lengkap Ayam, dari peternakan hingga ke
                    tangan Anda.
                </p>
                <form action="#" method="POST" class="mt-10 max-w-xl mx-auto flex shadow-lg">
                    @csrf
                    <input type="text" name="batch_code" placeholder="Contoh: BCH-20250721-001"
                        class="w-full px-5 py-4 text-gray-700 border border-gray-200 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-8 rounded-r-lg transition-colors">
                        Lacak
                    </button>
                </form>
            </div>
        </section>

        {{-- Section Toko Terdaftar --}}
        <section id="toko-terdaftar" class="py-20">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800">Toko Terdaftar</h2>
                    <p class="mt-2 text-gray-500">Temukan produk kami di toko-toko mitra terpercaya.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($stores as $store)
                        <div
                            class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            <h3 class="font-bold text-xl text-gray-900">{{ $store->name }}</h3>
                            <p class="text-gray-600 mt-2">{{ $store->address }}</p>
                        </div>
                    @empty
                        <div
                            class="md:col-span-2 lg:col-span-3 text-center bg-white border border-gray-200 rounded-lg p-8">
                            <p class="text-gray-500">Belum ada toko yang terdaftar saat ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- ===== [BARU] Section Transparansi Harga Pasar ===== --}}
        <section id="harga-pasar" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800">Transparansi Harga Pasar</h2>
                    <p class="mt-2 text-gray-500">Grafik ini menunjukkan harga rata-rata untuk membantu Anda memahami
                        dinamika pasar.</p>
                </div>
                {{-- Di sini kita akan meletakkan elemen canvas untuk grafik --}}
                <div class="max-w-4xl mx-auto">
                    <canvas id="priceChart"></canvas>
                </div>
            </div>
        </section>

        {{-- ===== [BARU] Section Informasi & Edukasi Telur ===== --}}
        <section id="edukasi" class="py-20">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800">Informasi & Edukasi Telur</h2>
                </div>
                <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    {{-- Kolom Kiri: Cara Penyimpanan --}}
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Cara Penyimpanan Telur yang Baik</h3>
                        <ul class="list-disc list-inside space-y-2 text-gray-600">
                            <li>Simpan telur di dalam kulkas pada suhu sekitar 4°C.</li>
                            <li>Letakkan telur di rak bagian dalam, bukan di pintu kulkas.</li>
                            <li>Simpan dalam karton aslinya untuk melindungi dari bau dan kerusakan.</li>
                            <li>Pastikan ujung telur yang lebih runcing berada di bawah.</li>
                        </ul>
                    </div>
                    {{-- Kolom Kanan: Nilai Gizi --}}
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Nilai Gizi per Butir (rata-rata)</h3>
                        <ul class="list-disc list-inside space-y-2 text-gray-600">
                            <li>Kalori: Sekitar 78 kcal</li>
                            <li>Protein: 6 gram</li>
                            <li>Lemak: 5 gram</li>
                            <li>Vitamin D, B12, A, dan Selenium</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; {{ date('Y') }} Telur Pangkep. Semua Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    {{-- ===== [BARU] SCRIPT UNTUK GRAFIK ===== --}}
    {{-- Memuat library Chart.js dari CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Mengambil data yang dikirim dari controller
        const priceLabels = @json($priceLabels ?? []);
        const farmerPrices = @json($farmerPrices ?? []);
        const distributorPrices = @json($distributorPrices ?? []);

        const data = {
            labels: priceLabels,
            datasets: [{
                    label: 'Harga Peternak (per butir)',
                    backgroundColor: 'rgba(52, 211, 153, 0.2)',
                    borderColor: 'rgba(52, 211, 153, 1)',
                    data: farmerPrices,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Harga Distributor (per butir)',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    data: distributorPrices,
                    fill: false,
                    tension: 0.4
                }
            ]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        ticks: {
                            // Format Rupiah pada sumbu Y
                            callback: function(value, index, ticks) {
                                return 'Rp ' + value;
                            }
                        }
                    }
                }
            }
        };

        // Render grafik pada elemen canvas dengan id 'priceChart'
        new Chart(
            document.getElementById('priceChart'),
            config
        );
    </script>

</body>

</html>
