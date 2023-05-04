<?php

namespace App\Listeners;

use App\Events\LoginEventCookie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailMailable;
class LoginListenerCookieSet
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LoginEventCookie  $event
     * @return void
     */
    public function handle(LoginEventCookie $event)
    {
        Mail::to($event->email)->send(new SendEmailMailable());
    }
}
