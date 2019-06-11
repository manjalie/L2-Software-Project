@extends('layouts.adminApp')
@section('title')
   {{$student->user->first_name}}

@stop
@section('pageHeader')
    {{$student->user->first_name}} Profile
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('moderator')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin/student/allProfiles')}}"> Student  Profiles</a></li>
        <li class="breadcrumb-item active"> {{$student->user->first_name}} </li>
    </ul>
@stop
@section('content')
    <section class="no-padding-top">
        <div class="row">
            <div class="col-lg-4 ">

                <div class="card card-profile ">
                    <div style="background-image: url(../../../../../template/img/photos/learning_back.jpg);" class="card-header"></div>
                    <div class="card-body text-center">
                        <img src="{{asset('Profilepic/'.$student->user->avatar)}}" class="card-profile-img">
                        <h4 class="mb-3 text-gray-light">{{$student->user->first_name}}</h4>
                        <p class="mb-4">Student Since {{$student->user->created_at}} </p>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item ">
                            <i class="fa fa-envelope"></i> &nbsp;&nbsp;
                            {{$student->user->email}}
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-phone"></i>&nbsp;&nbsp;
                            {{$student->mobile_no}}
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-address-card"></i>&nbsp;&nbsp;
                            {{$student->address}}
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-location-arrow"></i>&nbsp;&nbsp;
                            {{$student->city}}
                        </li>
                    </ul>

                    <div class="card-body">
                        <div class="card-link">
                            @if ($student->user->status == 'blocked')
                                <a href="{{route('admin/student/allProfiles/unblock/',$student->id)}}" data-toggle="confirmation" data-title="Unblock user?">Unblock</a>
                            @else
                                <a href="{{route('admin/student/allProfiles/block/',$student->id)}}" data-toggle="confirmation" data-title="Block user?">Block</a>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-lg-8  col-md-8">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Classrooms</h4>
                             </div>
                            <div class="card-body">
                                 <table class="table">
                                    <th>Subject</th>
                                    <th>Day</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Status</th>
                                    <th>Students</th>

                                    @foreach($classrooms as $classroom)
                                    <tr>
                                        <td>{{$classroom->subject->name}}</td>
                                        <td>{{$classroom->day}}</td>
                                        <td>{{\Carbon\Carbon::parse($classroom->started_at)->format('g:i A')}}</td>
                                        <td>{{\Carbon\Carbon::parse($classroom->end_at)->format('g:i A')}}</td>
                                        <td>{{$classroom->status}}</td>
                                        <td>
                                             @if (count($classroom->class_room_has_student) == 0)
                                                  No Students
                                             @else
                                                    {{count($classroom->class_room_has_student)}}
                                             @endif
                                        </td>
                                     </tr>
                                    @endforeach
                                 </table>
                             </div>
                        </div>
                    </div>

                    {{-------------------pending requests---------------------}}

                    <div class="col-lg-12  col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pending Requests</h4>
                        </div>
                            <div class="card-body">
                                <table class="table">
                                    <th>Subject</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Rquested</th>

                                 @foreach($requests as $request)
                                    <tr>
                                        <td>{{$request->subject->name}}</td>
                                        <td>{{$request->day}}</td>
                                        <td>{{\Carbon\Carbon::parse($request->time)->format('g:i A')}}</td>
                                        <td>{{\Carbon\Carbon::parse($request->created_at)->format('Y-m-d')}}</td>
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                     </div>
                </div>
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