@extends('layouts.lecturerApp')
@section('title')
    Requests
@stop
@section('pageHeader')
    Class Requests
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('lecturer')}}">Home</a></li>
        <li class="breadcrumb-item active">  Class Requests </li>
    </ul>
@stop
@section('content')




    <div class="block">
        <div class="block-body">
            <div class="">
                <div id="classroom" class="dataTables_wrapper dt-bootstrap4 ">
                    <table id="classroomTable" class="table dataTable no-footer"  aria-describedby="datatable1_info">
                        <thead>
                        <tr role="row">
                            <th >Subject</th>
                            <th >Day</th>
                            <th >Time</th>
                            <th>Request @</th>
                            <th>Approval</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr role="row" class="odd">
                                <td class="sorting_1">{{$request->student_class_request->subject->name}}</td>
                                <td>{{$request->student_class_request->day}}</td>
                                <td>{{\Carbon\Carbon::parse($request->student_class_request->time)->format('g:i A')}}</td>
                                <td>{{\Carbon\Carbon::parse($request->created_at)->format('Y-m-d')}}</td>
                                <td>
                                    @if ($request->lecturer_approved_at !== null )
                                        Approved
                                    @else
                                        <a class="btn btn-sm btn-outline-info" data-toggle="confirmation" data-title="Accept Request?" href="{{route('lecturer/classrooms/requests/accept/',$request->id)}}" >Accept</a>
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
            $('#classroomTable').DataTable();
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