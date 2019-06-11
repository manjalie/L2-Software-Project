@extends('layouts.adminApp')
@section('title')
    Students(Classroom)

@stop
@section('pageHeader')
    Classroom Students
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
        <li class="breadcrumb-item "> <a href="{{route('admin/classroom')}}">Classrooms</a> </li>
        <li class="breadcrumb-item active"> {{$classroom->subject->name}} class</li>
    </ul>
@stop
@section('content')
    <section class="no-padding-top">
        <div class="row">
            @foreach($c_students as $student)
                <div class="col-lg-4 col-sm-12 ">
                    <div class="card">
                        <img src="{{asset('Profilepic/'.$student->student->user->avatar)}}" alt="Card image cap" class="card-img-top img-fluid">
                        <div class="card-body">
                            <h5 class="card-title">{{$student->student->user->first_name}} {{$student->student->user->last_name}}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item ">
                                <i class="fa fa-envelope"></i> &nbsp;&nbsp;
                                {{$student->student->user->email}}
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-phone"></i>&nbsp;&nbsp;
                                {{$student->student->mobile_no}}
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-address-card"></i>&nbsp;&nbsp;
                                {{$student->student->address}}
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-location-arrow"></i>&nbsp;&nbsp;
                                {{$student->student->city}}
                            </li>
                        </ul>
                    </div>

                </div>
            @endforeach
        </div>

    </section>



@stop
