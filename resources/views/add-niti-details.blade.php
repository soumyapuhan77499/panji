@extends('layouts.app')

@section('styles')
    <!-- Internal Select2 CSS -->
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">ADD NITI DETAILS</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">
                <li class="breadcrumb-item tx-15"><a href="{{ url('admin/manage-niti-details') }}"
                        class="btn btn-warning text-dark">Manage Niti</a></li>
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active tx-15" aria-current="page">ADD NITI</li>
            </ol>
        </div>
    </div>
    <!-- End Breadcrumb -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success" id="Message">
            {{ session()->get('success') }}
        </div>
    @endif

    @if ($errors->has('danger'))
        <div class="alert alert-danger" id="Message">
            {{ $errors->first('danger') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 col-md-">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5" style="font-size: 16px">
                        Niti Information
                    </div>
                    <hr>

                    <form action="{{ route('saveNiti') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" class="form-control" id="niti_id" name="niti_id"
                                value="NITI{{ rand(1000, 9999) }}" placeholder="">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="language">Language</label>
                                    <select class="form-control" id="language" name="language">
                                        <option value=" ">select language...</option>
                                        <option value="Odia">Odia</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="English">English</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="niti_name">Niti Name</label>
                                    <input type="text" class="form-control" id="niti_name" name="niti_name"
                                        placeholder="Enter Niti Name">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="niti_time">Niti Time</label>
                                    <div class="input-group">
                                        <input type="time" class="form-control" id="niti_time" name="niti_time" placeholder="Enter Niti Time">
                                        <select class="form-control" id="niti_ampm" name="niti_ampm" style="max-width: 80px;">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group row align-items-center">
                                    <label for="niti_type" class="col-sm-3 col-form-label">Niti Type</label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" style="height:20px;width: 20px" type="radio" id="special_niti" name="niti_type" value="special">
                                            <label class="form-check-label" for="special_niti">Special Niti</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" style="height:20px;width: 20px" type="radio" id="daily_niti" name="niti_type" value="daily">
                                            <label class="form-check-label" for="daily_niti">Daily Niti</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Enter Description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" style="padding-top: 27px">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
@endsection

@section('scripts')
    <!-- Form-layouts js -->
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>
    <script>
        setTimeout(function() {
            document.getElementById('Message').style.display = 'none';
        }, 3000);
    </script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
@endsection
