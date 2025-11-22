@extends('layout.master')
@section('title', 'Lista de Clientes')

@section('main_content')
    <div class="container-fluid">

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Clientes Registrados</h5>
                <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Nuevo Cliente
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="clientsTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $i => $client)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->phone ?? '-' }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>

                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmDelete('{{ $client->id }}', '/clients')">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            $('#clientsTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/Spanish.json"
                }
            });

            @if (session('success'))
                Swal.fire('¡Éxito!', '{{ session('success') }}', 'success');
            @endif

            // Delete client
            $('.delete-btn').click(function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: '¿Eliminar este cliente?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then(result => {
                    if (result.isConfirmed) {
                        $.post("{{ url('clients') }}/" + id + "/delete", {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        }, function() {
                            Swal.fire('¡Eliminado!', '', 'success').then(() => location
                                .reload());
                        }).fail(() => Swal.fire('Error', 'No se pudo eliminar.', 'error'));
                    }
                });
            });
        });
    </script>
@endsection
