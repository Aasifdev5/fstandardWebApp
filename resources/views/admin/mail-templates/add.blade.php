@extends('layout.master')

@section('title', 'Agregar Plantilla de Correo')

@section('main_content')
<div class="container">
    <div class="card shadow-lg my-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Agregar Plantilla de Correo</h5>
            <a href="{{ url('admin/mail-templates') }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left"></i> Volver
            </a>
        </div>

        <div class="card-body">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <strong>¡Éxito!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-dismiss="alert"></button>
                </div>
            @endif
            @if(Session::has('fail'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>¡Error!</strong> {{ session('fail') }}
                    <button type="button" class="btn-close" data-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ url('admin/mail-templates/save') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="alias" class="form-label">Alias</label>
                    <input type="text" name="alias" id="alias" class="form-control @error('alias') is-invalid @enderror" placeholder="Ingrese el alias" value="{{ old('alias') }}">
                    @error('alias')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Ingrese el nombre" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label">Sujeto</label>
                    <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Ingrese el asunto" value="{{ old('subject') }}">
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="body" class="form-label">Cuerpo</label>
                    <textarea name="body" class="form-control @error('body') is-invalid @enderror" id="editor1" rows="5" placeholder="Escriba el contenido aquí">{{ old('body') }}</textarea>
                    @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Estado</label>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="status" id="status" class="form-check-input @error('status') is-invalid @enderror" {{ old('status', 1) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Activar por defecto</label>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="shortcodes" class="form-label">Códigos Cortos (JSON)</label>
                    <textarea name="shortcodes" id="shortcodes" class="form-control @error('shortcodes') is-invalid @enderror" placeholder='{"name": "Nombre", "website_name": "Nombre del sitio"}'>{{ old('shortcodes') }}</textarea>
                    @error('shortcodes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="alert alert-info">
                    <p><strong>Códigos Cortos Disponibles:</strong></p>
                    <ul>
                        <li><strong>{{ '{name}' }}</strong> : El nombre del destinatario</li>
                        <li><strong>{{ '{website_name}' }}</strong> : Nombre de su sitio web</li>
                        <li><strong>{{ '{link}' }}</strong> : Enlace correspondiente</li>
                        <li><strong>{{ '{expiry_time}' }}</strong> : Tiempo de expiración del enlace</li>
                    </ul>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                    <a href="{{ url('admin/mail-templates') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
