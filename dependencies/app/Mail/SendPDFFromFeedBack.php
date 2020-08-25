<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPDFFromFeedBack extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $request;
    protected $path;
    protected $factorModel;

    public function __construct($request ,$path ,$factorModel)
    {
        $this->request = $request;
        $this->path = $path;
        $this->factorModel = $factorModel;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Your Delta Configurable Power Solution';
 
      
        $data = [
            'contactForm' => $this->request,
            'header' => $subject,
        ];
       
        return $this->view('mail.sendpfdtomeFromFeedBack', $data)
        ->subject($subject)
        ->attach($this->path, [
            'as' => $this->factorModel.'_configurable_power.pdf',
            'mime' => 'application/pdf',
          ]);

      
    }
}
