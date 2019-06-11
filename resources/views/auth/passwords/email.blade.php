@extends('layouts.authApp')

@section('content')
    <div class="login-page">
        <div class="container d-flex align-items-center">
            <div class="form-holder has-shadow">
                <div class="row">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8 mt-5 pt-5">
                                <div class="card">
                                    <div class="card-header">{{ __('Reset Password') }}</div>

                                        <div class="card-body">
                                        @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                        @endif

                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf

                                    <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Send Password Reset Link') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                                    <div class="card-footer">
                                        <div class="card-link">
                                            <a href="{{route('/')}}" class="btn btn primary">Go Home</a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
