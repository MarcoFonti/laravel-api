<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContact extends Mailable
{
    use Queueable, SerializesModels;

    /* VARIABILI D'ISTANZA */
    public $email;
    public $name;
    public $text;

    /**
     * Create a new message instance.
     */

     /* NEL COSTRUTTORE PASSO LE VARIABILI CREATE CHE RIEMPIRO CON UNA NUOVA ISTANZA*/
    public function __construct($email, $name, $text)
    {
        $this->email = $email;
        $this->name = $name;
        $this->text = $text;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            /* EMAIL */
            from: $this->email,
            /* OGETTO */
            subject: $this->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            /* VISTA */
            view: 'mails.contact',
            /* CONTENUTO VISTA */
            with:['content' => $this->text]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}