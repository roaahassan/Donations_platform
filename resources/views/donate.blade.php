@extends('layouts.platform')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">التبرع للحوجة: {{ $need->title }}</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('donate.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- إخفاء حقل الحوجة -->
    <input type="hidden" name="need_id" value="{{ $need->id }}">

    <!-- اختيار البنك -->
    <div class="mb-3">
      <label for="bankSelect" class="form-label">اختر البنك</label>
      <select class="form-select @error('bank_account_id') is-invalid @enderror" id="bankSelect" name="bank_account_id" required>
        <option selected disabled>-- اختر البنك --</option>
        @foreach($bank_accounts as $bank_account)
          <option value="{{ $bank_account->id }}" {{ old('bank_account_id') == $bank_account->id ? 'selected' : '' }}>
            {{ $bank_account->bank_name }} - {{ $bank_account->account_number }}
          </option>
        @endforeach
      </select>
      @error('bank_account_id')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- مبلغ التبرع -->
    <div class="mb-3">
      <label for="donation_amount" class="form-label">مبلغ التبرع (بالجنيه)</label>
      <input type="number" class="form-control @error('donation_amount') is-invalid @enderror" name="donation_amount" id="donation_amount" value="{{ old('donation_amount') }}" min="1" required>
      @error('donation_amount')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- تاريخ التحويل -->
    <div class="mb-3">
      <label for="transfer_date" class="form-label">تاريخ التحويل</label>
      <input type="date" class="form-control @error('transfer_date') is-invalid @enderror" name="transfer_date" id="transfer_date" value="{{ old('transfer_date') }}" required>
      @error('transfer_date')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- رفع الإيصال -->
    <div class="mb-3">
      <label for="receipt" class="form-label">إرفاق إيصال التحويل</label>
      <input type="file" class="form-control @error('receipt') is-invalid @enderror" name="receipt" id="receipt" accept=".jpg,.jpeg,.png,.pdf" required>
      @error('receipt')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- زر الإرسال -->
    <button type="submit" class="btn btn-primary">إرسال التبرع</button>
  </form>
</div>
@endsection