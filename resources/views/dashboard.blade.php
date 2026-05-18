<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hafidz Catering - Menu Utama</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: #f4f7f6;
            color: #333;
        }

        /* Header / Navbar */
        .navbar {
            background-color: #2e7d32;
            color: white;
            padding: 1.2rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .navbar h2 {
            font-size: 1.5rem;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: #a5d6a7;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
            color: white;
            text-align: center;
            padding: 0 1.5rem;
            margin-top: 65px;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.2rem;
        }

        .hero p {
            font-size: 1.3rem;
            max-width: 650px;
            margin-bottom: 2.5rem;
            opacity: 0.9;
        }

        .scroll-hint {
            font-size: 1.1rem;
            animation: bounce 2s infinite;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 20px;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-12px);
            }
            60% {
                transform: translateY(-6px);
            }
        }

        /* Info Section */
        .info-section {
            padding: 100px 20px 80px 20px;
            max-width: 850px;
            margin: 0 auto;
            text-align: center;
            opacity: 0;
            transform: translateY(60px);
            transition: all 0.9s ease-out;
        }

        .info-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .info-section h2 {
            font-size: 2.8rem;
            color: #2E7D32;
            margin-bottom: 2rem;
        }

        .info-section p {
            font-size: 1.2rem;
            line-height: 1.9;
            color: #444;
            margin-bottom: 2.5rem;
        }

        /* KODE CSS BARU UNTUK MENU SCROLL DITENGAH */
        .menu-container-center {
            width: 100%;
            display: flex;
            justify-content: center; 
            padding: 0 15px;
        }

        .menu-horizontal-scroll {
            display: flex;
            overflow-x: auto; 
            gap: 20px; 
            padding: 15px;
            padding-bottom: 25px; 
            scroll-snap-type: x mandatory;
            max-width: 100%; 
            justify-content: safe center; 
        }

        .menu-horizontal-scroll::-webkit-scrollbar {
            height: 8px;
        }

        .menu-horizontal-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .menu-horizontal-scroll::-webkit-scrollbar-thumb {
            background: #2E7D32;
            border-radius: 4px;
        }

        .menu-card {
            background: white;
            flex: 0 0 260px; /* Memastikan lebar kartu tetap */
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.08);
            text-align: center;
            overflow: hidden;
            scroll-snap-align: start;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .menu-card:hover {
            transform: translateY(-5px);
        }

        .menu-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .no-image {
            width: 100%;
            height: 180px;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
        }

        .menu-details {
            padding: 20px;
        }

        .menu-card h3 {
            font-size: 1.3rem;
            color: #1b5e20;
            margin-bottom: 10px;
        }

        .price {
            font-weight: bold;
            color: #2e7d32;
            font-size: 1.1rem;
        }

        /* FAQ Section */
        .faq-section {
            padding: 60px 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-section h2 {
            text-align: center;
            color: #2E7D32;
            font-size: 2.2rem;
            margin-bottom: 2rem;
        }

        .faq-item {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin-bottom: 15px;
            overflow: hidden;
        }

        .faq-question {
            width: 100%;
            background: none;
            border: none;
            outline: none;
            padding: 20px;
            font-size: 1.1rem;
            font-weight: 600;
            color: #2e7d32;
            text-align: left;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.2s;
        }

        .faq-question:hover {
            background-color: #f9fdf9;
        }

        .faq-icon {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out, padding 0.3s ease-out;
            color: #555;
            line-height: 1.7;
            background-color: #fafafa;
        }

        .faq-answer p {
            padding: 0 20px 20px 20px;
        }

        .faq-item.active .faq-answer {
            max-height: 200px;
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }

        /* Contact & Map Section */
        .contact-section {
            padding: 60px 20px 80px 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .contact-section h2 {
            text-align: center;
            color: #2E7D32;
            font-size: 2.2rem;
            margin-bottom: 2rem;
        }

        .map-container {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            height: 350px;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .social-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            border-radius: 30px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .wa-btn {
            background-color: #25d366;
        }

        .ig-btn {
            background: linear-gradient(45deg, #405de6, #833ab4, #c13584, #fd1d1d, #f56040);
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 2.5rem;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <h2>Hafidz Catering</h2>
        <ul class="nav-links">
            <li><a href="#about-section">Penjelasan</a></li>
            <li><a href="#menu-section">Menu</a></li>
            <li><a href="#faq-section">FAQ</a></li>
            <li><a href="#contact-section">Lokasi</a></li>
            <li><a href="#contact-section">Contact</a></li>
        </ul>
    </nav>

    <div class="hero">
        <h1>Selamat Datang di Hafidz Catering</h1>
        <p>Solusi hidangan berkualitas untuk berbagai acara spesial Anda.</p>
        <div class="scroll-hint">Gulir ke bawah untuk menjelajah ↓</div>
    </div>

    <div class="info-section" id="about-section">
        <h2>Apa itu Hafidz Catering?</h2>
        <p>
            Hafidz Catering adalah layanan katering premium yang berfokus pada penyediaan hidangan 
            berkualitas tinggi untuk berbagai acara, mulai dari pertemuan kantor, pernikahan, hingga acara keluarga. 
            Didukung oleh tim profesional dan bahan-bahan segar, kami memastikan setiap hidangan memberikan 
            pengalaman kuliner yang tak terlupakan bagi pelanggan kami.
        </p>
        <p>
            Kami selalu siap melayani segala kebutuhan konsumsi untuk menyukseskan acara Anda.
        </p>
    </div>

    <div class="menu-container-center" id="menu-section">
        <div class="menu-horizontal-scroll">
            @foreach($menus as $menu)
                @if($menu->status)
                    <div class="menu-card">
                        @if($menu->image)
                            <img src="{{ asset('storage/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="menu-image">
                        @else
                            <div class="no-image">Tidak ada gambar</div>
                        @endif

                        <div class="menu-details">
                            <h3>{{ $menu->name }}</h3>
                            <p class="price">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="faq-section" id="faq-section">
        <h2>Pertanyaan Umum (FAQ)</h2>
        <div class="faq-item">
            <button class="faq-question">
                1. Apakah ada batasan minimum pemesanan?
                <span class="faq-icon">▼</span>
            </button>
            <div class="faq-answer">
                <p>Ya, untuk menu prasmanan dan nasi kotak, pemesanan minimum adalah untuk 20 porsi. Namun, untuk beberapa menu seperti snack box atau nasi tumpeng, terdapat ketentuan khusus.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">
                2. Berapa lama waktu pemesanan yang disarankan?
                <span class="faq-icon">▼</span>
            </button>
            <div class="faq-answer">
                <p>Kami menyarankan pemesanan dilakukan minimal H-3 sebelum acara agar tim kami dapat mempersiapkan bahan dan kualitas hidangan dengan maksimal.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">
                3. Apakah tersedia layanan pesan antar (delivery)?
                <span class="faq-icon">▼</span>
            </button>
            <div class="faq-answer">
                <p>Ya, kami menyediakan layanan pengantaran langsung ke lokasi acara Anda. Biaya antar akan disesuaikan dengan jarak lokasi dari dapur kami.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">
                4. Apakah menu bisa dikustomisasi sesuai permintaan?
                <span class="faq-icon">▼</span>
            </button>
            <div class="faq-answer">
                <p>Tentu saja! Anda bisa berdiskusi dengan tim kami jika ada penyesuaian porsi, tingkat kepedasan, atau bahan tertentu yang ingin diubah.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">
                5. Bagaimana cara melakukan pembayaran?
                <span class="faq-icon">▼</span>
            </button>
            <div class="faq-answer">
                <p>Pembayaran dapat dilakukan melalui transfer bank atau pembayaran tunai di tempat (COD) dengan memberikan uang muka (DP) sebesar 30% terlebih dahulu.</p>
            </div>
        </div>
    </div>

    <div class="contact-section" id="contact-section">
        <h2>Lokasi & Hubungi Kami</h2>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126901.32594614131!2d106.72973970638531!3d-6.594432804566367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c4d2899478f7%3A0x6b49e32a67e5108!2sBogor%2C+Jawa+Barat!5e0!3m2!1sid!2sid!4v1715000000000!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="social-buttons">
            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Hafidz%20Catering,%20saya%20ingin%20memesan%20katering" class="social-btn wa-btn" target="_blank">
                <span>💬</span> Hubungi WhatsApp
            </a>
            <a href="https://instagram.com/hafidzcatering" class="social-btn ig-btn" target="_blank">
                <span>📸</span> Lihat Instagram
            </a>
        </div>
    </div>

    <footer>
        © 2026 Hafidz Catering. Semua Hak Dilindungi.
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const section = document.getElementById('about-section');

            function checkVisibility() {
                const triggerBottom = window.innerHeight * 0.85;
                const sectionTop = section.getBoundingClientRect().top;

                if (sectionTop < triggerBottom) {
                    section.classList.add('visible');
                }
            }

            window.addEventListener('scroll', checkVisibility);
            checkVisibility();

            const faqQuestions = document.querySelectorAll('.faq-question');
            faqQuestions.forEach(button => {
                button.addEventListener('click', () => {
                    const faqItem = button.parentElement;
                    faqItem.classList.toggle('active');
                });
            });
        });
    </script>
</body>
</html>