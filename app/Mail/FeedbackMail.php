<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable {
  use Queueable, SerializesModels;

  protected $name;
  protected $surname;
  protected $city;
  protected $company;
  protected $phone;
  protected $email;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($name, $surname, $city, $company, $phone, $email) {
    $this->name = $name;
    $this->surname = $surname;
    $this->city = $city;
    $this->company = $company;
    $this->phone = $phone;
    $this->email = $email;
  }

  /**
   * Get the message envelope.
   *
   * @return \Illuminate\Mail\Mailables\Envelope
   */
  public function envelope(){
    return new Envelope(
      subject: 'Новая заявка с сайта',
    );
  }

  /**
   * Get the message content definition.
   *
   * @return \Illuminate\Mail\Mailables\Content
   */
  public function content() {
    return new Content(
      view: 'mails.feedback',
      with: [
        'name' => $this->name,
        'surname' => $this->surname,
        'city' => $this->city,
        'company' => $this->company,
        'phone' => $this->phone,
        'email' => $this->email
      ]
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array
   */
  public function attachments() {
    return [];
  }
}
