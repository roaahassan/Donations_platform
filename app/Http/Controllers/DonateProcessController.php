<?php

namespace App\Http\Controllers;

use App\Models\Need;
use App\Models\BankAccount;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonateProcessController extends Controller
{
    
// عرض صفحة التبرع
public function showDonationPage($needId)
{
    // التأكد من تسجيل الدخول
    if (!auth()->check()) {
        session(['redirect_to_donation' => $needId]);
        return redirect()->route('login');
    }

    // جلب الحوجة والحسابات البنكية لعرضها في النموذج
    $need = Need::findOrFail($needId);
    $bank_accounts = BankAccount::all();

    return view('donate', compact('need', 'bank_accounts'));
}

// حفظ التبرع وإرفاق الإيصال
public function storeDonation(Request $request)
{
    // التحقق من المدخلات
    $validated = $request->validate([
        'need_id' => 'required|exists:needs,id',
        'bank_account_id' => 'required|exists:bank_accounts,id',
        'donation_amount' => 'required|numeric|min:1',
        'transfer_date' => 'required|date',
        'receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    // تخزين الإيصال
    $receiptPath = $request->file('receipt')->store('receipts', 'public');

    // جلب الحوجة
    $need = Need::findOrFail($request->need_id);

    // إنشاء التبرع
    $donation = $need->donations()->create([
        'user_id' => auth()->id(),
        'bank_account_id' => $request->bank_account_id,
        'amount' => $request->donation_amount,
        'transfer_date' => $request->transfer_date,
        'receipt' => $receiptPath,
        'status' => 'pending',
    ]);

    auth()->user()->notifications()->create([
        'title' => 'شكرا لتبرعك',
            'message' => 'تم استلام تبرعك و ستتم مراجعته من قبل الادارة.',
            'is_read' => false,
    ]);

    // return response()->json([
    //     'message' => 'تم رفع الإيصال بنجاح.',
    //     'donation_id' => $donation->id,
    // ]);
    // توجيه المستخدم العادي إلى صفحة التبرعات الخاصة به
    return redirect()->back()->with('success', 'تم ارسال التبرع بنجاح .');
}

}
