@extends('layout.master')

@section('title')
    {{ __('Trader Behavioral Monitor') }}
@endsection

@section('main_content')
<div class="page-content ">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0  shadow-lg">
                    <div class="card-header border-bottom border-dark py-3 ">
                        <h4 class="card-title mb-0 text-white fw-bold">
                            <i class="fas fa-brain me-2 text-info"></i>{{ __('Behavioral Risk Matrix (Live)') }}
                        </h4>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table id="basic-1" class="table  table-hover align-middle mb-0">
                                <thead>
                                    <tr class="bg-secondary text-info">
                                        <th class="fw-bold">{{ __('Trader Details') }}</th>
                                        <th class="text-center fw-bold">{{ __('Discipline') }}</th>
                                        <th class="text-center fw-bold">{{ __('Aggression') }}</th>
                                        <th class="text-center fw-bold">{{ __('Risk Status') }}</th>
                                        <th class="text-center fw-bold">{{ __('Audit') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($traders as $trader)
                                    <tr class="border-bottom border-secondary">
                                        <td>
                                            <div class="fw-bold text-white fs-6">{{ $trader->name }}</div>
                                            <span class="badge bg-info text-dark fw-bold">UID: #{{ $trader->id }}</span>
                                        </td>
                                        <td class="text-center" style="width: 180px;">
                                            @php $disc = ($trader->psychometricState->discipline ?? 0) * 100; @endphp
                                            <div class="progress rounded-0 mb-1" style="height: 12px; background-color: #000;">
                                                <div class="progress-bar bg-info" style="width: {{ $disc }}%"></div>
                                            </div>
                                            <b class="text-white">{{ number_format($disc, 0) }}%</b>
                                        </td>
                                        <td class="text-center" style="width: 180px;">
                                            @php $aggr = ($trader->psychometricState->aggression ?? 0) * 100; @endphp
                                            <div class="progress rounded-0 mb-1" style="height: 12px; background-color: #000;">
                                                <div class="progress-bar bg-danger" style="width: {{ $aggr }}%"></div>
                                            </div>
                                            <b class="text-white">{{ number_format($aggr, 0) }}%</b>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge p-2 px-3 fw-bold shadow-sm
                                                @if($trader->risk_status == 'High Risk') bg-danger text-white
                                                @elseif($trader->risk_status == 'Medium Risk') bg-warning text-dark
                                                @else bg-success text-white @endif">
                                                {{ strtoupper($trader->risk_status) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-sm fw-bold text-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#modal-{{ $trader->id }}">
                                                <i class="fas fa-search-plus me-1"></i> {{ __('FULL AUDIT') }}
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal-{{ $trader->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content border-info  text-white shadow-lg">
                                                <div class="modal-header border-secondary ">
                                                    <h5 class="modal-title fw-bold text-info">
                                                        <i class="fas fa-user-secret me-2"></i>{{ __('BEHAVIORAL AUDIT:') }} {{ strtoupper($trader->name) }}
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body p-4 ">
                                                    <div class="row">
                                                        <div class="col-md-4 border-end border-dark">
                                                            <h6 class="text-info fw-bold text-uppercase mb-3"><i class="fas fa-shield-alt me-2"></i>{{ __('Risk Compliance') }}</h6>

                                                            <div class="mb-4">
                                                                <label class="text-white fw-bold mb-1 d-block">{{ __('Discipline Score') }}</label>
                                                                <div class="progress bg-black shadow-sm" style="height: 15px;">
                                                                    <div class="progress-bar bg-info fw-bold" style="width: {{ $trader->latestSnapshot->discipline_score ?? 0 }}%">{{ $trader->latestSnapshot->discipline_score ?? 0 }}%</div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <label class="text-white fw-bold mb-1 d-block">{{ __('Emotional Stability') }}</label>
                                                                <div class="progress bg-black shadow-sm" style="height: 15px;">
                                                                    <div class="progress-bar bg-success fw-bold" style="width: {{ $trader->latestSnapshot->emotional_stability ?? 0 }}%">{{ $trader->latestSnapshot->emotional_stability ?? 0 }}%</div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 border-end border-dark">
                                                            <h6 class="text-info fw-bold text-uppercase mb-3"><i class="fas fa-tachometer-alt me-2"></i>{{ __('Execution Metrics') }}</h6>

                                                            <div class="mb-4">
                                                                <label class="text-white fw-bold mb-1 d-block">{{ __('Impulse Score') }}</label>
                                                                <div class="progress bg-black shadow-sm" style="height: 15px;">
                                                                    <div class="progress-bar bg-warning text-dark fw-bold" style="width: {{ $trader->latestSnapshot->impulse_score ?? 0 }}%">{{ $trader->latestSnapshot->impulse_score ?? 0 }}%</div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <label class="text-white fw-bold mb-1 d-block">{{ __('Risk Consistency') }}</label>
                                                                <div class="progress bg-black shadow-sm" style="height: 15px;">
                                                                    <div class="progress-bar bg-primary fw-bold" style="width: {{ $trader->latestSnapshot->risk_consistency ?? 0 }}%">{{ $trader->latestSnapshot->risk_consistency ?? 0 }}%</div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <h6 class="text-info fw-bold text-uppercase mb-3"><i class="fas fa-undo-alt me-2"></i>{{ __('Psychological Gap') }}</h6>

                                                            <div class="mb-4">
                                                                <label class="text-white fw-bold mb-1 d-block">{{ __('Confidence Gap') }}</label>
                                                                <div class="progress bg-black shadow-sm" style="height: 15px;">
                                                                    <div class="progress-bar bg-danger fw-bold" style="width: {{ $trader->latestSnapshot->confidence_gap ?? 0 }}%">{{ $trader->latestSnapshot->confidence_gap ?? 0 }}%</div>
                                                                </div>
                                                                <b class="text-danger small mt-1 d-block font-italic">{{ __('Warning: High values indicate ego-trading risk.') }}</b>
                                                            </div>

                                                            <div class="mb-4">
                                                                <label class="text-white fw-bold mb-1 d-block">{{ __('Recovery Behavior') }}</label>
                                                                <div class="progress bg-black shadow-sm" style="height: 15px;">
                                                                    <div class="progress-bar bg-light text-dark fw-bold" style="width: {{ $trader->latestSnapshot->recovery_behavior ?? 0 }}%">{{ $trader->latestSnapshot->recovery_behavior ?? 0 }}%</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-12">
                                                            <div class="card  border-info shadow-none">
                                                                <div class="card-body p-4">
                                                                    <h6 class="text-info fw-bold text-uppercase mb-2"><i class="fas fa-robot me-2"></i>{{ __('AI Behavioral Forensic Advice') }}</h6>
                                                                    <p class="text-white fw-bold fs-6 border-start border-info border-4 ps-3 py-2 bg-black-50">
                                                                        "{{ $trader->latestExplanation->explanation ?? __('System analyzing user patterns... Data generation in progress.') }}"
                                                                    </p>
                                                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                                                        <span class="text-info fw-bold small"><i class="fas fa-history me-1"></i> {{ __('Last Logged:') }} {{ $trader->latestSnapshot->created_at ?? 'N/A' }}</span>
                                                                        <span class="badge bg-secondary text-white">{{ __('Generated By: AI Engine v1.2') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-secondary ">
                                                    <button type="button" class="btn btn-secondary fw-bold px-4 text-white" data-bs-dismiss="modal">{{ __('CLOSE AUDIT') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr><td colspan="5" class="text-center py-5 fw-bold text-info ">{{ __('NO TRADERS DETECTED IN ACTIVE DATABASE') }}</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* High Contrast Dark Theme Overrides */
    .bg-dark { background-color: #0b0e11 !important; }
    .bg-secondary { background-color: #161a1e !important; }
    .bg-black { background-color: #000000 !important; }
    .bg-black-50 { background-color: rgba(0,0,0,0.5); }
    .table-dark { background-color: #0b0e11 !important; }
    .progress { border-radius: 0 !important; overflow: hidden; }
    .text-info { color: #3b82f6 !important; }
    .progress-bar { transition: width 0.8s ease-in-out; font-size: 10px; }
    .modal-xl { max-width: 1200px; }
    .font-italic { font-style: italic; }
</style>
@endsection
