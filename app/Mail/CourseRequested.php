<?php

namespace App\Mail;

use App\student_class_request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CourseRequested extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var student_class_request
     */
    public $class_request;

    /**
     * Create a new message instance.
     *
     * @param student_class_request $class_request
     */
    public function __construct(student_class_request $class_request)
    {
        $this->class_request = $class_request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.course.requested');
    }
}
