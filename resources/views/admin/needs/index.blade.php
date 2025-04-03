@extends('layouts.admin')

@section('content')
    <div class="container" dir="rtl">
        <h2 class="text-center mb-4">إدارة الحوجات الميدانية</h2>
        <a href="{{ route('needs.create') }}" class="btn btn-primary mb-3">إضافة حوجة جديدة</a>
        
        <!-- عرض رسالة النجاح -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- نموذج البحث -->
        <form action="{{ route('needs.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="title" class="form-control" placeholder="البحث عن العنوان" value="{{ request('title') }}">
                </div>
                <div class="col-md-3">
                    <select name="need_status" class="form-control">
                        <option value="">اختر حالة الحوجة</option>
                        <option value="open" {{ request('need_status') == 'open' ? 'selected' : '' }}>مفتوحة</option>
                        <option value="not complite" {{ request('need_status') == 'not complite' ? 'selected' : '' }}>غير مكتملة</option>
                        <option value="complite" {{ request('need_status') == 'complite' ? 'selected' : '' }}>مكتملة</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" name="category" class="form-control" placeholder="البحث عن الفئة" value="{{ request('category') }}">
                </div>
                <div class="col-md-3">
                    <select name="isUrgent" class="form-control">
                        <option value="">اختر أولوية الحوجة</option>
                        <option value="1" {{ request('isUrgent') == '1' ? 'selected' : '' }}>عاجلة</option>
                        <option value="0" {{ request('isUrgent') == '0' ? 'selected' : '' }}>غير عاجلة</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">بحث</button>
                    <a href="{{ route('needs.index') }}" class="btn btn-secondary">إعادة تعيين</a>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-hover text-center align-middle">
            <thead>
                <tr>
                    <th>العنوان</th>
                    <th>الوصف</th>
                    <th>حالة الحوجة</th>
                    <th>المبلغ المطلوب</th>
                    <th>المبلغ المجمع</th>
                    <th>أولوية الحوجة</th>
                    <th>فئة الحوجة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($needs as $need)
                    <tr>
                        <td>{{ $need->title }}</td>
                        <td>{{ Str::limit($need->description, 50) }}</td>
                        <td>{{ $need->need_status }}</td>
                        <td>{{ $need->amount }}</td>
                        <td>{{ $need->collected_amount }}</td>
                        <td>{{ $need->isUrgent ? 'عاجلة' : 'غير عاجلة' }}</td>
                        <td>{{ $need->category }}</td>
                        <td>
                            <a href="{{ route('needs.show', $need->id) }}" class="btn btn-info btn-sm btn-block mb-1">تفاصيل</a>
                            <a href="{{ route('needs.edit', $need->id) }}" class="btn btn-warning btn-sm btn-block mb-1">تعديل</a>
                            <form action="{{ route('needs.destroy', $need->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-block">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">لا توجد بيانات لعرضها</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $needs->links() }}
        </div>

    <div class="mt-4">
        {{ $needs->links() }}
    </div>

    <!-- JavaScript لإعادة تعيين الحقل -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.update-form');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

            if (!csrfToken) {
                console.error('CSRF token not found in the meta tag.');
                return;
            }

            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); // منع الإرسال الافتراضي
                    const input = this.querySelector('.collected-amount');
                    const formData = new FormData(this);

                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // تحديث قيمة الحقل فقط
                            input.value = formData.get('collected_amount');
                            alert(data.message); // عرض رسالة نجاح
                        } else {
                            alert('حدث خطأ أثناء التحديث');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('حدث خطأ أثناء التحديث');
                    });
                });
            });
        });
    </script>
@endsection