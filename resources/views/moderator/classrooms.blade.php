@extends('layouts.moderatorApp')
@section('title')
   Classrooms
@stop
@section('pageHeader')
    Classrooms
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('moderator')}}">Home</a></li>
        <li class="breadcrumb-item active"> Classrooms</li>
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
                            <th >Lecturer</th>
                            <th >Subject</th>
                            <th >Students</th>
                            <th >Day</th>
                            <th >Start Time</th>
                            <th >End Time</th>
                            <th>Created</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($classrooms as $classroom)
                            <tr role="row" class="odd">
                                <td class="sorting_1">
                                    <a href="{{route('moderator/lecturer/allProfiles/view/',$classroom->lecturer->id)}}">{{$classroom->lecturer->user->first_name}}</a>
                                </td>
                                <td>{{$classroom->subject->name}}</td>
                                <td>
                                    @if (count($classroom->class_room_has_student)==0)
                                    No students
                                    @else
                                        <a href="{{route('moderator/classroom/profiles/',$classroom->id)}}">
                                            {{count($classroom->class_room_has_student)}}
                                        </a>
                                    @endif
                                </td>
                                <td>{{$classroom->day}}</td>
                                <td>{{\Carbon\Carbon::parse($classroom->started_at)->format('g:i A')}}</td>
                                <td>{{\Carbon\Carbon::parse($classroom->end_at)->format('g:i A')}}</td>
                                <td>{{\Carbon\Carbon::parse($classroom->created_at)->format('Y-m-d')}}</td>
                                <td>{{$classroom->status}}</td>
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