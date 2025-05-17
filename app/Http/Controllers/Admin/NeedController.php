<?php

namespace App\Http\Controllers\Admin;

use App\Models\Need;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

class NeedController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('admin');
    // }
    // public function index()
    // {
    //     $needs = Need::all();
    //     return view('admin.needs.index', compact('needs'));
    // }


  
    
    public function index(Request $request)
    {
        // إنشاء استعلام ديناميكي
        $query = Need::query();
    
        // البحث عن العنوان
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
    
        // تصفية حسب حالة الحوجة
        if ($request->filled('need_status')) {
            $query->where('need_status', $request->need_status);
        }
    
        // تصفية حسب الفئة
        if ($request->filled('category')) {
            $query->where('category', 'like', '%' . $request->category . '%');
        }
    
        // تصفية حسب الأولوية
        if ($request->filled('isUrgent')) {
            $query->where('isUrgent', $request->isUrgent);
        }
    
        // تنفيذ الاستعلام وجلب النتائج
        $needs = $query->paginate(10);
    
        // تمرير النتائج إلى العرض
        return view('admin.needs.index', compact('needs'));
    }

    public function create()
    {
        return view('admin.needs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category' => 'required|string',
        'amount' => 'required|numeric|min:0',
        'image_path' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048', // تحقق من أن الصورة ملف صالح
        'isUrgent' => 'boolean',
        ]);

    // معالجة رفع الصورة إذا تم تقديمها
    $imagePath = null;
    if ($request->hasFile('image_path')) {
        $imageName = $request->file('image_path')->getClientOriginalName();
        $imagePath = $request->file('image_path')->storeAs('storage', $imageName, 'public');
        $imagePath = $imageName; // تخزين اسم الصورة فقط في قاعدة البيانات
    }

    // إنشاء الحوجة
    Need::create([
        'user_id' => Auth::id(),
        'title' => $request->title,
        'description' => $request->description,
        'category' => $request->category,
        'amount' => $request->amount,
        'image_path' => $imagePath,
        'isUrgent' => $request->isUrgent ?? false,
        // 'rqst_date' => now(),
    ]);

    return redirect()->route('needs.index')->with('success', 'تمت إضافة الحوجة بنجاح.');
    }

    public function show(Need $need)
    {
        return view('admin.needs.show', compact('need'));
    }

    public function edit(Need $need)
    {
        return view('admin.needs.edit', compact('need'));
    }

    public function update(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            'amount' => 'required|numeric|min:0',
            'collected_amount' => 'nullable|numeric|min:0',
            'image_path' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048', // التحقق من رفع الملف
            'isUrgent' => 'nullable|boolean',
            'category' => 'required|string|max:255',
        ]);

        // استرجاع الحوجة
        $need = Need::findOrFail($id);

        // تحديث البيانات
        $need->title = $request->input('title');
        $need->description = $request->input('description');
        $need->status = $request->input('status');
        $need->amount = $request->input('amount');
        $need->collected_amount = $request->input('collected_amount');
        $need->isUrgent = $request->input('isUrgent', 0); // القيمة الافتراضية 0
        $need->category = $request->input('category');

        // معالجة رفع الصورة
        if ($request->hasFile('image_path')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($need->image_path && \Storage::exists('public/' . $need->image_path)) {
                \Storage::delete('public/' . $need->image_path);
            }

            // رفع الصورة الجديدة
            $path = $request->file('image_path')->store('needs', 'public');
            $need->image_path = $path;
        }

        // حفظ التعديلات
        $need->save();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('needs.index')->with('success', 'تم تحديث الحوجة بنجاح.');
    }

    public function destroy(Need $need)
    {
        $need->delete();

        return redirect()->route('needs.index')->with('success', 'تم حذف الحوجة بنجاح.');
    }

    // تحديث المبلغ المجمع للحاجة بعد تبرع جديد  

    public function updateCollectedAmount(Request $request, Need $need)
    {
        $request->validate([
            'collected_amount' => 'required|numeric|min:0',
        ]);
    
        $need->update([
            'collected_amount' => $request->collected_amount,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'تم تحديث المبلغ المجمع بنجاح.',
            'collected_amount' => $need->collected_amount,
        ]);
    }


}
