<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Support';
 
        if($this->request['subject'] == "0"){
            $subject = 'Sale Enquiries';
        }else{
            $subject = $this->request['subject'];
        }
      
        $data = [
            'contactForm' => $this->request,
            'header' => $subject,
        ];
       
        return $this->view('mail.contactUs', $data)
        ->subject($subject);

      
    }
}
