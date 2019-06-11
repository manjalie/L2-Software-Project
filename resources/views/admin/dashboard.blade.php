@extends('layouts.adminApp')
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
                <div role="progressbar" style="width: {{(count($classrooms)/count($subjects))*100}}%" aria-valuenow="{{(count($classrooms)/count($subjects))*100}}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
            <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                    <div class="icon"><i class="icon-contract"></i></div><strong>Subjects</strong>
                </div>
                <div class="number dashtext-2">{{count($subjects)}}</div>
            </div>
            <div class="progress progress-template">
                <div role="progressbar" style="width:{{(count($students)/count($subjects))*100}}%" aria-valuenow="{{(count($students)/count($subjects))*100}}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
            <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                    <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>Student Requests</strong>
                </div>
                <div class="number dashtext-3">{{count($student_requests)}}</div>
            </div>
            <div class="progress progress-template">
                <div role="progressbar" style="width:{{(count($students)/count($subjects))*100}}%" aria-valuenow="{{(count($student_requests)/count($students))*100}}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
            <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                    <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>Lecturer Requests</strong>
                </div>
                <div class="number dashtext-4">{{count($lecturer_requests)}}</div>
            </div>
            <div class="progress progress-template">
                <div role="progressbar" style="width: {{(count($lecturer_requests)/count($all_lecturers))*100}}%" aria-valuenow="{{(count($lecturer_requests)/count($all_lecturers))*100}}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
            </div>
        </div>
    </div>
    </div>

<div class="row  pt-5 ">
<div class=" col-lg-6 col-sm-12">
<div class="stats-2-block block d-flex">
    <div class="stats-2 d-flex">
        <div class="stats-2-arrow height"><i class="fa fa-caret-up"></i></div>
        <div class="stats-2-content"><strong class="d-block">{{count($all_students)}}</strong><span class="d-block"> Students</span>
            <div class="progress progress-template progress-small">
                <div role="progressbar" style="width: {{( count($all_students)/(count($all_students)+count($all_lecturers)) )*100}}%;" aria-valuenow="{{( count($all_students)/(count($all_students)+count($all_lecturers)) )*100}}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-2"></div>
            </div>
        </div>
    </div>
    <div class="stats-2 d-flex">
        <div class="stats-2-arrow height"><i class="fa fa-caret-up"></i></div>
        <div class="stats-2-content"><strong class="d-block">{{count($all_lecturers)}}</strong><span class="d-block">Lecturers</span>
            <div class="progress progress-template progress-small">
                <div role="progressbar" style="width: {{( count($all_lecturers)/(count($all_students)+count($all_lecturers)) )*100}}%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-3"></div>
            </div>
        </div>
    </div>
</div>
</div>
    <div class="col-lg-6 col-sm-12">
    <div class="stats-3-block block d-flex  pl-2">
        <div class="stats-3"><strong class="d-block">RS. {{$income}}</strong><span class="d-block">Total Income</span>
            <div class="progress progress-template progress-small">
                <div role="progressbar" style="width: {{$income/($subject_income*count($all_students))}}%;" aria-valuenow="{{$income/($subject_income*count($all_students))}}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-1"></div>
            </div>
        </div>
        <div class="stats-3 d-flex justify-content-between text-center">
            <div class="item"><strong class="d-block strong-sm">{{count($all_student_requests)}}</strong><span class="d-block span-sm">Requests</span>

            </div>
            <div class="item"><strong class="d-block strong-sm">{{count($classrooms)}}</strong><span class="d-block span-sm">Classrooms</span>

            </div>
        </div>
    </div>
    </div>
</div>

<div class="pt-5">
    <h6>Users</h6>
</div>
<div class=" row">
    @foreach ($students as $student)
        <div class="col-md-6 col-sm-12 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span style="background-image: url({{asset('Profilepic/'.$student->user->avatar)}})" class="avatar avatar-xl mr-3"></span>
                        <div class="media-body overflow-hidden">
                            <h5 class="card-text mb-0">{{$student->user->first_name}}</h5>
                            <p class="card-text text-uppercase font-weight-bold text-gray-dark">Student</p>
                            <p class="card-text">

                                {{$student->user->email}}<br>
                                @if ($student->mobile_no == null)
                                    No Mobile
                                @else
                                    P: {{$student->mobile_no}}
                                @endif

                            </p>
                        </div>
                    </div><a href="{{route('moderator/student/allProfiles')}}" class="tile-link"></a>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($lecturers as $lecturer)
        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span style="background-image: url({{asset('Profilepic/'.$lecturer->user->avatar)}})" class="avatar avatar-xl mr-3"></span>
                        <div class="media-body overflow-hidden">
                            <h5 class="card-text mb-0">{{$lecturer->user->first_name}}</h5>
                            <p class="card-text text-uppercase font-weight-bold text-gray-dark">Lecturer</p>
                            <p class="card-text">
                                {{$lecturer->user->email}}<br>
                                @if ($lecturer->mobile_no == null)
                                    No Mobile
                                @else
                                    P: {{$lecturer->mobile_no}}
                                @endif

                            </p>
                        </div>
                    </div><a href="{{route('moderator/lecturer/allProfiles')}}" class="tile-link"></a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@stop