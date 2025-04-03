<!-- filepath: resources/views/admin/needs/create.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>إضافة حوجة جديدة</h1>
        <form action="{{ route('needs.store') }}" method="POST" enctype="multipart/form-data">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            <div class="form-group">
                <label for="title">العنوان</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">الوصف</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">الفئة</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="">اختر الفئة</option>
                    <option value="food">غذاء</option>
                    <option value="health">صحة</option>
                    <option value="education">تعليم</option>
                    <option value="others">أخرى</option>
                </select>
            </div>
            </div>
            <div class="form-group">
                <label for="amount">المبلغ المطلوب </label>
                <input type="number" name="amount" id="amount" class="form-control">
            </div>
            <div class="form-group">
                <label for="image_path">مسار الصورة</label>
                <input type="file" name="image_path" id="image_path" class="form-control">
            </div>
            {{-- <div class="form-group">
                <label for="image_path">مسار الصورة</label>
                <input type="text" name="image_path" id="image_path" class="form-control">
            </div> --}}
            {{-- <div class="form-group">
                <label for="supp_doc">المستند الداعم</label>
                <input type="text" name="supp_doc" id="supp_doc" class="form-control">
            </div> --}}
            <div class="form-group">
                <label for="isUrgent">هل الحوجة عاجلة؟</label>
                <input type="checkbox" name="isUrgent" id="isUrgent" value="1">
            </div>
            <button type="submit" class="btn btn-primary">إضافة</button>
        </form>
    </div>
@endsection