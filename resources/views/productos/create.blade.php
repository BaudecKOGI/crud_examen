@extends('layouts.app')

@section('content')
<div class="form-page">
    <div class="form-container-wide">
        <div class="form-card-wide">
            <!-- Header -->
            <div class="form-card-header">
                <a href="{{ route('productos.index') }}" class="btn-back-small">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"/>
                        <polyline points="12 19 5 12 12 5"/>
                    </svg>
                </a>
                <div>
                    <h1>Crear Nuevo Producto</h1>
                    <p>Completa todos los campos para agregar un producto</p>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="custom-form-grid">
                @csrf

                <div class="form-left">
                    <div class="form-group-custom">
                        <label for="nombre">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                            </svg>
                            Nombre del producto
                        </label>
                        <input 
                            type="text" 
                            id="nombre" 
                            name="nombre" 
                            class="form-input-custom" 
                            placeholder="Ej: Laptop HP Pavilion"
                            required
                            autofocus
                            value="{{ old('nombre') }}"
                        >
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
                            class="form-textarea-custom" 
                            rows="4"
                            placeholder="Describe las características principales del producto..."
                            required
                        >{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group-custom">
                            <label for="precio">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="1" x2="12" y2="23"/>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                                </svg>
                                Precio (S/.)
                            </label>
                            <input 
                                type="number" 
                                id="precio" 
                                name="precio" 
                                class="form-input-custom" 
                                placeholder="0.00"
                                step="0.01"
                                min="0"
                                required
                                value="{{ old('precio') }}"
                            >
                        </div>

                        <div class="form-group-custom">
                          <label for="stock">
                              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                  <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                  <line x1="3" y1="9" x2="21" y2="9"/>
                                  <line x1="9" y1="21" x2="9" y2="9"/>
                              </svg>
                              Stock
                          </label>
                          <input 
                              type="number" 
                              id="stock" 
                              name="stock" 
                              class="form-input-custom" 
                              placeholder="Cantidad disponible"
                              step="1"
                              min="0"
                              required
                          >
                        </div>

                        <div class="form-group-custom">
                            <label for="categoria_id">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                                </svg>
                                Categoría
                            </label>
                            <select id="categoria_id" name="categoria_id" class="form-select-custom" required>
                                <option value="">Selecciona una categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-right">
                    <div class="image-upload-section">
                        <label class="image-label">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            Imagen del producto
                        </label>
                        
                        <div class="upload-area" id="uploadArea">
                            <input 
                                type="file" 
                                id="imagen" 
                                name="imagen" 
                                accept="image/*"
                                class="file-input"
                                onchange="previewImage(event)"
                            >
                            <div class="upload-content" id="uploadContent">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                    <polyline points="17 8 12 3 7 8"/>
                                    <line x1="12" y1="3" x2="12" y2="15"/>
                                </svg>
                                <h3>Arrastra una imagen aquí</h3>
                                <p>o haz clic para seleccionar</p>
                                <span class="file-types">PNG, JPG, JPEG (Max. 2MB)</span>
                            </div>
                            <div class="preview-container" id="previewContainer" style="display: none;">
                                <img id="imagePreview" src="" alt="Preview">
                                <button type="button" class="remove-image" onclick="removeImage()">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="18" y1="6" x2="6" y2="18"/>
                                        <line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-tips">
                        <div class="tip-icon">💡</div>
                        <h4>Consejos para la imagen</h4>
                        <ul>
                            <li>Usa imágenes de alta calidad</li>
                            <li>Fondo claro o neutro</li>
                            <li>Muestra el producto completo</li>
                            <li>Buena iluminación</li>
                        </ul>
                    </div>
                </div>

                <div class="form-actions-full">
                    <button type="submit" class="btn-submit-form">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        Guardar Producto
                    </button>
                    <a href="{{ route('productos.index') }}" class="btn-cancel">Cancelar</a>
                </div>
            </form>
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

    .form-container-wide {
        max-width: 1400px;
        width: 100%;
    }

    .form-card-wide {
        background: rgba(20, 20, 20, 0.9);
        border: 1px solid rgba(255, 215, 0, 0.2);
        border-radius: 24px;
        padding: 2.5rem;
        animation: fadeInUp 0.5s ease;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
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

    .custom-form-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 2.5rem;
    }

    .form-left {
        display: flex;
        flex-direction: column;
        gap: 1.75rem;
    }

    .form-right {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-group-custom {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .form-group-custom label,
    .image-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #FFD700;
        font-weight: 700;
        font-size: 1.05rem;
    }

    .form-input-custom,
    .form-textarea-custom,
    .form-select-custom {
        width: 100%;
        padding: 1.25rem 1.5rem;
        background: rgba(255, 215, 0, 0.05);
        border: 2px solid rgba(255, 215, 0, 0.2);
        border-radius: 14px;
        color: #fff;
        font-size: 1rem;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-textarea-custom {
        resize: vertical;
        min-height: 120px;
    }

    .form-input-custom::placeholder,
    .form-textarea-custom::placeholder {
        color: #666;
    }

    .form-input-custom:focus,
    .form-textarea-custom:focus,
    .form-select-custom:focus {
        outline: none;
        border-color: #FFD700;
        background: rgba(255, 215, 0, 0.1);
        box-shadow: 0 0 0 4px rgba(255, 215, 0, 0.1);
    }

    .form-select-custom {
        cursor: pointer;
    }

    .form-select-custom option {
        background: #1a1a1a;
        color: #FFD700;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .image-upload-section {
        flex: 1;
    }

    .upload-area {
        position: relative;
        border: 2px dashed rgba(255, 215, 0, 0.3);
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: rgba(255, 215, 0, 0.03);
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .upload-area:hover {
        border-color: #FFD700;
        background: rgba(255, 215, 0, 0.08);
    }

    .file-input {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }

    .upload-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        color: #888;
    }

    .upload-content svg {
        color: #FFD700;
        opacity: 0.5;
    }

    .upload-content h3 {
        color: #FFD700;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .upload-content p {
        color: #aaa;
    }

    .file-types {
        font-size: 0.85rem;
        color: #666;
        margin-top: 0.5rem;
    }

    .preview-container {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .preview-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 12px;
    }

    .remove-image {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 36px;
        height: 36px;
        background: rgba(220, 53, 69, 0.9);
        border: none;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .remove-image:hover {
        background: #dc3545;
        transform: scale(1.1);
    }

    .form-tips {
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 165, 0, 0.05));
        border: 1px solid rgba(255, 215, 0, 0.2);
        border-radius: 16px;
        padding: 1.5rem;
    }

    .tip-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .form-tips h4 {
        color: #FFD700;
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .form-tips ul {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .form-tips li {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #aaa;
        font-size: 0.95rem;
    }

    .form-tips li::before {
        content: '✓';
        color: #FFD700;
        font-weight: bold;
    }

    .form-actions-full {
        grid-column: 1 / -1;
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 215, 0, 0.1);
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

    @media (max-width: 1024px) {
        .custom-form-grid {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .form-page {
            padding: 1rem;
        }

        .form-card-wide {
            padding: 1.5rem;
        }

        .form-card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .form-actions-full {
            flex-direction: column;
        }
    }
</style>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('uploadContent').style.display = 'none';
                document.getElementById('previewContainer').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        document.getElementById('imagen').value = '';
        document.getElementById('imagePreview').src = '';
        document.getElementById('uploadContent').style.display = 'flex';
        document.getElementById('previewContainer').style.display = 'none';
    }

    // Drag and drop
    const uploadArea = document.getElementById('uploadArea');
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.style.borderColor = '#FFD700';
            uploadArea.style.background = 'rgba(255, 215, 0, 0.15)';
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.style.borderColor = 'rgba(255, 215, 0, 0.3)';
            uploadArea.style.background = 'rgba(255, 215, 0, 0.03)';
        }, false);
    });

    uploadArea.addEventListener('drop', function(e) {
        const dt = e.dataTransfer;
        const file = dt.files[0];
        document.getElementById('imagen').files = dt.files;
        previewImage({ target: { files: [file] } });
    }, false);
</script>
@endsection