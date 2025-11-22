@extends('layout.master')

@section('title')
Lista de Chambeadores
@endsection

@section('main_content')
<div class="container-fluid">
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session()->get('fail') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Lista de Chambeadores</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover display" id="chambeadorsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Profesión</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Registrado</th>
                                    <th>Estado</th> <!-- NEW STATUS COLUMN -->
                                    <th>Documentos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($chambeadors as $i => $chambeador)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $chambeador['name'] }} {{ $chambeador['last_name'] }}</td>
                                        <td>{{ $chambeador['profession'] }}</td>
                                        <td>{{ $chambeador['email'] }}</td>
                                        <td>{{ $chambeador['phone'] }}</td>
                                        <td>{{ $chambeador['created'] }}</td>
                                        <td>
                                            @php
                                                $status = $chambeador['status'] ?? 'pending';
                                                $badgeClass = match($status) {
                                                    'approved' => 'success',
                                                    'rejected' => 'danger',
                                                    default => 'warning',
                                                };
                                            @endphp
                                            <span class="badge bg-{{ $badgeClass }}">
                                                {{ ucfirst($status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($chambeador['certificate_path'])
                                                <a href="{{ asset($chambeador['certificate_path']) }}"
                                                   class="btn btn-sm btn-info"
                                                   target="_blank">
                                                    <i class="fas fa-certificate"></i> Certificado
                                                </a>
                                            @endif
                                            @if($chambeador['front_image'] || $chambeador['back_image'])
                                                <button class="btn btn-sm btn-secondary view-id-btn"
                                                        data-front="{{ asset($chambeador['front_image'] ?? '') }}"
                                                        data-back="{{ asset($chambeador['back_image'] ?? '') }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#idCardModal">
                                                    <i class="fas fa-id-card"></i> ID
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-success approve-btn"
                                                    data-uid="{{ $chambeador['uid'] }}"
                                                    data-email="{{ $chambeador['email'] }}"
                                                    data-name="{{ $chambeador['name'] }}">
                                                <i class="fas fa-check"></i> Aprobar
                                            </button>
                                            <button class="btn btn-sm btn-danger reject-btn"
                                                    data-uid="{{ $chambeador['uid'] }}"
                                                    data-email="{{ $chambeador['email'] }}"
                                                    data-name="{{ $chambeador['name'] }}">
                                                <i class="fas fa-times"></i> Rechazar
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
    </div>
</div>

<!-- Modal for ID Card Viewing -->
<div class="modal fade" id="idCardModal" tabindex="-1" aria-labelledby="idCardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="idCardModalLabel">Documentos de Identidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Frente</h6>
                        <img id="frontImage" src="" class="img-fluid" alt="Frente de ID">
                    </div>
                    <div class="col-md-6">
                        <h6>Reverso</h6>
                        <img id="backImage" src="" class="img-fluid" alt="Reverso de ID">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    $('#chambeadorsTable').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/Spanish.json"
        },
        responsive: true
    });

    // View ID Card
    $('.view-id-btn').click(function() {
        $('#frontImage').attr('src', $(this).data('front') || '/images/placeholder.png');
        $('#backImage').attr('src', $(this).data('back') || '/images/placeholder.png');
    });

    // Approve Chambeador
    $('.approve-btn').click(function() {
        const uid = $(this).data('uid');
        const email = $(this).data('email');
        const name = $(this).data('name');

        Swal.fire({
            title: '¿Aprobar a ' + name + '?',
            text: 'Se enviará un correo de confirmación',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Aprobar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("chambeador.approve") }}',
                    method: 'POST',
                    data: {
                        uid: uid,
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            '¡Aprobado!',
                            'El chambeador ha sido aprobado y se ha enviado el correo.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire(
                            'Error',
                            'No se pudo aprobar al chambeador.',
                            'error'
                        );
                    }
                });
            }
        });
    });

    // Reject Chambeador
    $('.reject-btn').click(function() {
        const uid = $(this).data('uid');
        const email = $(this).data('email');
        const name = $(this).data('name');

        Swal.fire({
            title: '¿Rechazar a ' + name + '?',
            text: 'Se enviará un correo de notificación',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Rechazar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("chambeador.reject") }}',
                    method: 'POST',
                    data: {
                        uid: uid,
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            '¡Rechazado!',
                            'El chambeador ha sido rechazado y se ha enviado el correo.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire(
                            'Error',
                            'No se pudo rechazar al chambeador.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>

<style>
.card {
    border-radius: 10px;
    transition: all 0.3s ease;
}
.card:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.btn {
    transition: all 0.3s ease;
}
.btn:hover {
    transform: translateY(-2px);
}
.alert {
    border-radius: 8px;
}
.table th, .table td {
    vertical-align: middle;
}
</style>
@endsection
