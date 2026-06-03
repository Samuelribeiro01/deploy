<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Java Express Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --azul-java: #291f73;
            --azul-java-escuro: #1a1349;
            --vermelho-express: #a81b1b;
        }
        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(135deg, #1a1349 0%, #291f73 50%, #523725 100%);
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            padding: 1rem;
        }
        .login-card {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem 2rem;
            width: 100%; max-width: 420px;
            box-shadow: 0 24px 64px rgba(0,0,0,0.3);
        }
        .login-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem; font-weight: 900;
            color: var(--azul-java);
            text-align: center; margin-bottom: 0.25rem;
        }
        .login-sub {
            text-align: center; font-size: 0.82rem;
            color: #999; text-transform: uppercase;
            letter-spacing: 2px; margin-bottom: 2rem;
        }
        .form-label { font-size: 0.85rem; font-weight: 600; color: var(--azul-java); }
        .form-control {
            border-radius: 10px; padding: 0.65rem 1rem;
            border: 1.5px solid #e0d9d0; font-size: 0.9rem;
        }
        .form-control:focus {
            border-color: var(--azul-java);
            box-shadow: 0 0 0 0.2rem rgba(41,31,115,0.12);
        }
        .btn-login {
            background: var(--azul-java); color: #fff;
            border: none; border-radius: 50px;
            padding: 0.7rem; font-weight: 600; font-size: 0.95rem;
            width: 100%; transition: background 0.2s;
        }
        .btn-login:hover { background: #3d2fa8; color: #fff; }
        .back-link {
            display: block; text-align: center;
            margin-top: 1.25rem; font-size: 0.84rem; color: #888;
            text-decoration: none;
        }
        .back-link:hover { color: var(--azul-java); }
        .demo-box {
            background: #f3f0eb; border-radius: 10px;
            padding: 0.75rem 1rem; margin-top: 1.5rem;
            font-size: 0.8rem; color: #666;
        }
        .demo-box strong { color: var(--azul-java); }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <i class="fa-solid fa-mug-hot me-2" style="color: var(--vermelho-express);"></i>Java Express
        </div>
        <p class="login-sub">Painel Administrativo</p>

        @if($errors->any())
            <div class="alert alert-danger rounded-3 py-2 px-3 mb-3" style="font-size:0.85rem;">
                <i class="fa-solid fa-circle-exclamation me-2"></i>{{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label" for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="{{ old('email') }}" required autofocus
                       placeholder="admin@javaexpress.com">
            </div>

            <div class="mb-4">
                <label class="form-label" for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password"
                       required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-login">
                <i class="fa-solid fa-right-to-bracket me-2"></i>Entrar
            </button>
        </form>

        <a href="{{ route('home') }}" class="back-link">
            <i class="fa-solid fa-arrow-left me-1"></i>Voltar ao site
        </a>

        <div class="demo-box">
            <strong>Credenciais de demonstração:</strong><br>
            E-mail: admin@javaexpress.com<br>
            Senha: admin123
        </div>
    </div>
</body>
</html>
