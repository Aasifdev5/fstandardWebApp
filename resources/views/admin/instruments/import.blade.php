@extends('layout.master')

@section('title')
    Import Instruments
@endsection

@section('main_content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Import Instruments (CSV / Excel)</h2>
                    </div>

                    <div class="card-body">

                        <div class="alert alert-info mb-4">
                            <strong>Important:</strong> File must contain this exact header:
                            <code>
symbol,category,sector,base_price,volatility_class,tick_size,lot_size,session_start,session_end,news_sensitivity
                            </code>
                            <br><br>
                            Existing instruments with the same <strong>symbol</strong> will be updated.
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('instruments.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label">Select CSV or Excel File</label>
                                <input
                                    type="file"
                                    name="file"
                                    class="form-control"
                                    accept=".csv,.xlsx,.xls"
                                    required
                                >
                                <small class="text-muted">
                                    Allowed formats: CSV, XLSX, XLS
                                </small>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success btn-lg">
                                    Upload & Import
                                </button>

                                <a href="{{ route('instruments.index') }}" class="btn btn-secondary btn-lg ms-2">
                                    Cancel
                                </a>
                            </div>
                        </form>

                        <hr class="my-5">

                        <h5>Sample CSV</h5>
                        <pre class="p-3 rounded ">
symbol,category,sector,base_price,volatility_class,tick_size,lot_size,session_start,session_end,news_sensitivity
FSI-NF50,index,broad_market,22850,medium,0.5,25,09:15,15:30,high
FSI-BN,index,banking,48700,high,1,15,09:15,15:30,very_high
FSI-GLD,commodity,bullion,66500,medium,1,100,09:00,23:30,high
                        </pre>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
