@extends('layouts.app')

@section('content')
<div class="form-page">
    <div class="form-container">
        <div class="form-card">
            <!-- Header -->
            <div class="form-card-header">
                <a href="{{ route('categorias.index') }}" class="btn-back-small">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"/>
                        <polyline points="12 19 5 12 12 5"/>
                    </svg>
                </a>
                <div>
                    <h1>Crear Nueva Categoría</h1>
                    <p>Completa el formulario para agregar una categoría</p>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data" class="custom-form">
                @csrf
                
                <div class="form-group-custom">
                    <label for="nombre">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                        </svg>
                        Nombre de la categoría
                    </label>
                    <input 
                        type="text" 
                        id="nombre" 
                        name="nombre" 
                        class="form-input-custom" 
                        placeholder="Ej: Electrónica, Ropa, Alimentos..."
                        required
                        autofocus
                        value="{{ old('nombre') }}"
                    >
                    <span class="form-hint">Ingresa un nombre descriptivo y único</span>
                    @error('nombre')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-custom">
                    <label for="descripcion">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                        Descripción
                    </label>
                    <textarea 
                        id="descripcion" 
                        name="descripcion" 
                        class="form-input-custom" 
                        placeholder="Describe la categoría..."
                        rows="4"
                    >{{ old('descripcion') }}</textarea>
                    <span class="form-hint">Opcional. Describe el propósito de esta categoría.</span>
                    @error('descripcion')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-custom">
                    <label for="imagen">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                        Imagen de la categoría
                    </label>
                    <div class="file-upload-wrapper">
                        <input 
                            type="file" 
                            id="imagen" 
                            name="imagen" 
                            class="file-input-custom" 
                            accept="image/*"
                        >
                        <div class="file-upload-area">
                            <div class="file-upload-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                    <polyline points="10 9 9 9 8 9"/>
                                </svg>
                            </div>
                            <div class="file-upload-text">
                                <span class="file-upload-title">Haz clic para subir una imagen</span>
                                <span class="file-upload-subtitle">o arrastra y suelta aquí</span>
                            </div>
                            <button type="button" class="file-upload-btn">Seleccionar archivo</button>
                        </div>
                        <div class="file-preview" id="filePreview"></div>
                    </div>
                    <span class="form-hint">Opcional. Sube una imagen representativa (JPEG, PNG, JPG, GIF - Max 2MB)</span>
                    @error('imagen')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-custom">
                    <label for="estado">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="m9 12 2 2 4-4"/>
                        </svg>
                        Estado
                    </label>
                    <div class="select-wrapper">
                        <select id="estado" name="estado" class="form-select-custom" required>
                            <option value="">Selecciona un estado</option>
                            <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        <div class="select-arrow">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </div>
                    </div>
                    <span class="form-hint">Selecciona el estado de la categoría</span>
                    @error('estado')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit-form">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        Crear Categoría
                    </button>
                    <a href="{{ route('categorias.index') }}" class="btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="info-card">
            <div class="info-icon">💡</div>
            <h3>Consejos</h3>
            <ul class="info-list">
                <li>Usa nombres cortos y descriptivos</li>
                <li>Evita duplicar categorías</li>
                <li>Piensa en cómo organizarás tus productos</li>
                <li>Puedes editar la categoría más tarde</li>
                <li>Las categorías inactivas no aparecerán en los filtros</li>
            </ul>
        </div>
    </div>
</div>

