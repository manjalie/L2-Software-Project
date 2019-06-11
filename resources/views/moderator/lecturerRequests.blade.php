@extends('layouts.moderatorApp')
@section('title')
   Lecturer
@stop
@section('pageHeader')
    Lecturer  Requests
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('moderator')}}">Home</a></li>
        <li class="breadcrumb-item active">  Lecturer  Requests </li>
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
                            <th >Day</th>
                            <th >Start Time</th>
                            <th >End Time</th>
                            <th>Request @</th>
                            <th>Approved @</th>
                            <th>Approval</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr role="row" class="odd">
                                <td class="sorting_1">
                                    <a href="{{route('moderator/lecturer/allProfiles/view/',$request->lecturer->id)}}">{{$request->lecturer->user->first_name}}</a>
                                </td>
                                <td>{{$request->subject->name}}</td>
                                <td>{{$request->day}}</td>
                                <td>{{\Carbon\Carbon::parse($request->start_time)->format('g:i A')}}</td>
                                <td>{{\Carbon\Carbon::parse($request->end_time)->format('g:i A')}}</td>
                                <td>{{\Carbon\Carbon::parse($request->created_at)->format('Y-m-d')}}</td>
                                <td>{{\Carbon\Carbon::parse($request->approved_at)->format('Y-m-d')}}</td>
                                <td>
                                    @if ($request->approved_at !== null )
                                        <a class="btn btn-sm btn-outline-danger" data-toggle="confirmation" data-title="Cancel Request?" href="{{route('moderator/lecturer/requests/cancel/',$request->id)}}" >Cancel</a>
                                    @else
                                        <a class="btn btn-sm btn-outline-info" href="{{route('moderator/lecturer/requests/accept/',$request->id)}}" >Accept</a>
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