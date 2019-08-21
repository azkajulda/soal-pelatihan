@extends('layouts.main')
@section('title')
    | Quiz Questions
@endsection
<style>
    html, body{
        height: 100%;
        min-height: 100%;
    }

    .card-body{
        vertical-align: middle;
        display: block;
        height: 600px;
        overflow-y: scroll;
    }

    .card .form-check {
        margin-right: 20px;
    }

</style>
@section('content')
    <div class="content">
        {{--Breadcrumb--}}
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('training')}}">Trainings</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Quizzes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Question</li>
            </ol>
        </nav>

        <div class="row">
            @foreach($question as $questions)
            <div class="col-md-7">
                <object width="100%" height="720px" data="{{asset('questions/'.$questions->question)}}"></object>
            </div>
            @endforeach

            @if(Auth::user()->level == 1)
            <div class="col-md-5">
                <div class="card">
                    @foreach($quiz as $quizzes)
                    <div class="card-header card-header-tabs card-header-primary">
                        <h4>Kunci Jawaban Quiz : <u>{{$quizzes->quiz_name}}</u></h4>
                    </div>
                    @endforeach
                    @foreach($question as $questions)
                    <form action="{{route('addAnswersKeys',$questions->id)}}" method="POST">
                    @endforeach
            @elseif(Auth::user()->level == 2)
            <div class="col-md-5">
                <div class="card">
                    @foreach($quiz as $quizzes)
                    <div class="card-header card-header-tabs card-header-primary">
                        <h4>Lembar Jawaban Quiz : <u>{{$quizzes->quiz_name}}</u></h4>
                    </div>
                    @endforeach
                    <form action="" method="">
            @endif
                    @csrf
                    @if (count($errors) > 0)
                        <h6 style="color:#dc3545;font-size:15px;" class="text-center"><strong>Apakah Anda Yakin!</strong> Tolong isikan nomor yang masih kosong walaupun masih ragu-ragu</h6>
                    @endif

                    <div class="card-body">
                        @foreach($question as $questions)
                        @for($i=1; $i <= $questions->number_of_question; $i++)
                        <div class="col-md-12">
                            <div class="form-check form-check-radio form-check-inline">
                                <label class="form-check-label">
                                    {{$i}}.
                                </label>
                            </div>
                            <div class="form-check form-check-radio form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="answer[{{$i}}]" id="inlineRadio1" value="A"> A
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check form-check-radio form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="answer[{{$i}}]" id="inlineRadio2" value="B"> B
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check form-check-radio form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="answer[{{$i}}]" id="inlineRadio3" value="C"> C
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check form-check-radio form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="answer[{{$i}}]" id="inlineRadio4" value="D"> D
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        @endfor
                        @endforeach
                    </div>
                    <center>
                        <button class="btn btn-success" type="submit">Submit</button>
                    </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection