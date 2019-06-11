@extends('layouts.moderatorApp')
@section('title')
   Lecturer
@stop
@section('pageHeader')
    Student  Requests
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('moderator')}}">Home</a></li>
        <li class="breadcrumb-item active">  Student  Requests </li>
    </ul>
@stop
@section('content')

    <div class="block">
        <div class="block-body">
            <div class="">
                <div id="classroom" class="dataTables_wrapper dt-bootstrap4 ">
                    <table id="lecturerTable" class="table dataTable no-footer"  aria-describedby="datatable1_info">
                        <thead>
                        <tr role="row">
                            <th >Student</th>
                            <th >Subject</th>
                            <th >Day</th>
                            <th >Time</th>
                            <th >Payment</th>
                            <th>Approved @</th>
                            <th>Suggestion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr role="row" class="odd">
                                <td class="sorting_1">
                                    <a href="#">{{$request->student->user->first_name}}</a>
                                </td>
                                <td>{{$request->subject->name}}</td>
                                <td>{{$request->day}}</td>
                                <td>{{\Carbon\Carbon::parse($request->time)->format('g:i A')}}</td>
                                <td>
                                    @if ($request->payment)
                                        {{$request->payment->status}}
                                     @elseif ($request->approve && $request->approve->moderator_approved_at !==null && $request->approve->lecturer_approved_at !==null)
                                        <a class="btn btn-outline-info" href="{{route('moderator/student/requests/askPayment/',$request->id)}}">Ask</a>
                                     @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if ($request->approve && $request->approve->moderator_approved_at ==null)
                                        N/A
                                    @elseif ($request->approve && $request->approve->moderator_approved_at !==null)
                                        {{\Carbon\Carbon::parse($request->approve->moderator_approved_at)->format('Y-m-d')}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if (!$request->approve)
                                        <a class="btn btn-sm btn-outline-info" href="{{route('moderator/student/requests/suggestion/',$request->id)}}" >Check</a>
                                    @elseif ($request->approve && $request->approve &&$request->approve->moderator_approved_at !==null && $request->approve->lecturer_approved_at ==null)
                                        <a class="btn btn-sm btn-outline-info" href="{{route('moderator/student/requests/suggestion/',$request->id)}}" >Update</a>
                                    @elseif ($request->approve && $request->approve &&$request->approve->moderator_approved_at !==null && $request->approve->lecturer_approved_at !==null)
                                        @if ($request->payment && $request->payment->status=='payed' && $request->classroom_added_at == null )
                                        <a class="btn btn-sm btn-outline-success" href="{{route('moderator/student/requests/createClassroom/',$request->id)}}" >Create Classroom</a>
                                         @elseif ($request->classroom_added_at !== null)
                                            <a class="btn btn-sm btn-outline-success" href="{{route('moderator/student/requests/createClassroom/',$request->id)}}" >View Classroom</a>
                                         @else
                                            Pay first
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javaScripts')
    <script>

        $(document).ready(function(){
            $('#lecturerTable').DataTable();
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