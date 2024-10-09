<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $template;

    /**
     * Create a new message instance.
     *
     * @param mixed $template
     * @return void
     */
    public function __construct($template)
    {
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.subscribe-email-notify')
            ->subject($this->subject)
            ->with('content', $this->template->body);
    }
}

