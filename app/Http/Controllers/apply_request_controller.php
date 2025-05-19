<?php

namespace App\Http\Controllers;

use App\Models\Need;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class apply_request_controller extends Controller {

public function create()
{
    return view('apply_request');
}


public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'estimated_amount' => 'required|numeric|min:1',
        'national_id' => 'required|string',
        'category' => 'required|in:health,food,education,others',
        'image' => 'nullable|image',
        'supporting_document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        'confirmation' => 'accepted',
    ]);

    $imagePath = $request->file('image')?->store('need_images', 'public');
    $documentPath = $request->file('supporting_document')?->store('supporting_docs', 'public');

    $needRequest = Need::create([
        'user_id' => Auth::id(),
        'title' => $request->title,
        'description' => $request->description,
        'amount' => $request->estimated_amount, // استخدم estimated_amount
        'national_id' => $request->national_id,
        'category' => $request->category,
        'image_path' => $imagePath,
        'supp_doc' => $documentPath,
        'status' => 'pending',
        'rqst_date' => now(),
    ]);

    Notification::create([
        'user_id' => Auth::id(),
        'title' => 'استلام طلب',
        'message' => 'تم استلام طلبك بنجاح، ستتم مراجعته في أقرب وقت ممكن.',
    ]);
    return redirect()->back()->with('success', 'تم إرسال الطلب بنجاح.');
}

}
