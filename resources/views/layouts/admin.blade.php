<!-- filepath: resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>لوحة الإدارة</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="d-flex">
        <!-- الشريط الجانبي -->
        <nav class="bg-dark text-white p-3" style="width: 250px; height: 100vh;">
            <h4 class="text-center">لوحة الإدارة</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('dashboard.needs') }}">إدارة الحوجات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('dashboard.donations') }}">إدارة التبرعات</a>
                </li>
                <li class="nav-item">
                    {{-- <a class="nav-link text-white" href="{{ route('admin.requests') }}">إدارة طلبات الحوجات</a> --}}
                </li>
                <li class="nav-item">
                    {{-- <a class="nav-link text-white" href="{{ route('admin.profile') }}">البروفايل</a> --}}
                </li>
                <li class="nav-item">
                    {{-- <a  class="nav-link text-white" href="{{ route('logout') }}">تسجيل الخروج</a> --}}
                </li>
            </ul>
        </nav>

        <!-- الجزء الأوسط -->
        <main class="flex-grow-1 p-4">
            @yield('content')
        </main>
    </div>
</body>
</html>