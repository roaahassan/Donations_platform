<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الأدمن - منصة التبرعات</title>
    <!-- ربط Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="icon" href="{{ asset('storage/logo.jpeg') }}" class="fav" type="image/jpeg">
    <style>
        body {
            background-color: #f8f9fa; /* لون خلفية مميز */
            font-family: 'Tajawal', sans-serif;
            height: 100vh; /* جعل الصفحة تأخذ كامل ارتفاع النافذة */
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .register-container {
            width: 100%;
            max-width: 500px;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .register-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .register-header h2 {
            font-weight: bold;
            color: #343a40;
        }
        .register-header p {
            color: #6c757d;
        }
        .btn-primary {
            background-color: #343a40;
            border: none;
        }
        .btn-primary:hover {
            background-color: #495057;
        }
        label {
            text-align: right; /* جعل النصوص تظهر في جهة اليمين */
            display: block; /* لضمان أن النصوص تظهر فوق الحقول */
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h2>تسجيل حساب أدمن</h2>
            <p>يرجى ملء البيانات لإنشاء حساب أدمن جديد</p>
        </div>
        <form method="POST" action="{{ route('admin.register') }}">
            @csrf
            <style>
                input::placeholder {
                    text-align: right; /* جعل النصوص داخل placeholder تظهر في جهة اليمين */
                }
                input {
                    direction: rtl; /* جعل اتجاه الكتابة داخل حقول الإدخال من اليمين إلى اليسار */
                }
            </style>
            <div class="mb-3">
                <label for="name" class="form-label">الاسم</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="أدخل اسمك" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">رقم الهاتف</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="أدخل رقم هاتفك" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="********" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">إنشاء الحساب</button>
        </form>
    </div>
    <!-- ربط Bootstrap -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>