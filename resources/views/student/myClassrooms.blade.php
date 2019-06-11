@extends('layouts.studentApp')
@section('title')
    Classroom
@stop
@section('pageHeader')
    My Classrooms
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('student')}}">Home</a></li>
        <li class="breadcrumb-item active"> My Classrooms </li>
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
                            <th >Subject</th>
                            <th >Day</th>
                            <th >Start Time</th>
                            <th>End Time</th>
                            <th>Lecturer</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($classrooms as $classroom)
                            <tr role="row" class="odd">
                                <td class="sorting_1">{{$classroom->subject->name}}</td>
                                <td>{{$classroom->day}}</td>
                                <td>{{\Carbon\Carbon::parse($classroom->started_at)->format('g:i A')}}</td>
                                <td>{{\Carbon\Carbon::parse($classroom->end_at)->format('g:i A')}}</td>
                                <td>pro.{{$classroom->lecturer->user->first_name}}</td>
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
    </script>
@stop