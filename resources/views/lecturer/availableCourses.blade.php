@extends('layouts.lecturerApp')
@section('title')
    Courses
@stop
@section('pageHeader')
   Available Courses
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{'lecturer'}}">Home</a></li>
        <li class="breadcrumb-item active"> Available Courses </li>
    </ul>
@stop
@section('content')
    <div class="block">
<div class="block-body">
                <div class="">
                    <div id="subjectTable" class="dataTables_wrapper dt-bootstrap4 ">
                            <table id="courseTable" class="table dataTable no-footer"  aria-describedby="datatable1_info">
                                    <thead>
                                    <tr role="row">
                                        <th >Name</th>
                                        <th >Duration (hrs.)</th>
                                        <th >Fees(Rs.)</th>
                                        <th>Request</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subjects as $subject)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{$subject->name}}</td>
                                        <td>{{$subject->duration}}</td>
                                        <td>{{$subject->price}}</td>
                                        <td><a class="btn btn-outline-primary request" href="{{route('lecturer/newCourse/',$subject->id)}}" id="{{$subject->id}}">Apply</a></td>
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
        $('#courseTable').DataTable();
    });
</script>
@stop