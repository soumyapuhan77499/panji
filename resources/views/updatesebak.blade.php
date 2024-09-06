@extends('layouts.app')

@section('styles')
    <!--- Internal Select2 css-->
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">UPDATE SEBAK</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">
                <li class="breadcrumb-item tx-15"><a href="{{ url('admin/manage-sebak') }}" class="btn btn-warning text-dark">Manage Sebak</a></li>
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active tx-15" aria-current="page">ADD SEBAK</li>
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

    <form action="{{ route('updateSebak', $sebak->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT"> <!-- This specifies the form is a PUT request -->
        
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-md-">
                <div class="card custom-card">
                    <div class="card-body">
                        <!-- Sebak ID -->
                        <div class="row">
                            <input type="hidden" class="form-control" id="sebak_id" name="sebak_id" value="{{ $sebak->sebak_id }}" placeholder="">
                        </div>
    
                        <!-- Sebak Name -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sebak_name">Sebak Name</label>
                                    <input type="text" class="form-control" id="sebak_name" name="sebak_name" value="{{ $sebak->name }}" placeholder="Enter Sebak Name" required>
                                </div>
                            </div>
                            
                            <!-- Mobile Number -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile_no">Mobile Number</label>
                                    <input type="tel" class="form-control" id="mobile_no" name="mobile_no" value="{{ substr($sebak->mobile_no, 3) }}" placeholder="Enter Mobile No" required pattern="\d{10}" maxlength="10">
                                </div>
                            </div>
                        </div>
    
                        <!-- Email -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $sebak->email }}" placeholder="Enter your email" required>
                                </div>
                            </div>
    
                            <!-- Profile Photo -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profile_photo">Profile Photo <span style="color: red">*</span></label>
                                    <input type="file" name="profile_photo" class="form-control" id="profile_photo">
                                    @if ($sebak->profile_photo)
                                        <img src="{{ url($sebak->profile_photo) }}" alt="Profile Photo" style="width: 50px; height: 50px; border-radius: 50%; margin-top: 10px;">
                                    @endif
                                </div>
                            </div>
                        </div>
    
                  
                        <!-- Submit Button -->
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
