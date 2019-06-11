@extends('layouts.studentApp')
@section('title')
    Request

@stop
@section('pageHeader')
    New Course
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('student')}}">Home</a></li>
        <li class="breadcrumb-item active"> Request new course </li>
    </ul>
@stop
@section('content')
    <section class="no-padding-top">
        <div class="container-fluid">
            <div class="card">
                <form class="text-left form-validate"  method="POST" action="{{route('requestNewCourse')}}">
                    @csrf
            <div class="card-header">
                <h4 class="card-title"> Send your request</h4>
            </div>
                <div class="card-body">
            <div class="container-fluid">
                <div class="row">




                    <div class="form-group-material col-lg-6 col-md-6 col-sm12">
                        <label class="label-material mr-4">Subject</label><br>


                        @if (!empty($selected_subject))
                            <select class="selectpicker " data-style="btn-outline-secondary" name="subject" id="subject" required data-live-search="true" tabindex="-98">
                                <option value="{{$selected_subject->id}}">{{$selected_subject->name}}</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </select>
                        @else
                            <select class="selectpicker " data-style="btn-outline-secondary" name="subject" id="subject" required data-live-search="true" tabindex="-98" title="Choose a subject" >
                                @foreach ($subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </select>

                        @endif
                    </div>
                    <div class="row col-lg-8 col-md-8 col-sm-12">
                    <div class="form-group-material col-lg-6 col-md-6 col-sm12">
                        <label class="label-material mr-4">Day</label><br>
                        <select class="selectpicker " data-style="btn-outline-secondary" name="day" id="days" required  title="Choose a day...">
                            @foreach ($days as $day)
                                <option value="{{$day}}">{{$day}}</option>
                            @endforeach
                        </select>
                    </div>
                        <div class="form-group-material col-lg-6 col-md-6 col-sm-12">
                            <label class="label-material mr-4">Time</label>
                            <input type="text"  id="timepicker" name="time" width="276" value="18:00" readonly required/>
                        </div>
                    </div>

                </div>
            </div>
                </div>
                <div class="card-footer">
                    <button type="submit" id="submit" data-toggle="confirmation" data-title="Request Course?" class="btn btn-primary ladda-button" data-style="expand-left">
                        <span class="ladda-label">Request</span>
                        <span class="ladda-spinner"></span>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </section>
@stop
@section('javaScripts')
    <script>
        //initialise time picker
        $('#timepicker').timepicker({
            uiLibrary: 'bootstrap4',
        });

        //initialise select picker
        $('select').selectpicker();

        /**
         * selecting only time after 6.
         * if the user select time after 6 alert will shows
         * and auto set time to 6 pm.
         */


        $('#timepicker').change(function () {

            let getTime = $('#timepicker').val();


            getTime = parseFloat(getTime);

            if (getTime<18)
            {
                alert('Please select time aftert 6 pm');
                $('#timepicker').val("18.00");
            }
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