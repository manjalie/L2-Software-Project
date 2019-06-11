@extends('layouts.adminApp')
@section('title')
   Payments
@stop
@section('pageHeader')
    Payments
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
        <li class="breadcrumb-item active"> Payments</li>
    </ul>
@stop
@section('content')

    <div class="block">
        <div class="block-body">
            <div class="">
                <div id="payment" class="dataTables_wrapper dt-bootstrap4 ">
                    <table id="paymentTable" class="table dataTable no-footer"  aria-describedby="datatable1_info">
                        <thead>
                        <tr role="row">
                            <th >Student</th>
                            <th >Course</th>
                            <th >Amount</th>
                            <th >Date</th>
                            <th >Gateway</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr role="row" class="odd">
                                <td class="sorting_1">
                                    <a href="{{route('admin/student/allProfiles/view/',$payment->student_class_request->student->id)}}">{{$payment->student_class_request->student->user->first_name}}</a>
                                </td>
                                <td>{{$payment->student_class_request->subject->name}}</td>
                                <td>{{$payment->amount}}</td>
                                <td>{{\Carbon\Carbon::parse($payment->updated_at)->format('Y-m-d')}}</td>
                                <td><a  href="https://sandbox.payhere.lk/account/user" target="_blank">PayHere</a></td>
                                <td>{{$payment->status}}</td>
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
            $('#paymentTable').DataTable();
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