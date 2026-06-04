<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hafidz Catering - Menu Utama</title>
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1a472a;
            --primary-dark: #0f2b19;
            --primary-light: #2d613e;
            --accent: #c28e67;
            --accent-gradient: linear-gradient(135deg, #d4a373 0%, #b07d56 100%);
            --bg-gradient: linear-gradient(180deg, #f5f9f6 0%, #fbfdfb 100%);
            --text-dark: #1b261e;
            --text-muted: #5c6c60;
            --card-shadow: 0 10px 30px rgba(26, 71, 42, 0.04);
            --hover-shadow: 0 20px 45px rgba(26, 71, 42, 0.09);
            --glass-bg: rgba(255, 255, 255, 0.88);
            --glass-border: rgba(255, 255, 255, 0.4);
            --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background: var(--bg-gradient);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        #about-section, #menu-section, #faq-section, #contact-section, #social-section {
            scroll-margin-top: 100px;
        }

        .mobile-menu-btn {
            display: none;
        }

        /* Header / Navbar - glassmorphic floating pill navbar */
        .navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 50px;
            padding: 0.85rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 90%;
            max-width: 1100px;
            top: 24px;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
            z-index: 1000;
            border: 1px solid var(--glass-border);
            transition: var(--transition);
        }

        .navbar h2 {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: -0.5px;
        }

        .navbar h2 span {
            color: var(--accent);
        }

        .nav-links {
            display: flex;
            gap: 1rem;
            list-style: none;
            align-items: center;
        }

        .nav-links a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            transition: var(--transition);
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
        }

        .nav-links a:hover {
            color: var(--primary);
            background: rgba(26, 71, 42, 0.04);
        }

        /* Highlight active link */
        .nav-links a.active {
            background-color: var(--primary);
            color: white !important;
            box-shadow: 0 6px 15px rgba(26, 71, 42, 0.15);
        }

        .nav-links a.active:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26, 71, 42, 0.25);
        }

        /* Hero Section style matches template with premium dark green overlay and parallax touch */
        .hero {
            position: relative;
            height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-image: url('https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1920&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 0 1.5rem;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(17, 45, 27, 0.35) 0%, rgba(15, 43, 25, 0.8) 100%);
            z-index: 1;
        }

        .hero h1, .hero p, .hero .scroll-hint {
            position: relative;
            z-index: 2;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: 3.8rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.35);
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            letter-spacing: -1px;
        }

        .hero p {
            font-size: 1.45rem;
            font-weight: 300;
            max-width: 700px;
            margin-bottom: 3rem;
            opacity: 0.95;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.35);
            animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Premium Green Button Scroll Hint */
        .hero .scroll-hint {
            background: var(--accent-gradient);
            color: white;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 14px 38px;
            border-radius: 50px;
            transition: var(--transition);
            box-shadow: 0 8px 25px rgba(194, 142, 103, 0.35);
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
            border: none;
            animation: fadeInUp 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .hero .scroll-hint:hover {
            background: linear-gradient(135deg, #dfab7b 0%, #a26b44 100%);
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(194, 142, 103, 0.5);
        }

        /* TABLET STYLES (768px to 1024px) */
        @media (min-width: 768px) and (max-width: 1024px) {
            .navbar {
                width: 92%;
                padding: 0.8rem 1.8rem;
            }

            .navbar h2 {
                font-size: 1.2rem;
            }

            .nav-links {
                gap: 0.5rem;
            }

            .nav-links a {
                font-size: 0.8rem;
                padding: 0.4rem 0.9rem;
            }

            .hero h1 {
                font-size: 3rem;
            }

            .hero p {
                font-size: 1.25rem;
            }
        }

        /* MOBILE STYLES (max-width: 768px) */
        @media (max-width: 768px) {
            #about-section, #menu-section, #faq-section, #contact-section, #social-section {
                scroll-margin-top: 80px;
            }

            .navbar {
                width: 100% !important;
                max-width: 100% !important;
                top: 0 !important;
                left: 0 !important;
                transform: none !important;
                border-radius: 0 !important;
                padding: 1rem 1.5rem !important;
                box-sizing: border-box;
                border-left: none !important;
                border-right: none !important;
                border-top: none !important;
                border-bottom: 1px solid rgba(26, 71, 42, 0.1) !important;
                background: rgba(255, 255, 255, 0.95) !important;
                backdrop-filter: blur(12px) !important;
                -webkit-backdrop-filter: blur(12px) !important;
                flex-wrap: wrap;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
            }
            
            .navbar h2 {
                font-size: 1.25rem;
            }

            .mobile-menu-btn {
                display: block;
                background: none;
                border: none;
                font-size: 1.35rem;
                color: var(--primary);
                cursor: pointer;
                padding: 4px;
                transition: var(--transition);
                outline: none;
            }

            .nav-links {
                display: none;
                width: 100%;
                flex-direction: column;
                gap: 0.2rem;
                padding-top: 1rem;
                align-items: center;
                background: transparent;
            }

            .nav-links.show {
                display: flex;
            }

            .nav-links li {
                width: 100%;
                text-align: center;
            }

            .nav-links a {
                display: block;
                width: 100%;
                font-size: 0.9rem !important;
                padding: 0.6rem 0 !important;
                border-radius: 12px;
            }

            .hero {
                height: 75vh;
            }

            .hero h1 {
                font-size: 2.25rem;
                margin-bottom: 0.75rem;
                line-height: 1.2;
            }

            .hero p {
                font-size: 1.05rem;
                margin-bottom: 2rem;
            }
            
            .hero .scroll-hint {
                font-size: 0.85rem;
                padding: 12px 28px;
            }

            .info-section {
                padding: 40px 20px;
                margin: 60px 15px 30px 15px;
                border-radius: 24px;
            }

            .info-section h2 {
                font-size: 1.8rem;
            }

            .info-section p {
                font-size: 0.95rem;
                line-height: 1.6;
            }

            .menu-container-center {
                padding: 20px 10px;
            }

            .menu-container-center h2 {
                font-size: 1.8rem !important;
            }

            .menu-card {
                flex: 0 0 280px;
                border-radius: 20px;
            }

            .menu-image {
                height: 180px;
            }

            .faq-section {
                padding: 50px 15px;
            }

            .faq-section h2 {
                font-size: 1.8rem;
                margin-bottom: 1.8rem;
            }

            .faq-question {
                padding: 18px 20px;
                font-size: 0.95rem;
            }

            .faq-answer p {
                padding: 0 20px 18px 20px;
                font-size: 0.88rem;
            }

            .contact-section {
                padding: 50px 15px;
            }

            .contact-section h2 {
                font-size: 1.8rem;
                margin-bottom: 1.8rem;
            }

            .map-container {
                height: 280px;
                border-radius: 20px;
                margin-bottom: 30px;
            }

            .social-buttons {
                gap: 12px;
            }

            .social-btn {
                padding: 12px 24px;
                font-size: 0.95rem;
                width: 100%;
                justify-content: center;
            }

            footer {
                padding: 50px 20px 30px 20px;
            }

            .footer-content {
                gap: 30px;
            }
        }

        /* NARROW MOBILE STYLES (max-width: 360px) */
        @media (max-width: 360px) {
            .navbar {
                padding: 0.6rem 0.8rem;
            }

            .nav-links a {
                font-size: 0.68rem;
                padding: 0.3rem 0.6rem;
            }

            .menu-card {
                flex: 0 0 250px;
            }
        }

        /* Info Section Spotlight Card */
        .info-section {
            padding: 60px 45px;
            max-width: 900px;
            margin: 80px auto 40px auto;
            text-align: center;
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 32px;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(255, 255, 255, 0.5);
            position: relative;
        }

        .info-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .info-section h2 {
            font-size: 2.3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1.25rem;
            position: relative;
        }

        .info-section h2::after {
            content: "";
            display: block;
            width: 50px;
            height: 3px;
            background-color: var(--primary);
            margin: 8px auto 0 auto;
            border-radius: 2px;
        }

        .info-section p {
            font-size: 1.05rem;
            line-height: 1.75;
            color: var(--text-muted);
            margin-bottom: 25px;
        }

        /* Elegant Key values grid underneath description */
        .about-grid {
            display: grid;
            grid-template-cols: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .about-card {
            background: white;
            border-radius: 20px;
            padding: 24px 20px;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(26, 71, 42, 0.02);
            border: 1px solid rgba(26, 71, 42, 0.03);
            text-align: center;
        }

        .about-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(26, 71, 42, 0.06);
            border-color: rgba(26, 71, 42, 0.1);
        }

        .about-icon {
            font-size: 2.2rem;
            display: inline-block;
            margin-bottom: 12px;
        }

        .about-card h4 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 6px;
        }

        .about-card p {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 0;
            line-height: 1.4;
        }

        /* Menu Horizontal Scroll Styling */
        .menu-container-center {
            width: 100%;
            display: flex;
            justify-content: center; 
            padding: 40px 15px;
        }

        .menu-horizontal-scroll {
            display: flex;
            overflow-x: auto; 
            gap: 24px; 
            padding: 20px 15px 30px 15px;
            scroll-snap-type: x mandatory;
            max-width: 100%; 
            justify-content: safe center; 
        }

        .menu-horizontal-scroll::-webkit-scrollbar {
            height: 8px;
        }

        .menu-horizontal-scroll::-webkit-scrollbar-track {
            background: #f1f5f2;
            border-radius: 8px;
        }

        .menu-horizontal-scroll::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 8px;
        }

        .menu-horizontal-scroll::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        .menu-card {
            background: white;
            flex: 0 0 300px;
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            text-align: center;
            overflow: hidden;
            scroll-snap-align: start;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
            border: 1px solid rgba(26, 71, 42, 0.04);
            position: relative;
        }

        .menu-card:hover {
            transform: translateY(-10px) scale(1.01);
            box-shadow: var(--hover-shadow);
            border-color: rgba(26, 71, 42, 0.12);
        }

        .menu-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .menu-card:hover .menu-image {
            transform: scale(1.08);
        }

        .no-image {
            width: 100%;
            height: 200px;
            background-color: #f4f6f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .no-image span {
            font-size: 2rem;
            margin-bottom: 8px;
        }

        .badge-ready {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--primary);
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 30px;
            box-shadow: 0 4px 10px rgba(26, 71, 42, 0.2);
            letter-spacing: 0.5px;
            z-index: 10;
        }

        .menu-details {
            padding: 24px 22px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            text-align: left;
        }

        .menu-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            letter-spacing: -0.2px;
        }

        .price {
            font-weight: 700;
            color: var(--accent);
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.25rem;
            margin-top: auto;
            border-top: 1px solid #f0f4f0;
            padding-top: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 500;
            -webkit-text-fill-color: initial;
        }

        /* Beautiful Empty State Card with soft shadows and glow */
        .empty-state {
            width: 100%;
            max-width: 650px;
            background: white;
            border: 2px dashed rgba(26, 71, 42, 0.18);
            border-radius: 28px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: var(--card-shadow);
            margin: 20px auto 40px auto;
            transition: var(--transition);
        }

        .empty-state:hover {
            border-color: var(--primary);
            box-shadow: var(--hover-shadow);
            transform: translateY(-3px);
        }

        /* FAQ Section Accordion styling */
        .faq-section {
            padding: 80px 20px;
            max-width: 850px;
            margin: 0 auto;
        }

        .faq-section h2 {
            text-align: center;
            color: var(--primary);
            font-size: 2.3rem;
            font-weight: 700;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .faq-section h2::after {
            content: "";
            display: block;
            width: 50px;
            height: 4px;
            background-color: var(--primary);
            margin: 10px auto 0 auto;
            border-radius: 2px;
        }

        .faq-item {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 18px rgba(26, 71, 42, 0.015);
            margin-bottom: 18px;
            overflow: hidden;
            border: 1px solid rgba(26, 71, 42, 0.03);
            transition: var(--transition);
        }

        .faq-item:hover {
            box-shadow: 0 8px 25px rgba(26, 71, 42, 0.04);
            border-color: rgba(26, 71, 42, 0.08);
        }

        .faq-item.active {
            border-color: rgba(26, 71, 42, 0.16);
            box-shadow: 0 12px 30px rgba(26, 71, 42, 0.06);
        }

        .faq-question {
            width: 100%;
            background: none;
            border: none;
            outline: none;
            padding: 24px 28px;
            font-size: 1.08rem;
            font-weight: 600;
            color: var(--text-dark);
            text-align: left;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition);
        }

        .faq-question:hover {
            color: var(--primary);
            background-color: #f7faf8;
        }

        .faq-icon {
            font-size: 0.8rem;
            color: var(--primary);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            background: rgba(26, 71, 42, 0.05);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            color: var(--text-muted);
            line-height: 1.75;
            background-color: #fafdfb;
        }

        .faq-answer p {
            padding: 0 28px 24px 28px;
            font-size: 0.95rem;
        }

        .faq-item.active .faq-answer {
            max-height: 250px;
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
            background: var(--primary);
            color: white;
        }

        /* Contact & Map Section */
        .contact-section {
            padding: 80px 20px;
            max-width: 900px;
            margin: 0 auto;
        }

        .contact-section h2 {
            text-align: center;
            color: var(--primary);
            font-size: 2.3rem;
            font-weight: 700;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .contact-section h2::after {
            content: "";
            display: block;
            width: 50px;
            height: 4px;
            background-color: var(--primary);
            margin: 10px auto 0 auto;
            border-radius: 2px;
        }

        .map-container {
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(26, 71, 42, 0.06);
            margin-bottom: 40px;
            height: 400px;
            border: 1px solid rgba(26, 71, 42, 0.07);
            transition: var(--transition);
        }

        .map-container:hover {
            transform: translateY(-4px);
            box-shadow: 0 22px 50px rgba(26, 71, 42, 0.12);
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 24px;
            flex-wrap: wrap;
        }

        .social-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 34px;
            border-radius: 50px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.05rem;
            transition: var(--transition);
        }

        .social-btn:hover {
            transform: translateY(-4px);
        }

        .wa-btn {
            background-color: #25d366;
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.25);
        }

        .wa-btn:hover {
            background-color: #20ba59;
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
        }

        .ig-btn {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            box-shadow: 0 6px 20px rgba(220, 39, 66, 0.25);
        }

        .ig-btn:hover {
            box-shadow: 0 10px 25px rgba(220, 39, 66, 0.4);
        }

        /* Footer Redesign with premium corporate information grids */
        footer {
            background-color: var(--primary-dark);
            color: rgba(255, 255, 255, 0.65);
            padding: 70px 20px 40px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .footer-content {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 40px;
            text-align: left;
            margin-bottom: 50px;
        }

        .footer-brand h3 {
            color: white;
            font-size: 1.45rem;
            font-weight: 700;
            margin-bottom: 15px;
            letter-spacing: -0.3px;
        }

        .footer-brand h3 span {
            color: var(--accent);
        }

        .footer-brand p {
            font-size: 0.9rem;
            line-height: 1.6;
            max-width: 320px;
        }

        .footer-links h4 {
            color: white;
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
            display: inline-block;
        }

        .footer-links a:hover {
            color: white;
            transform: translateX(4px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 25px;
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <h2>Hafidz Catering<span>.</span></h2>
        <button id="mobileMenuBtn" class="mobile-menu-btn">
            <i class="fa-solid fa-bars"></i>
        </button>
        <ul class="nav-links" id="navLinks">
            <li><a href="#about-section" class="active">Penjelasan</a></li>
            <li><a href="#menu-section">Menu</a></li>
            <li><a href="#faq-section">FAQ</a></li>
            <li><a href="#contact-section">Lokasi</a></li>
            <li><a href="#social-section">Contact</a></li>
        </ul>
    </nav>

    <div class="hero">
        <h1>Selamat Datang di Hafidz Catering</h1>
        <p>Solusi hidangan berkualitas untuk berbagai acara spesial Anda.</p>
        <a href="#about-section" class="scroll-hint">Gulir ke bawah untuk menjelajah ↓</a>
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
        <div style="width: 100%; max-width: 1200px; display: flex; flex-direction: column; align-items: center;">
            <h2 style="font-size: 2.2rem; font-weight: 700; color: #1a472a; margin-bottom: 30px; text-align: center; position: relative; font-family: 'Poppins', sans-serif;">
                Menu Kami
                <span style="display: block; font-size: 0.9rem; font-weight: 500; color: #c28e67; margin-top: 8px;">Tersedia {{ $menus->where('status', true)->count() }} Pilihan Hidangan Lezat</span>
                <span style="display: block; width: 60px; height: 4px; background-color: #1a472a; margin: 10px auto 0; border-radius: 2px;"></span>
            </h2>
            <div class="menu-horizontal-scroll" style="width: 100%;">
                @php $readyCount = 0; @endphp
                @foreach($menus as $menu)
                    @if($menu->status)
                        @php $readyCount++; @endphp
                        <a href="{{ route('menu.detail', $menu->id_menu) }}" class="menu-card {{ $readyCount > 3 ? 'extra-menu' : '' }}" style="text-decoration: none; color: inherit; {{ $readyCount > 3 ? 'display: none;' : '' }}">
                            <span class="badge-ready">TERSEDIA</span>
                            @if($menu->gambar)
                                <img src="{{ asset('storage/menus/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="menu-image">
                            @else
                                <div class="no-image">
                                    <span>🍲</span>
                                    Tidak ada gambar
                                </div>
                            @endif

                            <div class="menu-details">
                                <h3>{{ $menu->nama_menu }}</h3>
                                @if($menu->deskripsi)
                                    <p style="font-size: 0.85rem; color: var(--text-muted); margin: 8px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; min-height: 2.8em;">{{ $menu->deskripsi }}</p>
                                @else
                                    <div style="min-height: 2.8em; margin: 8px 0;"></div>
                                @endif
                                <p class="price">
                                    <span class="price-label">Harga Porsi</span>
                                    Rp {{ number_format($menu->harga_menu, 0, ',', '.') }}
                                </p>
                            </div>
                        </a>
                    @endif
                @endforeach

                @if($readyCount === 0)
                    <!-- Beautiful Empty State Card -->
                    <div class="empty-state">
                        <span style="font-size: 3.5rem; display: block; margin-bottom: 15px;">🍲</span>
                        <h4 style="font-size: 1.35rem; font-weight: 700; color: var(--primary); margin-bottom: 10px;">Belum Ada Menu Tersedia</h4>
                        <p style="font-size: 0.95rem; color: var(--text-muted); line-height: 1.7; max-width: 480px; margin: 0 auto 25px auto;">
                            Maaf, saat ini seluruh hidangan katering kami sedang tidak tersedia atau habis dipesan. Silakan hubungi kami langsung via WhatsApp untuk pemesanan khusus!
                        </p>
                        <a href="https://wa.me/6282114352721?text=Halo%20Admin%20Hafidz%20Catering,%20saya%20ingin%20bertanya%20mengenai%20pemesanan%20katering" target="_blank" class="social-btn wa-btn" style="display: inline-flex; justify-content: center; margin: 0 auto;">
                            <i class="fab fa-whatsapp" style="font-size: 1.25rem;"></i> Hubungi WhatsApp Admin
                        </a>
                    </div>
                @endif
            </div>

            @if($readyCount > 3)
                <div style="text-align: center; margin-top: 30px;">
                    <a href="{{ route('menu.pembeli') }}" style="
                        display: inline-block;
                        background-color: #1a472a;
                        color: white;
                        font-family: 'Poppins', sans-serif;
                        font-weight: 600;
                        font-size: 0.95rem;
                        padding: 12px 36px;
                        border-radius: 50px;
                        text-decoration: none;
                        transition: all 0.3s ease;
                        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
                    "
                    onmouseover="this.style.background='#225c37'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.background='#1a472a'; this.style.transform='translateY(0)';">
                        Lihat Menu Lainnya →
                    </a>
                </div>
            @endif
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
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.535090448107!2d106.77884177498335!3d-6.580227193412959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5003a2e03ab%3A0xf8fd8230520d0d73!2sTaman%20Cimanggu%2C%20Jl.%20Amarilis%205%20Blok%20V%20-%20XI%20No.9%2C%20RT.02%2C%20Bogor%20Barat!5e0!3m2!1sid!2sid!4v1715000000000!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="social-buttons" id="social-section">
            <a href="https://wa.me/6282114352721?text=Halo%20Admin%20Hafidz%20Catering,%20saya%20ingin%20memesan%20katering" class="social-btn wa-btn" target="_blank">
                <i class="fab fa-whatsapp" style="font-size: 1.3rem;"></i> Hubungi WhatsApp
            </a>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <h3>Hafidz Catering<span>.</span></h3>
                <p>Layanan katering premium terpercaya dengan cita rasa nusantara otentik, higienis, dan bahan bermutu tinggi untuk menyukseskan setiap momen spesial Anda.</p>
            </div>
            <div class="footer-links">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="#about-section">Tentang Kami</a></li>
                    <li><a href="#menu-section">Menu Pilihan</a></li>
                    <li><a href="#faq-section">Tanya Jawab (FAQ)</a></li>
                    <li><a href="#contact-section">Lokasi Kami</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Layanan Kami</h4>
                <ul>
                    <li><a href="/menu">Katering Prasmanan</a></li>
                    <li><a href="/menu">Nasi Kotak Premium</a></li>
                    <li><a href="/menu">Snack Box Acara</a></li>
                    <li><a href="/menu">Nasi Tumpeng Hias</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2026 Hafidz Catering. Semua Hak Dilindungi.
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mobile Menu Toggle
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const navLinksContainer = document.getElementById('navLinks');
            const mobileMenuIcon = mobileMenuBtn.querySelector('i');

            mobileMenuBtn.addEventListener('click', function () {
                navLinksContainer.classList.toggle('show');
                
                // Toggle icon between Hamburger (bars) and Close (xmark)
                if (navLinksContainer.classList.contains('show')) {
                    mobileMenuIcon.classList.remove('fa-bars');
                    mobileMenuIcon.classList.add('fa-xmark');
                } else {
                    mobileMenuIcon.classList.remove('fa-xmark');
                    mobileMenuIcon.classList.add('fa-bars');
                }
            });

            // Close mobile menu when clicking a link
            const navLinksItems = navLinksContainer.querySelectorAll('a');
            navLinksItems.forEach(link => {
                link.addEventListener('click', () => {
                    navLinksContainer.classList.remove('remove'); // safety remove
                    navLinksContainer.classList.remove('show');
                    mobileMenuIcon.classList.remove('fa-xmark');
                    mobileMenuIcon.classList.add('fa-bars');
                });
            });

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

            // Scroll Spy and Click highlight logic for Navbar
            const navLinks = document.querySelectorAll('.nav-links a');
            const scrollSections = document.querySelectorAll('#about-section, #menu-section, #faq-section, #contact-section, #social-section');

            function activateNavLink() {
                let currentSection = '';
                const scrollPos = window.scrollY || document.documentElement.scrollTop;

                scrollSections.forEach(sec => {
                    const sectionTop = sec.offsetTop;
                    
                    // Trigger section active if the viewport scroll is inside the section
                    // Using an offset (like 200px) so the visual pill updates slightly before the section fully hits the top of the viewport
                    if (scrollPos >= (sectionTop - 200)) {
                        currentSection = sec.getAttribute('id');
                    }
                });

                if (currentSection) {
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${currentSection}`) {
                            link.classList.add('active');
                        }
                    });
                } else {
                    // Default to first nav link if at the very top (Hero section)
                    navLinks.forEach((link, idx) => {
                        if (idx === 0) {
                            link.classList.add('active');
                        } else {
                            link.classList.remove('active');
                        }
                    });
                }
            }

            // Click listener for instant visual feedback on click
            navLinks.forEach(link => {
                link.addEventListener('click', function () {
                    navLinks.forEach(item => item.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            window.addEventListener('scroll', activateNavLink);
            // Run initially to set the correct active state on load
            activateNavLink();
        });
    </script>
</body>
</html>