@component('mail::message')
# Payment Request

Hi {{$payment->student_class_request->student->user->first_name}},

You have to make payment for following course request

Subject  :{{$payment->student_class_request->subject->name}}<br>
Duration :{{$payment->student_class_request->subject->duration}} Hours<br>
Lecturer :Prof .{{$payment->student_class_request->approve->lecturer->user->first_name}}<br>
Payment  :Rs .{{$payment->amount}}/=<br>

After the payment we'll notify about your classroom
@component('mail::button', ['url' => 'http://localhost:8000/student/paymentHistory/makePayment/'.$payment->id])
    Pay Now
@endcomponent

if there was any matter regarding payment please let us know.<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
