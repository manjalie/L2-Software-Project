@extends('layouts.authApp')

@section('content')


<div class="login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <div class="content">
                            <div class="logo">
                                <h1>Learning After 6</h1>
                            </div>
                            <p>Learning after 6 is an educational website that searching for new courses for part time students</p>
                        </div>
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <form method="POST" action="{{ route('login')}}" class="form-validate">
                                @csrf
                                <div class="form-group">
                                    <input id="login-username" type="text" name="email" required data-msg="Please enter your username" class="input-material {{ $errors->has('email') ? ' is-invalid' : '' }}"  value="{{ old('email') }}">
                                    <label for="login-username" class="label-material">Email</label>
                                </div>
                                <div class="form-group">
                                    <input id="login-password" type="password" name="password" required data-msg="Please enter your password" class="input-material{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                    <label for="login-password" class="label-material">Password</label>
                                </div>
                                <div class="form-group">
                                <input   type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}  class="checkbox-template">
                                <label for="login-remember">Remember Me</label>
                                </div>
                                <input id="login" type="submit" class="btn btn-primary" value="Login">
                            </form>
                            <a href="{{ route('password.request') }}" class="forgot-pass">Forgot Password?</a>
                            <br>
                            <br>
                            <small>Do not have an account? </small>
                            <br>
                            <br>
                            <a href="{{ route('register') }}" class="signup">Signup as student</a>
                            <br>
                            <a href="{{ route('register/lecturer') }}" class="signup">Signup as lecturer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javaScripts')
    <script>
        @if ($errors->has('email'))
            Messenger.options=
            {
                extraClasses:"messenger-fixed messenger-on-top  messenger-on-right",
                theme:"flat",
                messageDefaults:{showCloseButton:!0}
            },
            Messenger().post({message:"{{ $errors->first('email') }}",
                type:"error"});
        @endif

        @if ($errors->has('password'))
            Messenger.options=
            {
                extraClasses:"messenger-fixed messenger-on-top  messenger-on-right",
                theme:"flat",
                messageDefaults:{showCloseButton:!0}
            },
            Messenger().post({message:"{{ $errors->first('password') }}",
                type:"error"});
        @endif

    </script>
@stop