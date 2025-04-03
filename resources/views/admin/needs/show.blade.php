@extends('layouts.admin')
@section('title', 'تفاصيل الحوجة')
@section('content')
    <div class="container">
        <h1>تفاصيل الحوجة</h1>
        <p><strong>العنوان:</strong> {{ $need->title }}</p>
        <p><strong>تاريخ الإنشاء:</strong> {{ $need->created_at }}</p>
        <p><strong>تاريخ التحديث:</strong> {{ $need->updated_at }}</p>
        <p><strong>الحالة:</strong> 
            @php
                $statuses = ['open' => 'مفتوحة', 'incomplete' => 'غير مكتملة', 'complete' => 'مكتملة'];
            @endphp
            {{ $statuses[$need->need_status] ?? 'غير معروف' }}
        </p>
        <p><strong>الفئة:</strong> 
            @php
                $categories = ['health' => 'صحة', 'education' => 'تعليم', 'food' => 'غذاء'];
            @endphp
            {{ $categories[$need->category] ?? 'غير معروف' }}
        </p>
        <p><strong>الوصف:</strong> {{ $need->description }}</p>
        <p><strong>المبلغ المطلوب:</strong> {{ $need->amount }}</p>
        <p><strong>المبلغ المجمع:</strong> {{ $need->collected_amount }}</p>
        <p><strong>أولوية الحوجة:</strong> {{ $need->isUrgent ? 'عاجلة' : 'غير عاجلة' }}</p>
        <p><strong>الفئة:</strong> {{ $need->category }}</p>
        <a href="{{ route('needs.index') }}" class="btn btn-primary">رجوع</a>
    </div>
@endsection