@extends('layouts.main')
@section('title')
    | Profile
@endsection
@section('content')
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script type="text/javascript">
        function imagePreview(photo) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('fieldPhoto');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <div class="content">
        @if(session('alert'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('alert')}}
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
                            <h4 class="card-title">Edit Profile</h4>
                            <p class="card-category">Complete your profile</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route("addProfile")}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Name</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                        @if ($errors->has('name'))
                                            <p style="color:#dc3545;font-size:15px;">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Address</label>
                                            <input type="text" class="form-control" name="address">
                                        </div>
                                        @if ($errors->has('address'))
                                            <p style="color:#dc3545;font-size:15px;">{{ $errors->first('address') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Phone Number</label>
                                            <input type="number" class="form-control" name="phone_number">
                                        </div>
                                        @if ($errors->has('phone_number'))
                                            <p style="color:#dc3545;font-size:15px;">{{ $errors->first('phone_number') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Status</label>
                                            <input type="text" class="form-control" name="status">
                                        </div>
                                        @if ($errors->has('status'))
                                            <p style="color:#dc3545;font-size:15px;">{{ $errors->first('status') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check form-check-radio">
                                                <h6 class="card-subtitle mb-2 text-muted">Gender</h6>
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="gender" id="decrease" value="Laki-laki">
                                                    Laki-laki
                                                    <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                                </label>
                                                &nbsp;&nbsp;
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="gender" id="decrease" value="Perempuan">
                                                    Perempuan
                                                    <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                                </label>
                                                @if ($errors->has('gender'))
                                                    <p style="color:#dc3545;font-size:15px;">{{ $errors->first('gender') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fileinput fileinput-new thumbnail img-raised text-center col-md-12" data-provides="fileinput">
                                        <img width="75px" height="100px" src="" id="fieldPhoto">
                                        <span class="btn btn-raised btn-round btn-default btn-file">
                                            <span class="fileinput-new">Select Image</span>
                                            <input type="file" name="photo" id="photo" onchange="imagePreview(photo);" />
                                                @if ($errors->has('photo'))
                                                    <p style="color:#dc3545;font-size:15px;">{{ $errors->first('photo') }}</p>
                                                @endif
                                        </span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
