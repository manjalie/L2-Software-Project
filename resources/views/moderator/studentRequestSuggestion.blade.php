@extends('layouts.moderatorApp')
@section('title')
   Suggestion

@stop
@section('pageHeader')
    {{$student->user->first_name}} Requests' Suggestion
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('moderator')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('moderator/student/requests')}}">Student Requests </a></li>
        <li class="breadcrumb-item active"> {{$student->user->first_name}} Request Suggestion </li>
    </ul>
@stop
@section('content')
    <section class="no-padding-top">
        <div class="row">

                <div class="col-lg-4">
                    <div class="user-block block text-center">
                        <div class="avatar">
                            <img src="{{asset('Profilepic/'.$student->user->avatar)}}" alt="..." class="img-fluid">
                        </div>
                        <a href="#" class="user-title">
                            <h3 class="h5">{{$student->user->first_name}}</h3>
                            <span>{{$student->user->email}}</span>
                        </a>
                        <div class="contributions">{{$subject->name}}</div>
                        <div class="details d-flex">

                        </div>
                    </div>
                </div>
            <div class="col-lg-8  col-md-8">
                <label>Top Suggestions</label>
                <div class="row">
                @foreach ($top_lec as $lec)
                    <div class="card p-3">
                        <blockquote class="blockquote mb-0 card-body">
                            <p>Prof {{$lec->lecturer->user->first_name}}</p>
                            <p>From {{\Carbon\Carbon::parse($lec->start_time)->format('g:i A')}} &nbsp;&nbsp;&nbsp;&nbsp; To {{\Carbon\Carbon::parse($lec->end_time)->format('g:i A')}}</p>
                            <p><a class="btn btn-primary" data-toggle="confirmation" data-title="Hire Lecturer?" href="{{route('moderator/student/requests/respondRequest/',[$request->id,$lec->lecturer->id])}}">Hire</a></p>
                            <footer class="blockquote-footer">
                                <small class="text-muted">Lecturer Since {{\Carbon\Carbon::parse($lec->lecturer->user->created_at)->format('Y-m-d')}}
                                    <cite title="Source Title">
                                        <a href="{{route('moderator/lecturer/allProfiles/view/',$lec->lecturer->id)}}" target="_blank">View</a>
                                    </cite>
                                </small>
                            </footer>
                        </blockquote>
                    </div>
                @endforeach
                </div>
                @if (count($top_lec) ==0)
                    <h2 class="text-sm-center">No Result Available</h2>
                @endif
            </div>
        </div>

        <div class="container">
            @if (count($approved_lec) >0)
            <label>Matching with Subject</label>
            <div class="row">
            @foreach ($approved_lec as $lec)
            <div class="card p-3">
                <blockquote class="blockquote mb-0 card-body">
                    <p>Prof {{$lec->lecturer->user->first_name}}</p>
                    <p>From {{\Carbon\Carbon::parse($lec->start_time)->format('g:i A')}} &nbsp;&nbsp;&nbsp;&nbsp; To {{\Carbon\Carbon::parse($lec->end_time)->format('g:i A')}}</p>
                    <p><a class="btn btn-primary" data-toggle="confirmation" data-title="Hire Lecturer?" href="{{route('moderator/student/requests/respondRequest/',[$request->id,$lec->lecturer->id])}}">Hire</a></p>
                    <footer class="blockquote-footer">
                        <small class="text-muted">Lecturer Since {{\Carbon\Carbon::parse($lec->lecturer->user->created_at)->format('Y-m-d')}}
                            <cite title="Source Title">
                                <a href="{{route('moderator/lecturer/allProfiles/view/',$lec->lecturer->id)}}" target="_blank">View</a>
                            </cite>
                        </small>
                    </footer>
                </blockquote>
            </div>
            @endforeach
            </div>


            @endif
        </div>

        <div class="container">
            @if (count($non_approved_lec) >0)
            <label>Un-Approved Lecturers (if you select this,lecturer request will be automatically assigned as approved)</label>
            <div class="row">
            @foreach ($non_approved_lec as $lec)
            <div class="card p-3">
                <blockquote class="blockquote mb-0 card-body">
                    <p>Prof {{$lec->lecturer->user->first_name}}</p>
                    <p>From {{\Carbon\Carbon::parse($lec->start_time)->format('g:i A')}} &nbsp;&nbsp;&nbsp;&nbsp; To {{\Carbon\Carbon::parse($lec->end_time)->format('g:i A')}}</p>
                    <p><a class="btn btn-primary" data-toggle="confirmation" data-title="Hire Lecturer?" href="{{route('moderator/student/requests/respondRequest/',[$request->id,$lec->lecturer->id])}}">Hire</a></p>
                    <footer class="blockquote-footer">
                        <small class="text-muted">Lecturer Since {{\Carbon\Carbon::parse($lec->lecturer->user->created_at)->format('Y-m-d')}}
                            <cite title="Source Title">
                                <a href="{{route('moderator/lecturer/allProfiles/view/',$lec->lecturer->id)}}" target="_blank">View</a>
                            </cite>
                        </small>
                    </footer>
                </blockquote>
            </div>
            @endforeach
        </div>


            @endif
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