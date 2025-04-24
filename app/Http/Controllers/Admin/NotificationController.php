<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
    $notification->update(['is_read' => true]);

    return redirect()->back()->with('success', 'تم تحديد الإشعار كمقروء.');
    }
}