@extends('layouts.moderatorApp')
@section('title')
    Payments
@stop
@section('pageHeader')
    {{$request->student->user->first_name}} Payment request
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('moderator')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('moderator/student/requests')}}">Student Requests </a></li>
        <li class="breadcrumb-item active"> {{$request->student->user->first_name}} Payment request </li>
    </ul>
@stop
@section('content')
    <section class="no-padding-top">
        <div class="row">

            <div class="col-lg-4">
                <label>Student Info</label>
                <div class="user-block block text-center">
                    <div class="avatar">
                        <img src="{{asset('Profilepic/'.$request->student->user->avatar)}}" alt="..." class="img-fluid">
                    </div>
                    <a href="#" class="user-title">
                        <h3 class="h5">{{$request->student->user->first_name}}</h3>
                        <span>{{$request->student->user->email}}</span>
                    </a>
                    <div class="contributions">{{$request->subject->name}}</div>
                    <div class="details d-flex">

                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-2 offset-md-2  col-md-6">
                <label>Payment Info</label>

                        <div class="card p-3">
                            <blockquote class="blockquote mb-0 card-body">
                                <form method="post" class="form-validate" action="{{route('moderator/student/requests/askPayment/send')}}">
                                    @csrf
                                    <input type="hidden" name="request_id" value="{{$request->id}}">
                                <p>
                                    <small>Subject Cost {{$request->subject->price}}</small>
                                </p>

                                    <small>Requesting</small>
                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <input type="text" name="amount" value="{{$request->subject->price}}" required class="form-control">
                                </div>

                                <p class="offset-lg-10">
                                    <input type="submit" value="Request" class="btn btn-primary">
                                </p>
                                </form>
                                <footer class="blockquote-footer">
                                    <small class="text-muted">Payment will continue through pay here Account
                                        <cite title="Source Title">
                                            <a href="https://sandbox.payhere.lk/account/user" target="_blank">View</a>
                                        </cite>
                                    </small>
                                </footer>
                            </blockquote>
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


        $("input[name='amount']").TouchSpin({
            min: '{{$request->subject->price}}',
            max: 15000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: 'RS'
        });

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