@extends('layouts.main')
@section('title')
    | Quiz Questions
@endsection
@section('content')
    <div class="content">
        @if(Auth::user()->level == 1)
        @foreach($question as $questions)
        <div class="col-md-6">
            <object width="100%" height="100%" data="{{asset('questions/'.$questions->question)}}"></object>
        </div>

        <div class="col-md-6">

        </div>
        @endforeach
        @endif
    </div>
@endsection