<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | Sistema de Gestión</title>
    @vite(['resources/css/app.css'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0a0a0a;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .landing-container {
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .logo-circle {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a1a1a;
            font-weight: bold;
            font-size: 2rem;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 40px rgba(255, 215, 0, 0.4);
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        p.subtitle {
            color: #ccc;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .auth-card {
            background: rgba(30, 30, 30, 0.95);
            border: 1px solid rgba(255, 215, 0, 0.2);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(20px);
        }

        .auth-card h2 {
            color: #FFD700;
            margin-bottom: 0.5rem;
            font-size: 1.8rem;
        }

        .auth-card p {
            color: #888;
            margin-bottom: 1.5rem;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 1rem;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            color: #1a1a1a;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #FFD700, #FFA500);
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        .btn-secondary {
            border: 2px solid #FFD700;
            color: #FFD700;
            background: transparent;
        }

        .btn-secondary:hover {
            background: rgba(255, 215, 0, 0.1);
        }

        footer {
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="landing-container">
        <div class="logo-circle">SG</div>
        <h1>Sistema de Gestión</h1>
        <p class="subtitle">Administra tus productos y categorías de forma profesional</p>

        <div class="auth-card">
            <h2>Accede a tu cuenta</h2>
            <p>Elige una opción para continuar</p>

            <div class="button-group">
                <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Crear Cuenta</a>
            </div>
        </div>

        <footer>
            <p>Aplicación desarrollada por Bryan Alessandro Uceda De La Cruz</p>
        </footer>
    </div>
</body>
</html>
