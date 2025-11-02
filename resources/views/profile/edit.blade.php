@extends('layouts.app')

@section('title', 'Perfil de Usuario')

@section('content') 
<div class="profile-page">
    <div class="profile-container">
        <!-- Header -->
        <div class="profile-header">
            <a href="{{ url()->previous() }}" class="btn-back">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"/>
                    <polyline points="12 19 5 12 12 5"/>
                </svg>
                Volver
            </a>
            <div class="header-content">
                <h1>Mi Perfil</h1>
                <p>Gestiona tu información personal y configuración de cuenta</p>
            </div>
        </div>

        <!-- Foto de Perfil -->
        <div class="profile-photo-section">
            <div class="photo-card">
                <div class="photo-content">
                    <div class="current-photo">
                        <div class="photo-preview">
                            <img src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/150x150?text=Usuario' }}" 
                                 alt="Foto de perfil" 
                                 class="profile-photo">
                        </div>
                        <div class="user-info">
                            <h3>{{ Auth::user()->name }}</h3>
                            <p>{{ Auth::user()->email }}</p>
                            <span class="member-info">Miembro desde {{ Auth::user()->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    
                    <form action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data" class="photo-form">
                    @csrf
                    @method('PUT') <!-- ✅ IMPORTANTE: Usar PUT -->
                    
                    <div class="file-upload-wrapper">
                        <input 
                            type="file" 
                            id="profile_photo" 
                            name="profile_photo" 
                            class="file-input-custom" 
                            accept="image/*"
                            required
                        >
                        <div class="file-upload-area">
                            <div class="file-upload-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                            </div>
                            <div class="file-upload-text">
                                <span class="file-upload-title">Cambiar foto de perfil</span>
                                <span class="file-upload-subtitle">Haz clic o arrastra una imagen</span>
                            </div>
                            <button type="button" class="file-upload-btn">Seleccionar imagen</button>
                        </div>
                        <div class="file-preview" id="filePreview"></div>
                    </div>
                    
                    @error('profile_photo')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                    
                    @if (session('status'))
                        <div class="success-message">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <button type="submit" class="btn-update-photo">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        Actualizar Foto
                    </button>
                </form>
                </div>
            </div>
        </div>

        <!-- Secciones del Perfil -->
        <div class="profile-sections">
            <!-- Información del Perfil -->
            <div class="profile-card">
                <div class="card-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <h3>Información Personal</h3>
                </div>
                <div class="card-content">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Cambiar Contraseña -->
            <div class="profile-card">
                <div class="card-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
                    </svg>
                    <h3>Cambiar Contraseña</h3>
                </div>
                <div class="card-content">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Eliminar Cuenta -->
            <div class="profile-card danger">
                <div class="card-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    <h3>Eliminar Cuenta</h3>
                </div>
                <div class="card-content">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-page {
        min-height: 100vh;
        background: #0a0a0a;
        padding: 2rem;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    .profile-container {
        max-width: 800px;
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    /* Header */
    .profile-header {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        padding: 2rem;
        background: rgba(20, 20, 20, 0.9);
        border: 1px solid rgba(255, 215, 0, 0.2);
        border-radius: 24px;
        text-align: center;
    }

    .btn-back {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #FFD700;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        align-self: flex-start;
        padding: 0.75rem 1rem;
        background: rgba(255, 215, 0, 0.1);
        border: 1px solid rgba(255, 215, 0, 0.3);
        border-radius: 12px;
    }

    .btn-back:hover {
        background: rgba(255, 215, 0, 0.2);
        border-color: #FFD700;
        transform: translateX(-5px);
    }

    .header-content h1 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #FFD700;
        margin-bottom: 0.5rem;
    }

    .header-content p {
        color: #888;
        font-size: 1.1rem;
    }

    /* Foto de Perfil */
    .profile-photo-section {
        width: 100%;
    }

    .photo-card {
        background: rgba(20, 20, 20, 0.9);
        border: 1px solid rgba(255, 215, 0, 0.2);
        border-radius: 24px;
        padding: 2rem;
    }

    .photo-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2rem;
    }

    .current-photo {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 1.5rem;
    }

    .photo-preview {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        border: 4px solid rgba(255, 215, 0, 0.5);
        padding: 6px;
        background: rgba(255, 215, 0, 0.1);
        box-shadow: 0 8px 32px rgba(255, 215, 0, 0.2);
    }

    .profile-photo {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-info {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .user-info h3 {
        color: #FFD700;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .user-info p {
        color: #aaa;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }

    .member-info {
        color: #666;
        font-size: 0.9rem;
        font-style: italic;
    }

    .photo-form {
        width: 100%;
        max-width: 500px;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    /* Estilos para la subida de archivos */
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
        padding: 2.5rem;
        background: rgba(255, 215, 0, 0.05);
        border: 2px dashed rgba(255, 215, 0, 0.3);
        border-radius: 16px;
        transition: all 0.3s ease;
        text-align: center;
        gap: 1rem;
        min-height: 200px;
    }

    .file-upload-area:hover, .file-upload-area.dragover {
        background: rgba(255, 215, 0, 0.1);
        border-color: #FFD700;
        transform: translateY(-2px);
    }

    .file-upload-icon {
        color: #FFD700;
    }

    .file-upload-text {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .file-upload-title {
        color: #FFD700;
        font-weight: 600;
        font-size: 1.2rem;
    }

    .file-upload-subtitle {
        color: #888;
        font-size: 0.95rem;
    }

    .file-upload-btn {
        padding: 0.85rem 1.75rem;
        background: rgba(255, 215, 0, 0.2);
        border: 1px solid rgba(255, 215, 0, 0.5);
        border-radius: 12px;
        color: #FFD700;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .file-upload-btn:hover {
        background: rgba(255, 215, 0, 0.3);
        transform: translateY(-2px);
    }

    .file-preview {
        margin-top: 1rem;
        padding: 1.25rem;
        background: rgba(255, 215, 0, 0.05);
        border-radius: 12px;
        border: 1px solid rgba(255, 215, 0, 0.2);
        display: none;
    }

    .file-preview.show {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    .file-preview-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        color: #fff;
    }

    .file-preview-icon {
        color: #FFD700;
        flex-shrink: 0;
    }

    .file-preview-info {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .file-preview-name {
        font-weight: 600;
        color: #FFD700;
        font-size: 1.1rem;
    }

    .file-preview-size {
        font-size: 0.85rem;
        color: #888;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .btn-update-photo {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 1.25rem 2rem;
        background: linear-gradient(135deg, #FFD700, #FFA500);
        border: none;
        border-radius: 14px;
        color: #1a1a1a;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
        width: 100%;
    }

    .btn-update-photo:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(255, 215, 0, 0.6);
    }

    /* Secciones del Perfil */
    .profile-sections {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        width: 100%;
    }

    .profile-card {
        background: rgba(20, 20, 20, 0.9);
        border: 1px solid rgba(255, 215, 0, 0.2);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .profile-card:hover {
        border-color: rgba(255, 215, 0, 0.4);
        transform: translateY(-2px);
    }

    .profile-card.danger {
        border-color: rgba(239, 68, 68, 0.3);
    }

    .profile-card.danger:hover {
        border-color: rgba(239, 68, 68, 0.5);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.75rem 2rem;
        background: rgba(255, 215, 0, 0.05);
        border-bottom: 1px solid rgba(255, 215, 0, 0.1);
    }

    .profile-card.danger .card-header {
        background: rgba(239, 68, 68, 0.05);
        border-bottom-color: rgba(239, 68, 68, 0.1);
    }

    .card-header h3 {
        color: #FFD700;
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0;
    }

    .profile-card.danger .card-header h3 {
        color: #ef4444;
    }

    .card-header svg {
        color: #FFD700;
    }

    .profile-card.danger .card-header svg {
        color: #ef4444;
    }

    .card-content {
        padding: 2.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-page {
            padding: 1rem;
        }

        .profile-header {
            padding: 1.5rem;
            text-align: left;
        }

        .header-content h1 {
            font-size: 2rem;
        }

        .photo-card {
            padding: 1.5rem;
        }

        .photo-preview {
            width: 150px;
            height: 150px;
        }

        .file-upload-area {
            padding: 2rem 1.5rem;
            min-height: 180px;
        }

        .card-header,
        .card-content {
            padding: 1.5rem;
        }

        .card-header h3 {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 480px) {
        .profile-header {
            padding: 1.25rem;
        }

        .header-content h1 {
            font-size: 1.75rem;
        }

        .photo-card {
            padding: 1.25rem;
        }

        .photo-preview {
            width: 120px;
            height: 120px;
        }

        .user-info h3 {
            font-size: 1.3rem;
        }

        .file-upload-area {
            padding: 1.5rem 1rem;
            min-height: 160px;
        }

        .file-upload-title {
            font-size: 1.1rem;
        }

        .card-header,
        .card-content {
            padding: 1.25rem;
        }

        .btn-update-photo {
            padding: 1.1rem 1.5rem;
            font-size: 1rem;
        }
    }
</style>

<script>
    // Script para manejar la subida de archivos y mostrar vista previa
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('profile_photo');
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
                    imgPreview.style.width = '80px';
                    imgPreview.style.height = '80px';
                    imgPreview.style.borderRadius = '8px';
                    imgPreview.style.objectFit = 'cover';
                    imgPreview.style.border = '2px solid rgba(255, 215, 0, 0.3)';
                    imgPreview.style.flexShrink = '0';
                    
                    filePreview.querySelector('.file-preview-item').appendChild(imgPreview);
                };
                reader.readAsDataURL(file);
            }
        }
    });
</script>
@endsection