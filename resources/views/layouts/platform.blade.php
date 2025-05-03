<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية - منصة سواعد </title>
    <!-- ربط ملف CSS المحلي من Bootstrap -->
   {{-- <link href="{{ asset('bootstrap/css/bootstrap.rtl.min.css') }}" rel="stylesheet">  --}}
   
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
       html, body {
           height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            font-family: 'Tajawal', sans-serif;
        }
        main {
            flex: 1;
        }
        .fw-bold:hover {
            color: rgba(236, 146, 12, 0.849)
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand .logo {
            margin-right: 10px;
        }
        .auth-links a {
            border: none !important;
        }
        .navbar-brand span {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }
        .navbar {
            background-color: rgb(13, 95, 13) !important;
        }
        footer {
            background-color: black !important;
            color: white !important;
            text-align: center;
            padding: 1rem 0;
        }
            .auth-links a {
                color: white;
                background: none;
                text-decoration: none;
                padding: 0 5px;
            }
            .auth-links a:hover {
                background-color: rgba(180, 212, 180, 0.8);
                border-radius: 5px;
                padding: 5px;
            }
        
        .navbar-nav .nav-link {
            color: white !important;
        }
        .logo {
            height: 40px; /* زيادة حجم الشعار */
            border-radius: 60%;
            margin-right: 5px; إضافة مسافة بين الشعار واسم المنصة
            background-color: transparent;
        }
        
        /* .navbar-nav .nav-link {
            margin: 0 10px;
            font-weight: 500;
        } */
        .auth-links a {
            margin-left: 5px;
            font-weight: 500;
        }
        .logo {
            height: 40px;
            margin-left: 10px;
            border-radius: 60%
        }
        .fav{
            border-radius: 60%
        }

        /* تأثير hover لروابط الصفحاpath: path: ت */
        .navbar-nav .nav-link {
            color: white !important;
            margin: 0 10px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.3s ease, padding 0.3s ease; /* تأثير سلس */
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(180, 212, 180, 0.8); /* نفس تأثير تسجيل الدخول */
            border-radius: 5px;
            padding: 5px; /* إضافة مسافة داخلية عند التمرير */
        }

        /* تأثير hover لأزرار تسجيل الدخول وإنشاء حساب */
        .auth-links a {
            color: white;
            background: none;
            text-decoration: none;
            padding: 0 5px;
            transition: background-color 0.3s ease, padding 0.3s ease;
        }

        .auth-links a:hover {
            background-color: rgba(180, 212, 180, 0.8);
            border-radius: 5px;
            padding: 5px;
        }
    </style>
    <link rel="icon" href="{{ asset(path: 'storage/logo.jpeg') }}" class="fav" type="image/jpeg">

</head>
<body>

    {{-- header --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-success py-3 shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            {{-- الشعار واسم المنصة --}}
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('storage/logo.jpeg') }}" alt="شعار المنصة" class="logo">
                <span class="fw-bold">سواعد</span>
            </a>

            {{-- الروابط --}}
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('needs.user.index') }}">حوجات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">مشاريع</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">عن سواعد</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">اتصل بنا</a>
                    </li>
                    @if (auth()->check())
                        <li class="nav-item">
                            <a href="{{ route('user.profile') }}" class="nav-link">بروفايلي</a>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- تسجيل الدخول وإنشاء حساب --}}
            <div class="auth-links d-flex align-items-center">
                @if (auth()->check())
                    <a href="{{ route('logout') }}" class="btn btn-danger rounded-pill px-3">تسجيل الخروج</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-3 me-2">تسجيل الدخول</a>
                    <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-3">إنشاء حساب</a>
                @endif
            </div>
        </div>
    </nav>

    {{-- محتوى الصفحة --}}
    <main class="py-4">
        @yield('content')
    </main>
    
    {{-- الفوتر --}}
    <footer style="background-color: black; color: white; text-align: center; padding: 1rem 0; position: relative; width: 100%; bottom: 0;"> 
        جميع الحقوق محفوظة منصة سواعد  
    </footer>

    {{-- ربط سكريبت Bootstrap المحلي --}}
    {{-- <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>--}}  
</body> 
</html>