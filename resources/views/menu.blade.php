<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Hafidz Catering</title>
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

    <!-- Daftar Menu -->
    <section class="py-16">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="text-center mb-16">
                <span class="text-xs text-[#c28e67] font-bold tracking-widest uppercase bg-[#c28e67]/10 px-3.5 py-1.5 rounded-full">Menu Nusantara</span>
                <h1 class="text-4xl font-extrabold mt-4 mb-4 text-[#1a472a] tracking-tight md:text-5xl">Daftar Menu Kami</h1>
                <p class="text-gray-500 max-w-md mx-auto text-sm md:text-base">Pilih hidangan lezat berkualitas premium untuk melengkapi momen istimewa Anda.</p>
            </div>

            <!-- Grid Menu -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($menus as $menu)
                    @if($menu->status)
                        <!-- Menu Item -->
                        <a href="{{ route('menu.detail', $menu->id) }}" class="group bg-white rounded-3xl overflow-hidden border border-emerald-50/50 shadow-[0_10px_30px_rgba(26,71,42,0.03)] hover:shadow-[0_20px_45px_rgba(26,71,42,0.08)] hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between text-left relative">
                            <span class="absolute top-4 right-4 bg-[#1a472a] text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md tracking-wider z-10">TERSEDIA</span>
                            <div class="p-3">
                                <div class="overflow-hidden rounded-2xl w-full h-52 mb-4 bg-gray-100">
                                    @if($menu->image)
                                        <img src="{{ asset('storage/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 font-medium p-4">
                                            <span class="text-3xl mb-2">🍲</span>
                                            Tidak ada gambar
                                        </div>
                                    @endif
                                </div>
                                <div class="px-3 pb-2">
                                    <h3 class="font-bold text-xl mb-1 text-gray-900 group-hover:text-[#1a472a] transition-colors duration-300">{{ $menu->name }}</h3>
                                    <p class="text-xs text-gray-500 leading-relaxed line-clamp-3 mb-2">{{ $menu->description ?: 'Hidangan premium terbaik kami yang diracik khusus menggunakan bahan segar, higienis, halal, dan dijamin memuaskan selera.' }}</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-auto px-6 pb-6 pt-4 border-t border-gray-50 bg-[#fafdfb]/50">
                                <div class="flex flex-col">
                                    <span class="text-[10px] text-gray-400 font-medium uppercase tracking-wider">Harga per porsi</span>
                                    <span class="font-extrabold text-[#c28e67] text-xl font-sans tracking-tight">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                                </div>
                                <span class="bg-[#1a472a] text-white px-5 py-2.5 rounded-full text-xs font-bold tracking-wider group-hover:bg-[#112d1a] group-hover:scale-105 transition-all duration-300 shadow-md">
                                    Pesan
                                </span>
                            </div>
                        </a>
                    @endif
                @empty
                    <div class="col-span-full text-center py-16 bg-white border border-dashed border-gray-200 rounded-3xl p-8">
                        <span class="text-4xl block mb-4">🍲</span>
                        <h3 class="text-lg font-bold text-gray-700 mb-2">Belum Ada Menu Tersedia</h3>
                        <p class="text-sm text-gray-500 max-w-sm mx-auto mb-6">Maaf, saat ini seluruh hidangan katering kami sedang tidak tersedia atau habis dipesan. Silakan hubungi kami langsung via WhatsApp untuk pemesanan khusus!</p>
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Hafidz%20Catering,%20saya%20ingin%20memesan%20katering" target="_blank" class="inline-flex items-center gap-2 bg-[#25d366] hover:bg-[#20ba59] text-white px-6 py-2.5 rounded-full text-sm font-semibold transition shadow-md hover:shadow-lg">
                            <i class="fab fa-whatsapp text-base"></i> Hubungi WhatsApp Admin
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
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
