<!-- filepath: resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <link rel="icon" href="{{ asset(path: 'storage/greenLogo.jpeg') }}" class="fav" type="image/jpeg">
</head>
<body>
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

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

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

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>

    <div class="container">
        <h2>تسجيل الدخول</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="intended" value="{{ session('url.intended') }}">
            
            <label for="email">البريد الإلكتروني:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <label for="password">كلمة المرور:</label>
            <input type="password" id="password" name="password" required>

            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            

            <button type="submit">تسجيل الدخول</button>
        </form>
        <div class="login-link">
            <p>ليس لديك حساب؟ <a href="{{ route('register') }}">إنشاء حساب</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const needId = localStorage.getItem('redirect_to_donation');
            if (needId) {
                // أضف معرف الحوجة إلى نموذج تسجيل الدخول
                const loginForm = document.querySelector('form');
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'redirect_to_donation';
                hiddenInput.value = needId;
                loginForm.appendChild(hiddenInput);

                // احذف معرف الحوجة من Local Storage بعد إضافته إلى النموذج
                localStorage.removeItem('redirect_to_donation');
            }
        });
    </script>
</body>
</html>