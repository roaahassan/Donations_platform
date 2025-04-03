<!-- filepath: resources/views/admin/needs/edit.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>تعديل الحوجة</h1>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
        @endif
        <form action="{{ route('needs.update', $need->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">العنوان</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $need->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">الوصف</label>
                <textarea name="description" id="description" class="form-control" required>{{ $need->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="status">الحالة</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="pending" {{ $need->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                    <option value="approved" {{ $need->status == 'approved' ? 'selected' : '' }}>مقبول</option>
                    <option value="rejected" {{ $need->status == 'rejected' ? 'selected' : '' }}>مرفوض</option>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">المبلغ المطلوب</label>
                <input type="number" name="amount" id="amount" class="form-control" value="{{ $need->amount }}" required>
            </div>
            <div class="form-group">
                <label for="collected_amount">المبلغ المجمع</label>
                <input type="number" name="collected_amount" id="collected_amount" class="form-control" value="{{ $need->collected_amount }}">
            </div>
            
            <div class="form-group">
                <label for="image_path">مسار الصورة</label>
                <input type="text" name="image_path" id="image_path" class="form-control" value="{{ $need->image_path }}">
            </div>
            <div class="form-group">
                <label for="isUrgent">هل الحوجة عاجلة؟</label>
                <input type="hidden" name="isUrgent" value="0"> <!-- Hidden input to send false if unchecked -->
                <input type="checkbox" name="isUrgent" id="isUrgent" value="1" {{ $need->isUrgent ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label for="category">الفئة</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ $need->category }}" required>
            </div>
            <button type="submit" class="btn btn-primary">تعديل</button>
        </form>
    </div>
@endsection