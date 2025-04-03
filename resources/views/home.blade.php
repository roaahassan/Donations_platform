<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية - منصة التبرعات</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            direction: rtl;
        }
        .logo {
            float: left;
            border-radius: 50%;
            max-width: 100px;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #4CAF50;
            padding: 1rem;
        }
        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 1rem;
        }
        .navbar ul li {
            display: inline;
        }
        .navbar ul li a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
        }
        .navbar ul li a:hover {
            background-color: #45a049;
            border-radius: 5px;
        }
        .auth-links {
            display: flex;
            gap: 1rem;
        }
        .auth-links a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
        }
        .auth-links a:hover {
            background-color: #45a049;
            border-radius: 5px;
        }
    </style>
    <link rel="icon" href="{{ asset('images/logo_2.jpeg') }}" type="image/png">
</head>
<body>
    <header class="navbar">
        <img src="{{ asset('images/logo_2.jpeg') }}" alt="Logo" class="logo">
        <ul>
            <li><a href="#">اطلب</a></li>
            <li><a href="#">مشاريعنا</a></li>
            <li><a href="#">عن الجمعية</a></li>
            <li><a href="#">اتصل بنا</a></li>
        </ul>
        <div class="auth-links">
            <a href="#">انشاء حساب</a>
            <a href="#">تسجيل الدخول</a>
        </div>
    </header>
</head>
    <header style="background-color: #4CAF50; color: white; padding: 1rem 0; text-align: center;">
        <img src="{{ asset('images/logo_2.jpeg') }}" alt="Logo" class="logo">
    <header style="background-color: #4CAF50; color: white; padding: 1rem 0; text-align: center;">
        <h1>مرحبًا بكم في منصة التبرعات</h1>
    </header>
    <main style="padding: 2rem;">
        <section style="margin-bottom: 2rem;">
            <h2 style="border-bottom: 2px solid #4CAF50; padding-bottom: 0.5rem;">من نحن</h2>
            <p>نحن ملتزمون بمساعدة المحتاجين من خلال التبرعات السخية.</p>
        </section>
        <section>
            <h2 style="border-bottom: 2px solid #4CAF50; padding-bottom: 0.5rem;">التبرعات الأخيرة</h2>
            <!-- Example of looping through donations -->
            @if(isset($donations) && count($donations) > 0)
                <ul style="list-style-type: none; padding: 0;">
                    @foreach($donations as $donation)
                        <li style="background-color: #fff; margin-bottom: 0.5rem; padding: 1rem; border: 1px solid #ddd; border-radius: 5px;">
                            {{ $donation->name }} تبرع بمبلغ ${{ $donation->amount }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>لا توجد تبرعات حديثة.</p>
            @endif
        </section>
    </main>
    <footer style="background-color: #333; color: white; text-align: center; padding: 1rem 0; position: fixed; width: 100%; bottom: 0;">
        <p>&copy; {{ date('Y') }} منصة التبرعات. جميع الحقوق محفوظة.</p>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>