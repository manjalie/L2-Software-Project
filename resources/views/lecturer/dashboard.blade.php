@extends('layouts.lecturerApp')
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
                    <div class="icon"><i class="icon-user-1"></i></div><strong>Classrooms</strong>
                </div>
                <div class="number dashtext-1">{{count($classrooms)}}</div>
            </div>
            <div class="progress progress-template">
                <div role="progressbar" style="width: {{(count($classrooms)/count($all_classrooms))*100}}%" aria-valuenow="{{(count($classrooms)/count($all_classrooms))*100}}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
            <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                    <div class="icon"><i class="icon-contract"></i></div><strong>Applied Subjects</strong>
                </div>
                <div class="number dashtext-2">{{count($applied)}}</div>
            </div>
            <div class="progress progress-template">
                @if (count($applied)>0 && count($all_subjects)>0)
                    <div role="progressbar" style="width: {{(count($applied)/count($all_subjects))*100}}%" aria-valuenow="{{(count($applied)/count($all_subjects))*100}}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
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
                    <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>New Requests</strong>
                </div>
                <div class="number dashtext-3">{{count($requests)}}</div>
            </div>
            <div class="progress progress-template">

                @if (count($requests)>0 && count($applied)>0)
                    <div role="progressbar" style="width: {{(count($requests)/count($applied))*100}}%" aria-valuenow="{{(count($requests)/count($applied))*100}}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>
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
                    <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>Available Subjects</strong>
                </div>
                <div class="number dashtext-4">{{count($all_subjects)}}</div>
            </div>
            <div class="progress progress-template">
                @if (count($applied)>0 && count($all_subjects)>0)
                    <div role="progressbar" style="width: {{(count($applied)/count($all_subjects))*100}}%" aria-valuenow="{{(count($applied)/count($all_subjects))*100}}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                @else
                    <div role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                @endif
            </div>
        </div>
    </div>
    </div>
<div class="row pt-4">

    @foreach ($students as $index=> $student)
        <div class="col-lg-4">
            <div class="user-block block text-center">
                <div class="avatar">
                    <img src="{{asset('Profilepic/'.$student->class_room_has_student[$index]->student->user->avatar)}}" alt="..." class="img-fluid">
                </div><a href="#" class="user-title">
                    <h3 class="h5">{{$student->class_room_has_student[$index]->student->user->first_name}}</h3>
                    <span>{{$student->class_room_has_student[$index]->student->user->email}}</span></a>
                <div class="contributions">{{$student->subject->name}}</div>
                <div class="details d-flex">

                </div>
            </div>
        </div>

    @endforeach


</div>

@stop