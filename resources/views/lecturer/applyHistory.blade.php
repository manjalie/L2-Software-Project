@extends('layouts.lecturerApp')
@section('title')
    History
@stop
@section('pageHeader')
   Subject Apply History
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('lecturer')}}">Home</a></li>
        <li class="breadcrumb-item active"> Subject Apply History </li>
    </ul>
@stop
@section('content')
    <div class="block">
        <div class="block-body">
            <div class="">
                <div id="historyTable" class="dataTables_wrapper dt-bootstrap4 ">
                    <table id="applyHistoryTable" class="table dataTable no-footer"  aria-describedby="datatable1_info">
                        <thead>
                        <tr role="row">
                            <th >Subject</th>
                            <th >Day</th>
                            <th >Start Time</th>
                            <th >End Time</th>
                            <th>Request @</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr role="row" class="odd">
                                <td class="sorting_1">{{$request->subject->name}}</td>
                                <td>{{$request->day}}</td>
                                <td>{{\Carbon\Carbon::parse($request->start_time)->format('g:i A')}}</td>
                                <td>{{\Carbon\Carbon::parse($request->end_time)->format('g:i A')}}</td>
                                <td>{{\Carbon\Carbon::parse($request->created_at)->format('Y-m-d')}}</td>
                                <td>
                                    @if ($request->approved_at == null)
                                        <a class="btn btn-sm btn-outline-danger" data-toggle="confirmation" data-title="Cancel Request?" href="{{route('lecturer/requestHistory/delete/',$request->id)}}" >Cancel</a>
                                    @else
                                        <a class="btn btn-sm btn-outline-success" href="{{route('lecturer/classrooms/requests')}}" >Requests</a>
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
            $('#applyHistoryTable').DataTable();
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