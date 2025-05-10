<?php

namespace App\Http\Controllers;

use App\Models\Need;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class DonateProcessController extends Controller
{
    
    // عرض صفحة التبرع
    public function showDonationPage($needId)
    {
        // إذا لم يكن المستخدم مسجل الدخول، احفظ معرف الحوجة في الجلسة وأعد التوجيه إلى صفحة تسجيل الدخول
    if (!auth()->check()) {
        session(['redirect_to_donation' => $needId]);
        return redirect()->route('login');
    }

    // إذا كان المستخدم مسجل الدخول، اعرض صفحة التبرع
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
            'receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // تأكد من أن نوع الملف يتناسب مع الإيصالات
        ]);

        // تخزين الإيصال
        $receiptPath = $request->file('receipt')->store('receipts', 'public');

        // ربط التبرع بالحوجة
        $need = Need::findOrFail($request->need_id);
        $bank_account = BankAccount::findOrFail($request->bank_account_id);

        // إضافة التبرع أو حفظه في قاعدة البيانات (يفترض وجود جدول لتخزين التبرعات)
        $donation = $need->donations()->create([
            'bank_account_id' => $bank_account->id,
            'donation_amount' => $request->input('donation_amount'),
            'transfer_date' => $request->input('transfer_date'),
            'receipt_path' => $receiptPath,
        ]);

        // إرسال استجابة بنجاح
        return response()->json([
            'message' => 'تم رفع الإيصال بنجاح.',
        ]);
    }

}
