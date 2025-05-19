كود واجهة إدارة  طلبات الحوجات

 <h2>طلبات الحوجات</h2>

@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div style="color: red;">{{ session('error') }}</div>
@endif

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>العنوان</th>
            <th>الوصف</th>
            <th>المبلغ</th>
            <th>الفئة</th>
            <th>الرقم الوطني</th>
            <th>الصورة</th>
            <th>المستند</th>
            <th>الحالة</th>
            <th>تاريخ الطلب</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($needRequests as $request)
            <tr>
                <td>{{ $request->title }}</td>
                <td>{{ $request->description }}</td>
                <td>{{ $request->amount }}</td>
                <td>
                    @switch($request->category)
                        @case('health') صحة @break
                        @case('food') غذاء @break
                        @case('education') تعليم @break
                        @default أخرى
                    @endswitch
                </td>
                <td>{{ $request->national_id }}</td>
                <td>
                    @if ($request->image)
                        <a href="{{ asset('storage/' . $request->image) }}" target="_blank">عرض</a>
                    @else لا توجد
                    @endif
                </td>
                <td>
                    @if ($request->supporting_document)
                        <a href="{{ asset('storage/' . $request->supporting_document) }}" target="_blank">عرض</a>
                    @else لا يوجد
                    @endif
                </td>
                <td>
                    @switch($request->status)
                        @case('waiting') <span style="color: gray;">معلق</span> @break
                        @case('pending') <span style="color: orange;">قيد المراجعة</span> @break
                        @case('accepted') <span style="color: green;">تم القبول</span> @break
                        @case('rejected') <span style="color: red;">تم الرفض</span> @break
                    @endswitch
                </td>
                <td>{{ $request->created_at->format('Y-m-d') }}</td>
                <td>
                    @if($request->status === 'waiting')
                        <form action="{{ route('admin.need_requests.review', $request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" onclick="return confirm('هل تريد بدء مراجعة هذا الطلب؟')">بدء المراجعة</button>
                        </form>
                    @elseif($request->status === 'pending')
                        <form action="{{ route('admin.need_requests.accept', $request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" onclick="return confirm('هل أنت متأكد من قبول الطلب؟')">قبول</button>
                        </form>

                        <form action="{{ route('admin.need_requests.reject', $request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" onclick="return confirm('هل أنت متأكد من رفض الطلب؟')">رفض</button>
                        </form>
                    @else
                        <span>تمت المراجعة</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $needRequests->links() }}