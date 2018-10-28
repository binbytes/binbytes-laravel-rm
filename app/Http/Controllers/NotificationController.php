<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    /**
     * Get recent notifications
     *
     * @return \Illuminate\Http\Response
     */
    public function getRecentNotifications()
    {
        return auth()->user()->getRecentNotifications();
    }

    /**
     * Mark notification as read @API
     *
     * @param $notificationId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function markRead($notificationId)
    {
        if($notification = auth()->user()->unReadNotifications()
                                ->whereId($notificationId)
                                ->first()
        ) {
            $notification->markAsRead();

            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }
}
