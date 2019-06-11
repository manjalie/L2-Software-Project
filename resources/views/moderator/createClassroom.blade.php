@extends('layouts.moderatorApp')
@section('title')
    Create Classroom
@stop
@section('pageHeader')
    Create new classroom
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('moderator')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('moderator/student/requests')}}">Student Requests </a></li>
        <li class="breadcrumb-item active">Create new classroom </li>
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
            <div class="col-lg-4">
                <label>Classroom details</label>

                        <div class="card p-3">
                            <blockquote class="blockquote mb-0 card-body">

                                <p>
                                    {{$request->subject->name}}
                                </p>
                                <p>
                                   In  {{$request->day}}
                                </p>

                                <small>Start @</small>
                                <br>
                                {{$request->time}}
                                   <br>
                                    <small>End @</small>
                                <form method="POST" action="{{route('moderator/student/requests/createClassroom/create')}}">
                                        @csrf
                                    <input type="text"  id="endTimepicker" class="col-sm-8 form-control form-control-sm" name="endTime" width="276" value="{{( (float) $request->time)+1}}" readonly required/>
                                    <input type="hidden" name="student" value="{{$request->student->id}}">
                                    <input type="hidden" name="lecturer" value="{{$request->approve->lecturer->id}}">
                                    <input type="hidden" name="subject" value="{{$request->subject->id}}">
                                    <input type="hidden" name="day" value="{{$request->day}}">
                                    <input type="hidden" name="startTime" value="{{$request->time}}">
                                    <input type="hidden" name="requestID" value="{{$request->id}}">


                                <p class="offset-lg-4 pt-3">
                                    <input type="submit" value="Create" data-toggle="confirmation" data-title="Create Classroom?" class="btn btn-primary">
                                </p>
                                </form>
                                <footer class="blockquote-footer">
                                    <small class="text-muted">Classroom will be notified to both
                                        {{--<cite title="Source Title">--}}
                                            {{--<a href="https://sandbox.payhere.lk/account/user" target="_blank">View</a>--}}
                                        {{--</cite>--}}
                                    </small>
                                </footer>
                            </blockquote>
                        </div>

            </div>
            <div class="col-lg-4">
                <label>Lecturer Info</label>
                <div class="user-block block text-center">
                    <div class="avatar">
                        <img src="{{asset('Profilepic/'.$request->approve->lecturer->user->avatar)}}" alt="..." class="img-fluid">
                    </div>
                    <a href="#" class="user-title">
                        <h3 class="h5">{{$request->approve->lecturer->user->first_name}}</h3>
                        <span>{{$request->approve->lecturer->user->email}}</span>
                    </a>
                    <div class="contributions">{{$request->subject->name}}</div>
                    <div class="details d-flex">

                    </div>
                </div>
            </div>
        </div>




    </section>




@stop
@section('javaScripts')
    <script>

        //initialise time picker
        $('#endTimepicker').timepicker({
            uiLibrary: 'bootstrap4',
        });


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


        $('#endTimepicker').change(function () {

            let getEndTime = $('#endTimepicker').val();

            getEndTime = parseFloat(getEndTime);


            if (getEndTime< "{{( (float) $request->time)+1}}")
            {
                alert('end time  be more than 1 hour than start time');
                $('#endTimepicker').val("{{( (float) $request->time)+1}}");
            }

        });

    </script>
@stop