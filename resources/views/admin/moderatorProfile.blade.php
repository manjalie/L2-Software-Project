@extends('layouts.adminApp')
@section('title')
   {{$moderator->user->first_name}}

@stop
@section('pageHeader')
    {{$moderator->user->first_name}} Profile
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin/moderator/allProfiles')}}"> Moderator  Profiles</a></li>
        <li class="breadcrumb-item active"> {{$moderator->user->first_name}} </li>
    </ul>
@stop
@section('content')
    <section class="no-padding-top">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 ">

                <div class="card card-profile ">
                    <div style="background-image: url(../../../../../template/img/photos/learning_back.jpg);" class="card-header"></div>
                    <div class="card-body text-center">
                        <img src="{{asset('Profilepic/'.$moderator->user->avatar)}}" class="card-profile-img">
                        <h4 class="mb-3 text-gray-light">{{$moderator->user->first_name}}</h4>
                        <p class="mb-4">Moderator Since {{$moderator->user->created_at}} </p>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item ">
                            <i class="fa fa-envelope"></i> &nbsp;&nbsp;
                            {{$moderator->user->email}}
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-phone"></i>&nbsp;&nbsp;
                            {{$moderator->mobile_no}}
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-address-card"></i>&nbsp;&nbsp;
                            {{$moderator->address}}
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-location-arrow"></i>&nbsp;&nbsp;
                            {{$moderator->city}}
                        </li>
                        @if ($moderator->cv !== null)
                            <li class="list-group-item">
                                <i class="fa fa-download"></i>&nbsp;&nbsp;
                                CV <a href="{{asset('Docs/Moderator/'.$moderator->cv)}}" target="_blank">view</a>
                            </li>
                        @endif

                    </ul>
                    <div class="card-body">
                        <div class="card-link">
                            @if ($moderator->user->status == 'blocked')
                                <a href="{{route('admin/moderator/allProfiles/unblock/',$moderator->id)}}" data-toggle="confirmation" data-title="Unblock user?">Unblock</a>
                            @else
                                <a href="{{route('admin/moderator/allProfiles/block/',$moderator->id)}}" data-toggle="confirmation" data-title="Block user?">Block</a>
                            @endif
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </section>




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