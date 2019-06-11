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
                            <th>Course</th>
                            <th>Status</th>
                            <th>Payed @</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $pay)
                            <tr role="row" class="odd">
                                <td class="sorting_1">{{$pay->subject->name}}</td>
                                <td>
                                    @if ($pay->payment->status =='pending')
                                        <a class="btn btn-sm btn-outline-info" href="{{route('student/paymentHistory/makePayment/',$pay->payment->id)}}" >Pay Now </a>
                                    @else
                                        Payed
                                    @endif
                                </td>
                                <td>
                                    @if ($pay->payment->status =='pending')
                                        N/A
                                    @else
                                        {{\Carbon\Carbon::parse($pay->payment->created_at)->format('Y-m-d')}}
                                    @endif
                                </td>
                                <td>
                                    @if ($pay->payment->status =='pending')
                                        N/A
                                    @else
                                        {{$pay->payment->amount}}
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