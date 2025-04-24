<?php

namespace App\Http\Controllers\Admin;

use App\Models\Need;
use App\Models\Donation;    
use Illuminate\Http\Request;    
use App\Http\Controllers\Controller;

class DashboardController extends Controller {
      
        public function dashboard()
        {
            // احصل على الإحصائيات
            $needsCount = Need::count();
            $donationsCount = Donation::count();
            // $requestsCount = \App\Models\Request::count();

            // تمرير البيانات إلى الصفحة
            return view('admin.dashboard', compact('needsCount', 'donationsCount'));
        }
    
        public function needs()
        {
            // جلب جميع الحوجات
            $needs = Need::paginate(10); // استخدم paginate لتقسيم النتائج
            return view('admin.needs.index', compact('needs'));
        }
    
        public function donations()
        {
            // جلب جميع التبرعات مع المستخدمين المرتبطين
            $donations = Donation::with('user')->paginate(10); // استخدم paginate لتقسيم النتائج
            return view('admin.donations.index', compact('donations'));
        }
    
        public function profile()
        {
            // تمرير بيانات المستخدم الحالي إلى صفحة البروفايل
            $user = auth()->user();
            return view('admin.profile', compact('user'));
        }
    
}
