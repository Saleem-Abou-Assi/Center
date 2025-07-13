<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $deletedCount = Notification::whereBetween('created_at', [$startDate, $endDate])->delete();

        return redirect()->route('notifications.index')
            ->with('success', "تم حذف {$deletedCount} إشعار بنجاح");
    }

    public function getNotificationCount()
    {
        // Count only unread notifications
        $notificationCount = Notification::where('is_read', false)->count();

        return response()->json(['count' => $notificationCount]);
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->route('notifications.index')
            ->with('success', 'Notification deleted successfully');
    }
}
