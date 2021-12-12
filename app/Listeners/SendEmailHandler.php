<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailHandler
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
     * @param  SendEmailEvent  $event
     * @return void
     */
    public function handle(SendEmailEvent $event)
    {
        $template = $event->_template;
        $data = $event->_data;

        Mail::send($template, $data, function ($mail) use ($data) {
            $mail->to($data['to']);
            $mail->from($data['from_address'], $data['from_name']);
            $mail->subject($data['subject']);
        });
    }
}
