@extends('layouts.app')

@section('content')
    <div class="materialContainer">
        <div class="box">
            <div class="title">Forgot Password</div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="input">
                                <label for="name">Email</label>
                                <input id="name" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <span class="spin"></span>
                            </div>
                            <div class="col-md-6">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <div class="button login">
                                    <button type="submit"><span>Send Reset Link</span> <i class="fa fa-check"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="button login">
                        <a href="{{url('/')}}">
                            <button type="submit"><span>Home</span> <i class="fa fa-home"></i></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
@endsection
