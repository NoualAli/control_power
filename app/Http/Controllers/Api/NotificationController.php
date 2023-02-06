<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort(['view_mission']);
        try {
            $notifications = auth()->user()->notifications();

            if (request()->has('order')) {
                $notifications = $notifications->orderByMultiple(request()->order);
            } else {
                $notifications = $notifications->orderBy('read_at', 'DESC')->orderBy('created_at', 'DESC');
            }

            $search = request()->has('search') && !empty(request()->search) ? request()->search : false;
            if ($search) {
                $notifications = $notifications->search($search);
            }

            $filter = request()->has('filter') ? request()->filter : null;
            if ($filter) {
                $notifications = $notifications->filter($filter);
            }
            if (request()->has('fetchAll')) {
                $notifications = $notifications->get()->pluck('reference', 'id');
            } else {
                $notifications = NotificationResource::collection($notifications->paginate(10)->onEachSide(1));
            }
            return $notifications;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ]);
        }
    }
    /**
     * Mark unread notifications as read
     *
     * @return true
     */
    public function update()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return true;
    }

    /**
     * Count total of major facts notifications
     *
     * @return int
     */
    public function total_unread_major_facts()
    {
        return auth()->user()->unreadNotifications->where('type', 'App\Notifications\MajorFactDetectedNotification')->count();
    }

    /**
     * Mark all notifications of major facts as read
     *
     * @return void
     */
    public function read_major_facts()
    {
        $notifications = auth()->user()->unreadNotifications->where('type', 'App\Notifications\MajorFactDetectedNotification');
        foreach ($notifications as $notification) {
            $notification->update(['read_at' => now()]);
        }
    }
}
