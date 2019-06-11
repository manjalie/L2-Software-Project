@extends('layouts.moderatorApp')
@section('title')
    New Course

@stop
@section('pageHeader')
    Add New Course
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('moderator')}}">Home</a></li>
        <li class="breadcrumb-item active"> Add New Course </li>
    </ul>
@stop
@section('content')
    <section class="no-padding-top">
    <div class="row">
        <div class="col-lg-8 offset-md-2 offset-lg-2 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create New Cource</h4>
                </div>
                    <div class="form  ">
                        <div class="content">
                            <form class="text-left form-validate"  method="POST" action="{{route('moderator/course/addNew/add')}}">
                                <div class="card-body">
                                @csrf
                                <div class="row">

                                    {{-------------------Name---------------------------------------}}
                                    <div class="form-group-material col-md-6 col-sm-12 col-lg-6">
                                        <label>Name</label>
                                        <input id="register-firstname" type="text"  required data-msg="Please enter course name" class="form-control"  name="name" value="{{ old('name')  }}"  autofocus>
                                        <small class="help-block-none">e.g English (Name must be unique)</small>
                                    </div>
                                    {{-------------------Duration---------------------------------------}}
                                    <div class="form-group-material col-md-6 col-sm-12 col-lg-6">
                                        <label  >Duration</label>
                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                            <input type="text" name="duration" value="15" data-msg="Please enter course duration" required class="form-control">
                                        </div>
                                        <small class="help-block-none">e.g Hrs .6 (enter hours)</small>
                                    </div>

                                    {{-------------------Price---------------------------------------}}
                                    <div class="form-group-material col-md-6 col-sm-12 col-lg-6">
                                        <label>Course Price</label>
                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                            <input type="text" name="price" value="1000" data-msg="Please enter course price" required class="form-control">
                                        </div>
                                        <small class="help-block-none">e.g Rs.1000 (max : Rs.15000/=)</small>
                                    </div>

                                </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-group text-center">
                                        <input id="register" type="submit" value="Create" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
    </section>

@stop
@section('javaScripts')
    <script>

        $("input[name='duration']").TouchSpin({
            min: 12,
            max: 1500,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: 'Hrs'
        });

        $("input[name='price']").TouchSpin({
            min: 1000,
            max: 15000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: 'Rs'
        });

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