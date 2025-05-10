<?php

namespace App\Http\Controllers;

use App\Models\Need;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BankAccount;

class ShowNeedsController extends Controller
{
    // عرض قائمة الحوجات
    public function index(Request $request)
    {
        // الحصول على قيمة البحث والفئة من الطلب
        $search = $request->input('search');
        $category = $request->input('category');

        // استرجاع الحوجات بناءً على البحث والفئة
        $needs = Need::query();

        if ($search) {
            $needs = $needs->where('title', 'like', '%' . $search . '%');
        }

        if ($category) {
            $needs = $needs->where('category', $category);
        }

        // استرجاع النتائج مع التصفية
        $needs = $needs->get();
        // dd($needs); 
        // استرجاع الحسابات البنكية
        $bankAccounts = BankAccount::all();
        

        // تمرير الحوجات والحسابات البنكية إلى الـ view
        return view('show_needs', compact('needs', 'bankAccounts'));
    }

    // إضافة تبرع لحوجة معينة
    public function donate(Request $request, $id)
    {
        // التحقق من تسجيل الدخول
        if (!Auth::check()) {
            // تخزين الرابط الحالي لإعادة التوجيه بعد تسجيل الدخول
            session(['url.intended' => route('needs.user.donate', $id)]);
            return redirect()->route('login')->with('error', 'يرجى تسجيل الدخول لإتمام عملية التبرع.');
        }

        // استرجاع الحوجة بناءً على الـ ID
        $need = Need::findOrFail($id);

        // استرجاع الحسابات البنكية لعرضها في النموذج
        $bankAccounts = BankAccount::all();

        // تمرير البيانات إلى صفحة العرض
        return view('show_needs', compact('need', 'bankAccounts'));
    }

    public function processDonation(Request $request, $id)
    {
        // التحقق من تسجيل الدخول
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يرجى تسجيل الدخول لإتمام عملية التبرع.');
        }

        // التحقق من صحة البيانات
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|exists:bank_accounts,id',
            'transfer_date' => 'required|date',
            'receipt' => 'required|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        // استرجاع الحوجة
        $need = Need::findOrFail($id);

        // رفع الإيصال المالي
        $receiptPath = $request->file('receipt')->store('receipts', 'public');

        // تحديث بيانات الحوجة
        $need->collected_amount += $request->input('amount');
        if ($need->collected_amount >= $need->amount) {
            $need->status = 'مكتملة';
        }
        $need->save();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('needs.user.index')->with('success', 'تم التبرع بنجاح!');
    }
}