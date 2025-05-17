@extends('layouts.platform')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">تقديم طلب حوجة</h2>
<form action="{{ route('need_requests.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>عنوان الحوجة:</label>
    <input type="text" name="title" required><br>

    <label>وصف تفصيلي:</label>
    <textarea name="description" required></textarea><br>

    <label>المبلغ التقديري:</label>
    <input type="number" name="amount" step="0.01" required><br>

    <label>الرقم الوطني:</label>
    <input type="text" name="national_id" required><br>

    <label>فئة الحوجة:</label>
    <select name="category" required>
        <option value="health">صحة</option>
        <option value="food">غذاء</option>
        <option value="education">تعليم</option>
        <option value="other">أخرى</option>
    </select><br>

    <label>صورة:</label>
    <input type="file" name="image"><br>

    <label>مستند داعم:</label>
    <input type="file" name="supporting_document"><br>

    <label>
        <input type="checkbox" name="confirmation" required>
        أقر بأن جميع البيانات التي قدمتها صحيحة ودقيقة
    </label><br>

    <button type="submit">إرسال الطلب</button>
</form>
</div>
@endsection