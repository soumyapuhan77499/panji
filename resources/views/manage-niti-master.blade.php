@extends('layouts.app')

@section('styles')
    <!-- Data table css -->
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatable/responsive.bootstrap5.css') }}" rel="stylesheet" />
    <!-- INTERNAL Select2 css -->
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Manage Niti</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">
                <a href="{{ url('admin/add-niti') }}" class="breadcrumb-item tx-15 btn btn-warning">Add Niti</a>
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Niti</li>
            </ol>
        </div>
    </div>

    @if (session('success'))
        <div id="Message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('danger'))
        <div id="Message" class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">SlNo</th>
                                    <th class="border-bottom-0">Language</th>
                                    <th class="border-bottom-0">Niti Name</th>
                                    <th class="border-bottom-0">Seba Name</th>
                                    <th class="border-bottom-0">Niti Steps</th>
                                    <th class="border-bottom-0">Description</th>
                                    <th class="border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($manage_niti_master as $niti)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $niti->language }}</td> <!-- Display language -->
                                        <td>{{ $niti->niti_name }}</td>
                        
                                        <!-- Display multiple Seba names -->
                                        <td>
                                            @if($niti->seba_name) <!-- Check if seba_name exists -->
                                                @php
                                                    $sebaNames = explode(',', $niti->seba_name); // Exploding the comma-separated string
                                                @endphp
                                                <ol>
                                                    @foreach ($sebaNames as $sebaName)
                                                        <li>{{ $sebaName }}</li> <!-- Display each Seba name -->
                                                    @endforeach
                                                </ol>
                                            @else
                                                <p>No Seba name available</p>
                                            @endif
                                        </td>
                        
                                        <!-- Display Steps -->
                                        <td>
                                            @if($niti->steps->isNotEmpty())
                                                <table class="table table-bordered mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Step No</th>
                                                            <th>Step Name</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($niti->steps as $step)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $step->step_name }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <p>No steps available</p>
                                            @endif
                                        </td>
                        
                                        <td>{{ $niti->description }}</td>
                        
                                        <td style="color:#B7070A;font-size: 15px">
                                            <a class="btn btn-success cursor-pointer" href="{{ url('admin/edit-niti-master/' . $niti->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form id="delete-form-{{ $niti->id }}" action="{{ route('deletNitiMaster', $niti->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger" style="display:inline;" onclick="confirmDelete({{ $niti->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
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
    <!-- End Row -->
@endsection

@section('scripts')
    <!-- Internal Data tables -->
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/table-data.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
    
<script>
        // Hide success/error message after 3 seconds
        setTimeout(function(){
            document.getElementById('Message').style.display = 'none';
        }, 3000);
    </script>
@endsection
