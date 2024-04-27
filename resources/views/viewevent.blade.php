@extends('layouts.app')

@section('styles')
    <!--- Internal Select2 css-->
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!--  smart photo master css -->
    <link href="{{ asset('assets/plugins/SmartPhoto-master/smartphoto.css') }}" rel="stylesheet">

    <style>
        .address-text {
            text-transform: uppercase;
            line-height: 1;
            margin-bottom: 10px;
            letter-spacing: 0.2px;
            font-size: 14px;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content" style="display: flex; align-items: center;">
            <a href="{{ url('admin/manage-event') }}" class="btn btn-warning text-dark">Back</a>
            <span class="main-content-title mg-b-0 mg-b-lg-1" style="margin-left: 10px">EVENT</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body d-md-flex">
                    <div class="">
                        <span class="profile-image pos-relative">
                            @if($eventinfo->event_photo)
                                <img class="br-5" alt="" src="{{ asset('assets/uploads/event_photo/'.$eventinfo->event_photo) }}" alt="event">
                            @else
                                <img class="br-5" alt="" src="{{ asset('assets/img/user.jpg') }}">
                            @endif
                        </span>
                    </div>
                    <div class="my-md-auto mt-4 prof-details">
                        <h4 class="font-weight-semibold ms-md-4 ms-0 mb-1 pb-0">{{$eventinfo->event_name}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content-body tab-pane active border-top-0" id="edit">
        <div class="card">
            <div class="card-body border-0">
                <div class="mb-4 main-content-label">Event Information</div>
                <form class="form-horizontal">
                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">Date</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Last Name" value="{{ date('d-m-Y', strtotime($eventinfo->date)) }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">Language</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control"
                                    placeholder="Last Name"  value="{{$eventinfo->language}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">Tithi</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control"
                                    placeholder="Last Name"  value="{{$eventinfo->tithi}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">Good Time</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control"
                                    value="{{$eventinfo->good_time}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">Bad Time</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control"
                                    value="{{$eventinfo->bad_time}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">Sun Rise</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control"
                                    value="{{$eventinfo->sun_rise}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">Sun Set</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control"
                                    value="{{$eventinfo->sun_set}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">Special Niti</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control"
                                    value="{{$eventinfo->special_niti}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">Status</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control"
                                    value="{{$eventinfo->status}}" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Internal Select2 js-->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>

    <!-- smart photo master js -->
    <script src="{{ asset('assets/plugins/SmartPhoto-master/smartphoto.js') }}"></script>
    <script src="{{ asset('assets/js/gallery.js') }}"></script>
@endsection
