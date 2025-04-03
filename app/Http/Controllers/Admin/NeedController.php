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
        $imagePath = $request->file('image_path')->store('images', 'public');
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
        'rqst_date' => now(),
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

    public function update(Request $request, Need $need)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:pending,approved,rejected',
            'amount' => 'required|numeric|min:0',
            'collected_amount' => 'nullable|numeric|min:0',
            'image_path' => 'nullable|string',
            'isUrgent' => 'boolean',
            'category' => 'required|string|max:255',
        ]);
    
        // Update the need
        $need->update([
            'user_id' => $need->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'amount' => $request->amount,
            'collected_amount' => $request->collected_amount,
            'image_path' => $request->image_path,
            'isUrgent' => $request->isUrgent ?? false,
            'category' => $request->category,
        ]);
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
