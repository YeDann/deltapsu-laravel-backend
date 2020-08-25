<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Forgetpass extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $request;
    protected $pin;
    protected $link;
    public function __construct($request ,$pin ,$link)
    {
        $this->request = $request;
        $this->pin = $pin;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return dd($this->pin);
        $data = [
            'contactForm' => $this->request,
        
        ];
        return $this->view('mail.forgetpass',['contactForm'=>$this->request ])
                 ->with('pin', $this->pin)
                 ->with('link', $this->link)
                ->subject("Change Your Password");
    }
}
