@extends('layouts.main')
@section('title')
    | Profile
@endsection
@section('content')
    <div class="content">
        <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">My Profile</h4>
                            </div>
                            <div class="card card-profile" style="margin-top: 100px">
                                <div class="card-avatar">
                                    <a href="#pablo">
                                        <img class="img" src="{{asset('img/faces/'.$profile[0]->photo)}}" />
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-category text-gray">{{$profile[0]->status}}</h6>
                                    <h4 class="card-title">{{$profile[0]->name}}</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Address</h6>
                                            {{$profile[0]->address}}
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Phone Number</h6>
                                            {{$profile[0]->phone_number}}
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 20px">
                                        <div class="col-md-6">
                                            <h6>Status</h6>
                                            {{$profile[0]->status}}
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Gender</h6>
                                            {{$profile[0]->gender}}
                                        </div>
                                    </div>
                                    <a href="#pablo" class="btn btn-primary btn-round">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection