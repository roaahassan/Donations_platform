@extends('layouts.platform')

@section('content')

  <div class="container mt-2">
    <h3> بيانات التبرع </h3>

    <form action="{{ route('donation.store') }}" method="POST">
      @csrf
      <input type="hidden" name="need_id" id="need_id" value="{{ $need->id }}">

      <div class="mb-3">
        <label for="bankSelect" class="form-label">اختر البنك</label>
        <select class="form-select" id="bankSelect" name="bank_account_id" required>
          <option selected disabled>-- اختر البنك --</option>
          @foreach($bank_accounts as $bank_account)
            <option 
              value="{{ $bank_account->id }}" 
              data-account="{{ $bank_account->account_number }}">
              {{ $bank_account->bank_name }} - {{ $bank_account->account_number }}>
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="accountNumber" class="form-label">رقم الحساب</label>
        <input type="text" class="form-control" id="accountNumber" readonly>
      </div>

      <!-- المبلغ الذي يود المتبرع التبرع به -->
     <div class="mb-3">
       <label for="donationAmount" class="form-label">المبلغ الذي تود التبرع به</label>
       <input type="number" class="form-control" id="donationAmount" name="donation_amount" placeholder="أدخل المبلغ" required>
     </div>

      <div class="alert alert-warning mt-3">
        <p>يرجى حفظ رقم الحساب وإجراء التحويل البنكي، ثم إرفاق إيصال التبرع بالأسفل.</p>
      </div>

      @if(Auth::check())
          <!-- إذا كان المستخدم مسجل الدخول -->
          <button type="submit" class="btn btn-primary">تبرع الآن</button>
      @else
          <!-- إذا لم يكن المستخدم مسجل الدخول -->
          <a href="{{ route('login') }}" class="btn btn-primary">سجل الدخول للتبرع</a>
      @endif
    </form>

    <!-- Modal لإرفاق الإيصال -->
    <div class="modal fade" id="uploadReceiptModal" tabindex="-1" aria-labelledby="uploadReceiptModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="uploadReceiptModalLabel">رفع إيصال التبرع</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="receiptForm" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="need_id" id="modalNeedId" value="{{ $need->id }}">
              <input type="hidden" name="bank_account_id" id="modalBankId">

              <p class="text-warning mb-2">تأكد من أنك قمت بالتحويل الى رقم الحساب اعلاه قبل رفع الإيصال.</p>

              <div class="mb-3">
                <label>البنك المحوّل إليه</label>
                <input type="text" class="form-control" id="modalBankName" readonly>
              </div>

              <div class="mb-3">
                <label>رقم الحساب</label>
                <input type="text" class="form-control" id="modalAccountNumber" readonly>
              </div>

              <!-- تاريخ التحويل -->
              <div class="mb-3">
                <label for="transferDate" class="form-label">تاريخ التحويل</label>
                <input type="date" class="form-control" id="transferDate" name="transfer_date" required>
              </div>

              <div class="mb-3">
                <label>أرفق صورة الإيصال</label>
                <input type="file" name="receipt" class="form-control" required>
              </div>

              <div id="formAlert" class="alert d-none mt-2"></div>

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
    const bankSelect = document.getElementById('bankSelect');
    const accountNumberInput = document.getElementById('accountNumber');
    const modalBankNameInput = document.getElementById('modalBankName');
    const modalAccountNumberInput = document.getElementById('modalAccountNumber');
    const modalBankIdInput = document.getElementById('modalBankId');

    bankSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        
        // تحديث حقل رقم الحساب
        const accountNumber = selectedOption.getAttribute('data-account');
        accountNumberInput.value = accountNumber || '';

        // تحديث الحقول الخاصة بالنافذة المنبثقة
        const bankName = selectedOption.text.split(' - ')[0];
        modalBankNameInput.value = bankName || '';
        modalAccountNumberInput.value = accountNumber || '';
        modalBankIdInput.value = selectedOption.value || '';
    });
});

document.getElementById('receiptForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const alertBox = document.getElementById('formAlert');
    alertBox.classList.add('d-none');

    fetch("{{ route('donation.store') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData
    })
    .then(async response => {
        const data = await response.json();
        if (response.ok) {
            alertBox.className = 'alert alert-success mt-2';
            alertBox.textContent = data.message || 'تم رفع الإيصال بنجاح';
            alertBox.classList.remove('d-none');
            form.reset();

            // إغلاق النافذة المنبثقة بعد ثانيتين
            const modal = bootstrap.Modal.getInstance(document.getElementById('uploadReceiptModal'));
            setTimeout(() => {
                modal.hide();
            }, 2000);
        } else {
            throw data;
        }
    })
    .catch(errorData => {
        let errors = errorData.errors || {};
        let messages = Object.values(errors).flat().join('\n');
        alertBox.className = 'alert alert-danger mt-2';
        alertBox.textContent = messages || 'حدث خطأ أثناء الرفع';
        alertBox.classList.remove('d-none');
    });
});
</script>
@endpush