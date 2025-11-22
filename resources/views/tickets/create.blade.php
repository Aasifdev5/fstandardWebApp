@extends('master')
@section('title')
    {{ __('Crear Ticket') }}
@endsection

@section('content')
    <section style="padding: 90px 0; background: #1a1a1a">
        <div class="container">
            <h3 class="text-white">{{ __('Crear Nuevo Ticket') }}</h3>

            <form action="{{ route('tickets.store') }}" method="POST">
                @csrf

                <!-- Name Field -->
                <div class="form-group">
                    <label class="text-white" for="name">{{ __('Tu Nombre') }}</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label class="text-white" for="email">{{ __('Tu Correo Electrónico') }}</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <!-- Subject Field -->
                <div class="form-group">
                    <label class="text-white" for="subject">{{ __('Asunto') }}</label>
                    <input type="text" id="subject" name="subject" class="form-control" value="{{ old('subject') }}" required>
                </div>

                <!-- Status Field (Open/Closed) -->
                <div class="form-group">
                    <label class="text-white" for="status">{{ __('Estado') }}</label>
                    <select id="status" name="status" class="form-control">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>{{ __('Abierto') }}</option>
                        <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>{{ __('Cerrado') }}</option>
                    </select>
                </div>

                <!-- Department Dropdown (Optional) -->
                <div class="form-group">
                    <label class="text-white" for="department_id">{{ __('Departamento') }}</label>
                    <select id="department_id" name="department_id" class="form-control">
                        <option value="">{{ __('Seleccionar Departamento') }}</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Related Service Dropdown (Optional) -->
                <div class="form-group">
                    <label class="text-white" for="related_service_id">{{ __('Servicio Relacionado') }}</label>
                    <select id="related_service_id" name="related_service_id" class="form-control">
                        <option value="">{{ __('Seleccionar Servicio') }}</option>
                        @foreach ($relatedServices as $service)
                            <option value="{{ $service->id }}" {{ old('related_service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Priority Dropdown (Optional) -->
                <div class="form-group">
                    <label class="text-white" for="priority_id">{{ __('Prioridad') }}</label>
                    <select id="priority_id" name="priority_id" class="form-control">
                        <option value="">{{ __('Seleccionar Prioridad') }}</option>
                        @foreach ($priorities as $priority)
                            <option value="{{ $priority->id }}" {{ old('priority_id') == $priority->id ? 'selected' : '' }}>
                                {{ $priority->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <br>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">{{ __('Crear Ticket') }}</button>
            </form>
        </div>
    </section>
    <section style="background: #1a1a1a;padding-bottom:20px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card customers__area bg-style mb-30">
                        <div class="card-header item-title d-flex justify-content-between">
                            <h1>{{ __('Tickets List') }}</h1>
                        </div>
                        <div class="card-body">
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
                            <div class="table-responsive">
                                <table id="salesTable" class="table table-bordered table-dark table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Ticket Number') }}</th>
                                            <th>{{ __('Asunto') }}</th>
                                            <th>{{ __('Prioridad') }}</th>
                                            <th>{{ __('Estado') }}</th>
                                            <th>{{ __('Último Mensaje') }}</th>
                                            <th>{{ __('Fecha del Mensaje') }}</th>
                                            <th>{{ __('Acción') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tickets as $ticket)
                                            <tr class="removable-item">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ticket->ticket_number }}</td>
                                                <td>{{ $ticket->subject }}</td>
                                                <td>{{ optional($ticket->priority)->name }}</td>
                                                <td>{{ $ticket->status == 1 ? __('Abierto') : __('Cerrado') }}</td>
                                                <td>{{ optional($ticket->latestMessage)->message ?? __('No hay mensajes') }}</td>
                                                <td>
                                                    {{ optional($ticket->latestMessage)->created_at ? $ticket->latestMessage->created_at->format('d-m-Y H:i') : __('N/A') }}
                                                </td>
                                                <td>
                                                    <div class="action__buttons">
                                                        <a href="{{ route('show', $ticket->uuid) }}" class="btn-action mr-1" title="Ver detalles del ticket">
                                                            <i class="fas fa-eye" style="font-size: 18px;"></i>
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
    </section>

    <style>
        /* Custom table styling */
        .table {
            width: 100%;
            margin: 20px 0;
            border-radius: 10px;
        }
        .table th, .table td {
            padding: 12px;
            text-align: center;
            font-size: 16px;
            vertical-align: middle;
        }
        .table thead {
            background-color: #333;
            color: #fff;
        }
        .table tbody tr {
            background-color: #444;
        }
        .table tbody tr:hover {
            background-color: #555;
            cursor: pointer;
        }
        .table .action__buttons a {
            color: #007bff;
            text-decoration: none;
        }
        .table .action__buttons a:hover {
            color: #0056b3;
        }

        /* SweetAlert and DataTable button styles */
        .dt-buttons .btn, .dt-buttons .dt-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            margin: 5px;
        }

        .dt-buttons .btn:hover, .dt-buttons .dt-button:hover {
            background-color: #0056b3;
            color: #fff;
        }

        /* DataTable buttons for export */
        .dt-buttons {
            margin-bottom: 15px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#salesTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5', 'pdfHtml5', 'print'
                ],
                paging: true,
                lengthChange: false,
                searching: true,
                ordering: true,
                order: [[0, 'desc']],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/Spanish.json"
                }
            });
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endsection
