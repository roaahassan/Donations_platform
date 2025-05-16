@extends('layouts.platform')

@section('content')
<div class="container">
   <!-- نموذج البحث -->
   <form method="GET" action="{{ route('needs.user.index') }}" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="ابحث عن حاجة..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="category" class="form-control">
                <option value="">اختر الفئة</option>
                <option value="health" {{ request('category') == 'health' ? 'selected' : '' }}>صحة </option>
                <option value="food" {{ request('category') == 'food' ? 'selected' : '' }}>غذاء </option>
                <option value="education" {{ request('category') == 'education' ? 'selected' : '' }}>تعليم </option>
                <option value="others" {{ request('category') == 'others' ? 'selected' : '' }}>أخرى </option>
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-30">بحث</button>
        </div>
    </div>
</form>
    <!-- عرض الحوجات -->
    <div class="row">
        @foreach($needs as $need)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <!-- صورة الحوجة -->
                    @if($need->image_path)
                        <img src="{{ asset("storage/{$need->image_path}") }}" class="card-img-top img-fluid" alt="{{ $need->title }}" style="height: 280px; object-fit: cover;">
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title text-truncate">{{ $need->title }}</h5>
                        @php
                        $categories = [
                        'health' => 'صحة',
                        'food' => 'غذاء',
                        'education' => 'تعليم',
                        'others' => 'أخرى',
                        ];
                        @endphp
                        <p class="card-text text-muted">الفئة: {{ $categories[$need->category] ?? 'غير محددة' }}</p>
                        <p class="card-text">المبلغ المطلوب: <strong>{{ $need->amount }} ج.س</strong></p>

                        <!-- شريط التقدم -->
                        @php
                            $remaining = $need->amount - $need->collected_amount;
                            $progress = $need->amount > 0 ? ($need->collected_amount / $need->amount) * 100 : 0;
                            $isComplete = $need->collected_amount >= $need->amount;
                        @endphp

                        <div class="progress mb-3" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <p class="card-text">المبلغ المتبقي: <strong>{{ $remaining }} ج.س</strong></p>

                        <!-- أزرار -->
                        @if($isComplete)
                            <div class="alert alert-success fade-in-message" role="alert">
                                <strong>جزاكم الله خيرًا</strong> الحوجة مكتملة.
                            </div>
                        @else
                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal-{{ $need->id }}">عرض التفاصيل</a>
                            {{-- @if(Auth::check())
                                <!-- إذا كان المستخدم مسجل الدخول -->
                                <a href="{{ route('donate.show', $need->id) }}" class="btn btn-success btn-sm">تبرع الآن</a>
                            @else
                                <!-- إذا لم يكن المستخدم مسجل الدخول -->
                                <a href="{{ route('login') }}" class="btn btn-success btn-sm" onclick="saveNeedIdToLocalStorage({{ $need->id }})">تبرع الآن</a>
                            @endif --}}
                            <button onclick="goToDonate({{ $need->id }})" class="btn btn-success btn-sm">تبرع الآن</button>
                        @endif
                        <!-- Modal -->
<div class="modal fade" id="detailsModal-{{ $need->id }}" tabindex="-1" aria-labelledby="detailsModalLabel-{{ $need->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-{{ $need->id }}">تفاصيل الحوجة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body">
                <p><strong>العنوان:</strong> {{ $need->title }}</p>
                <p><strong>الفئة:</strong> {{ $categories[$need->category] ?? 'غير محددة' }}</p>
                <p><strong>المبلغ المطلوب:</strong> {{ $need->amount }} ج.س</p>
                <p><strong>المبلغ المتبقي:</strong> {{ $need->amount - $need->collected_amount }} ج.س</p>
                <p><strong>الوصف:</strong> {{ $need->description }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <a href="{{ route('donate.show', $need->id) }}" class="btn btn-success">تبرع الآن</a>
            </div>
        </div>
    </div>
</div>  {{-- modal end --}}

{{-- <!-- donation Modal -->
<div class="modal fade" id="donateModal" tabindex="-1" aria-labelledby="donateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('needs.user.process_donation', $need->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <a href="{{ route('needs.user.donate', $need->id) }}" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#donateModal">تبرع الآن</a>                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="bank_name" class="form-label">اسم البنك</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="account_number" class="form-label">رقم الحساب</label>
                        <select class="form-control" id="account_number" name="account_number" required>
                            <option value="">اختر رقم الحساب</option>
                            @if(isset($bankAccounts) && $bankAccounts->count() > 0)
                                @foreach($bankAccounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->account_no }} - {{ $account->bank_name }}</option>
                                @endforeach
                            @else
                                <option value="" disabled>لا توجد حسابات بنكية متاحة</option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="transfer_date" class="form-label">تاريخ التحويل</label>
                        <input type="date" class="form-control" id="transfer_date" name="transfer_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="receipt" class="form-label">إرفاق الإيصال المالي</label>
                        <input type="file" class="form-control" id="receipt" name="receipt" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-success">تبرع الآن</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

                    </div>
                    <script>
                        function goToDonate(needId) {
                            // نحفظ المعرف والمنطق
                            
                            //const needId = this.getAttribute('data-need-id'); 
                            // افترض أن الزر يحتوي على معرف الحاجة

                            localStorage.setItem('pending_donation_need_id', needId);
                            localStorage.setItem('was_in_donate_page', 'true');
                    
                            @auth
                                window.location.href = '/donate/' + needId;
                            @else
                                window.location.href = '/login';
                            @endauth
                        }
                    </script>
                </div>
            </div>
        @endforeach
    </div>

    <!-- عرض رسالة إذا لم توجد نتائج -->
    @if($needs->isEmpty())
        <p class="text-center">لا توجد حوجات مطابقة للبحث.</p>
    @endif
</div>
@endsection

@section('styles')
    <style>
        /* تأثير fade-in عند اكتمال الحوجة */
        .fade-in-message {
            animation: fadeIn 2s ease-in-out;
            display: block;
            text-align: center;
            font-size: 1.2em;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
@endsection