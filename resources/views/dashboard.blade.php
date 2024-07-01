@extends('layouts.app')

@section('styles')
    <!-- INTERNAL Select2 css -->
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />

    <!-- INTERNAL Data table css -->
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatable/responsive.bootstrap5.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">DASHBOARD</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sales</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-9 col-lg-7 col-md-6 col-sm-12">
                                    <div class="text-justified align-items-center">
                                        <h3 class="text-dark font-weight-semibold mb-2 mt-0">Hi, Welcome Back <span
                                                class="text-primary">Admin</span></h3>
                                        <p class="text-dark tx-14 mb-3 lh-3"> You have used the 85% of free plan storage.
                                            Please upgrade your plan to get unlimited storage.</p>
                                        <button class="btn btn-primary shadow">Upgrade Now</button>
                                    </div>
                                </div>
                                <div
                                    class="col-xl-3 col-lg-5 col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
                                    <div class="chart-circle float-md-end mt-4 mt-md-0" data-value="0.85" data-thickness="8"
                                        data-color=""><canvas width="100" height="100"></canvas>
                                        <div class="chart-circle-value circle-style">
                                            <div class="tx-18 font-weight-semibold">85%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- </div> -->
    </div>
    <!-- row closed -->

    <!-- row -->


    <!-- row  -->
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product Summary</h4>
                </div>
                <div class="card-body pt-0 example1-table">
                    <div class="table-responsive">
                        <table class="table  table-bordered text-nowrap mb-0" id="example1">
                            <thead>
                                <tr>
                                    <th>SlNo.</th>
                                    <th>Niti Type</th>
                                    <th>Niti Name</th>
                                    <th class="text-center">Niti Date</th>
                                    <th>Niti Time</th>
                                    <th>Start Time</th>
                                    <th>Pause Time</th>
                                    <th>Resume Time</th>
                                    <th>Stop Time</th>
                                    <th>Niti Duration</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($manage_nitis as $index => $niti)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $niti->niti_type }}</td>
                                        <td>{{ $niti->niti_name }}</td>
                                        <td>{{ $niti->niti_date }}</td>
                                        <td>{{ $niti->niti_time }}</td>
                                        <td>{{ $niti->start_time }}</td>
                                        <td>{{ $niti->pause_time }}</td>
                                        <td>{{ $niti->resume_time }}</td>
                                        <td>{{ $niti->end_time }}</td>
                                        <td>{{ $niti->duration }}</td>
                                        <td>
                                            <span
                                                class="badge 
                                                            @if ($niti->niti_status == 'completed') badge-primary 
                                                            @elseif($niti->niti_status == 'paused') badge-danger 
                                                            @elseif($niti->niti_status == 'started') badge-warning @endif">
                                                {{ $niti->niti_status }}
                                            </span>
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
    <!-- /row closed -->
@endsection

@section('scripts')
    <!-- Internal Chart.Bundle js-->
    <script src="{{ asset('assets/plugins/chartjs/Chart.bundle.min.js') }}"></script>

    <!-- Moment js -->
    <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>

    <!-- INTERNAL Apexchart js -->
    <script src="{{ asset('assets/js/apexcharts.js') }}"></script>

    <!--Internal Sparkline js -->
    <script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <!--Internal  index js -->
    <script src="{{ asset('assets/js/index.js') }}"></script>

    <!-- Chart-circle js -->
    <script src="{{ asset('assets/js/chart-circle.js') }}"></script>

    <!-- Internal Data tables -->
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>

    <!-- INTERNAL Select2 js -->
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection
