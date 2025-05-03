<!-- filepath: resources/views/logout.blade.php -->
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الخروج</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset(path: 'storage/logo.jpeg') }}" class="fav" type="image/jpeg">
</head>
<body>
    <div class="container text-center mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">تسجيل الخروج</h2>
                <p class="card-text">هل أنت متأكد أنك تريد تسجيل الخروج؟</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">تسجيل الخروج</button>
                </form>
                <a href="{{ route('home') }}" class="btn btn-secondary mt-3">إلغاء</a>
            </div>
        </div>
    </div>
    @vite('resources/js/app.js')
</body>
</html>