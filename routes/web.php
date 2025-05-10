<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShowNeedsController;
use App\Http\Controllers\Admin\NeedController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DonateProcessController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\DashboardController; // Ensure this class exists in the specified namespace


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Route for showing the login form
Route::get('/login', [LoginController::class , 'showLoginForm'])->name('login');

// Route for handling the login form submission
Route::post('/login', [LoginController::class,'login']);

Route::get('/logout', [LogoutController::class, 'showLogoutButton'])->name('logout.show');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// مسار صفحة البروفايل للمستخدم العادي
Route::middleware(['auth'])->group(function () {
Route::get('/profile', [UserProfileController::class, 'profile'])->name('user.profile');
//مسارات صفحة وعملية التبرع
Route::get('donate/{needId}', [DonateProcessController::class, 'showDonationPage'])->name('donate.show');
Route::post('donate', [DonateProcessController::class, 'storeDonation'])->name('donation.store');
});



// Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
// Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

// admin routes
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [ DashboardController::class , 'dashboard'])->name('admin.dashboard');   
    Route::get('/dashboard/needs', [DashboardController::class, 'needs'])->name('dashboard.needs');
    Route::get('/dashboard/donations', [DashboardController::class, 'donations'])->name('dashboard.donations');
    // Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/dashboard/profile', [AdminProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');
    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    // مسارات إدارة الحوجات
    Route::resource('needs', NeedController::class);
    //     ->names([
    //     'index' => 'admin.needs.index',
    //     'create' => 'admin.needs.create',
    //     'store' => 'admin.needs.store',
    //     'show' => 'admin.needs.show',
    //     'edit' => 'admin.needs.edit',
    //     'update' => 'admin.needs.update',
    //     'destroy' => 'admin.needs.destroy',
    //    ]);

    // Route for updating the collected amount
    Route::post('needs/{need}/update-collected-amount', [NeedController::class, 'updateCollectedAmount'])->name('needs.updateCollectedAmount');
    //مسارات ادارة التبرعات
    Route::resource('donations', DonationController::class);
    Route::post('donations/{id}/confirm', [DonationController::class, 'confirm'])->name('donations.confirm');
    Route::post('donations/reject', [DonationController::class, 'reject'])->name('donations.reject');
    Route::get('/donations/{id}', [DonationController::class, 'show'])->name('donations.show');
    
    // Route::get('/requests', [AdminController::class, 'requests'])->name('admin.requests');
    

// // notifications
// Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
});

//مسارات المستخدم 
//مسارات صفحة عرض الحوجات
Route::get('/needs/list', [ShowNeedsController::class, 'index'])->name('needs.user.index');
// Route::get('/needs/{id}/show', [ShowNeedsController::class, 'show'])->name('needs.user.show');
// Route::get('/needs/details', action: [ShowNeedsController::class, 'showNeeddetails'])->name('needs.show.details');
// Route::get('/needs/{id}/donate', [ShowNeedsController::class, 'donate'])
//     ->name('needs.user.donate')
//     ->middleware('auth');
// Route::post('/needs/{id}/donate', [ShowNeedsController::class, 'processDonation'])->name('needs.user.process_donation');

Route::get('/admin/register', [AdminController::class, 'showAdminRegisterForm'])->name('admin.register.form');
Route::post('/admin/register', [AdminController::class, 'registerAdmin'])->name('admin.register');