@extends('layouts.app')

@section('styles')
    <!--- Internal Select2 css-->
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">UPDATE NITI</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">
                <li class="breadcrumb-item tx-15"><a href="{{ url('admin/manage-niti') }}" class="btn btn-warning text-dark">Manage Niti</a></li>
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active tx-15" aria-current="page">ADD NITI</li>
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
        <div class="alert alert-success"  id="Message">
            {{ session()->get('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert" id="Message">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('updateNiti', $niti->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-md-">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" class="form-control" id="niti_id" name="niti_id" value="{{ $niti->niti_id }}" placeholder="">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="language">Language</label>
                                    <select class="form-control" id="language" name="language">
                                        <option value="odia" {{ $niti->language == 'odia' ? 'selected' : '' }}>Odia</option>
                                        <option value="english" {{ $niti->language == 'english' ? 'selected' : '' }}>English</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="niti_name">Niti Name</label>
                                    <input type="text" class="form-control" id="niti_name" name="niti_name" value="{{ $niti->niti_name }}" placeholder="Enter Niti Name">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="niti_date">Niti Date</label>
                                    <input type="date" class="form-control" id="niti_date" name="niti_date" value="{{ $niti->niti_date }}" placeholder="Enter Niti Date">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="niti_time">Niti Time</label>
                                    <input type="time" class="form-control" id="niti_time" name="niti_time" value="{{ $niti->niti_time }}" placeholder="Enter Niti Time">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="niti_type">Niti Type</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="special_niti" name="niti_type" value="special" {{ $niti->niti_type == 'special' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="special_niti">
                                            Special Niti
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="daily_niti" name="niti_type" value="daily" {{ $niti->niti_type == 'daily' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="daily_niti">
                                            Daily Niti
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Enter Description">{{ $niti->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="padding-top: 27px">
                                <input type="submit" class="btn btn-primary" value="Update">
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
    <!-- Form-layouts js -->
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>
    <script>
        setTimeout(function(){
            document.getElementById('Message').style.display = 'none';
        }, 3000);
    </script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
@endsection
