@component('mail::message')
# New Classroom

Hello {{$studentClassroom->student->user->first_name}},

we are glade to say that we assigned you in a new classroom for
{{$studentClassroom->class_room->subject->name}}.
classroom start this {{$studentClassroom->class_room->day}},<br>
from {{\Carbon\Carbon::parse($studentClassroom->class_room->started_at)->format('g:i A')}} to {{\Carbon\Carbon::parse($studentClassroom->class_room->end_at)->format('g:i A')}}<br>
the lecturer is prof.{{$studentClassroom->class_room->lecturer->user->first_name}}.<br>
course duration is {{$studentClassroom->class_room->subject->duration}}

please be continue your class sessions.
Happy Learning

Thanks,<br>
{{ config('app.name') }}
@endcomponent
