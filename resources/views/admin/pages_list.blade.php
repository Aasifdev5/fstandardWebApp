@extends('layout.master')
@section('title')
    Páginas
@endsection
@section('main_content')

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">
                            <p>{{ Session::get('fail') }}</p>
                        </div>
                    @endif
                    <div class="card" >
                        <div class="card-header">
                            <h5>Páginas</h5>
                            <div class="col-md-12">
                                <a href="{{ URL::to('admin/add') }}"
                                   class="btn btn-success btn-md waves-effect waves-light m-b-20 pull-right"
                                   data-toggle="tooltip" title="{{ trans('words.add_page') }}">
                                    <i class="fa fa-plus"></i> AGREGAR PÁGINA
                                </a>
                                <button id="bulkDeleteBtn" class="btn btn-danger btn-md waves-effect waves-light m-b-20 pull-right"
                                        data-toggle="tooltip" title="{{ trans('words.delete_selected') }}">
                                    <i class="fa fa-trash"></i> ELIMINAR SELECCIONADOS
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered display" id="advance-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <input type="checkbox" id="selectAll" />
                                            </th>
                                            <th class="text-center">#</th>
                                            <th>Título de la Página</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pages_list as $i => $page)
                                            <tr>
                                                <td class="text-center">
                                                    <input type="checkbox" class="recordCheckbox" value="{{ $page->id }}" />
                                                </td>
                                                <td class="text-center">{{ $i + 1 }}</td>
                                                <td>{{ stripslashes($page->page_title) }}</td>
                                                <td>
                                                    @if ($page->status == 1)
                                                        <span class="badge badge-success">Activo</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactivo</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a target="_blank" href="{{ URL::to('page/' . $page->page_slug) }}"
                                                       class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5"
                                                       data-toggle="tooltip" title="View">
                                                       <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ URL::to('admin/edit/' . $page->id) }}"
                                                       class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5"
                                                       data-toggle="tooltip" title="{{ trans('edit') }}">
                                                       <i class="fa fa-edit"></i>
                                                    </a>
                                                    @if ($page->id != 5)
                                                        <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5 single-delete"
                                                                data-id="{{ $page->id }}"
                                                                data-toggle="tooltip" title="{{ trans('words.remove') }}">
                                                           <i class="fa fa-remove"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!-- Include SweetAlert and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Select/Deselect All
    document.getElementById('selectAll').addEventListener('click', function () {
        document.querySelectorAll('.recordCheckbox').forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Bulk Delete Button
    document.getElementById('bulkDeleteBtn').addEventListener('click', function () {
        const selectedIds = Array.from(document.querySelectorAll('.recordCheckbox:checked')).map(cb => cb.value);

        if (selectedIds.length > 0) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ url('admin/pages/bulk_delete') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ ids: selectedIds })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('¡Eliminado!', data.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }
                    });
                }
            });
        } else {
            Swal.fire('Seleccione registros', 'Seleccione al menos un registro para eliminar.', 'info');
        }
    });

    // Single Delete Button
    document.querySelectorAll('.single-delete').forEach(button => {
        button.addEventListener('click', function () {
            const pageId = this.getAttribute('data-id');
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ url('admin/pages/delete') }}/${pageId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('¡Eliminado!', data.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
