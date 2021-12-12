<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendEmailEvent extends Event
{
    use SerializesModels;

    public $_template;

    public $_data;

    /**
     * SendEmailEvent constructor.
     * @param $template
     * @param $data
     */
    public function __construct($template, $data)
    {
        $this->_template = $template;

        $this->_data = $data;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
