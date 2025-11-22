@extends('layout.master')

@section('title', 'Editar Plantilla de Correo')

@section('main_content')
<div class="container my-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Editar Plantilla de Correo</h5>
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

            <form action="{{ url('admin/mail-templates/update', $mailTemplate->id) }}" method="POST">
                @csrf

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="alias" class="form-label">Alias</label>
                        <input type="text" name="alias" id="alias" class="form-control" value="{{ old('alias', $mailTemplate->alias) }}" required>
                        @error('alias')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $mailTemplate->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-8">
                        <label for="subject" class="form-label">Sujeto</label>
                        <input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject', $mailTemplate->subject) }}" required>
                        @error('subject')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if (!$mailTemplate->isDefault())
                        <div class="col-md-4">
                            <label for="status" class="form-label">Estado</label>
                            <div class="form-check form-switch mt-2">
                                <input type="checkbox" name="status" id="status" class="form-check-input" {{ $mailTemplate->status ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Activo</label>
                            </div>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="body" class="form-label">Cuerpo</label>
                    <textarea name="body" class="form-control" id="editor1" rows="5">{{ old('body', $mailTemplate->body) }}</textarea>
                    @error('body')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="alert alert-info">
                    <p><strong>Códigos Cortos Disponibles:</strong></p>
                    <ul>
                        <li><strong>{{ '{name}' }}</strong>: El nombre del destinatario</li>
                        <li><strong>{{ '{website_name}' }}</strong>: Nombre del sitio web</li>
                        <li><strong>{{ '{link}' }}</strong>: Enlace correspondiente</li>
                        <li><strong>{{ '{expiry_time}' }}</strong>: Tiempo de expiración del enlace</li>
                    </ul>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Actualizar
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
