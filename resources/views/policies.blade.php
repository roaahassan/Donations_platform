@extends('layouts.platform')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0">
        <div class="card-body">
            <h2 class="mb-4 text-center text-primary">سياسات وأحكام استخدام المنصة</h2>
            
            <p class="mb-4 text-muted">
                مرحبًا بك في منصتنا. باستخدامك لهذه المنصة، فإنك تقرّ وتوافق على الالتزام بالشروط والأحكام التالية:
            </p>

            <div class="mb-4">
                <h5 class="mt-4 text-secondary">
                    <i class="bi bi-arrow-right-circle-fill text-primary"></i> 1. استخدام المنصة
                </h5>
                <p>يُسمح لك باستخدام هذه المنصة لأغراض مشروعة فقط، ولا يجوز استخدامها بأي طريقة قد تضر بالمنصة أو تعطل خدماتها أو تنتهك حقوق الآخرين.</p>
            </div>

            <div class="mb-4">
                <h5 class="mt-4 text-secondary">
                    <i class="bi bi-arrow-right-circle-fill text-primary"></i> 2. دقة البيانات
                </h5>
                <p>أنت مسؤول عن صحة البيانات التي تقدمها أثناء إنشاء الحساب أو تقديم الطلبات. تحتفظ الإدارة بحق مراجعة أو رفض أي معلومات غير دقيقة أو مضللة.</p>
            </div>

            <div class="mb-4">
                <h5 class="mt-4 text-secondary">
                    <i class="bi bi-arrow-right-circle-fill text-primary"></i> 3. الخصوصية
                </h5>
                <p>تلتزم المنصة بالحفاظ على خصوصية بيانات المستخدمين وعدم مشاركتها مع أي طرف ثالث إلا للضرورة القانونية أو بموافقة المستخدم.</p>
            </div>

            <div class="mb-4">
                <h5 class="mt-4 text-secondary">
                    <i class="bi bi-arrow-right-circle-fill text-primary"></i> 4. التبرعات
                </h5>
                <p>تتم التبرعات عبر التحويل البنكي فقط، ويتحمل المتبرع مسؤولية إرسال الإيصال المالي بعد إتمام العملية. لا تضمن المنصة استرداد المبالغ بعد التبرع.</p>
            </div>

            <div class="mb-4">
                <h5 class="mt-4 text-secondary">
                    <i class="bi bi-arrow-right-circle-fill text-primary"></i> 5. إنهاء الاستخدام
                </h5>
                <p>يحق لإدارة المنصة إيقاف حساب أي مستخدم يخالف هذه السياسات دون إشعار مسبق.</p>
            </div>

            <div class="mb-4">
                <h5 class="mt-4 text-secondary">
                    <i class="bi bi-arrow-right-circle-fill text-primary"></i> 6. التعديلات
                </h5>
                <p>يجوز للمنصة تعديل هذه الشروط في أي وقت، ويُعد استمرار استخدامك للمنصة بعد التعديل قبولًا بالشروط الجديدة.</p>
            </div>

            <div class="mb-4">
                <h5 class="mt-4 text-danger">
                    <i class="bi bi-exclamation-triangle-fill text-danger"></i> 7. حدود المسؤولية
                </h5>
                <p>
                    لا تتحمل المنصة أو الجمعية المسؤولية عن أي تأخير في معالجة الطلبات نتيجة نقص المعلومات أو تقديم مستندات غير مكتملة.
                    كما أن الجمعية ليست مسؤولة عن أي قرارات ناتجة عن تقديم معلومات خاطئة من قبل المحتاج.
                    تعمل المنصة كوسيط بين المتبرعين والمحتاجين، ولا تتحمل مسؤولية قانونية عن محتوى الطلبات أو التبرعات.
                </p>
            </div>
            <!-- زر الرجوع -->
            <div class="text-center mt-4">
                <a href="javascript:history.back()" class="btn btn-secondary">
                    <i class="bi bi-arrow-left p-3">رجوع</i> 
                </a>
            </div>
        </div>
    </div>
</div>
@endsection