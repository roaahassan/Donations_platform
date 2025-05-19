@extends('layouts.platform')

@section('content')
<div class="container mt-2" dir="rtl">
    <h3 class="mb-4 text-center">نموذج تقديم طلب حوجة</h3>

    {{-- رسالة النجاح --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('need_requests.store') }}" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">عنوان الحوجة</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title') }}" placeholder="مثال: رسوم دراسية، علاج طارئ...">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">وصف الحوجة</label>
            <textarea name="description" id="description" rows="4"
                      class="form-control @error('description') is-invalid @enderror"
                      placeholder="يرجى كتابة تفاصيل الحالة بوضوح..."
                      value="{{ old('description') }}"> </textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estimated_amount" class="form-label">المبلغ التقديري (جنيه سوداني)</label>
            <input type="number" name="estimated_amount" id="estimated_amount"
                   class="form-control @error('estimated_amount') is-invalid @enderror"
                   value="{{ old('estimated_amount') }}" placeholder="أدخل المبلغ المطلوب تقريباً">
            @error('estimated_amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- الرقم الوطني --}}
        <div class="mb-3">
            <label for="national_id" class="form-label">الرقم الوطني</label>
            <input type="text" name="national_id" id="national_id"
                   class="form-control @error('national_id') is-invalid @enderror"
                   value="{{ old('national_id') }}" placeholder="أدخل الرقم الوطني">
            @error('national_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- فئة الحوجة --}}
        <div class="mb-3">
            <label for="category" class="form-label">فئة الحوجة</label>
            <select name="category" id="category" class="form-select @error('category') is-invalid @enderror">
                <option value="">اختر الفئة</option>
                <option value="health" {{ request('category') == 'health' ? 'selected' : '' }}>صحة </option>
                <option value="food" {{ request('category') == 'food' ? 'selected' : '' }}>غذاء </option>
                <option value="education" {{ request('category') == 'education' ? 'selected' : '' }}>تعليم </option>
                <option value="others" {{ request('category') == 'others' ? 'selected' : '' }}>أخرى </option>
            </select>
            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- صورة توضح الحوجة --}}
        <div class="mb-3">
            <label for="image" class="form-label">صورة توضح الحوجة</label>
            <input type="file" name="image" id="image"
                   class="form-control @error('image') is-invalid @enderror" accept="image/*">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="supporting_document" class="form-label">المستند الداعم (اختياري)</label>
            <input type="file" name="supporting_document" id="supporting_document"
                   class="form-control @error('supporting_document') is-invalid @enderror">
            @error('supporting_document')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

       <div class="form-checkbox mb-3">
            <input class="form-check-input "
                type="checkbox" name="confirmation" id="confirmation" required>
            <label class="form-check-label" for="confirmation">
                أقر بأن جميع البيانات التي قدمتها صحيحة ودقيقة
            </label>
        
     </div>
        <button type="submit" class="btn btn-primary">إرسال الطلب</button>
    </form>
</div>
@endsection

