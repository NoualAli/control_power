<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\MissionDetail;
use App\Models\User;
use App\Notifications\Mission\MajorFact\Detected;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $notifications = auth()->user()->notifications();

            if (request()->has('order')) {
                $notifications = $notifications->sortByMultiple(request()->order);
            } else {
                $notifications = $notifications->orderBy('read_at', 'DESC');
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
            if (request()->has('withCount')) {
                $totalUnread = auth()->user()->unreadNotifications()->count();
                return compact('notifications', 'totalUnread');
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
        $notifications = auth()->user()->unreadNotifications;
        $totalUnread = $notifications->count();
        return compact('notifications', 'totalUnread');
    }

    /**
     * Count total of major facts notifications
     *
     * @return int
     */
    public function total_unread_major_facts()
    {
        return auth()->user()->unreadNotifications()->where('type', 'App\Notifications\MajorFactDetectedNotification')->count();
    }

    /**
     * Mark all notifications of major facts as read
     *
     * @return void
     */
    public function read_major_facts()
    {
        $notifications = auth()->user()->unreadNotifications()->where('type', 'App\Notifications\MajorFactDetectedNotification');
        foreach ($notifications as $notification) {
            $notification->update(['read_at' => now()]);
        }
    }

    public function dispatchMajorFact(MissionDetail $majorFact)
    {
        try {
            $roles = ['ig', 'dg', 'cdrcp', 'der'];
            $users = User::whereRoles($roles)->get();
            foreach ($users as $user) {
                $majorFact->update(['major_fact_dispatched_at' => now()]);
                Notification::send($user, new Detected($majorFact));
            }
            return response()->json([
                'message' => NOTIFICATION_SUCCESS,
                'status' => true
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
        }
    }
}
