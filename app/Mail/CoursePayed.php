<?php

namespace App\Mail;

use App\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CoursePayed extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * The order instance.
     *
     * @var Payment
     */
    public $payment;

    /**
     * Create a new message instance.
     *
     * @param payment $payment
     */
    /**
     * Create a new message instance.
     *
     * @param Payment $payment
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.course.payed');
    }
}
