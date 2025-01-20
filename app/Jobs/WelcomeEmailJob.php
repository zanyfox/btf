<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class WelcomeEmailJob implements ShouldQueue {
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  private $email;
  private $name;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($name, $email){
    $this->name = $name;
    $this->email = $email;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle() {
    //
    Mail::to($this->email)->send(new WelcomeMail($this->name));
  }
}
