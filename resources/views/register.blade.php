<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد</title>
    <style>
        body {
            font-family: sans-serif;
            direction: rtl; /* اتجاه النص من اليمين إلى اليسار */
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .navbar {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: right; /* محاذاة عناصر التنقل إلى اليمين */
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    {{-- <div class="navbar">
        <a href="#">شعار</a>
        <a href="#">طلب مشاريعنا</a>
        <a href="#">عن الجمعية</a>
        <a href="#">اتصل بنا</a>
        <a href="{{ route('register') }}">إنشاء حساب</a>
        <a href="#">تسجيل دخول</a>
    </div> --}}

    <div class="container">
        <h1>إنشاء حساب جديد</h1>
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <label for="name">الاسم:</label>
            <input type="text" id="name" name="name" required>

            <label for="phone">رقم الهاتف:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="email">البريد الإلكتروني:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">كلمة المرور:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">إرسال</button>
        </form>
        <div class="login-link">
            <p>هل لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
        </div>
    </div>
</body>
</html>