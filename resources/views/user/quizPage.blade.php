@extends('layouts.main')
@section('title')
    | Quizzes
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
        @endif

        @if ($errors->has('quiz_name'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p>{{ $errors->first('quiz_name') }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif($errors->has('quiz_description'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p>{{ $errors->first('quiz_description') }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{--Breadcrumb--}}
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('training')}}">Trainings</a></li>
                <li class="breadcrumb-item">Quizzes</li>

                {{--<li class="breadcrumb-item active" aria-current="page">Data</li>--}}
            </ol>
        </nav>

        <div class="container-fluid">
            {{--//if Admin--}}
            @if(Auth::user()->level == 0)
                <div class="row">
                    @foreach($quiz as $quizzes)
                        <div class="col-md-4">
                            <div class="card card-chart">
                                <a href="#">
                                    <div class="card-header card-header-rose" style="height: 150px;"></div>
                                </a>
                                <div class="card-body">
                                    <a href="#">
                                        <h4 class="card-title">{{$quizzes->quiz_name}}</h4>
                                    </a>
                                    <p class="card-category">{{substr($quizzes->quiz_description,0,25)."..."}}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> created at : {{$quizzes->created_at}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            {{--If user has not been activated--}}
            @elseif(Auth::user()->level == 1)
                <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#addQuizzes">
                    <i class="material-icons">add</i> Add Quizzes
                </button>
                <div class="row">
                    @foreach($quiz as $quizzes)
                        <div class="col-md-4">
                            <div class="card card-chart">
                                @if($quizzes->difficulty == 'Easy')
                                    <a href="#">
                                        <div class="card-header card-header-success" data-header-animation="true" style="height: 150px;">{{$quizzes->difficulty}}</div>
                                    </a>
                                @elseif($quizzes->difficulty == 'Medium')
                                    <a href="#">
                                        <div class="card-header card-header-warning" data-header-animation="true" style="height: 150px;">{{$quizzes->difficulty}}</div>
                                    </a>
                                @elseif($quizzes->difficulty == 'Hard')
                                    <a href="#">
                                        <div class="card-header card-header-danger" data-header-animation="true" style="height: 150px;">{{$quizzes->difficulty}}</div>
                                    </a>
                                @endif
                                <div class="card-body">
                                    <div class="card-actions">
                                        <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                            <i class="material-icons">build</i> Fix Header!
                                        </button>

                                        <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                                            <i class="material-icons">refresh</i>
                                        </button>
                                        <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                                            <i class="material-icons">edit</i>
                                        </button>
                                    </div>
                                    <a href="#">
                                        <h4 class="card-title">{{$quizzes->quiz_name}}</h4>
                                    </a>
                                    <p class="card-category">{{substr($quizzes->quiz_description,0,25)."..."}}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> created at : {{$quizzes->created_at}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif(Auth::user()->level == 2)
                <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#addQuizzes">
                    <i class="material-icons">add</i> Add Quizzes
                </button>
                <div class="row">
                    @foreach($quiz as $quizzes)
                        <div class="col-md-4">
                            <div class="card card-chart">
                                @if($quizzes->difficulty == 'Easy')
                                    <a href="#">
                                        <div class="card-header card-header-success" data-header-animation="true" style="height: 150px;">{{$quizzes->difficulty}}</div>
                                    </a>
                                @elseif($quizzes->difficulty == 'Medium')
                                    <a href="#">
                                        <div class="card-header card-header-warning" data-header-animation="true" style="height: 150px;">{{$quizzes->difficulty}}</div>
                                    </a>
                                @elseif($quizzes->difficulty == 'Hard')
                                    <a href="#">
                                        <div class="card-header card-header-danger" data-header-animation="true" style="height: 150px;">{{$quizzes->difficulty}}</div>
                                    </a>
                                @endif
                                <div class="card-body">
                                    <a href="#">
                                        <h4 class="card-title">{{$quizzes->quiz_name}}</h4>
                                    </a>
                                    <p class="card-category">{{substr($quizzes->quiz_description,0,40)."..."}}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> created at : {{$quizzes->created_at}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{--Modal Add Quizzes--}}
    <div class="modal fade" id="addQuizzes" tabindex="-1" role="dialog" aria-labelledby="addTrainingLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Quizzes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('addQuizzes',Request::segment(2))}}">
                    @csrf
                    <div class="modal-body">
                        <h3>Quiz</h3>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Quiz Name" name="quiz_name">
                        </div>
                        @if ($errors->has('quiz_name'))
                            <p style="color:#dc3545;font-size:15px;">{{ $errors->first('quiz_name') }}</p>
                        @endif

                        <div class="form-group" style="margin-top: 25px;">
                            <label for="Training Description">Quiz Description</label>
                            <textarea class="form-control" id="Training Description" rows="3" name="quiz_description"></textarea>
                        </div>
                        @if ($errors->has('quiz_description'))
                            <p style="color:#dc3545;font-size:15px;">{{ $errors->first('quiz_description') }}</p>
                        @endif

                        <div class="form-group">
                            <h6 class="card-subtitle mb-2 text-muted">Difficulty</h6>
                            <select id="inputActivity" class="form-control" name="difficulty">
                                <option value="" selected>Choose...</option>
                                <option value="Easy">Easy</option>
                                <option value="Medium">Medium</option>
                                <option value="Hard">Hard</option>
                            </select>
                            @if ($errors->has('difficulty'))
                                <p style="color:#dc3545;font-size:15px;">{{ $errors->first('difficulty') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Quiz Time (Minutes)" name="time">
                        </div>
                        @if ($errors->has('time'))
                            <p style="color:#dc3545;font-size:15px;">{{ $errors->first('time') }}</p>
                        @endif

                        <div class="fileinput fileinput-new thumbnail img-raised text-center col-md-12" data-provides="fileinput">
                            <span class="btn btn-raised btn-round btn-default btn-file">
                                <span class="fileinput-new">Select Question Pdf</span>
                                <input type="file" name="question" id="photo"/>
                                @if ($errors->has('question'))
                                    <p style="color:#dc3545;font-size:15px;">{{ $errors->first('question') }}</p>
                                @endif
                            </span>
                        </div>
                        {{--<div style="text-align: center">--}}
                            {{--<span class="btn btn-raised btn-round btn-default btn-file" style="width: 100%">--}}
                                {{--<span class="fileinput-new">Select Question Pdf</span>--}}
                                {{--<input type="file" name="question" id="photo" />--}}
                                {{--@if ($errors->has('question'))--}}
                                    {{--<p style="color:#dc3545;font-size:15px;">{{ $errors->first('question') }}</p>--}}
                                {{--@endif--}}
                            {{--</span>--}}
                        {{--</div>--}}
                        @if ($errors->has('question'))
                            <p style="color:#dc3545;font-size:15px;">{{ $errors->first('question') }}</p>
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
@endsection