<?php

namespace App\Mail;

use App\class_room;
use App\Class_room_has_student;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewClassroom extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Class_room_has_student
     */
    public $studentClassroom;

    /**
     * Create a new message instance.
     *
     * @param Class_room_has_student $studentClassroom
     */
    public function __construct(Class_room_has_student $studentClassroom)
    {
        $this->studentClassroom = $studentClassroom;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.course.newClassroom');
    }
}
