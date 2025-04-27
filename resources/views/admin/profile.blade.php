@extends('layouts.admin')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-center mb-4">صفحة البروفايل</h2>

    <!-- تعديل البيانات الشخصية -->
    <div class="card mb-4">
        <div class="card-header">تعديل البيانات الشخصية</div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">الاسم</label>
                <input type="text" id="name" class="form-control" value="{{ auth()->user()->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور الجديدة</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </form>
        </div>
        {{-- <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">الاسم</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" required>
                </div>
                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </form>
        </div> --}}
    </div>

    <!-- عرض الإشعارات -->
    <div class="card mb-4">
        <div class="card-header">الإشعارات</div>
        <div class="card-body">
            <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#notificationsModal">
                عرض الإشعارات
                <span class="badge bg-danger">{{ auth()->user()->notifications()->where('is_read', false)->count() }}</span>
            </a>
        </div>
    </div>
    <!-- Modal لعرض الإشعارات -->
<div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationsModalLabel">الإشعارات</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (auth()->user()->notifications->isEmpty())
                    <p>لا توجد إشعارات جديدة.</p>
                @else
                    <ul class="list-group">
                        @foreach (auth()->user()->notifications as $notification)
                            <li class="list-group-item {{ $notification->is_read ? 'bg-light' : 'bg-warning' }}">
                                <h5>{{ $notification->title }}</h5>
                                <p>{{ $notification->message }}</p>
                                <small>تاريخ الإشعار: {{ $notification->created_at->format('Y-m-d H:i') }}</small>

                                @if (!$notification->is_read)
                                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">تحديد كمقروء</button>
                                    </form>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>

    <!-- تسجيل الخروج -->
    {{-- <div class="card">
        <div class="card-header">تسجيل الخروج</div>
        <div class="card-body">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">تسجيل الخروج</button>
            </form>
        </div>
    </div> --}}
</div>
@endsection