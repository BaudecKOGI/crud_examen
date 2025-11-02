@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Bienvenido, <span class="highlight">{{ Auth::user()->name }}</span> 🎉</h1>
                <p>Gestiona tus productos y categorías desde un solo lugar. Interfaz intuitiva y potente.</p>
            </div>
            <div class="hero-stats">
                <div class="stat-card">
                    <div class="stat-icon">📊</div>
                    <div class="stat-info">
                        <span class="stat-number">{{ \App\Models\Categoria::count() }}</span>
                        <span class="stat-label">Categorías</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">🛍️</div>
                    <div class="stat-info">
                        <span class="stat-number">{{ \App\Models\Producto::count() }}</span>
                        <span class="stat-label">Productos</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="section-header">
                <h2>Accesos Rápidos</h2>
                <p>Selecciona una opción para comenzar</p>
            </div>

            <div class="cards-grid">
                <!-- Card Categorías -->
                <a href="{{ route('categorias.index') }}" class="dashboard-card">
                    <div class="card-icon categories">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                        </svg>
                    </div>
                    <div class="card-content">
                        <h3>Gestionar Categorías</h3>
                        <p>Organiza y administra todas tus categorías de productos</p>
                        <div class="card-footer">
                            <span class="card-link">Ver listado →</span>
                        </div>
                    </div>
                    <div class="card-badge">{{ \App\Models\Categoria::count() }}</div>
                </a>

                <!-- Card Productos -->
                <a href="{{ route('productos.index') }}" class="dashboard-card">
                    <div class="card-icon products">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <path d="M16 10a4 4 0 0 1-8 0"/>
                        </svg>
                    </div>
                    <div class="card-content">
                        <h3>Gestionar Productos</h3>
                        <p>Agrega, edita y elimina tus productos de manera sencilla</p>
                        <div class="card-footer">
                            <span class="card-link">Ver listado →</span>
                        </div>
                    </div>
                    <div class="card-badge">{{ \App\Models\Producto::count() }}</div>
                </a>
            </div>

            <!-- Features Section -->
            <div class="features-section">
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h4>Rápido y Eficiente</h4>
                    <p>Optimizado para una gestión ágil</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h4>Seguro</h4>
                    <p>Tus datos están protegidos</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h4>Responsive</h4>
                    <p>Funciona en cualquier dispositivo</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎨</div>
                    <h4>Interfaz Moderna</h4>
                    <p>Diseño intuitivo y profesional</p>
                </div>
            </div>
        </div>
    </main>

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

        

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 165, 0, 0.05));
            padding: 4rem 2rem;
            border-bottom: 1px solid rgba(255, 215, 0, 0.2);
            width: 100%;
        }

        .hero-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }

        .hero-text h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: #fff;
        }

        .highlight {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-text p {
            font-size: 1.2rem;
            color: #aaa;
            max-width: 600px;
        }

        .hero-stats {
            display: flex;
            gap: 2rem;
        }

        .stat-card {
            background: rgba(20, 20, 20, 0.8);
            border: 1px solid rgba(255, 215, 0, 0.2);
            border-radius: 16px;
            padding: 1.5rem 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            min-width: 180px;
        }

        .stat-icon {
            font-size: 2.5rem;
        }

        .stat-info {
            display: flex;
            flex-direction: column;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #FFD700;
        }

        .stat-label {
            color: #888;
            font-size: 0.95rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 4rem 2rem;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #FFD700;
            margin-bottom: 0.5rem;
        }

        .section-header p {
            color: #888;
            font-size: 1.1rem;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .dashboard-card {
            background: rgba(20, 20, 20, 0.8);
            border: 2px solid rgba(255, 215, 0, 0.2);
            border-radius: 20px;
            padding: 2rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.05), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            border-color: #FFD700;
            box-shadow: 0 10px 40px rgba(255, 215, 0, 0.2);
        }

        .dashboard-card:hover::before {
            opacity: 1;
        }

        .card-icon {
            width: 80px;
            height: 80px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .card-icon.categories {
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(255, 165, 0, 0.2));
            color: #FFD700;
        }

        .card-icon.products {
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(255, 165, 0, 0.2));
            color: #FFA500;
        }

        .card-content {
            position: relative;
            z-index: 1;
        }

        .card-content h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #FFD700;
            margin-bottom: 0.75rem;
        }

        .card-content p {
            color: #aaa;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-link {
            color: #FFA500;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .dashboard-card:hover .card-link {
            color: #FFD700;
        }

        .card-badge {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #1a1a1a;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 1.1rem;
        }

        /* Features Section */
        .features-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }

        .feature-card {
            background: rgba(20, 20, 20, 0.6);
            border: 1px solid rgba(255, 215, 0, 0.1);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            border-color: rgba(255, 215, 0, 0.3);
            transform: translateY(-3px);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .feature-card h4 {
            color: #FFD700;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .feature-card p {
            color: #888;
        }

        

        /* Responsive */
        @media (max-width: 1024px) {
            .hero-content {
                flex-direction: column;
                text-align: center;
            }

            .hero-text p {
                max-width: 100%;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .navbar-menu {
                display: none;
            }

            .user-info {
                display: none;
            }

            .hero-section {
                padding: 2rem 1rem;
            }

            .hero-text h1 {
                font-size: 2rem;
            }

            .hero-stats {
                flex-direction: column;
                width: 100%;
            }

            .stat-card {
                width: 100%;
            }
        }
    </style>
@endsection