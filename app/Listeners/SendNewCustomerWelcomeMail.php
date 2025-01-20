<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\WelcomeMail;
use Mail;

class SendNewCustomerWelcomeMail {
  /**
   * Create the event listener.
   */
  public function __construct() {
    //
  }

  /**
   * Handle the event.
   */
  public function handle(\App\Events\NewOrderCreated $event): void {
    // TODO : send welcome telegram message
    Mail::to($event->order->customer->email)->send(new WelcomeMail($event->order->customer->name));

  }
}
