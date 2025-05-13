<?php

namespace App\Http\Controllers;

use App\Models\Need;
use App\Models\BankAccount;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonateProcessController extends Controller
{
    
    // عرض صفحة التبرع
    public function showDonationPage($needId , Request $request)
    {
        // إذا لم يكن المستخدم مسجل الدخول، احفظ معرف الحوجة في الجلسة وأعد التوجيه إلى صفحة تسجيل الدخول
    // if (!auth()->check()) {
    //     session(['redirect_to_donation' => $needId]);
    //     return redirect()->route('login');
    // }

    // إذا كان المستخدم مسجل الدخول، اعرض صفحة التبرع
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
        'user_id' => auth()->id(), // معرف المستخدم الحالي
        'need_id' => $need->id, // معرف الحوجة
        'bank_account_id' => $bank_account->id,
        'amount' => $request->input('donation_amount'),
        'transfer_date' => $request->input('transfer_date'),
        'receipt' => $receiptPath,
        'status' => 'pending', // الحالة الافتراضية للتبرع
    ]);


    return view('donate', compact('need', 'bank_accounts' , 'donation'));
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
            'user_id' => auth()->id(), // معرف المستخدم الحالي
            'need_id' => $need->id, // معرف الحوجة
            'bank_account_id' => $bank_account->id,
            'amount' => $request->input('donation_amount'),
            'transfer_date' => $request->input('transfer_date'),
            'receipt' => $receiptPath,
            'status' => 'pending', // الحالة الافتراضية للتبرع
        ]);

        // إرسال استجابة بنجاح
        return response()->json([
            'message' => 'تم رفع الإيصال بنجاح.',
        ]);
    }

    public function storeInitial(Request $request)
    {
        $validated = $request->validate([
            'need_id' => 'required|exists:needs,id',
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'donation_amount' => 'required|numeric|min:1',
        ]);

        // حفظ البيانات الأولية في قاعدة البيانات
        $donation = Donation::create([
            'user_id' => auth()->id(),
            'need_id' => $validated['need_id'],
            'bank_account_id' => $validated['bank_account_id'],
            'amount' => $validated['donation_amount'],
            'status' => 'pending', // الحالة الافتراضية
        ]);

        // إعادة التوجيه إلى نفس الصفحة مع رسالة نجاح
        return response()->json([
            'message' => 'تم حفظ البيانات الأولية بنجاح.',
            'donation_id' => $donation->id, // إرسال معرف التبرع لاستخدامه لاحقًا
        ]);
    }

    public function showReceiptForm(Donation $donation)
    {
        return view('donate', compact('donation'));
    }

    public function storeReceipt(Request $request, $donationId)
    {
        $validated = $request->validate([
            'transfer_date' => 'required|date',
            'receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // استرجاع التبرع
        $donation = Donation::findOrFail($donationId);

        // تخزين الإيصال
        $receiptPath = $request->file('receipt')->store('receipts', 'public');

        // تحديث بيانات الإيصال في التبرع
        $donation->update([
            'transfer_date' => $validated['transfer_date'],
            'receipt' => $receiptPath,
        ]);

        // التحقق من المبلغ الإجمالي للتبرعات
        $need = $donation->need;
        $totalDonations = $need->donations()->sum('amount');

        if ($totalDonations >= $need->amount) {
            // إذا تم الوصول إلى المبلغ المستهدف، قم بتحديث الحالة إلى completed
            $donation->update(['status' => 'completed']);
        }

        return response()->json([
            'message' => 'تم رفع الإيصال بنجاح.',
        ]);
    }

}
