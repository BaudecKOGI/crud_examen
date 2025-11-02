<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Gestión')</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
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
        }

        /* Navbar */
        .navbar {
            background: rgba(20, 20, 20, 0.95);
            border-bottom: 2px solid rgba(255, 215, 0, 0.2);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
        }

        .logo {
            width: auto;
            height: auto;
        }

        .brand-text {
            font-size: 1.4rem;
            font-weight: 800;
            color: #FFD700;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-menu {
            display: flex;
            gap: 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            color: #aaa;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover {
            background: rgba(255, 215, 0, 0.1);
            color: #FFD700;
            transform: translateY(-2px);
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .user-name {
            font-weight: 600;
            color: #FFD700;
        }

        .user-role {
            font-size: 0.85rem;
            color: #888;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: 2px solid rgba(255, 215, 0, 0.3);
            overflow: hidden;
            position: relative;
            background: rgba(255, 215, 0, 0.1);
        }

        .user-avatar:hover {
            transform: scale(1.1);
            border-color: #FFD700;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
        }

        .profile-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-initials {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #1a1a1a;
            font-weight: 700;
            font-size: 1.1rem;
            border-radius: 50%;
        }


        /* Dropdown de usuario */
        .user-dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background: rgba(30, 30, 30, 0.98);
            border: 1px solid rgba(255, 215, 0, 0.2);
            border-radius: 12px;
            padding: 0.5rem;
            min-width: 200px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(20px);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #aaa;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: rgba(255, 215, 0, 0.1);
            color: #FFD700;
        }

        .dropdown-divider {
            height: 1px;
            background: rgba(255, 215, 0, 0.1);
            margin: 0.5rem 0;
        }

        /* Footer */
        footer {
            background: rgba(20, 20, 20, 0.95);
            border-top: 2px solid rgba(255, 215, 0, 0.2);
            padding: 3rem 2rem 2rem;
            text-align: center;
            margin-top: auto;
        }

        footer p {
            color: #aaa;
            margin-bottom: 0.5rem;
        }

        footer .heart {
            color: #FFD700;
            animation: heartbeat 1.5s infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            25% { transform: scale(1.1); }
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: #FFD700;
            font-size: 1.5rem;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .navbar-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: rgba(20, 20, 20, 0.98);
                border-bottom: 2px solid rgba(255, 215, 0, 0.2);
                flex-direction: column;
                padding: 1rem;
                gap: 0.5rem;
            }

            .navbar-menu.active {
                display: flex;
            }

            .mobile-menu-btn {
                display: block;
            }

            .user-info {
                display: none;
            }

            .brand-text {
                font-size: 1.2rem;
            }

            .logo {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .user-avatar {
                width: 40px;
                height: 40px;
            }

            .dropdown-menu {
                position: fixed;
                top: auto;
                bottom: 0;
                left: 0;
                right: 0;
                margin: 0;
                border-radius: 20px 20px 0 0;
                transform: translateY(100%);
            }

            .dropdown-menu.show {
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .navbar-container {
                padding: 0 1rem;
            }

            .brand-text {
                font-size: 1.1rem;
            }

            .logo {
                width: 35px;
                height: 35px;
            }

            .user-avatar {
                width: 35px;
                height: 35px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <!-- Logo que lleva al Dashboard -->
            <a href="{{ route('dashboard') }}" class="navbar-brand" title="Ir al Dashboard">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" 
                    alt="Logo" 
                    style="width: 60px; height: 60px; border-radius: 8px;">
                </div>
            </a>

            <!-- Botón menú móvil -->
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                ☰
            </button>

            <!-- Menú de navegación -->
            <div class="navbar-menu" id="navbarMenu">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('categorias.index') }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                    </svg>
                    Categorías
                </a>
                <a href="{{ route('productos.index') }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                    Productos
                </a>
            </div>

            <div class="navbar-user">
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-role">Administrador</span>
                </div>

                <!-- Dropdown de usuario con foto de perfil -->
                <div class="user-dropdown">
                    <div class="user-avatar" id="userAvatar">
                        @if(Auth::user()->profile_photo_path)
                            <img src="{{ Auth::user()->profile_photo_url }}" 
                                 alt="{{ Auth::user()->name }}" 
                                 class="profile-photo"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="profile-initials" style="display: none;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                        @else
                            <div class="profile-initials">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>

                    <!-- Menú desplegable -->
                    <div class="dropdown-menu" id="dropdownMenu">
                        <div class="dropdown-header" style="padding: 0.75rem 1rem; border-bottom: 1px solid rgba(255,215,0,0.1);">
                            <div style="font-weight: 600; color: #FFD700;">{{ Auth::user()->name }}</div>
                            <div style="font-size: 0.85rem; color: #888;">{{ Auth::user()->email }}</div>
                        </div>
                        
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Mi Perfil
                        </a>
                        
                        <a href="{{ route('dashboard') }}" class="dropdown-item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                            Dashboard
                        </a>

                        <div class="dropdown-divider"></div>

                        <form method="POST" action="{{ route('logout') }}" class="logout-form" style="width: 100%;">
                            @csrf
                            <button type="submit" class="dropdown-item" style="width: 100%; background: none; border: none; text-align: left; font: inherit; cursor: pointer;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                    <polyline points="16 17 21 12 16 7"/>
                                    <line x1="21" y1="12" x2="9" y2="12"/>
                                </svg>
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    @yield('content')

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} Sistema de Gestión. Todos los derechos reservados.</p>
        <p>Desarrollado por Alessandro Uceda</p>
    </footer>

    <script>
        // Menú móvil
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const navbarMenu = document.getElementById('navbarMenu');
            const userAvatar = document.getElementById('userAvatar');
            const dropdownMenu = document.getElementById('dropdownMenu');

            // Menú principal móvil
            if (mobileMenuBtn && navbarMenu) {
                mobileMenuBtn.addEventListener('click', function() {
                    navbarMenu.classList.toggle('active');
                    
                    // Cerrar dropdown si está abierto
                    if (dropdownMenu) {
                        dropdownMenu.classList.remove('show');
                    }
                    
                    // Cambiar ícono del botón
                    if (navbarMenu.classList.contains('active')) {
                        mobileMenuBtn.textContent = '✕';
                    } else {
                        mobileMenuBtn.textContent = '☰';
                    }
                });

                // Cerrar menú al hacer clic en un enlace (en móvil)
                const navLinks = navbarMenu.querySelectorAll('.nav-link');
                navLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        if (window.innerWidth <= 768) {
                            navbarMenu.classList.remove('active');
                            mobileMenuBtn.textContent = '☰';
                        }
                    });
                });
            }

            // Dropdown de usuario
            if (userAvatar && dropdownMenu) {
                userAvatar.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdownMenu.classList.toggle('show');
                });

                // Cerrar dropdown al hacer clic fuera
                document.addEventListener('click', function(e) {
                    if (!userAvatar.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        dropdownMenu.classList.remove('show');
                    }
                });

                // Cerrar dropdown al hacer clic en un enlace
                const dropdownItems = dropdownMenu.querySelectorAll('.dropdown-item, .logout-form button');
                dropdownItems.forEach(item => {
                    item.addEventListener('click', function() {
                        dropdownMenu.classList.remove('show');
                    });
                });
            }

            // Cerrar menús al redimensionar la ventana
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    if (navbarMenu) {
                        navbarMenu.classList.remove('active');
                        mobileMenuBtn.textContent = '☰';
                    }
                }
            });

            // Efecto de scroll en navbar
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.style.background = 'rgba(20, 20, 20, 0.98)';
                    navbar.style.backdropFilter = 'blur(20px)';
                } else {
                    navbar.style.background = 'rgba(20, 20, 20, 0.95)';
                    navbar.style.backdropFilter = 'blur(10px)';
                }
            });

            // Manejo de errores en imágenes de perfil
            const profilePhotos = document.querySelectorAll('.profile-photo');
            profilePhotos.forEach(photo => {
                photo.addEventListener('error', function() {
                    this.style.display = 'none';
                    const initials = this.nextElementSibling;
                    if (initials && initials.classList.contains('profile-initials')) {
                        initials.style.display = 'flex';
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>