<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GeneralMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $recipientName;
    public $recipientRole;
    public $endorserPosition;
    public $endorserName;
    public $letterHeading;
    public $letterContent;

    

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $recipientName
     * @param string $recipientRole
     * @param string $endorserPosition
     * @param string $endorserName
     * @param string $letterHeading
     * @param string $letterContent
     */


    public function __construct($subject, $recipientName, $recipientRole, $endorserPosition, $endorserName, $letterHeading, $letterContent)
    {
        $this->subject = $subject;
        $this->recipientName = $recipientName;
        $this->recipientRole = $recipientRole;
        $this->endorserPosition = $endorserPosition;
        $this->endorserName = $endorserName;
        $this->letterHeading = $letterHeading;
        $this->letterContent = $letterContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email-template-1')
                    ->subject($this->subject)
                    ->with([
                        'recipientName' => $this->recipientName,
                        'recipientRole' => $this->recipientRole,
                        'endorserPosition' => $this->endorserPosition,
                        'endorserName' => $this->endorserName,
                        'letterHeading' => $this->letterHeading,
                        'letterContent' => $this->letterContent,
                    ]);
    }
}
