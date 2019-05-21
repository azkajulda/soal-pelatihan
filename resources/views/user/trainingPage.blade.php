@extends('layouts.main')
@section('title')
    | Training
@endsection
@section('content')
    <div class="content">
        {{--Notifications--}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('alert'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('alert')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('delete'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('delete')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->has('training_name'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p>{{ $errors->first('training_name') }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif($errors->has('training_description'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p>{{ $errors->first('training_description') }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{--Breadcrumb--}}
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Trainings</li>
                {{--<li class="breadcrumb-item"><a href="#">Library</a></li>--}}
                {{--<li class="breadcrumb-item active" aria-current="page">Data</li>--}}
            </ol>
        </nav>

        <div class="container-fluid">
            {{--//if Admin--}}
            @if(Auth::user()->level == 1)
                <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#addTraining">
                    <i class="material-icons">add</i> Add Training
                </button>
                <div class="row">
                    @foreach($training as $trainings)
                        <div class="col-md-4">
                            <div class="card card-chart">
                                <a href="{{route('quiz',$trainings->id)}}">
                                    <div class="card-header card-header-rose" data-header-animation="true"
                                         style="height: 150px;"></div>
                                </a>
                                <div class="card-body">
                                    <div class="card-actions">
                                        <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                            <i class="material-icons">build</i> Fix Header!
                                        </button>
                                        <a href="{{route('deleteTraining',$trainings->id)}}">
                                            <button type="button" class="btn btn-info btn-link" rel="tooltip"
                                                    data-placement="bottom" title="Delete">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </a>

                                        <button type="button" class="btn btn-default btn-link" rel="tooltip"
                                                data-placement="bottom" title="Update" data-toggle="modal"
                                                data-target="#editTraining_{{$trainings->id}}">
                                            <i class="material-icons">edit</i>
                                        </button>

                                    </div>
                                    <a href="#">
                                        <h4 class="card-title">{{$trainings->training_name}}</h4>
                                    </a>
                                    <p class="card-category">{{substr($trainings->training_description,0,25)."..."}}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> created at
                                        : {{$trainings->created_at}}&nbsp;
                                        <i class="material-icons">library_books</i> Quiz : {{$trainings->quizzes_count}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{--If user--}}
            @elseif(Auth::user()->level == 0)
                <div class="row">
                    @foreach($training as $trainings)
                        <div class="col-md-4">
                            <div class="card card-chart">
                                <a href="{{route('quiz',$trainings->id)}}">
                                    <div class="card-header card-header-rose" style="height: 150px;"></div>
                                </a>
                                <div class="card-body">
                                    <a href="#">
                                        <h4 class="card-title">{{$trainings->training_name}}</h4>
                                    </a>
                                    <p class="card-category">{{substr($trainings->training_description,0,25)."..."}}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> created at
                                        : {{$trainings->created_at}}&nbsp;
                                        <i class="material-icons">library_books</i> Quiz : {{$trainings->quizzes_count}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>


    {{--Modal Add Training--}}
    <div class="modal fade" id="addTraining" tabindex="-1" role="dialog" aria-labelledby="addTrainingLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Training</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('addTraining')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Training Name" name="training_name">
                        </div>
                        @if ($errors->has('training_name'))
                            <p style="color:#dc3545;font-size:15px;">{{ $errors->first('training_name') }}</p>
                        @endif
                        <div class="form-group" style="margin-top: 25px;">
                            <label for="Training Description">Training Description</label>
                            <textarea class="form-control" id="Training Description" rows="3"
                                      name="training_description"></textarea>
                        </div>
                        @if ($errors->has('training_description'))
                            <p style="color:#dc3545;font-size:15px;">{{ $errors->first('training_description') }}</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($training as $trainings)
    {{--Modal Edit Training--}}
    <div class="modal fade" id="editTraining_{{$trainings->id}}" tabindex="-1" role="dialog" aria-labelledby="addTrainingLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Training</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('updateTraining',$trainings->id)}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Training Name" name="training_name">
                        </div>
                        @if ($errors->has('training_name'))
                            <p style="color:#dc3545;font-size:15px;">{{ $errors->first('training_name') }}</p>
                        @endif
                        <div class="form-group" style="margin-top: 25px;">
                            <label for="Training Description">Training Description</label>
                            <textarea class="form-control" id="Training Description" rows="3"
                                      name="training_description"></textarea>
                        </div>
                        @if ($errors->has('training_description'))
                            <p style="color:#dc3545;font-size:15px;">{{ $errors->first('training_description') }}</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

@endsection