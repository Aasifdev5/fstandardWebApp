@extends('layout.master')

@section('title')
Gestión de Saldos - Chambeadores
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
                    <h5 class="mb-0">
                        <i class="fas fa-wallet text-primary"></i>
                        Gestión de Saldos de Chambeadores
                    </h5>
                    <p class="mb-0 text-muted small">Administra los saldos de los chambeadores y procesa recargas</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Add Balance Form -->
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-plus-circle text-success"></i>
                                        Agregar Saldo por Depósito
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form id="addBalanceForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Chambeador</label>
                                            <select name="uid" class="form-select" required>
                                                <option value="">Seleccionar chambeador</option>
                                                @foreach($chambeadors as $chambeador)
                                                    <option value="{{ $chambeador['uid'] }}"
                                                            data-name="{{ $chambeador['name'] }} {{ $chambeador['last_name'] }}"
                                                            data-current-balance="{{ $chambeador['balance'] ?? 0 }}">
                                                        {{ $chambeador['name'] }} {{ $chambeador['last_name'] }}
                                                        ({{ $chambeador['email'] }})
                                                        @if($chambeador['balance'] ?? 0 > 0)
                                                            <span class="badge bg-success ms-2">Saldo: BOB. {{ number_format($chambeador['balance'], 2) }}</span>
                                                        @else
                                                            <span class="badge bg-warning ms-2">Sin saldo</span>
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="form-text">Selecciona el chambeador que realizó un depósito</div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Monto del Depósito (BOB)</label>
                                            <input type="number"
                                                   name="deposit_amount"
                                                   class="form-control"
                                                   step="0.01"
                                                   min="1"
                                                   placeholder="100.00"
                                                   required>
                                            <div class="form-text">
                                                Ingresa el monto total del depósito.
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Nota del Administrador</label>
                                            <textarea name="admin_note"
                                                      class="form-control"
                                                      rows="3"
                                                      placeholder="Detalles del depósito, número de transacción, fecha, etc... (opcional)"></textarea>
                                            <div class="form-text">Información adicional para el registro</div>
                                        </div>

                                        <button type="submit" class="btn btn-success w-100" id="submitBtn">
                                            <i class="fas fa-credit-card"></i> Procesar Recarga
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Balance History with Pagination -->
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-history text-info"></i>
                                        Historial de Saldos Activos
                                    </h6>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive" style="max-height: 400px;">
                                        <table class="table table-hover mb-0" id="balanceTable">
                                            <thead>
                                                <tr>
                                                    <th class="ps-3">Chambeador</th>
                                                    <th class="text-center">Saldo (BOB)</th>
                                                    <th class="text-center">Última Actualización</th>
                                                </tr>
                                            </thead>
                                            <tbody id="balanceBody">
                                                <!-- Filled via JS -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-center" id="paginationLinks">
                                    <!-- Pagination buttons via JS -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="row mt-4 summary-cards">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fa-2x mb-2"></i>
                                    <h5 class="card-title">{{ count($chambeadors) }}</h5>
                                    <p class="card-text">Total Chambeadores</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-wallet fa-2x mb-2"></i>
                                    @php
                                        $totalBalance = $workersWithBalance ? $workersWithBalance->sum('balance') : 0;
                                    @endphp
                                    <h5 class="card-title">BOB. {{ number_format($totalBalance, 2) }}</h5>
                                    <p class="card-text">Saldo Total</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-chart-line fa-2x mb-2"></i>
                                    <h5 class="card-title">{{ $workersWithBalance ? $workersWithBalance->count() : 0 }}</h5>
                                    <p class="card-text">Con Saldo</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                                    <h5 class="card-title">{{ count($chambeadors) - ($workersWithBalance ? $workersWithBalance->count() : 0) }}</h5>
                                    <p class="card-text">Sin Saldo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    let currentPage = 1;
    let selectedWorkerName = '';

    // Update worker info when selection changes
    $('select[name="uid"]').on('change', function() {
        const selectedOption = $(this).find('option:selected');
        selectedWorkerName = selectedOption.data('name') || '';
        const currentBalance = parseFloat(selectedOption.data('current-balance')) || 0;

        if (currentBalance > 0) {
            $('.form-text').first().html(
                `Saldo actual de ${selectedWorkerName}: <strong>BOB. ${currentBalance.toFixed(2)}</strong>`
            );
        } else {
            $('.form-text').first().html('Selecciona el chambeador que realizó un depósito');
        }
    });

    // Form submission
    $('#addBalanceForm').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const depositAmount = parseFloat($('input[name="deposit_amount"]').val()) || 0;
        const uid = $('select[name="uid"]').val();

        if (!uid) {
            Swal.fire({ icon: 'warning', title: 'Selección requerida', text: 'Por favor selecciona un chambeador' });
            return;
        }

        if (depositAmount < 1) {
            Swal.fire({ icon: 'warning', title: 'Monto inválido', text: 'El monto del depósito debe ser mayor a BOB. 1.00' });
            return;
        }

        const newBalance = depositAmount + parseFloat($('select[name="uid"] option:selected').data('current-balance') || 0);

        Swal.fire({
            title: `¿Confirmar recarga para ${selectedWorkerName}?`,
            html: `
                <div class="text-start">
                    <div class="mb-3"><strong>Detalles de la recarga:</strong></div>
                    <div class="row">
                        <div class="col-6"><strong>Depósito:</strong></div>
                        <div class="col-6 text-end">BOB. ${depositAmount.toFixed(2)}</div>
                    </div>
                    <div class="row">
                        <div class="col-6"><strong>Nuevo saldo total:</strong></div>
                        <div class="col-6 text-end fw-bold">BOB. ${newBalance.toFixed(2)}</div>
                    </div>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Confirmar Recarga',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#28a745'
        }).then((result) => {
            if (result.isConfirmed) {
                const submitBtn = $('#submitBtn');
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Procesando...');

                $.ajax({
                    url: '{{ route("admin.add.balance") }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Recarga procesada!',
                            html: `<div class="text-start">
                                <p><strong>${selectedWorkerName}</strong> ha recibido <strong>BOB. ${response.data.deposit_amount}</strong></p>
                                <p>Nuevo saldo: <strong>BOB. ${response.data.new_balance}</strong></p>
                            </div>`,
                            confirmButtonText: 'Ver Historial'
                        }).then(() => { loadBalanceHistory(currentPage); });
                    },
                    error: function(xhr) {
                        let errorMessage = 'Error desconocido';
                        try { const response = JSON.parse(xhr.responseText); errorMessage = response.message || 'Error al procesar la recarga'; }
                        catch (e) { errorMessage = 'Error de conexión. Por favor intenta de nuevo.'; }
                        Swal.fire({ icon: 'error', title: 'Error', text: errorMessage });
                    },
                    complete: function() { submitBtn.prop('disabled', false).html('<i class="fas fa-credit-card"></i> Procesar Recarga'); }
                });
            }
        });
    });

    // Load balance history with pagination
    function loadBalanceHistory(page = 1) {
        $.get(`{{ route("admin.balance.history") }}?page=${page}`, function(data) {
            console.log('Balance History Data:', data); // Debug the response
            if (data.success) {
                const tbody = $('#balanceBody');
                tbody.empty();

                console.log('Number of records:', data.data.length); // Debug number of records
                if (data.data.length > 0) {
                    data.data.forEach(function(worker) {
                        // Ensure balance is a valid number
                        const balance = parseFloat(worker.balance) || 0;
                        if (balance > 0) { // Double-check positive balance
                            tbody.append(`
                                <tr>
                                    <td class="ps-3">
                                        <div><strong>${worker.name || 'N/A'} ${worker.last_name || ''}</strong><br><small class="text-muted">${worker.email || 'N/A'}</small></div>
                                    </td>
                                    <td class="text-center fw-bold text-success">${balance.toFixed(2)}</td>
                                    <td class="text-center text-muted small">${new Date(worker.updated_at).toLocaleString('es-BO')}</td>
                                </tr>
                            `);
                        }
                    });
                } else {
                    tbody.html(`
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2"></i><br>No hay saldos activos
                            </td>
                        </tr>
                    `);
                }

                // Pagination buttons
                const pagination = $('#paginationLinks');
                pagination.empty();
                for (let i = 1; i <= data.pagination.last_page; i++) {
                    pagination.append(`<button class="btn btn-sm btn-outline-primary mx-1 page-btn ${i === data.pagination.current_page ? 'active' : ''}" data-page="${i}">${i}</button>`);
                }

                // Summary cards update
                const totalBalance = data.data.reduce((sum, w) => sum + (parseFloat(w.balance) || 0), 0).toFixed(2);
                $('.card.bg-success h5').text(`BOB. ${totalBalance}`);
                $('.card.bg-warning h5').text(data.data.length);
                $('.card.bg-info h5').text({{ count($chambeadors) }} - data.data.length);
            } else {
                console.error('Error loading balance history:', data);
                Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo cargar el historial de saldos.' });
            }
        }).fail(function(xhr) {
            console.error('AJAX error:', xhr);
            Swal.fire({ icon: 'error', title: 'Error', text: 'Error de conexión al cargar el historial.' });
        });
    }

    // Pagination click
    $(document).on('click', '.page-btn', function() {
        currentPage = $(this).data('page');
        loadBalanceHistory(currentPage);
    });

    // Initial load
    loadBalanceHistory(currentPage);

    // Auto-refresh every 30 seconds
    setInterval(() => loadBalanceHistory(currentPage), 30000);
});
</script>

<style>
.card { border-radius: 10px; transition: all 0.3s ease; }
.card:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.btn { transition: all 0.3s ease; }
.btn:hover { transform: translateY(-2px); }
.alert { border-radius: 8px; }
.table th, .table td { vertical-align: middle; }
.form-label { color: #495057; }
.swal-wide .swal2-popup { width: 600px !important; }
.summary-cards .card { cursor: pointer; transition: all 0.3s ease; }
.summary-cards .card:hover { transform: translateY(-5px); }
.table-responsive { border-radius: 8px; overflow: hidden; }
.badge { font-size: 0.75em; }
.page-btn.active { background-color: #0d6efd; color: #fff; }
</style>
@endsection
