@extends('layouts.moderatorApp')
@section('title')
   Courses
@stop
@section('pageHeader')
    Courses
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('moderator')}}">Home</a></li>
        <li class="breadcrumb-item active"> Courses</li>
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
                            <th >Name</th>
                            <th >Duration</th>
                            <th >Price</th>
                            <th >Created @</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr role="row" class="odd">
                                <td class="sorting_1">{{$course->name}}</td>
                                <td>{{$course->duration}}</td>
                                <td>{{$course->price}}</td>
                                <td>{{\Carbon\Carbon::parse($course->created_at)->format('Y-m-d')}}</td>
                                <td><a  href="{{route('moderator/course/delete/',$course->id)}}" data-toggle="confirmation" data-title="Delete Subject?" class="btn btn-outline-danger">Delete</a></td>
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