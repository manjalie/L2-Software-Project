@extends('layouts.adminApp')
@section('title')
   Profiles
@stop
@section('pageHeader')
    Moderator  Profile
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
        <li class="breadcrumb-item active">  Moderator  Profiles </li>
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
                            <th >Status</th>
                            <th >View</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($moderators as $moderator)
                            <tr role="row" class="odd">
                                <td class="sorting_1">
                                    <div class="avatar">
                                        <img src="{{asset('Profilepic/'.$moderator->user->avatar)}}" alt="avatar" class="img-fluid rounded-circle">
                                    </div>
                                </td>
                                <td>
                                    {{$moderator->user->first_name}}
                                </td>
                                <td>
                                    {{$moderator->user->email}}
                                </td>
                                <td>
                                    {{$moderator->mobile_no}}
                                </td>
                                <td>
                                    {{$moderator->nic_no}}
                                </td>
                                <td>
                                    {{$moderator->address}}
                                </td>
                                <td>
                                    {{$moderator->city}}
                                </td>
                                <td>
                                    {{$moderator->user->status}}
                                </td>
                                <td>
                                    <a class="btn btn-outline-info" href="{{route('admin/moderator/allProfiles/view/',$moderator->id)}}">View</a>
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