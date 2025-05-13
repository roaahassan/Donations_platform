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
            margin: 20px auto;
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
            font-size: 16px;
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
        .form-checkbox {
            display: flex;
            align-items: center;
            justify-content: flex-start; /* محاذاة المحتوى إلى اليمين */
            margin-bottom: 15px;
        }
        .form-checkbox input {
            /* margin-right: 10px; */
            order: 1; /* اجعل مربع الاختيار يظهر قبل النص */
            margin-left: 10px; /* إضافة مسافة بين النص ومربع الاختيار */
        }
        .form-checkbox label {
            order: 2; /* اجعل النص يظهر بعد مربع الاختيار */
            display: inline-block;
            margin-left: 10px; /* إضافة مسافة بين النص ومربع الاختيار */
            margin: 0;
        }
        .form-checkbox a {
            color: #4CAF50;
            text-decoration: none;
        }
        .form-group {
            text-align: center;
        }
        .form-group button {
            display: inline-block;
            margin-top: 10px;
        }
        .text-danger {
            color: red;
            font-size: 14px;
        }
        .text-warning {
            color: #ffae00;
            font-size: 16px;
        }
        button#submitBtn {
        display: block; /* اجعل الزر يظهر كعنصر block */
        margin: 20px auto; /* اجعل الزر في المنتصف أفقياً */
        text-align: center; /* محاذاة النص داخل الزر */
        background-color: #4CAF50; /* لون الخلفية */
        color: white; /* لون النص */
        padding: 10px 20px; /* مسافة داخلية */
        border: none; /* إزالة الحدود */
        border-radius: 5px; /* زوايا مستديرة */
        cursor: pointer; /* تغيير المؤشر عند التمرير */
        }
        button#submitBtn:hover {
            background-color: #45a049; /* لون الخلفية عند التمرير */
        }
        
    </style>
        <link rel="icon" href="{{ asset(path: 'storage/greenLogo.jpeg') }}" class="fav" type="image/jpeg">
</head>
<body>
    
    <div class="container">
        <h1>إنشاء حساب جديد</h1>
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <label for="name">الاسم:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            <small class="text-warning" style="color: #ffae00; margin:2px; font-size:16px;">يرجى التأكد من إدخال الاسم الصحيح، لأنه لا يمكن تعديله بعد إنشاء الحساب.</small>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror 

            <label for="phone">رقم الهاتف:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="email">البريد الإلكتروني:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="password">كلمة المرور:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            
            <div class="form-checkbox mt-3">
                <input class="form-check-input" type="checkbox" id="termsCheckbox" required>
                <label class="form-check-label" for="termsCheckbox">
                    أقر بأنني قرأت و أوافق على سياسات وأحكام استخدام المنصة
                    <a href="{{ route('policies') }}">قراءة المزيد</a>
                </label>
            </div>
            
            
            <button type="submit" id="submitBtn" style="display: none;">تسجيل</button>
           
        </form>
        <div class="login-link">
            <p>هل لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const termsCheckbox = document.getElementById('termsCheckbox');
        const submitBtn = document.getElementById('submitBtn');
    
        // إخفاء الزر افتراضيًا
        submitBtn.style.display = 'none';
    
        // إضافة حدث عند تغيير حالة الـ checkbox
        termsCheckbox.addEventListener('change', function () {
            console.log('Checkbox state changed:', this.checked); // Debugging
            if (this.checked) {
                submitBtn.style.display = 'block'; // إظهار الزر عند تحديد checkbox
            } else {
                submitBtn.style.display = 'none'; // إخفاء الزر عند إلغاء التحديد
            }
        });
    });
    </script>
    {{-- <script>
        // إظهار الزر عند تحميل الصفحة إذا كان الـ checkbox محددًا
        document.addEventListener('DOMContentLoaded', function () {
            const termsCheckbox = document.getElementById('termsCheckbox');
            const submitBtn = document.getElementById('submitBtn');
    
            if (termsCheckbox.checked) {
                submitBtn.style.display = 'block'; // إظهار الزر إذا كان checkbox محددًا
            }
        });
    </script> --}}
</body>
</html>