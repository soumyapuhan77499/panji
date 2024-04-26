@extends('layouts.app')

@section('styles')
    <!--- Internal Select2 CSS -->
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">EDIT EVENT</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb d-flex justify-content-between align-items-center">
                <li class="breadcrumb-item tx-15"><a href="{{ url('admin/manage-event') }}" class="btn btn-warning text-dark">Manage Event</a></li>
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active tx-15" aria-current="page">ADD EVENT</li>
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

    @if(session()->has('success'))
        <div class="alert alert-success" id="Message">
            {{ session()->get('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert" id="Message">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('updateEvent', $event->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-md-">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">Profile Information</div>
                        <div class="row">
                            <input type="hidden" class="form-control" id="event_id" name="event_id" value="{{ $event->event_id }}" placeholder="">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="language">Choose Language</label>
                                    <select class="form-control" id="language" name="language">
                                        <option value="English" {{ $event->language == 'English' ? 'selected' : '' }}>English</option>
                                        <option value="Hindi" {{ $event->language == 'Hindi' ? 'selected' : '' }}>Hindi</option>
                                        <option value="Odia" {{ $event->language == 'Odia' ? 'selected' : '' }}>Odia</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" id="date" name="date" value="{{ $event->date }}" placeholder="">
                                </div>
                                
                                <div class="form-group">
                                    <label for="event_name">Event Name</label>
                                    <input type="text" class="form-control" id="event_name" name="event_name" value="{{ $event->event_name }}" placeholder="Enter Event Name">
                                </div>
                               
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="event_photo">Upload Event Photo</label>
                                    <input type="file" class="form-control" name="event_photo" id="event_photo" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="tithi">Tithi</label>
                                    <input type="text" class="form-control" id="tithi" name="tithi" value="{{ $event->tithi }}" placeholder="Enter Tithi">
                                </div>
                                <div class="form-group">
                                    <label for="good_time">Good Time</label>
                                    <input type="text" class="form-control" id="good_time" name="good_time" value="{{ $event->good_time }}" placeholder="Enter Good Time">
                                </div>
                              
                             </div>
                             
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bad_time">Bad Time</label>
                                    <input type="text" class="form-control" id="bad_time" name="bad_time" value="{{ $event->bad_time }}" placeholder="Enter Bad Time">
                                </div>
                                <div class="form-group">
                                    <label for="sun_rise">Sun Rise</label>
                                    <input type="text" class="form-control" id="sun_rise" name="sun_rise" value="{{ $event->sun_rise }}" placeholder="Enter Sun Rise">
                                </div>
                                <div class="form-group">
                                    <label for="sun_set">Sun Set</label>
                                    <input type="text" class="form-control" id="sun_set" name="sun_set" value="{{ $event->sun_set }}" placeholder="Enter Sun Set">
                                </div>
                                                                                       
                                
                             </div>
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label for="special_niti">Special Niti</label>
                                    <textarea class="form-control" id="special_niti" name="special_niti" placeholder="Enter Special Niti">{{ $event->special_niti }}</textarea>
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
