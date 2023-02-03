<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\MajorFactDetectedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendMajorFactDetectedNotification
{
    private $detail;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($detail)
    {
        $this->detail = $detail;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $dcp = User::dcp();
        Notification::send($dcp, new MajorFactDetectedNotification($event->user, $this->detail));
    }
}