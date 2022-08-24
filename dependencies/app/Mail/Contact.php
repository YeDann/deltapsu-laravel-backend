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
    protected $ticket_id;
    

    public function __construct($request ,$ticket_id)
    {
        $this->request = $request;
        $this->ticket_id = $ticket_id;
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
         $subjectName =  $subject.'_'.$this->ticket_id;
        $data = [
            'contactForm' => $this->request,
            'header' => $subject,
        ];
       
        return $this->view('mail.contactUs', $data)
        ->with('ticket_id', $this->ticket_id)
        ->subject($subjectName);

      
    }
}
