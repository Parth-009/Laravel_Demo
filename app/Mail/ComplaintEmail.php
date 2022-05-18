<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $type;
    public $complaint; 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail)
    {
        $this->type= $mail['type'];
        $this->complaint = $mail['complaints']; 
    }

    /**
     * Build the message.
     *
     * @return $this    
     */
    public function build()
    {
        $type= $this->type;
        $complaint = $this->complaint;
        return $this->view('auth.mailsend',compact('type','complaint'));
    }
}
