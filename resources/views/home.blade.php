@extends('layouts.platform')

@section('content')

<style>
    body {
      font-family: 'Arial', sans-serif;
      color: #fff;
      background: none;
    }.icon-box {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 14px;
  cursor: pointer;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  margin: auto;
}

.icon-box:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.icon-box i {
  font-size: 24px;
  margin-bottom: 8px;
}
.c-item{
    height: 500px;
}

.c-img{
    height: 100%;
    
}
.donation {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 8px 20px rgba(0, 100, 0, 0.2);
  }
.donation:hover{

    transform: scale(1.02);
    box-shadow: 0 12px 25px rgba(0, 100, 0, 0.25);
}

.card{
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  box-shadow: 0 8px 20px rgba(0, 100, 0, 0.2);
}
.card:hover {
  transform: scale(1.02);
  box-shadow: 0 12px 25px rgba(0, 100, 0, 0.25);
}

  </style>

    <!-- القسم الرئيسي بصورة الخلفية والنص -->
    <main style="padding: 0; margin: 0; height: 100vh; overflow: hidden;">
        <img src="{{ asset("storage/sawaed.jpeg") }}" alt="Background Image" style="width: 100%; height: 97vh; object-fit: cover; object-position: center; position: absolute; top: 0; left: 0; z-index: -1;">
        {{-- <h1 style="text-align: center; color: rgba(92, 158, 221, 0.781); font-size: 50px; padding-top: 10%; font-family: 'Cairo', sans-serif; height: 100%; display: flex; align-items: center; justify-content: center; font-weight: bold; ">
            أبسط يدك بالعطاء... تمتد لك أبواب السماء
        </h1> --}}
    </main>

    
    <!-- قسم الترحيب والدعوة للتبرع -->
    <section class="container py-2 text-center" data-aos="fade-up" data-aos-duration="1000">
        <p style="color:black; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif ;font-weight: bold;font-size: 50px;">
            ﴿ لن تَنَالُوا الْبِرَّ حَتَّى تُنفِقُوا مِمَّا تُحِبُّونَ ﴾
        </p>
        <div class="card mb-1 donation mx-auto" style="max-width: 700px;">
            <div class="card-body" style="background-color: #a5c4b3;">
                <h5 class="card-title" style="color: black; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif ;font-weight: bold;font-size: 30px;">ساهم معنا</h5>
                <hr class="mx-auto my-3" style="width: 100px; height: 3px;background-color: black; opacity: 1; border: none; border-radius: 2px;">
                <p class="card-text" style="font-size:20px;color: black; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif ;font-weight: bold;">
                    مرحبا بكم في منصة سواعد للتبرعات<br><br>
                    نحن ملتزمين بمساعدة المحتاجين من خلال التبرعات الانسانية
                </p>
                <p style="font-size:20px;color: black; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif ;font-weight: bold;">
                    ساهم معنا في مساعدة الاخرين
                </p>
                <h3 style="color: black; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif ;font-weight: bold;font-size: 30px;">
                    ﴿ وَأَحْسِنُوا إِنَّ اللَّهَ يُحِبُّ الْمُحْسِنِينَ ﴾
                </h3>
            </div>
        </div>
    </section>

    <!-- قسم أثر الإحسان -->
    <section class="container py-3 text-center" data-aos="fade-up" data-aos-duration="1000">
        <h2 class="text-center" style="margin-top: 10px; margin-bottom: 10px;color:#2E8B57; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif ;font-weight: bold;font-size: 50px;">من أثر إحسانكم</h2>
        <h4 class="text-center mb-5" style="color:#2E8B57; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif ;font-weight: bold;font-size: 30px;">أثر يغير الحياة، وسعادة تنمو لعطاء مستمر</h4>
        <div class="row g-3">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset("storage/P25700.png") }}" class="card-img-top" alt="مستلزمات مدرسية">
                    <div class="card-body">
                        <h4 class="card-title" style="color: black;font-weight: bold;">مستلزمات مدرسية</h4>
                        <p class="card-text" style="color: black; font-size:20px;">بفضل لله,دعمتنا منصة الرحمة بتوفير كافة المستلزمات المدرسية</p>
                        <h1 style="color: rgb(173, 55, 55);">&#10084;</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/P01180.jpg') }}" class="card-img-top" alt="سقيا الماء">
                    <div class="card-body">
                        <h4 class="card-title" style="color: black;font-weight: bold;">سقيا الماء</h4>
                        <p class="card-text" style="color: black; font-size:20px;">بفضل الله , ساعدتنا منصة الرحمة في حفر بئر للشرب</p>
                        <h1 style="color: rgb(173, 55, 55);">&#10084;</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/P149.jpg') }}" class="card-img-top" alt="الرعاية الصحية">
                    <div class="card-body">
                        <h4 class="card-title" style="color:black;font-weight: bold;">الرعاية الصحية</h4>
                        <p class="card-text" style="color: black; font-size:20px;">بحمد الله , تمكنا من دفع مبلغ 100 عملية جراحية للمرضى</p>
                        <h1 style="color: rgb(173, 55, 55);">&#10084;</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/P77.jpg') }}" class="card-img-top" alt="سداد ايجار أسرة متعففة">
                    <div class="card-body">
                        <h4 class="card-title" style="color: black;font-weight: bold;">سداد ايجار أسرة متعففة</h4>
                        <p class="card-text" style="color: black; font-size:20px">بحمد الله, تمكنا من سداد ايجار سنة كاملة لأسرة متعففة</p>
                        <h1 style="color: rgb(173, 55, 55);">&#10084;</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- مجالات التبرع -->
    <div class="container text-center my-5">
        <h3 class="mb-3 fw-bold" style="color: black;">مجالات التبرع</h3>
        <hr class="mx-auto my-3" style="width: 100px; height: 3px;background-color: #198754; opacity: 1; border: none; border-radius: 2px;"><br>
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-sm-4 col-md-2">
                <div class="icon-box bg-warning">
                    <i class="fas fa-apple-alt"></i>
                    غذائي
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-2">
                <div class="icon-box bg-success">
                    <i class="fas fa-heartbeat"></i>
                    صحي
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-2">
                <div class="icon-box bg-primary">
                    <i class="fas fa-graduation-cap"></i>
                    تعليمي
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-2">
                <div class="icon-box bg-secondary">
                    <i class="fas fa-ellipsis-h"></i>
                    اخرى
                </div>
            </div>
        </div>
    </div>
@endsection