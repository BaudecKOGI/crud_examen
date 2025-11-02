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
                    <h1>Gestión de Productos</h1>
                    <p>Administra todos tus productos de manera eficiente</p>
                </div>
            </div>
            <a href="{{ route('productos.create') }}" class="btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Nuevo Producto
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
            <div class="stat-icon">🛍️</div>
            <div class="stat-details">
                <span class="stat-number">{{ $productos->count() }}</span>
                <span class="stat-label">Total Productos</span>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">📁</div>
            <div class="stat-details">
                <span class="stat-number">{{ \App\Models\Categoria::count() }}</span>
                <span class="stat-label">Categorías</span>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon">💰</div>
            <div class="stat-details">
                <span class="stat-number">S/. {{ number_format($productos->sum('precio'), 2) }}</span>
                <span class="stat-label">Valor Total</span>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <div class="table-header">
            <h2>Listado de Productos</h2>
            <div class="header-actions">
                <div class="search-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                    <input type="text" id="searchInput" placeholder="Buscar producto...">
                </div>
                <select id="filterCategory" class="filter-select">
                    <option value="">Todas las categorías</option>
                    @foreach(\App\Models\Categoria::all() as $cat)
                        <option value="{{ $cat->nombre }}">{{ $cat->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse($productos as $producto)
                    <tr>
                        <td><span class="badge-id">#{{ $producto->id }}</span></td>
                        <td>
                            <div class="product-image">
                                @if($producto->imagen)
                                    <img src="{{ asset('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}">
                                @else
                                    <div class="no-image">
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
                            <div class="product-info">
                                <span class="product-name">{{ $producto->nombre }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="product-desc">{{ Str::limit($producto->descripcion, 50) }}</span>
                        </td>
                        <td>
                            <span class="product-price">S/. {{ number_format($producto->precio, 2) }}</span>
                        </td>
                        <td>
                            <span class="badge-stock">{{ $producto->stock }}</span>
                        </td>
                        <td>
                            <span class="badge-category">{{ $producto->categoria->nombre }}</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button type="button" class="btn-action view" 
                                    title="Ver Producto"
                                    onclick="openProductModal(this)"
                                    data-nombre="{{ $producto->nombre }}"
                                    data-descripcion="{{ $producto->descripcion }}"
                                    data-precio="S/. {{ number_format($producto->precio, 2) }}"
                                    data-stock="{{ $producto->stock }}"
                                    data-categoria="{{ $producto->categoria->nombre }}"
                                    @if($producto->imagen) data-imagen="{{ asset('storage/'.$producto->imagen) }}" @endif
                                >
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="3"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>

                                <a href="{{ route('productos.edit', $producto) }}" class="btn-action edit" title="Editar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="delete-form" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
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
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                    <line x1="3" y1="6" x2="21" y2="6"/>
                                    <path d="M16 10a4 4 0 0 1-8 0"/>
                                </svg>
                                <h3>No hay productos registrados</h3>
                                <p>Comienza agregando tu primer producto</p>
                                <a href="{{ route('productos.create') }}" class="btn-primary">Crear Producto</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Ver Producto - MEJORADO -->
    <div id="productModal" class="modal-producto">
        <div class="modal-producto-content">
            <div class="modal-producto-header">
                <h2>Detalles del Producto</h2>
                <span class="modal-producto-close" onclick="closeProductModal()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </span>
            </div>
            <div class="modal-producto-body">
                <div class="modal-producto-image">
                    <div id="modalImageContainer">
                        <img id="modalImage" src="" alt="Imagen del producto">
                        <div id="modalNoImage" class="modal-no-image">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            <span>Sin imagen</span>
                        </div>
                    </div>
                </div>
                <div class="modal-producto-info">
                    <h3 id="modalTitle"></h3>
                    <div class="modal-producto-details">
                        <div class="detail-row">
                            <span class="detail-label">Precio:</span>
                            <span id="modalPrice" class="detail-value price"></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Stock:</span>
                            <span id="modalStock" class="detail-value stock"></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Categoría:</span>
                            <span id="modalCategory" class="detail-value category"></span>
                        </div>
                        <div class="detail-row full-width">
                            <span class="detail-label">Descripción:</span>
                            <p id="modalDescription" class="detail-value description"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* === ESTILOS DEL MODAL MEJORADO === */
    .modal-producto {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(5px);
        animation: modalFadeIn 0.3s ease;
    }

    @keyframes modalFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-producto-content {
        background: rgba(20, 20, 20, 0.95);
        border: 2px solid rgba(255, 215, 0, 0.3);
        border-radius: 20px;
        margin: 5% auto;
        padding: 0;
        width: 90%;
        max-width: 700px;
        box-shadow: 0 20px 60px rgba(255, 215, 0, 0.2);
        animation: modalSlideIn 0.4s ease;
    }

    @keyframes modalSlideIn {
        from { transform: translateY(-50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .modal-producto-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid rgba(255, 215, 0, 0.2);
        background: rgba(255, 215, 0, 0.05);
        border-radius: 20px 20px 0 0;
    }

    .modal-producto-header h2 {
        color: #FFD700;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }

    .modal-producto-close {
        color: #FFD700;
        font-size: 2rem;
        font-weight: bold;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-producto-close:hover {
        background: rgba(255, 215, 0, 0.1);
        transform: scale(1.1);
    }

    .modal-producto-body {
        padding: 2rem;
        display: flex;
        gap: 2rem;
        align-items: flex-start;
    }

    .modal-producto-image {
        flex-shrink: 0;
        width: 250px;
    }

    #modalImageContainer {
        width: 100%;
        height: 250px;
        border-radius: 16px;
        overflow: hidden;
        border: 2px solid rgba(255, 215, 0, 0.3);
        background: rgba(255, 215, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #modalImage {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
    }

    .modal-no-image {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #666;
        gap: 0.5rem;
    }

    .modal-no-image svg {
        opacity: 0.5;
    }

    .modal-no-image span {
        font-size: 0.9rem;
        color: #888;
    }

    .modal-producto-info {
        flex: 1;
    }

    .modal-producto-info h3 {
        color: #FFD700;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0 0 1.5rem 0;
        line-height: 1.2;
    }

    .modal-producto-details {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .detail-row {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255, 215, 0, 0.1);
    }

    .detail-row.full-width {
        flex-direction: column;
        gap: 0.5rem;
        border-bottom: none;
        padding-bottom: 0;
    }

    .detail-label {
        color: #FFD700;
        font-weight: 600;
        min-width: 100px;
        font-size: 0.95rem;
    }

    .detail-value {
        color: #fff;
        flex: 1;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .detail-value.price {
        font-size: 1.2rem;
        font-weight: 700;
        color: #FFD700;
    }

    .detail-value.stock {
        background: rgba(255, 215, 0, 0.2);
        color: #FFD700;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
    }

    .detail-value.category {
        background: rgba(255, 165, 0, 0.2);
        color: #FFA500;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
    }

    .detail-value.description {
        color: #ccc;
        line-height: 1.6;
        margin: 0;
        padding: 1rem;
        background: rgba(255, 215, 0, 0.05);
        border-radius: 8px;
        border-left: 3px solid #FFD700;
    }

    /* === ESTILOS RESPONSIVE DEL MODAL === */
    @media (max-width: 768px) {
        .modal-producto-content {
            margin: 10% auto;
            width: 95%;
        }

        .modal-producto-body {
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 1.5rem;
        }

        .modal-producto-image {
            width: 100%;
            max-width: 300px;
        }

        #modalImageContainer {
            height: 200px;
        }

        .detail-row {
            flex-direction: column;
            gap: 0.5rem;
            align-items: center;
            text-align: center;
        }

        .detail-label {
            min-width: auto;
        }

        .modal-producto-info h3 {
            font-size: 1.5rem;
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        .modal-producto-header {
            padding: 1rem 1.5rem;
        }

        .modal-producto-body {
            padding: 1.5rem;
        }

        .modal-producto-header h2 {
            font-size: 1.3rem;
        }
    }

    /* === ESTILOS EXISTENTES DE LA PÁGINA (se mantienen igual) === */
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
        white-space: nowrap;
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
        width: 200px;
    }

    .search-box input::placeholder {
        color: #666;
    }

    .filter-select {
        background: rgba(255, 215, 0, 0.05);
        border: 1px solid rgba(255, 215, 0, 0.2);
        border-radius: 10px;
        padding: 0.65rem 1.25rem;
        color: #FFD700;
        font-size: 0.95rem;
        outline: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-select:hover {
        border-color: #FFD700;
        background: rgba(255, 215, 0, 0.1);
    }

    .filter-select option {
        background: #1a1a1a;
        color: #FFD700;
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

    .product-image {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid rgba(255, 215, 0, 0.2);
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-image {
        width: 100%;
        height: 100%;
        background: rgba(255, 215, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
    }

    .product-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .product-name {
        font-weight: 700;
        color: #fff;
        font-size: 1.05rem;
    }

    .product-desc {
        color: #888;
        font-size: 0.95rem;
    }

    .product-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: #FFD700;
    }

    .badge-stock {
        background: rgba(255, 215, 0, 0.2);
        color: #FFD700;
        padding: 0.4rem 0.9rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .badge-category {
        background: rgba(255, 165, 0, 0.2);
        color: #FFA500;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
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

    .btn-action.view {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .btn-action.view:hover {
        background: rgba(59, 130, 246, 0.2);
        border-color: #3b82f6;
        transform: scale(1.1);
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
            width: 150px;
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

        .product-image {
            width: 50px;
            height: 50px;
        }
    }
</style>

<script>
    // Búsqueda en tiempo real
    document.getElementById('searchInput').addEventListener('keyup', function() {
        filterTable();
    });

    // Filtro por categoría
    document.getElementById('filterCategory').addEventListener('change', function() {
        filterTable();
    });

    function filterTable() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const categoryFilter = document.getElementById('filterCategory').value.toLowerCase();
        const tableRows = document.querySelectorAll('#tableBody tr');
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const matchesSearch = text.includes(searchTerm);
            const matchesCategory = categoryFilter === '' || text.includes(categoryFilter);
            
            row.style.display = (matchesSearch && matchesCategory) ? '' : 'none';
        });
    }

    function openProductModal(button) {
        // Leer datos del producto
        const nombre = button.dataset.nombre;
        const descripcion = button.dataset.descripcion;
        const precio = button.dataset.precio;
        const stock = button.dataset.stock;
        const categoria = button.dataset.categoria;
        const imagen = button.dataset.imagen || '';

        // Rellenar modal
        document.getElementById('modalTitle').innerText = nombre;
        document.getElementById('modalDescription').innerText = descripcion;
        document.getElementById('modalPrice').innerText = precio;
        document.getElementById('modalStock').innerText = stock;
        document.getElementById('modalCategory').innerText = categoria;

        // Manejar imagen
        const modalImage = document.getElementById('modalImage');
        const modalNoImage = document.getElementById('modalNoImage');
        
        if (imagen) {
            modalImage.src = imagen;
            modalImage.style.display = 'block';
            modalNoImage.style.display = 'none';
        } else {
            modalImage.style.display = 'none';
            modalNoImage.style.display = 'flex';
        }

        // Mostrar modal
        document.getElementById('productModal').style.display = 'block';
        
        // Prevenir scroll del body
        document.body.style.overflow = 'hidden';
    }

    function closeProductModal() {
        document.getElementById('productModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Cerrar modal al hacer clic fuera
    window.onclick = function(event) {
        const modal = document.getElementById('productModal');
        if (event.target == modal) {
            closeProductModal();
        }
    }

    // Cerrar modal con tecla ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeProductModal();
        }
    });
</script>
@endsection