@component('mail::message')
# Request In Review

Hi {{$class_request->student->user->first_name}},

we are start to search new class room for your request.please be hold we'll notify the class schedule ASAP

your request was,<br>
Subject : {{$class_request->subject->name}}<br>
Day : {{$class_request->day}}<br>
From : {{\Carbon\Carbon::parse($class_request->time)->format('g:i A')}}

you can check your request respond at any time
@component('mail::button', ['url' => 'http://localhost:8000/student/requestHistory'])
Check Request
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