<style>
    .form-page {
        min-height: 100vh;
        background: #0a0a0a;
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-container {
        max-width: 1200px;
        width: 100%;
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 2rem;
    }

    .form-card {
        background: rgba(20, 20, 20, 0.9);
        border: 1px solid rgba(255, 215, 0, 0.2);
        border-radius: 24px;
        padding: 2.5rem;
        animation: fadeInUp 0.5s ease;
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

    .form-card-header {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid rgba(255, 215, 0, 0.1);
    }

    .btn-back-small {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 215, 0, 0.1);
        border: 1px solid rgba(255, 215, 0, 0.3);
        border-radius: 12px;
        color: #FFD700;
        text-decoration: none;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .btn-back-small:hover {
        background: rgba(255, 215, 0, 0.2);
        border-color: #FFD700;
        transform: translateX(-5px);
    }

    .form-card-header h1 {
        font-size: 2rem;
        font-weight: 800;
        color: #FFD700;
        margin-bottom: 0.5rem;
    }

    .form-card-header p {
        color: #888;
        font-size: 1rem;
    }

    .custom-form {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .form-group-custom {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .form-group-custom label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #FFD700;
        font-weight: 700;
        font-size: 1.05rem;
    }

    .form-input-custom {
        width: 100%;
        padding: 1.25rem 1.5rem;
        background: rgba(255, 215, 0, 0.05);
        border: 2px solid rgba(255, 215, 0, 0.2);
        border-radius: 14px;
        color: #fff;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .form-input-custom::placeholder {
        color: #666;
    }

    .form-input-custom:focus {
        outline: none;
        border-color: #FFD700;
        background: rgba(255, 215, 0, 0.1);
        box-shadow: 0 0 0 4px rgba(255, 215, 0, 0.1);
    }

    /* Estilos mejorados para el select de estado */
    .select-wrapper {
        position: relative;
        width: 100%;
    }

    .form-select-custom {
        width: 100%;
        padding: 1.25rem 3rem 1.25rem 1.5rem;
        background: rgba(255, 215, 0, 0.05);
        border: 2px solid rgba(255, 215, 0, 0.2);
        border-radius: 14px;
        color: #fff;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        appearance: none;
        cursor: pointer;
        background-image: none;
    }

    .form-select-custom:focus {
        outline: none;
        border-color: #FFD700;
        background: rgba(255, 215, 0, 0.1);
        box-shadow: 0 0 0 4px rgba(255, 215, 0, 0.1);
    }

    .select-arrow {
        position: absolute;
        right: 1.5rem;
        top: 50%;
        transform: translateY(-50%);
        color: #FFD700;
        pointer-events: none;
        transition: transform 0.3s ease;
    }

    .select-wrapper:focus-within .select-arrow {
        transform: translateY(-50%) rotate(180deg);
    }

    .form-select-custom option {
        background: #1a1a1a;
        color: #fff;
        padding: 0.5rem;
    }

    /* Estilos mejorados para la subida de archivos */
    .file-upload-wrapper {
        position: relative;
        width: 100%;
    }

    .file-input-custom {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
        z-index: 10;
    }

    .file-upload-area {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2.5rem 2rem;
        background: rgba(255, 215, 0, 0.05);
        border: 2px dashed rgba(255, 215, 0, 0.3);
        border-radius: 14px;
        transition: all 0.3s ease;
        text-align: center;
        gap: 1rem;
    }

    .file-upload-area:hover, .file-upload-area.dragover {
        background: rgba(255, 215, 0, 0.1);
        border-color: #FFD700;
    }

    .file-upload-icon {
        color: #FFD700;
        margin-bottom: 0.5rem;
    }

    .file-upload-text {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .file-upload-title {
        color: #FFD700;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .file-upload-subtitle {
        color: #888;
        font-size: 0.9rem;
    }

    .file-upload-btn {
        padding: 0.75rem 1.5rem;
        background: rgba(255, 215, 0, 0.2);
        border: 1px solid rgba(255, 215, 0, 0.5);
        border-radius: 10px;
        color: #FFD700;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-upload-btn:hover {
        background: rgba(255, 215, 0, 0.3);
        transform: translateY(-2px);
    }

    .file-preview {
        margin-top: 1rem;
        display: none;
        padding: 1rem;
        background: rgba(255, 215, 0, 0.05);
        border-radius: 10px;
        border: 1px solid rgba(255, 215, 0, 0.2);
    }

    .file-preview.show {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    .file-preview-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #fff;
    }

    .file-preview-icon {
        color: #FFD700;
    }

    .file-preview-info {
        display: flex;
        flex-direction: column;
    }

    .file-preview-name {
        font-weight: 600;
        color: #FFD700;
    }

    .file-preview-size {
        font-size: 0.8rem;
        color: #888;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .form-hint {
        color: #666;
        font-size: 0.9rem;
        margin-top: -0.25rem;
    }

    .form-error {
        color: #ef4444;
        font-size: 0.9rem;
        margin-top: -0.25rem;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .btn-submit-form {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 1.2rem 2rem;
        background: linear-gradient(135deg, #FFD700, #FFA500);
        border: none;
        border-radius: 14px;
        color: #1a1a1a;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
    }

    .btn-submit-form:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(255, 215, 0, 0.6);
    }

    .btn-cancel {
        padding: 1.2rem 2rem;
        background: transparent;
        border: 2px solid rgba(255, 215, 0, 0.3);
        border-radius: 14px;
        color: #FFD700;
        font-size: 1.1rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-cancel:hover {
        background: rgba(255, 215, 0, 0.1);
        border-color: #FFD700;
    }

    .info-card {
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.15), rgba(255, 165, 0, 0.05));
        border: 1px solid rgba(255, 215, 0, 0.3);
        border-radius: 24px;
        padding: 2.5rem;
        animation: fadeInRight 0.5s ease;
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .info-icon {
        font-size: 3rem;
        margin-bottom: 1.5rem;
    }

    .info-card h3 {
        color: #FFD700;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .info-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .info-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        color: #aaa;
        font-size: 1rem;
        line-height: 1.6;
    }

    .info-list li::before {
        content: '✓';
        color: #FFD700;
        font-weight: bold;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    @media (max-width: 1024px) {
        .form-container {
            grid-template-columns: 1fr;
        }

        .info-card {
            order: -1;
        }
    }

    @media (max-width: 768px) {
        .form-page {
            padding: 1rem;
        }

        .form-card {
            padding: 1.5rem;
        }

        .form-card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .form-actions {
            flex-direction: column;
        }
    }
</style>

<script>
    // Script para manejar la subida de archivos y mostrar vista previa
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('imagen');
        const fileUploadArea = document.querySelector('.file-upload-area');
        const filePreview = document.getElementById('filePreview');
        
        // Manejar el evento de cambio de archivo
        fileInput.addEventListener('change', function() {
            handleFileSelection(this.files);
        });
        
        // Manejar el arrastrar y soltar
        fileUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });
        
        fileUploadArea.addEventListener('dragleave', function() {
            this.classList.remove('dragover');
        });
        
        fileUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                handleFileSelection(e.dataTransfer.files);
            }
        });
        
        // Función para manejar la selección de archivos
        function handleFileSelection(files) {
            if (files.length > 0) {
                const file = files[0];
                
                // Validar tipo de archivo
                if (!file.type.match('image.*')) {
                    alert('Por favor, selecciona solo archivos de imagen.');
                    return;
                }
                
                // Validar tamaño (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('El archivo es demasiado grande. El tamaño máximo permitido es 2MB.');
                    return;
                }
                
                // Mostrar vista previa
                showFilePreview(file);
            }
        }
        
        // Función para mostrar vista previa del archivo
        function showFilePreview(file) {
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            
            filePreview.innerHTML = `
                <div class="file-preview-item">
                    <div class="file-preview-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                    </div>
                    <div class="file-preview-info">
                        <span class="file-preview-name">${file.name}</span>
                        <span class="file-preview-size">${fileSize} MB</span>
                    </div>
                </div>
            `;
            
            filePreview.classList.add('show');
            
            // Si es una imagen, mostrar miniatura
            if (file.type.match('image.*')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgPreview = document.createElement('img');
                    imgPreview.src = e.target.result;
                    imgPreview.style.maxWidth = '100px';
                    imgPreview.style.maxHeight = '100px';
                    imgPreview.style.borderRadius = '8px';
                    imgPreview.style.marginTop = '10px';
                    
                    filePreview.querySelector('.file-preview-item').appendChild(imgPreview);
                };
                reader.readAsDataURL(file);
            }
        }
    });
</script>
@endsection