<?php

namespace App\Http\Controllers\Admin;

use App\Models\Need;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminNeedRequestController extends Controller
{
    public function index()
    {
        $needRequests = Need::latest()->paginate(10);
        return view('admin.admin_need_requests', compact('needRequests'));
    }

    public function review($id)
    {
        $request = Need::findOrFail($id);
        $request->update(['status' => 'pending']);

        Notification::create([
            'user_id' => $request->user_id,
            'title'   => 'مراجعة طلب',
            'message' => 'تم بدء مراجعة طلب الحوجة الخاص بك  '
        ]);

        return redirect()->back()->with('success',   'تم تغيير حالة الطلب الى قيد المراجعة.');
    }

    public function accept($id)
    {
        $request = Need::findOrFail($id);
        $request->update(['status' => 'accepted']);

        Notification::create([
            'user_id' => $request->user_id,
            'title'   => 'قبول طلب',
            'message' => 'تم قبول طلب الحوجة الخاص بك بعنوان "' . $request->title . '".'
        ]);

        return redirect()->back()->with('success', 'تم قبول الطلب.');
    }

    public function reject($id)
    {
        $request = Need::findOrFail($id);
        $request->update(['status' => 'rejected']);

        Notification::create([
            'user_id' => $request->user_id,
            'title'   => 'رفض طلب',
            'message' => 'تم رفض طلب الحوجة الخاص بك بعنوان "' . $request->title . '".'
        ]);

        return redirect()->back()->with('error', 'تم رفض الطلب.');
    }
}
