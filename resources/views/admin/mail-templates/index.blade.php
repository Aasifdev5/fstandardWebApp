@extends('layout.master')
@section('title')
    Plantillas de Correo
@endsection
@section('main_content')

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @if(Session::has('success'))
                <div class="alert alert-success">
                   <p>{{session::get('success')}}</p>
                </div>
                @endif
                @if(Session::has('fail'))
                <div class="alert alert-danger">
                   <p>{{session::get('fail')}}</p>
                </div>
                @endif
                <div class="card" >
                    <div class="card-header">
                        <h5>LISTA DE PLANTILLAS DE CORREO</h5>
                        <br>
                        <a class="btn btn-pill btn-primary btn-air-primary pull-right"
                           href="{{ url('admin/mail-templates/add') }}"
                           data-toggle="tooltip"
                           title=""
                           role="button"
                           data-bs-original-title="btn btn-primary">
                            Agregar Plantillas de Correo
                        </a>
                        <!-- Bulk Delete Button -->
                        <button id="bulk-delete-btn" class="btn btn-danger " style="margin-right: 10px;">
                            Eliminar Seleccionados
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th class="tb-w-2x"><input type="checkbox" id="select-all"></th>
                                        <th class="tb-w-3x">Nombre</th>
                                        <th class="tb-w-7x">Asunto</th>
                                        <th class="tb-w-3x">Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mailTemplates as $mailTemplate)
                                        <tr class="item">
                                            <td><input type="checkbox" class="template-checkbox" value="{{ $mailTemplate->id }}"></td>
                                            <td>
                                                <a href="{{ url('admin/mail-templates/edit', $mailTemplate->id) }}" class="text-dark d-inline">
                                                    <i data-feather="mail" ></i> {{ $mailTemplate->name }}
                                                </a>
                                            </td>
                                            <td>{{ $mailTemplate->subject }}</td>
                                            <td>
                                                @if ($mailTemplate->status)
                                                    <span class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-danger">Desactivado</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="text-end">

                                                    <a
                                                    href="{{ url('admin/mail-templates/edit', $mailTemplate->id) }}">
                                                     <i class="fa fa-edit me-2"></i>Editar
                                                 </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DOM / jQuery Ends -->
        </div>
    </div>
    <!-- Container-fluid Ends-->


<!-- Include SweetAlert library -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.template-checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById('bulk-delete-btn').addEventListener('click', function() {
        const selectedIds = Array.from(document.querySelectorAll('.template-checkbox:checked')).map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            Swal.fire('¡Error!', 'Por favor seleccione al menos una plantilla.', 'error');
            return;
        }

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Make a request to delete the selected templates
                axios.post('{{ url("admin/mail-templates/bulk-delete") }}', {
                    ids: selectedIds
                }).then(response => {
                    if (response.data.success) {
                        Swal.fire('¡Eliminado!', response.data.message, 'success').then(() => {
                            location.reload(); // Reload the page to see the changes
                        });
                    } else {
                        Swal.fire('¡Error!', response.data.message, 'error');
                    }
                }).catch(error => {
                    Swal.fire('¡Error!', 'Hubo un problema al eliminar las plantillas.', 'error');
                });
            }
        });
    });
</script>

@endsection
