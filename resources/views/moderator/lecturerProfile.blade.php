@extends('layouts.moderatorApp')
@section('title')
   {{$lecturer->user->first_name}}

@stop
@section('pageHeader')
    {{$lecturer->user->first_name}} Profile
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('moderator')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('moderator/lecturer/allProfiles')}}"> Lecturer  Profiles</a></li>
        <li class="breadcrumb-item active"> {{$lecturer->user->first_name}} </li>
    </ul>
@stop
@section('content')
    <section class="no-padding-top">
        <div class="row">
            <div class="col-lg-4 ">

                <div class="card card-profile ">
                    <div style="background-image: url(../../../../../template/img/photos/learning_back.jpg);" class="card-header"></div>
                    <div class="card-body text-center">
                        <img src="{{asset('Profilepic/'.$lecturer->user->avatar)}}" class="card-profile-img">
                        <h4 class="mb-3 text-gray-light">{{$lecturer->user->first_name}}</h4>
                        <p class="mb-4">Lecturer Since {{$lecturer->user->created_at}} </p>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item ">
                            <i class="fa fa-envelope"></i> &nbsp;&nbsp;
                            {{$lecturer->user->email}}
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-phone"></i>&nbsp;&nbsp;
                            {{$lecturer->mobile_no}}
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-address-card"></i>&nbsp;&nbsp;
                            {{$lecturer->address}}
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-location-arrow"></i>&nbsp;&nbsp;
                            {{$lecturer->city}}
                        </li>
                    </ul>

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
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Rquested</th>

                                 @foreach($requests as $request)
                                    <tr>
                                        <td>{{$request->subject->name}}</td>
                                        <td>{{$request->day}}</td>
                                        <td>{{\Carbon\Carbon::parse($request->start_time)->format('g:i A')}}</td>
                                        <td>{{\Carbon\Carbon::parse($request->end_time)->format('g:i A')}}</td>
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