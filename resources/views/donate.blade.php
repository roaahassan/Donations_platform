@extends('layouts.platform')

@section('content')
  <div class="container mt-2">
    <h3> تبرع لحوجة : {{ $need->title }} </h3>

    <!-- الفورم الأول -->
    <form id="donationForm" method="POST" action="{{ route('donation.storeInitial') }}">
      @csrf
      <input type="hidden" name="need_id" id="need_id" value="{{ $need->id }}">

      <!-- اختيار البنك -->
      <div class="mb-3">
        <label for="bankSelect" class="form-label">اختر البنك</label>
        <select class="form-select" id="bankSelect" name="bank_account_id" required>
          <option selected disabled>-- اختر البنك --</option>
          @foreach($bank_accounts as $bank_account)
            <option 
              value="{{ $bank_account->id }}" 
              data-account="{{ $bank_account->account_number }}">
              {{ $bank_account->bank_name }} - {{ $bank_account->account_number }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- المبلغ -->
      <div class="mb-3">
        <label for="donationAmount" class="form-label">المبلغ الذي تود التبرع به</label>
        <input type="number" class="form-control" id="donationAmount" name="donation_amount" placeholder="أدخل المبلغ" required>
      </div>

      <!-- زر إرسال النموذج -->
      <button type="submit" class="btn btn-primary">إرسال</button>
    </form>

    <!-- زر "ارفق إيصال التبرع" -->
    <button type="button" id="openReceiptModal" class="btn btn-success mt-3 d-none" data-bs-toggle="modal" data-bs-target="#uploadReceiptModal">
      ارفق إيصال التبرع
    </button>

    <!-- Modal لإرفاق الإيصال -->
    <div class="modal fade" id="uploadReceiptModal" tabindex="-1" aria-labelledby="uploadReceiptModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="uploadReceiptModalLabel">رفع إيصال التبرع</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="receiptForm" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="donation_id" id="donation_id">

              <!-- تاريخ التحويل -->
              <div class="mb-3">
                <label for="transferDate" class="form-label">تاريخ التحويل</label>
                <input type="date" class="form-control" id="transferDate" name="transfer_date" required>
              </div>

              <!-- رفع صورة الإيصال -->
              <div class="mb-3">
                <label>أرفق صورة الإيصال</label>
                <input type="file" name="receipt" class="form-control" required>
              </div>

              <button type="submit" class="btn btn-primary">إرسال</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('donationForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            document.getElementById('donation_id').value = data.donation_id;
            document.getElementById('openReceiptModal').classList.remove('d-none');
        })
        .catch(error => console.error('Error:', error));
    });

    document.getElementById('receiptForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        fetch("{{ route('donation.storeReceipt', ['donation' => ':donationId']) }}".replace(':donationId', document.getElementById('donation_id').value), {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            form.reset();
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>
@endpush