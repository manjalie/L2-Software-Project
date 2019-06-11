<?php

namespace App\Mail;

use App\class_request_approval;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AskingLecturerApproval extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var class_request_approval
     */
    public $approval;

    /**
     * Create a new message instance.
     *
     * @param class_request_approval $approval
     */
    public function __construct(class_request_approval $approval)
    {
        $this->approval = $approval;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.course.askingLecturerApproval');
    }
}
