@extends('layout.master')
@section('title', 'Editar Cliente')

@section('main_content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>Editar Cliente</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('clients.update', $client->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $client->name) }}">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email', $client->email) }}">
                </div>
                <div class="mb-3">
                    <label>Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $client->phone) }}">
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
