@extends('layouts.studentApp')
@section('title')
    Dashboard
@stop
@section('pageHeader')
    Dashboard
@stop
@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
            <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                    <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>My Classrooms</strong>
                </div>
                <div class="number dashtext-1">{{count($my_classrooms)}}</div>
            </div>
            <div class="progress progress-template">
                @if (count($my_classrooms)>0 && count($all_classrooms)>0)
                    <div role="progressbar" style="width: {{(count($my_classrooms)/count($all_classrooms))*100}}%" aria-valuenow="{{(count($my_classrooms)/count($all_classrooms))*100}}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                @else
                    <div role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
            <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                    <div class="icon"><i class="icon-info"></i></div><strong>Available Courses</strong>
                </div>
                <div class="number dashtext-2">{{count($subjects)}}</div>
            </div>
            <div class="progress progress-template">
                @if (count($my_classrooms)>0 && count($subjects)>0)
                    <div role="progressbar" style="width: {{(count($my_classrooms)/count($subjects))*100}}%" aria-valuenow="{{(count($my_classrooms)/count($subjects))*100}}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                @else
                    <div role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
            <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                    <div class="icon"><i class="icon-windows"></i></div><strong>Course Requests</strong>
                </div>
                <div class="number dashtext-3">{{count($requests)}}</div>
            </div>
            <div class="progress progress-template">
                @if (count($requests)>0 && count($subjects)>0)
                    <div role="progressbar" style="width: {{(count($requests)/count($subjects))*100}}%" aria-valuenow="{{(count($requests)/count($subjects))*100}}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>
                @else
                    <div role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
            <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                    <div class="icon"><i class="icon-bill"></i></div><strong>Pending payments</strong>
                </div>
                <div class="number dashtext-4">{{count($pending_payments)}}</div>
            </div>
            <div class="progress progress-template">
                @if (count($pending_payments)>0 && count($all_payments)>0)
                    <div role="progressbar" style="width: {{(count($pending_payments)/count($all_payments))*100}}%" aria-valuenow="{{(count($pending_payments)/count($all_payments))*100}}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                @else
                    <div role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                @endif
            </div>
        </div>
    </div>
    </div>

<div class="row pt-4">

    @foreach ($my_classrooms as  $classroom)
        <div class="col-lg-4">
            <div class="user-block block text-center">
                <div class="avatar">
                    <img src="{{asset('Profilepic/'.$classroom->class_room->lecturer->user->avatar)}}" alt="..." class="img-fluid">
                </div><a href="#" class="user-title">
                    <h3 class="h5">Prof.{{$classroom->class_room->lecturer->user->first_name}}</h3>
                    <span>{{$classroom->class_room->lecturer->user->email}}</span></a>
                <div class="contributions">{{$classroom->class_room->subject->name}}</div>
                <div class="details d-flex">

                </div>
            </div>
        </div>

    @endforeach


</div>

@stop