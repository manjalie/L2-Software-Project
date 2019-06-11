@component('mail::message')
# Asking new class

Hi {{$approval->lecturer->user->first_name}},

we are bringing some student(s) for your subject {{$approval->student_class_request->subject->name}}

Request as following,

Subject : {{$approval->student_class_request->subject->name}}<br>
Day : {{$approval->student_class_request->day}}<br>
From : {{\Carbon\Carbon::parse($approval->student_class_request->time)->format('g:i A')}}

you can  Accept to request at any time
@component('mail::button', ['url' => 'lecturer/classrooms/requests/accept/'.$approval->id])
Accept Request
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
