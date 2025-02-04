<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with(['doctor', 'patient'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);
        
        return redirect()->back();
    }

    
    public function getNotificationCount()
{
    // Count only unread notifications
    $notificationCount = Notification::where('is_read', false)->count();
dd($notificationCount);
    return response()->json(['count' => $notificationCount]);
}
}
