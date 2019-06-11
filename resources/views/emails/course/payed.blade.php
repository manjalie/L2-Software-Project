@component('mail::message')
# Payment Succeeded

Hi {{$payment->student_class_request->student->user->first_name}},

your payment for {{$payment->student_class_request->subject->name}} successfully accepted.
please be hold we'll notify the class date time as soon as possible.<br>
Your course detail,


Subject  :{{$payment->student_class_request->subject->name}}<br>
Duration :{{$payment->student_class_request->subject->duration}} Hours<br>
Lecturer :Prof .{{$payment->student_class_request->approve->lecturer->user->first_name}}<br>
Payment  :Rs .{{$payment->amount}}/=<br>

you can check your classroom availability
@component('mail::button', ['url' => 'http://localhost:8000/student/requestHistory'])
    Check Availability
@endcomponent

if there was any delay or something that you want to know please let us know.<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
