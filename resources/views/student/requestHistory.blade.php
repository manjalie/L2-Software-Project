@extends('layouts.studentApp')
@section('title')
    Requests
@stop
@section('pageHeader')
    Pending Requests
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('student')}}">Home</a></li>
        <li class="breadcrumb-item active">  Pending Requests </li>
    </ul>
@stop
@section('content')



    <div class="block">
        <div class="block-body">
            <div class="">
                <div id="classroomTable" class="dataTables_wrapper dt-bootstrap4 ">
                    <table id="datatable1" class="table dataTable no-footer"  aria-describedby="datatable1_info">
                        <thead>
                        <tr role="row">
                            <th >Subject</th>
                            <th >Day</th>
                            <th >Time</th>
                            <th>Request @</th>
                            <th>Request</th>
                            <th>Payment</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr role="row" class="odd">
                                <td class="sorting_1">{{$request->subject->name}}</td>
                                <td>{{$request->day}}</td>
                                <td>{{\Carbon\Carbon::parse($request->time)->format('g:i A')}}</td>
                                <td>{{\Carbon\Carbon::parse($request->created_at)->format('Y-m-d')}}</td>
                                <td>
                                    @if (!$request->payment)
                                        <a class="btn btn-sm btn-outline-danger" data-toggle="confirmation" data-title="Cancel request?" href="{{route('student/requestHistory/delete/',$request->id)}}" id="{{$request->id}}">Cancel </a>
                                    @elseif ( $request->payment->status == 'pending' || $request->classroom_added_at == null)
                                        Accepted
                                    @else
                                        <a class="btn btn-sm btn-outline-success" href="{{route('student/classrooms')}}" >Classroom </a>
                                    @endif
                                </td>
                                <td>
                                    @if (!$request->payment )
                                       N/A
                                    @elseif ($request->payment  && $request->payment->status == 'pending' )
                                        <a class="btn btn-sm btn-outline-info" href="{{route('student/paymentHistory/makePayment/',$request->payment->id)}}" >Pay Now</a>
                                    @elseif ($request->payment && $request->payment->status == 'payed' )
                                        <a class="btn btn-sm btn-outline-success" href="{{route('student/paymentHistory')}}" >View</a>
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