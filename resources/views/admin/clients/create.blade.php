@extends('layout.master')
@section('title', 'Nuevo Cliente')

@section('main_content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>Agregar Cliente</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label>Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
