<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Java Express | Cafeteria para Devs</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --azul-java: #291f73;
            --azul-java-escuro: #1a1349;
            --azul-java-claro: #3d2fa8;
            --vermelho-express: #a81b1b;
            --vermelho-hover: #821414;
            --marrom-cafe: #523725;
            --marrom-claro: #7a5540;
            --creme-claro: #fcf9f5;
            --creme-medio: #f5ede3;
            --branco: #ffffff;
            --cinza-texto: #6c757d;
            --sombra-suave: 0 8px 32px rgba(41, 31, 115, 0.10);
            --sombra-hover: 0 16px 48px rgba(41, 31, 115, 0.18);
            --raio-card: 18px;
            --raio-btn: 50px;
            --fonte-display: 'Playfair Display', Georgia, serif;
            --fonte-corpo: 'DM Sans', 'Segoe UI', sans-serif;
        }

        /* ─── Reset & Base ─── */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            background-color: var(--creme-claro);
            font-family: var(--fonte-corpo);
            color: var(--marrom-cafe);
            margin: 0;
            overflow-x: hidden;
        }

        /* ─── Skip Link (Acessibilidade) ─── */
        .skip-link {
            position: absolute;
            top: -100px;
            left: 1rem;
            background: var(--azul-java);
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: var(--raio-btn);
            font-size: 0.875rem;
            z-index: 9999;
            text-decoration: none;
            transition: top 0.2s;
        }
        .skip-link:focus { top: 1rem; }

        /* ─── Navbar ─── */
        .navbar.bg-java {
            background-color: var(--azul-java);
            padding: 0.85rem 0;
            border-bottom: 3px solid var(--vermelho-express);
        }
        .navbar.bg-java .navbar-brand {
            font-family: var(--fonte-display);
            font-size: 1.5rem;
            color: #fff;
            letter-spacing: -0.5px;
        }
        .navbar.bg-java .navbar-brand .badge-brand {
            font-family: var(--fonte-corpo);
            font-size: 0.6rem;
            background: var(--vermelho-express);
            color: #fff;
            padding: 2px 6px;
            border-radius: 4px;
            vertical-align: middle;
            margin-left: 4px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .navbar.bg-java .nav-link {
            color: rgba(255,255,255,0.85);
            font-size: 0.9rem;
            font-weight: 500;
            padding: 0.4rem 0.9rem !important;
            border-radius: var(--raio-btn);
            transition: color 0.2s, background 0.2s;
        }
        .navbar.bg-java .nav-link:hover,
        .navbar.bg-java .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.12);
        }
        .navbar.bg-java .btn-nav-cta {
            background: var(--vermelho-express);
            color: #fff !important;
            font-weight: 600;
            padding: 0.4rem 1.1rem !important;
        }
        .navbar.bg-java .btn-nav-cta:hover {
            background: var(--vermelho-hover);
        }

        /* ─── Hero ─── */
        .hero-header {
            position: relative;
            background:
                linear-gradient(135deg, rgba(26, 19, 73, 0.93) 0%, rgba(82, 55, 37, 0.82) 100%),
                url('https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?q=80&w=1400') no-repeat center center / cover;
            color: #fff;
            padding: 120px 0 100px;
            overflow: hidden;
        }
        .hero-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 60px;
            background: var(--creme-claro);
            clip-path: ellipse(55% 100% at 50% 100%);
        }
        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(168, 27, 27, 0.25);
            border: 1px solid rgba(168, 27, 27, 0.5);
            color: #ffb3b3;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: var(--raio-btn);
            margin-bottom: 1.25rem;
            animation: fadeInUp 0.6s ease both;
        }
        .hero-title {
            font-family: var(--fonte-display);
            font-size: clamp(2.4rem, 5.5vw, 4.2rem);
            font-weight: 900;
            line-height: 1.1;
            letter-spacing: -1.5px;
            margin-bottom: 1.25rem;
            animation: fadeInUp 0.6s 0.1s ease both;
        }
        .hero-title .destaque {
            color: #ffb3b3;
            font-style: italic;
        }
        .hero-desc {
            font-size: 1.1rem;
            font-weight: 300;
            line-height: 1.7;
            color: rgba(255,255,255,0.82);
            max-width: 520px;
            margin-bottom: 2rem;
            animation: fadeInUp 0.6s 0.2s ease both;
        }
        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            animation: fadeInUp 0.6s 0.3s ease both;
        }
        .hero-stats {
            display: flex;
            gap: 2rem;
            margin-top: 3rem;
            animation: fadeInUp 0.6s 0.4s ease both;
        }
        .hero-stat-num {
            font-family: var(--fonte-display);
            font-size: 1.9rem;
            font-weight: 700;
            color: #fff;
            line-height: 1;
        }
        .hero-stat-label {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.6);
            margin-top: 2px;
            letter-spacing: 0.5px;
        }
        .hero-divider {
            width: 1px;
            background: rgba(255,255,255,0.2);
            align-self: stretch;
        }
        .hero-image-wrap {
            position: relative;
            animation: fadeInRight 0.7s 0.35s ease both;
        }
        .hero-image-wrap img {
            width: 100%;
            max-width: 420px;
            border-radius: 24px;
            border: 4px solid rgba(255,255,255,0.15);
            display: block;
            margin-left: auto;
        }
        .hero-badge-float {
            position: absolute;
            bottom: -10px;
            left: -10px;
            background: var(--vermelho-express);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 10px 16px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(168,27,27,0.4);
        }

        /* ─── Buttons ─── */
        .btn-express {
            background-color: var(--vermelho-express);
            color: #fff;
            border: none;
            padding: 0.75rem 1.75rem;
            border-radius: var(--raio-btn);
            font-weight: 600;
            font-size: 0.95rem;
            transition: background 0.25s, transform 0.25s, box-shadow 0.25s;
        }
        .btn-express:hover, .btn-express:focus {
            background-color: var(--vermelho-hover);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(168,27,27,0.35);
        }
        .btn-outline-branco {
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255,255,255,0.45);
            padding: 0.7rem 1.6rem;
            border-radius: var(--raio-btn);
            font-weight: 500;
            font-size: 0.95rem;
            transition: background 0.25s, border-color 0.25s;
        }
        .btn-outline-branco:hover, .btn-outline-branco:focus {
            background: rgba(255,255,255,0.12);
            border-color: rgba(255,255,255,0.8);
            color: #fff;
        }

        /* ─── Seção Why ─── */
        .section-label {
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--vermelho-express);
            margin-bottom: 0.6rem;
        }
        .section-title {
            font-family: var(--fonte-display);
            font-size: clamp(1.8rem, 3.5vw, 2.6rem);
            font-weight: 700;
            color: var(--azul-java);
            line-height: 1.2;
            letter-spacing: -0.5px;
        }

        .card-cafe {
            border: none;
            border-radius: var(--raio-card);
            box-shadow: var(--sombra-suave);
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: var(--branco);
            overflow: hidden;
        }
        .card-cafe:hover {
            transform: translateY(-6px);
            box-shadow: var(--sombra-hover);
        }
        .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 1rem;
        }
        .icon-box.vermelho { background: rgba(168,27,27,0.1); color: var(--vermelho-express); }
        .icon-box.azul     { background: rgba(41,31,115,0.1); color: var(--azul-java); }
        .icon-box.marrom   { background: rgba(82,55,37,0.1);  color: var(--marrom-cafe); }

        /* ─── Cardápio ─── */
        .bg-menu { background-color: var(--creme-medio); }

        .menu-card {
            background: var(--branco);
            border-radius: var(--raio-card);
            overflow: hidden;
            box-shadow: var(--sombra-suave);
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--sombra-hover);
        }
        .menu-card-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .menu-card-body { padding: 1.25rem; }
        .menu-card-tag {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--vermelho-express);
            margin-bottom: 0.35rem;
        }
        .menu-card-name {
            font-family: var(--fonte-display);
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--azul-java);
            margin-bottom: 0.35rem;
        }
        .menu-card-desc {
            font-size: 0.87rem;
            color: var(--cinza-texto);
            line-height: 1.5;
            margin-bottom: 1rem;
        }
        .menu-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .menu-card-price {
            font-family: var(--fonte-display);
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--marrom-cafe);
        }
        .btn-add {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--azul-java);
            color: #fff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
            flex-shrink: 0;
        }
        .btn-add:hover { background: var(--azul-java-claro); transform: scale(1.1); }
        .btn-add:focus {
            outline: 3px solid var(--azul-java-claro);
            outline-offset: 2px;
        }

        /* ─── CTA Banner ─── */
        .cta-banner {
            background: linear-gradient(135deg, var(--azul-java) 0%, var(--azul-java-escuro) 100%);
            border-radius: 24px;
            color: #fff;
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .cta-banner::before {
            content: '\f0f4';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: -20px;
            bottom: -30px;
            font-size: 12rem;
            color: rgba(255,255,255,0.05);
            line-height: 1;
            pointer-events: none;
        }
        .cta-banner-title {
            font-family: var(--fonte-display);
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            font-weight: 700;
            margin-bottom: 0.75rem;
        }
        .cta-banner-desc {
            color: rgba(255,255,255,0.75);
            font-size: 1rem;
            font-weight: 300;
            margin-bottom: 0;
        }

        /* ─── Footer ─── */
        .footer-cafe {
            background-color: var(--marrom-cafe);
            color: rgba(255,255,255,0.8);
        }
        .footer-logo {
            font-family: var(--fonte-display);
            font-size: 1.5rem;
            color: #fff;
            font-weight: 700;
        }
        .footer-tagline {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.55);
            margin-top: 4px;
        }
        .footer-heading {
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            margin-bottom: 1rem;
        }
        .footer-link {
            display: block;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            transition: color 0.2s;
        }
        .footer-link:hover { color: #fff; }
        .footer-social {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
            font-size: 0.9rem;
        }
        .footer-social:hover { background: var(--vermelho-express); color: #fff; }
        .footer-divider {
            border-color: rgba(255,255,255,0.12);
        }
        .footer-bottom {
            font-size: 0.83rem;
            color: rgba(255,255,255,0.4);
        }

        /* ─── Animations ─── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* ─── Responsividade ─── */
        @media (max-width: 767px) {
            .hero-header { padding: 80px 0 90px; }
            .hero-image-wrap { margin-top: 2.5rem; }
            .hero-image-wrap img { max-width: 100%; }
            .hero-stats { gap: 1.25rem; flex-wrap: wrap; }
            .cta-banner { text-align: center; }
        }
    </style>
</head>
<body>

    <a class="skip-link" href="#conteudo-principal">Pular para o conteúdo</a>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-java sticky-top" role="navigation" aria-label="Navegação principal">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fa-solid fa-mug-hot me-2" aria-hidden="true"></i>Java Express
                <span class="badge-brand">Dev Edition</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Abrir menu de navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item"><a class="nav-link active" href="#" aria-current="page"><i class="fa-solid fa-house me-1" aria-hidden="true"></i>Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#cardapio"><i class="fa-solid fa-mug-saucer me-1" aria-hidden="true"></i>Cardápio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contato"><i class="fa-solid fa-envelope me-1" aria-hidden="true"></i>Contato</a></li>
                    <li class="nav-item ms-2">
                        <a class="nav-link btn-nav-cta px-3 rounded-pill" href="#cardapio">
                            <i class="fa-solid fa-cart-shopping me-1" aria-hidden="true"></i>Pedir Agora
                        </a>
                    </li>
                    <li class="nav-item ms-1">
                        <a class="nav-link" href="{{ route('login') }}" style="opacity:0.55;font-size:0.82rem;">
                            <i class="fa-solid fa-lock me-1" aria-hidden="true"></i>Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <header class="hero-header" role="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-7">
                    <div class="hero-eyebrow">
                        <i class="fa-solid fa-bolt" aria-hidden="true"></i>
                        Code &amp; Coffee · Est. 2020
                    </div>
                    <h1 class="hero-title">
                        O combustível<br>para o seu <span class="destaque">código.</span>
                    </h1>
                    <p class="hero-desc">
                        A Java Express une o melhor do grão selecionado com o ambiente perfeito para quem transforma café em linhas de código.
                    </p>
                    <div class="hero-actions">
                        <a href="#cardapio" class="btn btn-express btn-lg shadow">
                            <i class="fa-solid fa-mug-saucer me-2" aria-hidden="true"></i>Ver Cardápio
                        </a>
                        <a href="#sobre" class="btn btn-outline-branco btn-lg">
                            Nossa História
                        </a>
                    </div>
                    <div class="hero-stats" aria-label="Números da Java Express">
                        <div>
                            <div class="hero-stat-num">4.8★</div>
                            <div class="hero-stat-label">Avaliação Média</div>
                        </div>
                        <div class="hero-divider" aria-hidden="true"></div>
                        <div>
                            <div class="hero-stat-num">+2k</div>
                            <div class="hero-stat-label">Devs Satisfeitos</div>
                        </div>
                        <div class="hero-divider" aria-hidden="true"></div>
                        <div>
                            <div class="hero-stat-num">12</div>
                            <div class="hero-stat-label">Blends Exclusivos</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 d-none d-md-block offset-lg-1">
                    <div class="hero-image-wrap">
                        <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=800"
                             alt="Xícara de café expresso artesanal servida na Java Express"
                             loading="lazy">
                        <div class="hero-badge-float" aria-label="Wi-Fi grátis">
                            <i class="fa-solid fa-wifi me-1" aria-hidden="true"></i>Wi-Fi Grátis · 500 Mbps
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <main id="conteudo-principal">

        <!-- Por que Java Express? -->
        <section id="sobre" class="container my-5 py-4" aria-labelledby="titulo-sobre">
            <div class="text-center mb-5">
                <p class="section-label">Por que escolher</p>
                <h2 id="titulo-sobre" class="section-title">Uma cafeteria feita para devs</h2>
                <p class="text-muted mt-2" style="max-width: 480px; margin: 0.5rem auto 0;">Muito além de um expresso comum — uma experiência pensada para quem vive de código.</p>
            </div>

            <div class="row g-4">
                <article class="col-md-4">
                    <div class="card-cafe p-4 text-center h-100">
                        <div class="icon-box vermelho mx-auto" aria-hidden="true">
                            <i class="fa-solid fa-terminal"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-2" style="color: var(--azul-java)">Expresso Puro</h3>
                        <p class="text-muted mb-0" style="font-size: 0.92rem;">Grãos selecionados com torra média para manter seu foco no nível máximo — sem bugs, sem travamentos.</p>
                    </div>
                </article>
                <article class="col-md-4">
                    <div class="card-cafe p-4 text-center h-100">
                        <div class="icon-box azul mx-auto" aria-hidden="true">
                            <i class="fa-solid fa-wifi"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-2" style="color: var(--azul-java)">Wi-Fi 500 Mbps</h3>
                        <p class="text-muted mb-0" style="font-size: 0.92rem;">Ambiente perfeito para rodar aquele <code>npm install</code> ou fazer seus deploys em produção sem sofrimento.</p>
                    </div>
                </article>
                <article class="col-md-4">
                    <div class="card-cafe p-4 text-center h-100">
                        <div class="icon-box marrom mx-auto" aria-hidden="true">
                            <i class="fa-solid fa-cookie-bite"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-2" style="color: var(--azul-java)">Cookies Binários</h3>
                        <p class="text-muted mb-0" style="font-size: 0.92rem;">Acompanhamentos doces e salgados artesanais para acompanhar sua maratona de programação.</p>
                    </div>
                </article>
            </div>
        </section>

        <!-- Cardápio Destaque -->
        <section id="cardapio" class="bg-menu py-5 mt-3" aria-labelledby="titulo-cardapio">
            <div class="container">
                <div class="text-center mb-5">
                    <p class="section-label">Nossos Favoritos</p>
                    <h2 id="titulo-cardapio" class="section-title">Cardápio em Destaque</h2>
                    <p class="text-muted mt-2" style="max-width: 440px; margin: 0.5rem auto 0;">Blends cuidadosamente desenvolvidos para manter a produtividade lá no alto.</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4 col-sm-6">
                        <article class="menu-card">
                            <img class="menu-card-img"
                                 src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?q=80&w=600"
                                 alt="Expresso Duplo servido em xícara de cerâmica" loading="lazy">
                            <div class="menu-card-body">
                                <p class="menu-card-tag">Clássico</p>
                                <h3 class="menu-card-name">Expresso Duplo</h3>
                                <p class="menu-card-desc">A base de tudo. Dose dupla de puro grão, sem distrações.</p>
                                <div class="menu-card-footer">
                                    <span class="menu-card-price">R$ 9,90</span>
                                    <button class="btn-add" aria-label="Adicionar Expresso Duplo ao pedido">
                                        <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <article class="menu-card">
                            <img class="menu-card-img"
                                 src="https://images.unsplash.com/photo-1572442388796-11668a67e53d?q=80&w=600"
                                 alt="Cappuccino cremoso com latte art" loading="lazy">
                            <div class="menu-card-body">
                                <p class="menu-card-tag">Mais Pedido</p>
                                <h3 class="menu-card-name">Cappuccino Dev</h3>
                                <p class="menu-card-desc">Leite vaporizado, espuma perfeita e um toque de canela. Deploy aprovado.</p>
                                <div class="menu-card-footer">
                                    <span class="menu-card-price">R$ 14,90</span>
                                    <button class="btn-add" aria-label="Adicionar Cappuccino Dev ao pedido">
                                        <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <article class="menu-card">
                            <img class="menu-card-img"
                                 src="https://images.unsplash.com/photo-1461023058943-07fcbe16d735?q=80&w=600"
                                 alt="Cold Brew Nitro servido em copo alto" loading="lazy">
                            <div class="menu-card-body">
                                <p class="menu-card-tag">Edição Especial</p>
                                <h3 class="menu-card-name">Cold Brew Nitro</h3>
                                <p class="menu-card-desc">18h de extração a frio com gás nitrogênio. Para os deploys de madrugada.</p>
                                <div class="menu-card-footer">
                                    <span class="menu-card-price">R$ 19,90</span>
                                    <button class="btn-add" aria-label="Adicionar Cold Brew Nitro ao pedido">
                                        <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="#" class="btn btn-express btn-lg px-4" aria-label="Ver cardápio completo da Java Express">
                        Ver cardápio completo <i class="fa-solid fa-arrow-right ms-2" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- CTA Banner -->
        <section id="contato" class="container my-5 py-2" aria-labelledby="titulo-cta">
            <div class="cta-banner">
                <div class="row align-items-center g-4">
                    <div class="col-md-7">
                        <h2 id="titulo-cta" class="cta-banner-title">Trabalhe, code e tome café.<br>Tudo no mesmo lugar.</h2>
                        <p class="cta-banner-desc">Reserve um espaço ou venha de walk-in. Estamos abertos de segunda a domingo, das 7h às 22h.</p>
                    </div>
                    <div class="col-md-5 text-md-end d-flex flex-wrap gap-3 justify-content-md-end">
                        <a href="#" class="btn btn-express btn-lg">
                            <i class="fa-solid fa-calendar-check me-2" aria-hidden="true"></i>Reservar Mesa
                        </a>
                        <a href="tel:+5511999999999" class="btn btn-outline-branco btn-lg">
                            <i class="fa-solid fa-phone me-2" aria-hidden="true"></i>Ligar
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="footer-cafe pt-5 pb-4 mt-3">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="footer-logo">
                        <i class="fa-solid fa-mug-hot me-2" aria-hidden="true"></i>Java Express
                    </div>
                    <p class="footer-tagline">O combustível para o seu código.</p>
                    <div class="mt-3 d-flex gap-2">
                        <a href="#" class="footer-social" aria-label="Instagram da Java Express"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
                        <a href="#" class="footer-social" aria-label="Twitter da Java Express"><i class="fa-brands fa-twitter" aria-hidden="true"></i></a>
                        <a href="#" class="footer-social" aria-label="GitHub da Java Express"><i class="fa-brands fa-github" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="col-md-2 offset-md-2">
                    <p class="footer-heading">Menu</p>
                    <a href="#" class="footer-link">Início</a>
                    <a href="#cardapio" class="footer-link">Cardápio</a>
                    <a href="#sobre" class="footer-link">Sobre</a>
                </div>
                <div class="col-md-2">
                    <p class="footer-heading">Mais</p>
                    <a href="#" class="footer-link">Blog</a>
                    <a href="#" class="footer-link">Eventos Dev</a>
                    <a href="#contato" class="footer-link">Contato</a>
                </div>
                <div class="col-md-2">
                    <p class="footer-heading">Horário</p>
                    <p style="font-size: 0.88rem; margin-bottom: 0.25rem;">Seg – Sex: 7h – 22h</p>
                    <p style="font-size: 0.88rem; margin-bottom: 0.25rem;">Sábado: 8h – 22h</p>
                    <p style="font-size: 0.88rem;">Domingo: 9h – 20h</p>
                </div>
            </div>

            <hr class="footer-divider">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                <p class="footer-bottom mb-0">&copy; 2026 Java Express Cafeteria. Todos os direitos reservados.</p>
                <p class="footer-bottom mb-0">Desenvolvido com <i class="fa-solid fa-heart" style="color: var(--vermelho-express);" aria-label="amor"></i> em Laravel &amp; Bootstrap</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll para âncoras internas
        document.querySelectorAll('a[href^="#"]').forEach(link => {
            link.addEventListener('click', function (e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Feedback visual ao adicionar item ao pedido
        document.querySelectorAll('.btn-add').forEach(btn => {
            btn.addEventListener('click', function () {
                const original = this.innerHTML;
                this.innerHTML = '<i class="fa-solid fa-check" aria-hidden="true"></i>';
                this.style.background = '#1d9e75';
                this.setAttribute('aria-label', 'Item adicionado!');
                setTimeout(() => {
                    this.innerHTML = original;
                    this.style.background = '';
                    this.setAttribute('aria-label', this.getAttribute('aria-label'));
                }, 1200);
            });
        });
    </script>
</body>
</html>