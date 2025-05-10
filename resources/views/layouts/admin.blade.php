<!-- filepath: resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>لوحة الإدارة</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <header class="bg-success text-white py-2 text-center">
        <h1 style="font-size: 1.5rem;">مرحباً بك في لوحة الإدارة</h1>
    </header>
    <style>
        footer p {
            direction: rtl;
            text-align: center;
            font-size: 1rem;
        }
    </style>
        <link rel="icon" href="{{ asset(path: 'storage/greenLogo.jpeg') }}" class="fav" type="image/jpeg">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="d-flex flex-grow-1">
        <!-- الشريط الجانبي -->
        <nav class="bg-dark text-white p-4" style="width: 220px; height: 100vh; position: fixed; top: 0; overflow-y: auto;">
            <h4 class="text-center" >لوحة الإدارة</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white mt-4" href="{{ route('admin.dashboard') }}">الرئيسية</a>
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
                    <a class="nav-link text-white" href="{{ route('profile.index') }}">البروفايل</a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link text-white" href="{{ route('logout') }}">تسجيل الخروج</a>
                </li>
            </ul>
        </nav>

        <!-- الجزء الأوسط -->
        <main class="flex-grow-1 p-4" style="margin-right: 220px;">
            @yield('content')
        </main>
    </div>
    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3 mt-auto" style="margin-right: 220px;">
        <p> منصة سواعد جميع الحقوق محفوظة </p>
    </footer>
</body>
</html>