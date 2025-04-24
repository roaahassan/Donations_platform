@extends('layouts.admin')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-center mt-4 mb-4">إدارة التبرعات</h2>

    <!-- فلاتر البحث والتصفية -->
    <form action="{{ route('donations.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="donor_name" class="form-control" placeholder="اسم المتبرع" value="{{ request('donor_name') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">اختر حالة التبرع</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>بانتظار المراجعة</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>تم التأكيد</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>مرفوض</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">بحث</button>
                <a href="{{ route('donations.index') }}" class="btn btn-secondary">إعادة تعيين</a>
            </div>
        </div>
    </form>

    <!-- جدول التبرعات -->
    <table class="table table-bordered table-hover text-center align-middle">
        <thead>
            <tr>
                <th>رقم التبرع</th>
                <th>اسم المتبرع</th>
                <th>مبلغ التبرع</th>
                <th>تاريخ التبرع</th>
                <th>حالة التبرع</th>
                <th>إيصال الدفع</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($donations as $donation)
                <tr>
                    <td>{{ $donation->id }}</td>
                    <td>{{ $donation->user ? $donation->user->name : 'مجهول' }}</td>
                    <td>{{ $donation->amount }}</td>
                    <td>{{ $donation->created_at->format('Y-m-d') }}</td>
                    <td>
                        @if ($donation->status === 'pending')
                            معلق
                        @elseif ($donation->status === 'confirmed')
                            مقبول
                        @elseif ($donation->status === 'rejected')
                            مرفوض
                        @endif
                    </td>
                    <td>
                        @if ($donation->receipt_path)
                            <a href="{{ asset($donation->receipt_path) }}" target="_blank" class="btn btn-info btn-sm">عرض الإيصال</a>
                        @else
                            <span>لا يوجد إيصال</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="openReviewModal({{ $donation->id }})">مراجعة</button>
                        <form action="{{ route('donations.confirm', $donation->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">تأكيد</button>
                        </form>
                        <button class="btn btn-danger btn-sm" onclick="openRejectModal({{ $donation->id }})">رفض</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">لا توجد تبرعات لعرضها</td>
                </tr>
            @endforelse
            @empty
                <tr>
                    <td colspan="7">لا توجد تبرعات لعرضها</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- روابط التنقل -->
    <div class="mt-4">
        {{ $donations->links() }}
    </div>
</div>

<!-- نافذة المراجعة -->
<div class="modal fade" id="reviewModal{{ $donation->id }}" tabindex="-1" aria-labelledby="reviewModalLabel{{$donation->id}}" aria-hidden="true" inert>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel{{$donation->id}}">مراجعة التبرع</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- محتوى المراجعة -->
                <p id="donationDetails">
                    <strong>رقم التبرع:</strong> <span id="donationId">-</span><br>
                    <strong>اسم المتبرع:</strong> <span id="donorName">-</span><br>
                    <strong>مبلغ التبرع:</strong> <span id="donationAmount">-</span><br>
                    <strong>تاريخ التبرع:</strong> <span id="donationDate">-</span><br>
                    <strong>حالة التبرع:</strong> <span id="donationStatus">-</span><br>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- نافذة الرفض -->
<div class="modal fade" id="rejectModal{{ $donation->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $donation->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel{{$donation->id}}">رفض التبرع</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('donations.reject') }}" method="POST">
                    @csrf
                    <input type="hidden" name="donation_id" id="rejectDonationId">
                    <div class="mb-3">
                        <label for="reason" class="form-label">سبب الرفض</label>
                        <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">رفض</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and dependencies -->
{{-- <script>
    window.openReviewModal = function(donationId) {
        // Fetch donation details and open the review modal
        fetch(`{{ route('donations.show', '') }}/${donationId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('donationId').textContent = data.id || '-';
                document.getElementById('donorName').textContent = data.user_name || 'مجهول';
                document.getElementById('donationAmount').textContent = data.amount || '-';
                document.getElementById('donationDate').textContent = data.date || '-';
                document.getElementById('donationStatus').textContent = data.status || '-';
                const modal = new bootstrap.Modal(document.getElementById('reviewModal'));
                modal.show();
            })
            .catch(error => {
                document.getElementById('donationDetails').innerHTML = 'حدث خطأ أثناء جلب تفاصيل التبرع.';
            });
    }

    function openRejectModal(donationId) {
        // Open the reject modal and set the donation ID
        document.getElementById('rejectDonationId').value = donationId;
        document.querySelector('#rejectModal .modal-title').innerHTML = `رفض التبرع رقم ${donationId}`;
        const modal = new bootstrap.Modal(document.getElementById('rejectModal'));
        modal.show();
    }
</script> --}}
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script>
    if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap is not defined. Ensure the bootstrap.bundle.min.js file is correctly loaded.');
    }
</script>
@endsection
