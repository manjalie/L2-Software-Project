@extends('layouts.studentApp')
@section('title')
    New Payment

@stop
@section('pageHeader')
    New Payment
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('student')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('student/paymentHistory')}}">Payments</a></li>
        <li class="breadcrumb-item active">New Payment</li>
    </ul>
@stop
@section('content')
    <section class="no-padding-top">
        <div class="container-fluid col-lg-5 col-md-5 offset-lg-3 offset-md-3 col-sm-12">
            <div class="card">
                <form class="text-left form-validate"  method="post" action="https://sandbox.payhere.lk/pay/checkout">
                        @csrf
                    <div class="card-title">
                       <h4 class="card-header text-primary"> {{$payment->student_class_request->subject->name}}</h4>
                    </div>
                    <div class="card-body">
                        <span>
                            Please make payment for following course.after the payment we'll notify about classroom and
                            class time.please notify the payment for the full course.
                        </span>
                        <table class="table-responsive mt-md-4 ml-4">
                            <tr>
                                <td>Subject :</td>
                                <td><strong>{{$payment->student_class_request->subject->name}}</strong></td>
                            </tr>
                            <tr>
                                <td>Duration :</td>
                                <td><strong>{{$payment->student_class_request->subject->duration}}<strong></td>
                            </tr>
                            <tr>
                                <td>Lecturer :</td>
                                <td><strong> Prof .{{$payment->student_class_request->approve->lecturer->user->first_name}} </strong></td>
                            </tr>
                            <tr>
                                <td>Payment :</td>
                                <td><strong>Rs .{{$payment->amount}}</strong></td>
                            </tr>
                        </table>
                    </div>

{{----------------------------------------------pay here values------------------------------------------------------}}
                    <input type="hidden" name="merchant_id" value="1212198">    <!-- Replace your Merchant ID -->
                    <input type="hidden" name="return_url" value="{{route('payhereReturn')}}">
                    <input type="hidden" name="cancel_url" value="{{route('student/paymentHistory/makePayment/',$payment->id)}}">
                    <input type="hidden" name="notify_url" value="{{route('payhereReturnNotify')}}">

                    <input type="hidden" name="order_id" value="{{$payment->id}}">
                    <input type="hidden" name="items" value="{{$payment->student_class_request->subject->name}}"><br>
                    <input type="hidden" name="currency" value="LKR">
                    <input type="hidden" name="amount" value="{{$payment->amount}}">

                    <input type="hidden" name="first_name" value="{{Auth::user()->first_name}}">
                    <input type="hidden" name="last_name" value="{{Auth::user()->last_name}}"><br>
                    <input type="hidden" name="email" value="{{Auth::user()->email}}">
                    <input type="hidden" name="phone" value="{{$student->first_name}}"><br>
                    <input type="hidden" name="address" value="{{$student->address}}">
                    <input type="hidden" name="city" value="{{$student->city}}">
                    <input type="hidden" name="country" value="Sri Lanka"><br><br>
{{------------------------------------End of pay here values------------------------------------------------------}}
                    <div class="card-footer">
                        <div class="offset-md-4">
                        <button type="submit" id="submit" class="btn btn-primary ladda-button" data-style="expand-left">
                            <span class="ladda-label" data-toggle="confirmation" data-title="Make Payment?">Pay Now</span>
                            <span class="ladda-spinner"></span>
                        </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@stop
@section('javaScripts')
    <script>


    </script>
@stop