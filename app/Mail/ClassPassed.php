<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClassPassed extends Mailable
{
    use Queueable, SerializesModels;
    public $category;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($categroy, $user)
    {
        $this->category = $categroy;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@kdetechnology.com', 'Safety First Consulting')
            ->markdown('email.classPassed');
    }
}
