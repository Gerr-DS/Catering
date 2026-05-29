<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Menu - {{ $menu->name }}</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gradient-to-b from-[#f5f9f6] to-[#fbfdfb] min-h-screen text-gray-800 font-sans">

    <!-- Navbar Standar / Responsive -->
    <nav class="bg-white/90 backdrop-blur-md shadow-sm py-4 sticky top-0 z-50 border-b border-gray-100/55 transition-all duration-300">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="flex justify-between items-center">
                <a href="/dashboard" class="font-bold text-xl text-[#1a472a] tracking-tight">Hafidz Catering<span class="text-[#c28e67]">.</span></a>
                
                <!-- Desktop Menu -->
                <ul class="hidden md:flex items-center space-x-5 text-sm font-medium">
                    <li><a href="/dashboard" class="hover:text-[#1a472a] px-4 py-2 rounded-full hover:bg-green-50/50 transition duration-300">Beranda</a></li>
                    <li><a href="/menu" class="text-white bg-[#1a472a] px-5 py-2 rounded-full transition duration-300 font-semibold shadow-sm hover:bg-[#112d1a]">Menu</a></li>
                    <li><a href="/dashboard#about-section" class="hover:text-[#1a472a] px-4 py-2 rounded-full hover:bg-green-50/50 transition duration-300">Tentang Kami</a></li>
                    <li><a href="/dashboard#contact-section" class="hover:text-[#1a472a] px-4 py-2 rounded-full hover:bg-green-50/50 transition duration-300">Kontak</a></li>
                </ul>

                <!-- Hamburger Button (Mobile) -->
                <button id="mobileMenuBtn" class="md:hidden flex items-center justify-center w-10 h-10 rounded-full hover:bg-green-50/60 text-[#1a472a] focus:outline-none transition duration-300">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div id="mobileMenu" class="hidden md:hidden mt-4 bg-white rounded-2xl border border-gray-100 p-4 shadow-xl transition-all duration-300 flex flex-col space-y-2">
                <a href="/dashboard" class="hover:text-[#1a472a] block px-4 py-2.5 rounded-xl hover:bg-green-50/50 transition font-medium text-sm text-gray-700">Beranda</a>
                <a href="/menu" class="text-white bg-[#1a472a] block px-4 py-2.5 rounded-xl transition font-semibold text-sm shadow-sm">Menu</a>
                <a href="/dashboard#about-section" class="hover:text-[#1a472a] block px-4 py-2.5 rounded-xl hover:bg-green-50/50 transition font-medium text-sm text-gray-700">Tentang Kami</a>
                <a href="/dashboard#contact-section" class="hover:text-[#1a472a] block px-4 py-2.5 rounded-xl hover:bg-green-50/50 transition font-medium text-sm text-gray-700">Kontak</a>
            </div>
        </div>
    </nav>

    <!-- Content Detail Produk -->
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4 max-w-4xl">
            
            <!-- Tombol Kembali -->
            <a href="/menu" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-[#1a472a] mb-8 transition-colors duration-300 group">
                <i class="fas fa-arrow-left mr-2.5 transition-transform duration-300 group-hover:-translate-x-1"></i> Kembali ke Menu
            </a>

            <!-- Card Utama -->
            <div class="bg-white rounded-3xl border border-emerald-50/50 shadow-[0_15px_45px_rgba(26,71,42,0.04)] overflow-hidden flex flex-col md:flex-row relative">
                
                <!-- Gambar Produk -->
                <div class="md:w-1/2 relative overflow-hidden group">
                    <span class="absolute top-4 left-4 bg-gradient-to-r from-[#d4a373] to-[#b07d56] text-white text-[10px] font-bold px-3.5 py-1.5 rounded-full shadow-md tracking-wider uppercase z-10">Pilihan Spesial</span>
                    @if($menu->image)
                        <img src="{{ asset('storage/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-72 md:h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105 min-h-[350px]">
                    @else
                        <div class="w-full h-72 md:h-full bg-[#f4f6f4] flex flex-col items-center justify-center text-gray-400 p-6 min-h-[350px]">
                            <i class="fas fa-image text-5xl mb-3 text-gray-300"></i>
                            <span class="text-sm font-semibold">Tidak ada gambar</span>
                        </div>
                    @endif
                </div>

                <!-- Informasi Produk -->
                <div class="md:w-1/2 p-8 md:p-10 flex flex-col justify-center bg-white">
                    <span class="text-[#c28e67] font-bold tracking-widest text-[11px] mb-2 uppercase block">KATERING PREMIUM</span>
                    <h1 id="nama-menu" class="text-3xl font-extrabold text-gray-900 mb-2 tracking-tight">{{ $menu->name }}</h1>
                    
                    <h2 class="text-2xl font-black text-[#1a472a] mb-5 flex items-baseline gap-1">
                        Rp <span id="harga-satuan-text">{{ number_format($menu->price, 0, ',', '.') }}</span>
                        <span class="text-xs text-gray-400 font-normal tracking-wide lowercase">/ porsi</span>
                    </h2>
                    
                    <div class="mb-6">
                        <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider mb-2">Deskripsi Hidangan</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">
                            {{ $menu->description ?: 'Hidangan premium terbaik kami yang diracik khusus menggunakan bahan baku pilihan segar, higienis, halal, dan dijamin memuaskan selera bersantap Anda sekeluarga.' }}
                        </p>
                    </div>

                    <!-- Pengaturan Porsi -->
                    <div class="mb-8 p-5 bg-gradient-to-br from-[#fafdfb] to-white rounded-2xl border border-emerald-50/50">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-gray-700">Jumlah Porsi:</span>
                            <!-- Kontrol Plus Minus -->
                            <div class="flex items-center bg-white border border-gray-200 rounded-xl overflow-hidden h-10 p-1">
                                <button onclick="ubahPorsi(-1)" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-100 hover:text-[#1a472a] transition-all duration-200"><i class="fas fa-minus text-xs"></i></button>
                                <input type="number" id="input-porsi" value="1" min="1" class="w-10 h-full text-center text-sm font-bold focus:outline-none bg-white pointer-events-none" readonly>
                                <button onclick="ubahPorsi(1)" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-100 hover:text-[#1a472a] transition-all duration-200"><i class="fas fa-plus text-xs"></i></button>
                            </div>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                            <span class="text-sm font-bold text-gray-800">Total Harga:</span>
                            <span class="text-xl font-extrabold text-[#c28e67] font-sans tracking-tight">Rp <span id="total-harga">{{ number_format($menu->price, 0, ',', '.') }}</span></span>
                        </div>
                    </div>

                    <!-- Tombol Pesan WA -->
                    <button onclick="pesanKeWA()" class="w-full bg-[#25D366] hover:bg-[#20ba59] text-white font-bold py-4 rounded-2xl shadow-[0_6px_20px_rgba(37,211,102,0.2)] hover:shadow-[0_10px_25px_rgba(37,211,102,0.35)] hover:-translate-y-0.5 transition-all duration-300 flex justify-center items-center gap-3 text-base">
                        <i class="fab fa-whatsapp text-xl"></i>
                        Pesan Sekarang
                    </button>
                    
                    <!-- Culinary Trust Badges -->
                    <div class="mt-6 pt-5 border-t border-gray-100 grid grid-cols-3 gap-2 text-center text-[10px] text-gray-400 font-semibold tracking-wider uppercase">
                        <div class="flex flex-col items-center">
                            <span class="text-lg mb-1 block">⭐</span>
                            <span>100% Halal</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <span class="text-lg mb-1 block">🥬</span>
                            <span>Bahan Segar</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <span class="text-lg mb-1 block">🧼</span>
                            <span>Higienis & Bersih</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skrip Logika Harga & WhatsApp -->
    <script>
        const hargaSatuan = {{ $menu->price }};
        let porsiSaatIni = 1;

        // Porsi Minimum diset 20 porsi jika menu katering (sesuai FAQ)
        // Namun demi kenyamanan pembeli, kita biarkan mulai dari 1 porsi, atau disesuaikan kelipatan
        function formatRupiah(angka) {
            return angka.toLocaleString('id-ID');
        }

        function ubahPorsi(nilai) {
            let porsiBaru = porsiSaatIni + nilai;
            if (porsiBaru >= 1) {
                porsiSaatIni = porsiBaru;
                document.getElementById('input-porsi').value = porsiSaatIni;
                let totalHarga = porsiSaatIni * hargaSatuan;
                document.getElementById('total-harga').innerText = formatRupiah(totalHarga);
            }
        }

        function pesanKeWA() {
            const namaMenu = document.getElementById('nama-menu').innerText;
            const totalHarga = document.getElementById('total-harga').innerText;
            const nomorAdmin = "6281234567890"; // Ganti nomor ini

            const teksPesan = `Halo *Hafidz Catering*, saya ingin memesan:\n\n` +
                              `🍱 *Menu:* ${namaMenu}\n` +
                              `🔢 *Jumlah:* ${porsiSaatIni} Porsi\n` +
                              `💰 *Total:* Rp ${totalHarga}\n\n` +
                              `Apakah pesanan ini masih tersedia?`;

            const urlWA = `https://wa.me/${nomorAdmin}?text=${encodeURIComponent(teksPesan)}`;
            window.open(urlWA, '_blank');
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuIcon = mobileMenuBtn.querySelector('i');

            mobileMenuBtn.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
                
                // Toggle icon between Hamburger (bars) and Close (xmark)
                if (mobileMenu.classList.contains('hidden')) {
                    mobileMenuIcon.classList.remove('fa-xmark');
                    mobileMenuIcon.classList.add('fa-bars');
                } else {
                    mobileMenuIcon.classList.remove('fa-bars');
                    mobileMenuIcon.classList.add('fa-xmark');
                }
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function (event) {
                const isClickInside = mobileMenuBtn.contains(event.target) || mobileMenu.contains(event.target);
                if (!isClickInside && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    mobileMenuIcon.classList.remove('fa-xmark');
                    mobileMenuIcon.classList.add('fa-bars');
                }
            });
        });
    </script>
</body>
</html>
