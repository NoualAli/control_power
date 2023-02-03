<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function total_unread_major_facts()
    {
        return auth()->user()->unreadNotifications->where('type', 'App\Notifications\MajorFactDetectedNotification')->count();
    }

    public function read_major_facts()
    {
        $notifications = auth()->user()->unreadNotifications->where('type', 'App\Notifications\MajorFactDetectedNotification');
        foreach ($notifications as $notification) {
            $notification->update(['read_at' => now()]);
        }
    }
}