{{-- filepath: c:\xampp\htdocs\Donations_platform\resources\views\admin\admin_need_requests.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container py-3">
    <h2 class="mb-4 text-center fw-bold" style="color:#198754;">طلبات الحوجات</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show w-75 mx-auto" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show w-75 mx-auto" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle shadow-sm bg-white">
            <thead class="table-success text-center">
                <tr>
                    <th>العنوان</th>
                    <th>الوصف</th>
                    <th>المبلغ</th>
                    <th>الفئة</th>
                    <th>الرقم الوطني</th>
                    {{-- <th>الصورة</th>
                    <th>المستند</th> --}}
                    <th>الحالة</th>
                    <th>تاريخ الطلب</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($needRequests as $request)
                    <tr>
                        <td>{{ $request->title }}</td>
                        <td style="max-width: 200px; white-space: pre-line;">{{ Str::limit($request->description, 80) }}</td>
                        <td class="text-center">{{ number_format($request->amount) }}</td>
                        <td class="text-center">
                            @switch($request->category)
                                @case('health') صحة @break
                                @case('food') غذاء @break
                                @case('education') تعليم @break
                                @default أخرى
                            @endswitch
                        </td>
                        <td class="text-center">{{ $request->national_id ?? '---' }}</td>
                        {{-- <td class="text-center">
                            @if ($request->image)
                                <a href="{{ asset('storage/' . $request->image) }}" target="_blank" class="btn btn-outline-primary btn-sm">عرض</a>
                            @else
                                <span class="text-muted">لا توجد</span>
                            @endif
                        </td> --}}
                        {{-- <td class="text-center">
                            @if ($request->supporting_document)
                                <a href="{{ asset('storage/' . $request->supporting_document) }}" target="_blank" class="btn btn-outline-secondary btn-sm">عرض</a>
                            @else
                                <span class="text-muted">لا يوجد</span>
                            @endif
                        </td> --}}
                        <td class="text-center">
                            @switch($request->status)
                                @case('waiting') <span class="badge bg-secondary">معلق</span> @break
                                @case('pending') <span class="badge bg-warning text-dark">قيد المراجعة</span> @break
                                @case('accepted') <span class="badge bg-success">تم القبول</span> @break
                                @case('rejected') <span class="badge bg-danger">تم الرفض</span> @break
                            @endswitch
                        </td>
                        <td class="text-center">{{ $request->created_at->format('Y-m-d') }}</td>
                        <td class="text-center">
                            @if($request->status === 'waiting')
                                <form action="{{ route('admin.need_requests.review', $request->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm" onclick="return confirm('هل تريد بدء مراجعة هذا الطلب؟')">بدء المراجعة</button>
                                </form>
                            @elseif($request->status === 'pending')
                                <form action="{{ route('admin.need_requests.accept', $request->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('هل أنت متأكد من قبول الطلب؟')">قبول</button>
                                </form>
                                <form action="{{ route('admin.need_requests.reject', $request->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من رفض الطلب؟')">رفض</button>
                                </form>
                            @else
                                <span class="text-muted">تمت المراجعة</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $needRequests->links() }}
    </div>
</div>
@endsection