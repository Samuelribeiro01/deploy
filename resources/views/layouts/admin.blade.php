<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Java Express</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
            --creme-claro: #fcf9f5;
            --sidebar-w: 260px;
        }
        body { font-family: 'DM Sans', sans-serif; background: #f3f0eb; margin: 0; }

        /* Sidebar */
        .sidebar {
            position: fixed; top: 0; left: 0;
            width: var(--sidebar-w); height: 100vh;
            background: var(--azul-java-escuro);
            display: flex; flex-direction: column;
            z-index: 1000; overflow-y: auto;
        }
        .sidebar-brand {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-brand .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem; color: #fff; display: block;
        }
        .sidebar-brand .brand-sub {
            font-size: 0.7rem; color: rgba(255,255,255,0.45);
            text-transform: uppercase; letter-spacing: 1.5px;
        }
        .sidebar-nav { padding: 1rem 0; flex: 1; }
        .nav-section-label {
            font-size: 0.65rem; font-weight: 600;
            color: rgba(255,255,255,0.35);
            text-transform: uppercase; letter-spacing: 2px;
            padding: 0.75rem 1.25rem 0.25rem;
        }
        .sidebar-link {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.65rem 1.25rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none; font-size: 0.9rem;
            transition: all 0.18s; border-left: 3px solid transparent;
        }
        .sidebar-link:hover { color: #fff; background: rgba(255,255,255,0.07); }
        .sidebar-link.active {
            color: #fff; background: rgba(168,27,27,0.22);
            border-left-color: var(--vermelho-express);
        }
        .sidebar-link i { width: 18px; text-align: center; font-size: 0.95rem; }
        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        /* Main */
        .main-content { margin-left: var(--sidebar-w); min-height: 100vh; }
        .topbar {
            background: #fff; padding: 0.85rem 1.75rem;
            border-bottom: 1px solid #e8e2d8;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
            box-shadow: 0 2px 8px rgba(41,31,115,0.05);
        }
        .topbar-title { font-size: 1.1rem; font-weight: 600; color: var(--azul-java); }
        .topbar-user { font-size: 0.85rem; color: #6c757d; }

        .content-area { padding: 1.75rem; }

        /* Cards de estatística */
        .stat-card {
            background: #fff; border-radius: 14px;
            padding: 1.4rem 1.5rem;
            box-shadow: 0 2px 12px rgba(41,31,115,0.07);
            border-left: 4px solid var(--azul-java);
            transition: transform 0.18s, box-shadow 0.18s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(41,31,115,0.12); }
        .stat-card.vermelho  { border-left-color: var(--vermelho-express); }
        .stat-card.verde     { border-left-color: #1d9e75; }
        .stat-card.laranja   { border-left-color: #e07b39; }
        .stat-card .stat-label { font-size: 0.78rem; color: #6c757d; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.25rem; }
        .stat-card .stat-value { font-size: 2rem; font-weight: 700; color: var(--azul-java); line-height: 1; }
        .stat-card.vermelho .stat-value { color: var(--vermelho-express); }
        .stat-card.verde .stat-value    { color: #1d9e75; }
        .stat-card.laranja .stat-value  { color: #e07b39; }

        /* Tabelas */
        .table-card {
            background: #fff; border-radius: 14px;
            box-shadow: 0 2px 12px rgba(41,31,115,0.07); overflow: hidden;
        }
        .table-card-header {
            padding: 1.1rem 1.5rem; border-bottom: 1px solid #f0ebe3;
            display: flex; align-items: center; justify-content: space-between;
        }
        .table-card-header h5 { margin: 0; font-size: 1rem; font-weight: 600; color: var(--azul-java); }

        /* Formulários */
        .form-card {
            background: #fff; border-radius: 14px;
            padding: 1.75rem;
            box-shadow: 0 2px 12px rgba(41,31,115,0.07);
        }
        .form-label { font-weight: 500; font-size: 0.88rem; color: var(--azul-java); }
        .form-control:focus, .form-select:focus {
            border-color: var(--azul-java-claro);
            box-shadow: 0 0 0 0.2rem rgba(41,31,115,0.12);
        }

        /* Botões */
        .btn-java {
            background: var(--azul-java); color: #fff; border: none;
            border-radius: 50px; padding: 0.45rem 1.2rem; font-weight: 600;
            font-size: 0.875rem; transition: background 0.18s;
        }
        .btn-java:hover { background: var(--azul-java-claro); color: #fff; }
        .btn-express {
            background: var(--vermelho-express); color: #fff; border: none;
            border-radius: 50px; padding: 0.45rem 1.2rem; font-weight: 600;
            font-size: 0.875rem; transition: background 0.18s;
        }
        .btn-express:hover { background: var(--vermelho-hover); color: #fff; }

        /* Alert flash */
        .alert-sucesso {
            background: #d1fae5; border: 1px solid #6ee7b7; color: #065f46;
            border-radius: 10px; padding: 0.85rem 1.1rem;
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s; }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <span class="brand-name"><i class="fa-solid fa-mug-hot me-2"></i>Java Express</span>
        <span class="brand-sub">Painel Administrativo</span>
    </div>

    <nav class="sidebar-nav">
        <p class="nav-section-label">Geral</p>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge-high"></i> Dashboard
        </a>

        <p class="nav-section-label mt-2">Gerenciar</p>
        <a href="{{ route('admin.produtos.index') }}" class="sidebar-link {{ request()->routeIs('admin.produtos.*') ? 'active' : '' }}">
            <i class="fa-solid fa-mug-saucer"></i> Produtos
        </a>
        <a href="{{ route('admin.pedidos.index') }}" class="sidebar-link {{ request()->routeIs('admin.pedidos.*') ? 'active' : '' }}">
            <i class="fa-solid fa-receipt"></i> Pedidos
        </a>

        <p class="nav-section-label mt-2">Site</p>
        <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Ver Site
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div style="width:32px;height:32px;background:var(--vermelho-express);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                <i class="fa-solid fa-user" style="color:#fff;font-size:0.75rem;"></i>
            </div>
            <div>
                <div style="font-size:0.82rem;color:#fff;font-weight:500;">{{ Auth::user()->name }}</div>
                <div style="font-size:0.72rem;color:rgba(255,255,255,0.45);">Administrador</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm w-100" style="background:rgba(168,27,27,0.25);color:rgba(255,255,255,0.75);border-radius:8px;font-size:0.8rem;">
                <i class="fa-solid fa-right-from-bracket me-1"></i> Sair
            </button>
        </form>
    </div>
</aside>

<!-- Conteúdo principal -->
<div class="main-content">
    <div class="topbar">
        <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        <span class="topbar-user"><i class="fa-regular fa-clock me-1"></i>{{ now()->format('d/m/Y H:i') }}</span>
    </div>

    <div class="content-area">
        @if(session('sucesso'))
            <div class="alert-sucesso mb-3">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('sucesso') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
