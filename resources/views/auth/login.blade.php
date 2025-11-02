<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Sistema de Gestión</title>
    @vite(['resources/css/app.css'])
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0a0a0a;
            color: #fff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .login-card {
            background: rgba(30,30,30,0.95);
            border: 2px solid rgba(255,215,0,0.2);
            border-radius: 20px;
            padding: 3rem 2.5rem;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .login-card h2 {
            color: #FFD700;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .login-card p {
            color: #aaa;
            margin-bottom: 2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-group label {
            color: #FFD700;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .form-group input {
            padding: 0.75rem 1rem;
            border: 1px solid rgba(255,215,0,0.3);
            border-radius: 10px;
            background: #0a0a0a;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #FFD700;
            box-shadow: 0 0 5px rgba(255,215,0,0.5);
        }

        .btn-login {
            padding: 0.8rem;
            width: 100%;
            background: linear-gradient(135deg,#FFD700,#FFA500);
            border: none;
            border-radius: 10px;
            color: #1a1a1a;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg,#FFA500,#FFD700);
        }

        .error {
            color: #FF4C4C;
            font-size: 0.85rem;
            margin-top: 0.3rem;
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
    <div class="login-card">
        <h2>Iniciar Sesión</h2>
        <p>Ingresa tus credenciales para acceder al sistema</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
                @error('email')<span class="error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" required>
                @error('password')<span class="error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn-login">Entrar</button>
            </div>
        </form>

        <footer>
            Aplicación desarrollada por Bryan Alessandro Uceda De La Cruz
        </footer>
    </div>
</body>
</html>
