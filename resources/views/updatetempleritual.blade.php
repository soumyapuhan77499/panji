@extends('layouts.app')

@section('styles')
    <!-- Internal Select2 css -->
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">EDIT TEMPLE RITUAL</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">
                <li class="breadcrumb-item tx-15"><a href="{{ url('admin/manage-temple-ritual') }}" class="btn btn-warning text-dark">Manage Temple Ritual</a></li>
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active tx-15" aria-current="page">EDIT RITUAL</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session()->has('success'))
        <div class="alert alert-success" id="Message">
            {{ session()->get('success') }}
        </div>
    @endif

    @if ($errors->has('danger'))
        <div class="alert alert-danger" id="Message">
            {{ $errors->first('danger') }}
        </div>
    @endif

    <form action="{{ route('updateRitual', $ritual->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12 col-md-">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ritual_name">Ritual Name</label>
                                    <input type="text" class="form-control" id="ritual_name" name="ritual_name" placeholder="Enter Ritual Name" value="{{ $ritual->ritual_name }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="time">Time</label>
                                    <input type="text" class="form-control" id="time" name="time" placeholder="Enter Time" value="{{ $ritual->time }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Date">Date</label>
                                    <input type="date" class="form-control" id="date" name="date" placeholder="dd-mm-yyyy" value="{{ $ritual->date}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="niti_name">Niti Name</label>
                                    <select class="form-control select2" id="niti_name" name="niti_name[]" multiple="multiple">
                                        <option value="">Select Niti</option>
                                        @foreach($nitis as $niti)
                                        <option value="{{ $niti->niti_name }}" {{ in_array($niti->niti_name, explode(',', $ritual->niti_name)) ? 'selected' : '' }}>{{ $niti->niti_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sebak_name">Sebak Name</label>
                                    <select class="form-control select2" id="sebak_name" name="sebak_name[]" multiple="multiple">
                                        <option value="">Select Sebak</option>
                                        @foreach($sebaks as $sebak)
                                        <option value="{{ $sebak->sebak_name }}" {{ in_array($sebak->sebak_name, explode(',', $ritual->sebak_name)) ? 'selected' : '' }}>{{ $sebak->sebak_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Enter Description">{{ $ritual->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" style="padding-top: 27px">
                                    <input type="submit" class="btn btn-primary" value="Update">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('modal')
@endsection

@section('scripts')
    <!-- Include jQuery first -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Include Select2 JS after jQuery -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <!-- Form-layouts js -->
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        
        setTimeout(function(){
            document.getElementById('Message').style.display = 'none';
        }, 3000);
    </script>
@endsection
