<?php

namespace App\Http\Controllers\Admin;
use App\Models\Need;
use App\Models\Donation;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;



class DonationController extends Controller {
    
public function index(Request $request) {

    $query = Donation::query();


    if ($request->filled('donor_name')) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->donor_name . '%');
        });
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $donations = $query->paginate(10);

    return view('admin.donations.index', compact('donations'));
}


public function show($id) {
    $donation = Donation::with('user')->find($id);

    if (!$donation) {
        return response()->json(['error' => 'Donation not found'], 404);
    }

    return response()->json([
        'id' => $donation->id,
        'user_name' => $donation->user ? $donation->user->name : 'مجهول',
        'amount' => $donation->amount,
        'date' => $donation->created_at->format('Y-m-d'),
        'status' => $donation->status,
    ]);
}

public function confirm($id)
{
    $donation = Donation::findOrFail($id);
    $donation->status = 'confirmed';
    $donation->save();

     // تحديث المبلغ المجمع للحوجة
     $need = $donation->need;
     $need->collected_amount += $donation->amount;
 
     // التحقق إذا كان المبلغ المجمع قد وصل إلى المبلغ المطلوب
     if ($need->collected_amount >= $need->required_amount) {
         $need->status = 'closed'; // تغيير حالة الحوجة إلى مغلقة
     }
 
     $need->save();

    // إنشاء إشعار للمتبرع
    Notification::create([
        'user_id' => $donation->user_id, // إذا كان هناك علاقة بين التبرع والمستخدم
        'title' => 'تم تأكيد التبرع',
        'message' => 'تم تأكيد تبرعك بمبلغ ' . $donation->amount . ' بنجاح.',
        // 'type' => 'donation_confirmation',
        'is_read' => false, // الإشعار غير مقروء
    ]);
    
    

    // إرسال إشعار للمتبرع
    // ...

    return redirect()->route('donations.index')->with('success', 'تم تأكيد التبرع بنجاح.');
}

public function reject(Request $request)
{
    $validatedData = $request->validate([
        'donation_id' => 'required|exists:donations,id',
        'reason' => 'required|string|max:255',

    ]);

    $donation = Donation::findOrFail($validatedData['donation_id']);
    $donation->status = 'rejected';
    $donation->rejection_reason = $request->reason;
    $donation->save();

     // إنشاء إشعار للمتبرع
     Notification::create([
        'user_id' => $donation->user_id, // إذا كان هناك علاقة بين التبرع والمستخدم
        'title' => 'تم رفض التبرع',
        'message' => 'تم رفض تبرعك بمبلغ ' . $donation->amount . '. السبب: ' . $request->reason,
        // 'type' => 'donation_rejection',
        'is_read' => false, // الإشعار غير مقروء
    ]);

    // إرسال إشعار للمتبرع
    // ...

    return redirect()->route('donations.index')->with('success', 'تم رفض التبرع بنجاح.');
}


}