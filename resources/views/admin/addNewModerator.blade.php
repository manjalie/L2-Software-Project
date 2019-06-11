@extends('layouts.adminApp')
@section('title')
   New Moderator

@stop
@section('pageHeader')
    Create New Moderator
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
        <li class="breadcrumb-item active"> Create New Moderator </li>
    </ul>
@stop
@section('content')
    <section class="no-padding-top">
        <div class="col-lg-8 offset-lg-2">

            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Add New Moderator</h4>
                </div>
                <div class="container-fluid">
                    <form class="text-left form-validate"  method="POST" action="{{route('admin/moderator/addNew/add')}}">
                        @csrf
                        <input type="hidden" name="role" value="moderator">
                        <div class="row">
                        <div class="form-group-material col-lg-6 col-sm-12">
                            <label>First Name</label>
                            <input id="register-firstname" type="text"  required data-msg="Please enter your first name" class="form-control"  name="firstname" value="{{ old('firstname') }}"  autofocus>
                        </div>
                        <div class="form-group-material col-lg-6 col-sm-12">
                            <label >Last Name</label>
                            <input id="register-lastname" type="text"  required data-msg="Please enter your last name" class="form-control"  name="lastname" value="{{ old('lastname') }}"  autofocus>
                        </div>
                        </div>
                        <div class="form-group-material">
                            <label >Email Address      </label>
                            <input id="register-email" type="email"  data-msg="Please enter a valid email address" required class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="row">
                        <div class="form-group-material col-lg-6 col-sm-12">
                            <label >Password        </label>
                            <input id="register-password" type="password" name="password" required data-msg="Please enter your password" class="form-control ">
                        </div>
                        <div class="form-group-material col-lg-6 col-sm-12">
                            <label for="register-password" >Confirm Password        </label>
                            <input id="register-password" type="password" name="password_confirmation" required data-msg="Please confirm your password" class="form-control ">
                        </div>
                        </div>
                        <div class="form-group text-center">
                            <input id="register" type="submit" value="Create" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>




@stop
@section('javaScripts')
    <script>

        /**
         * notifications
         * getting error from session
         * getting success from session
         * if exists show using bootstrap notify
         */
        @if(\Session::has('success'))

            Messenger.options=
            {
                extraClasses:"messenger-fixed messenger-on-top  messenger-on-right",
                theme:"flat",
                messageDefaults:{showCloseButton:!0}
            },
            Messenger().post({message:"{{Session::get('success')}}",
                type:"success"});
        @elseif(\Session::has('error'))

            Messenger.options=
            {
                extraClasses:"messenger-fixed messenger-on-top  messenger-on-right",
                theme:"flat",
                messageDefaults:{showCloseButton:!0}
            },
            Messenger().post({message:"{{Session::get('error')}}",
                type:"error"});
        @endif

    </script>
@stop