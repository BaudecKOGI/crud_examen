@extends('layouts.app')

@section('content')
<div class="page-container">
    <!-- Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-left">
                <a href="{{ route('dashboard') }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"/>
                        <polyline points="12 19 5 12 12 5"/>
                    </svg>
                    Volver
                </a>
                <div>
                    <h1>Gestión de Categorías</h1>
                    <p>Administra todas las categorías de tus productos</p>
                </div>
            </div>
            <a href="{{ route('categorias.create') }}" class="btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Nueva Categoría
            </a>
        </div>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="alert-success">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="stat-box">
            <div class="stat-icon">📁</div>
            <div class="stat-details">
                <span class="stat-number">{{ $categorias->count() }}</span>
                <span class="stat-label">Total Categorías</span>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">📊</div>
            <div class="stat-details">
                <span class="stat-number">{{ $productos->count() }}</span>
                <span class="stat-label">Total Productos</span>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">✅</div>
            <div class="stat-details">
                <span class="stat-number">{{ $categorias->where('estado', 'activo')->count() }}</span>
                <span class="stat-label">Categorías Activas</span>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <div class="table-header">
            <h2>Listado de Categorías</h2>
            <div class="header-actions">
                <div class="search-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                    <input type="text" id="searchInput" placeholder="Buscar categoría...">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Productos</th>
                        <th>Fecha Creación</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse($categorias as $index => $categoria)
                    <tr>
                        <td><span class="badge-id">#{{ $index + 1 }}</span></td>
                        <td>
                            <div class="categoria-image">
                                @if($categoria->imagen)
                                    <img src="{{ asset('storage/'.$categoria->imagen) }}" alt="{{ $categoria->nombre }}">
                                @else
                                    <div class="no-categoria-image">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <polyline points="21 15 16 10 5 21"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="categoria-info">
                                <span class="categoria-name">{{ $categoria->nombre }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="categoria-desc">{{ Str::limit($categoria->descripcion, 50) }}</span>
                        </td>
                        <td>
                            <span class="badge-estado {{ $categoria->estado }}">{{ $categoria->estado }}</span>
                        </td>
                        <td>
                            <span class="badge-count">{{ $categoria->productos->count() }} </span>
                        </td>
                        <td>{{ $categoria->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('categorias.edit', $categoria) }}" class="btn-action edit" title="Editar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="delete-form" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action delete" title="Eliminar">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="empty-state">
                            <div class="empty-content">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                                </svg>
                                <h3>No hay categorías registradas</h3>
                                <p>Comienza creando tu primera categoría</p>
                                <a href="{{ route('categorias.create') }}" class="btn-primary">Crear Categoría</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .page-container {
        min-height: 100vh;
        background: #0a0a0a;
        padding: 6rem;
    }

    .page-header {
        margin-bottom: 2rem;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .btn-back {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        background: rgba(255, 215, 0, 0.1);
        border: 1px solid rgba(255, 215, 0, 0.3);
        border-radius: 10px;
        color: #FFD700;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background: rgba(255, 215, 0, 0.2);
        border-color: #FFD700;
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 800;
        color: #FFD700;
        margin-bottom: 0.25rem;
    }

    .page-header p {
        color: #888;
        font-size: 1rem;
    }

    .btn-primary {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.9rem 1.75rem;
        background: linear-gradient(135deg, #FFD700, #FFA500);
        border: none;
        border-radius: 12px;
        color: #1a1a1a;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(255, 215, 0, 0.5);
    }

    .alert-success {
        background: rgba(255, 215, 0, 0.15);
        border: 1px solid rgba(255, 215, 0, 0.3);
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        color: #FFD700;
        margin-bottom: 2rem;
        animation: slideDown 0.4s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-box {
        background: rgba(20, 20, 20, 0.8);
        border: 1px solid rgba(255, 215, 0, 0.2);
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        transition: all 0.3s ease;
    }

    .stat-box:hover {
        border-color: #FFD700;
        transform: translateY(-3px);
    }

    .stat-icon {
        font-size: 2.5rem;
    }

    .stat-details {
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

    .table-card {
        background: rgba(20, 20, 20, 0.8);
        border: 1px solid rgba(255, 215, 0, 0.2);
        border-radius: 20px;
        overflow: hidden;
    }

    .table-header {
        padding: 1.75rem 2rem;
        border-bottom: 1px solid rgba(255, 215, 0, 0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .table-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #FFD700;
    }

    .header-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: rgba(255, 215, 0, 0.05);
        border: 1px solid rgba(255, 215, 0, 0.2);
        border-radius: 10px;
        padding: 0.65rem 1.25rem;
        color: #FFD700;
    }

    .search-box input {
        background: transparent;
        border: none;
        outline: none;
        color: #fff;
        font-size: 0.95rem;
        width: 250px;
    }

    .search-box input::placeholder {
        color: #666;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table thead tr {
        background: rgba(255, 215, 0, 0.1);
    }

    .custom-table th {
        padding: 1.25rem 1.5rem;
        text-align: left;
        font-weight: 700;
        color: #FFD700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .custom-table td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(255, 215, 0, 0.1);
        color: #aaa;
    }

    .custom-table tbody tr {
        transition: all 0.3s ease;
    }

    .custom-table tbody tr:hover {
        background: rgba(255, 215, 0, 0.05);
    }

    .badge-id {
        background: rgba(255, 215, 0, 0.2);
        color: #FFD700;
        padding: 0.4rem 0.9rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .categoria-image {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid rgba(255, 215, 0, 0.2);
    }

    .categoria-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-categoria-image {
        width: 100%;
        height: 100%;
        background: rgba(255, 215, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
    }

    .categoria-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .categoria-name {
        font-weight: 700;
        color: #fff;
        font-size: 1.05rem;
    }

    .categoria-desc {
        color: #888;
        font-size: 0.95rem;
    }

    .badge-estado {
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }

    .badge-estado.activo {
        background: rgba(34, 197, 94, 0.2);
        color: #22c55e;
    }

    .badge-estado.inactivo {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
    }

    .badge-count {
        white-space: nowrap; /* Evita el salto de línea */
        display: inline-block;
        padding: 0.4rem 0.8rem;
        margin-left: 1.7rem;
        background: rgba(255, 215, 0, 0.15);
        border: 1px solid rgba(255, 215, 0, 0.4);
        border-radius: 12px;
        color: #FFD700;
        font-weight: 600;
        font-size: 0.85rem;
        min-width: auto; /* Ancho mínimo */
        text-align: center;
    }

    .text-center {
        text-align: center !important;
    }

    .action-buttons {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
    }

    .btn-action {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-action.edit {
        background: rgba(255, 215, 0, 0.1);
        color: #FFD700;
        border: 1px solid rgba(255, 215, 0, 0.3);
    }

    .btn-action.edit:hover {
        background: rgba(255, 215, 0, 0.2);
        border-color: #FFD700;
        transform: scale(1.1);
    }

    .btn-action.delete {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.3);
    }

    .btn-action.delete:hover {
        background: rgba(220, 53, 69, 0.2);
        border-color: #dc3545;
        transform: scale(1.1);
    }

    .delete-form {
        display: inline;
    }

    .empty-state {
        padding: 4rem 2rem !important;
    }

    .empty-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        color: #666;
    }

    .empty-content svg {
        margin-bottom: 1.5rem;
        opacity: 0.5;
    }

    .empty-content h3 {
        color: #FFD700;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .empty-content p {
        margin-bottom: 2rem;
    }

    @media (max-width: 1024px) {
        .header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .table-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .header-actions {
            width: 100%;
        }

        .search-box input {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 1rem;
        }

        .header-left {
            flex-direction: column;
            align-items: flex-start;
        }

        .stats-container {
            grid-template-columns: 1fr;
        }

        .table-responsive {
            font-size: 0.85rem;
        }

        .custom-table th,
        .custom-table td {
            padding: 0.75rem;
        }

        .categoria-image {
            width: 50px;
            height: 50px;
        }
    }
</style>

<script>
    // Búsqueda en tiempo real
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('#tableBody tr');
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endsection