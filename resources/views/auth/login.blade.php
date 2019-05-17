@extends('layouts.app')

@section('content')
    <div class="materialContainer">
        <div class="box">
            <div class="title">LOGIN</div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input">
                    <label for="name">Email</label>
                    <input type="email" id="name" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus>
                    <span class="spin"></span>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="input">
                    <label for="pass">Password</label>
                    <input type="password" id="pass" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <span class="spin"></span>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="button login">
                    <button type="submit"><span>GO</span> <i class="fa fa-check"></i></button>
                </div>
                <a href="{{ route('password.request') }}" class="pass-forgot">Forgot your password?</a>
            </form>
        </div>

        {{--//Register--}}
        <div class="overbox">
            <div class="material-button alt-2"><span class="shape"></span></div>
            <div class="title">REGISTER</div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input">
                    <label for="regname">Email</label>
                    <input id="regname" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">
                    <span class="spin"></span>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <div class="input">
                    <label for="regpass">Password</label>
                    <input id="regpass" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    <span class="spin"></span>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <div class="input">
                    <label for="reregpass">Repeat Password</label>
                    <input id="reregpass" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <span class="spin"></span>
                </div>
                <div class="button">
                    <button><span>Register</span></button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
