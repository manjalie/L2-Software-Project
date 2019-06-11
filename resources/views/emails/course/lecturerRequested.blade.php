@component('mail::message')
# Request In Review

Hi {{$class_request->lecturer->user->first_name}},

we are start to match the classes that suits for you.please hold on while.we'll notify about the classes as soon as possible.

your request was,<br>
Subject : {{$class_request->subject->name}}<br>
Day : {{$class_request->day}}<br>
From : {{\Carbon\Carbon::parse($class_request->start_time)->format('g:i A')}}
To : {{\Carbon\Carbon::parse($class_request->end_time)->format('g:i A')}}

you can check your request respond at any time
@component('mail::button', ['url' => 'http://localhost:8000/lecturer/applyHistory'])
Check Request
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
