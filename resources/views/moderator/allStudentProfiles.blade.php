@extends('layouts.moderatorApp')
@section('title')
   Profiles
@stop
@section('pageHeader')
    Student  Profile
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('moderator')}}">Home</a></li>
        <li class="breadcrumb-item active">  Student  Profiles </li>
    </ul>
@stop
@section('content')

    <div class="block">
        <div class="block-body">
            <div class="">
                <div id="classroom" class="dataTables_wrapper dt-bootstrap4 ">
                    <table id="userTable" class="table dataTable no-footer"  aria-describedby="datatable1_info">
                        <thead>
                        <tr role="row">
                            <th >Avatar</th>
                            <th >Name</th>
                            <th >Email</th>
                            <th >Mobile</th>
                            <th >NIC</th>
                            <th >Address</th>
                            <th >City</th>
                            <th >View</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr role="row" class="odd">
                                <td class="sorting_1">
                                    <div class="avatar">
                                        <img src="{{asset('Profilepic/'.$student->user->avatar)}}" alt="avatar" class="img-fluid rounded-circle">
                                    </div>
                                </td>
                                <td>
                                    {{$student->user->first_name}}
                                </td>
                                <td>
                                    {{$student->user->email}}
                                </td>
                                <td>
                                    {{$student->mobile_no}}
                                </td>
                                <td>
                                    {{$student->nic_no}}
                                </td>
                                <td>
                                    {{$student->address}}
                                </td>
                                <td>
                                    {{$student->city}}
                                </td>
                                <td>
                                    <a class="btn btn-outline-info" href="{{route('moderator/student/allProfiles/view/',$student->id)}}">View</a>
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
            $('#userTable').DataTable();
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