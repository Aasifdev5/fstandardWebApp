@extends('layout.master')

@section('title')
    {{ $title }}
@endsection

@section('main_content')
    <!-- Inicio del área de contenido de la página -->

        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-style mb-30" >
                        <div class="card-header item-title d-flex justify-content-between">
                            <h2>{{ __('Categoría de Foro') }}</h2>
                            <button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal"
                                data-bs-target="#add-modal">
                                <i class="fa fa-plus"></i> {{ __('Añadir Categoría de Foro') }}
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="customers-table" class="row-border data-table-filter table-style">
                                    <thead>
                                        <tr>
                                            <th>{{ __('N°') }}</th>
                                            <th>{{ __('Logo') }}</th>
                                            <th>{{ __('Título') }}</th>
                                            <th>{{ __('Subtítulo') }}</th>
                                            <th>{{ __('Estado') }}</th>
                                            <th>{{ __('Acción') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($forumCategories as $category)
                                            <tr class="removable-item">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="user-info__img">
                                                        <img src="{{ getImageFile($category->logo) }}" alt="logo">
                                                    </div>
                                                </td>
                                                <td>{{ Str::limit($category->title, 20) }}</td>
                                                <td>{{ Str::limit($category->subtitle, 60) }}</td>
                                                <td>
                                                    <span
                                                        class="status {{ $category->status == 1 ? 'bg-green' : 'bg-red' }}">
                                                        {{ $category->status == 1 ? __('Activo') : __('Desactivado') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="action__buttons">
                                                        <a class="btn-action edit"
                                                            data-logo="{{ getImageFile($category->logo) }}"
                                                            data-item="{{ json_encode($category) }}"
                                                            data-updateurl="{{ route('forum.category.update', $category->uuid) }}"
                                                            title="{{ __('Editar') }}" style="margin-right: 10px;">
                                                            <!-- Added margin -->
                                                            <i class="fas fa-edit" style="font-size: 18px;"></i>
                                                        </a>

                                                        <a href="javascript:void(0);"
                                                            data-url="{{ route('forum.category.delete', $category->uuid) }}"
                                                            class="btn-action delete" title="{{ __('Eliminar') }}">
                                                            <i class="fas fa-trash" style="font-size: 18px;"></i>
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
            </div>
        </div>

    <!-- Modal Agregar inicio -->
    <div class="modal fade" id="add-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Añadir Categoría de Foro') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form action="{{ route('forum.category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('Título') }}</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                id="title" placeholder="{{ __('Escriba el título') }}" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="subtitle" class="form-label">{{ __('Subtítulo') }}</label>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                name="subtitle" id="subtitle" placeholder="{{ __('Escriba el subtítulo') }}"
                                value="{{ old('subtitle') }}">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">{{ __('Estado') }}</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="">{{ __('Seleccione una opción') }}</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ __('Activo') }}
                                </option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                    {{ __('Desactivado') }}</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="logo" class="form-label">{{ __('Logo') }}</label>
                            <div class="d-flex align-items-center">
                                <img src="" alt="vista previa del logo" id="logo-preview" class="me-2"
                                    style="width: 60px; height: 60px;">
                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                    name="logo" id="logo" accept="image/*" onchange="previewFile(this)">
                            </div>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">{{ __('Archivos de imagen aceptados') }}: PNG,
                                {{ __('Tamaño aceptado') }}: 60 x 60 (1MB)</small>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary w-100">{{ __('Guardar') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Agregar fin -->

    <!-- Modal Editar inicio -->
    <div class="modal fade" id="edit-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Editar Categoría de Foro') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form id="updateEditModal" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('Título') }}</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" id="title" placeholder="{{ __('Escriba el título') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="subtitle" class="form-label">{{ __('Subtítulo') }}</label>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                name="subtitle" id="subtitle" placeholder="{{ __('Escriba el subtítulo') }}">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">{{ __('Estado') }}</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror"
                                id="status">
                                <option value="">{{ __('Seleccione una opción') }}</option>
                                <option value="1">{{ __('Activo') }}</option>
                                <option value="0">{{ __('Desactivado') }}</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="logo" class="form-label">{{ __('Logo') }}</label>
                            <div class="d-flex align-items-center">
                                <img src="" alt="Logo preview" id="logoSrc" class="me-2"
                                    style="width: 60px; height: 60px;">
                                <input type="file" class="form-control" name="logo" id="logo"
                                    accept="image/*" onchange="previewFile(this)">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary w-100">{{ __('Guardar cambios') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Editar fin -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin/js/custom/image-preview.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <style>
        /* Ensure text is white and handle table overflow */
        .table-dark th,
        .table-dark td {
            white-space: nowrap;
            color: #ededed;
        }

        /* Set padding for readability */
        .table-dark th,
        .table-dark td {
            padding: 10px;
        }

        /* Adjust badge styling */
        .badge {
            font-size: 1em;
            padding: 5px 10px;
        }

        /* Custom style for DataTables buttons */
        .dt-buttons .btn,
        .dt-buttons .dt-button {
            background-color: #333;
            /* Dark background */
            color: #ededed;
            /* White text */
            border: none;
            /* Remove border */
            padding: 5px 10px;
            margin: 2px;
            border-radius: 4px;
        }

        /* Hover and focus effect for buttons */
        .dt-buttons .btn:hover,
        .dt-buttons .dt-button:hover,
        .dt-buttons .btn:focus,
        .dt-buttons .dt-button:focus {
            background-color: #0090ff;
            /* Accent color on hover */
            color: #fff;
        }
    </style>
    <script>
        // Preview file for logo
        function previewFile(input) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logo-preview').src = e.target.result;
                document.getElementById('logoSrc').src = e.target.result; // Update preview in edit modal
            };
            reader.readAsDataURL(file);
        }

        // Initialize DataTable
        $(document).ready(function() {
            $('#customers-table').DataTable({
                dom: 'Bfrtip',
                buttons: ['excel', 'pdf', 'print']
            });
        });

        // Handle Edit modal
        $(document).on('click', '.edit', function() {
            const category = $(this).data('item');
            const updateUrl = $(this).data('updateurl');
            $('#edit-modal').find('#updateEditModal').attr('action', updateUrl);
            $('#edit-modal').find('#title').val(category.title);
            $('#edit-modal').find('#subtitle').val(category.subtitle);
            $('#edit-modal').find('#status').val(category.status);
            $('#edit-modal').find('#logoSrc').attr('src', category.logo);
            $('#edit-modal').modal('show'); // Ensure the modal is displayed
        });

        // Handle delete confirmation
        $(document).on('click', '.delete', function() {
            const url = $(this).data('url');
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    </script>
@endsection
