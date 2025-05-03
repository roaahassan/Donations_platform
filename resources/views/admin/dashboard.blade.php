@extends('layouts.admin')

@section('content')
<div class="container">
    {{-- <h1 class="mb-4">مرحبًا بك في لوحةالادارة</h1> --}}

    <div class="row">
        <!-- ملخص الحوجات -->
        <div class="d-flex justify-content-center">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-10 mt-10 p-3">
                    <div class="card-header">إدارة الحوجات</div>
                        <div class="card-body">
                          <h5 class="card-title mt-3">عدد الحوجات: {{ $needsCount }}</h5>
                           <a href="{{ route('dashboard.needs') }}" class="btn btn-light mt-3">عرض الحوجات</a>
                        </div>
                </div>
            </div>
        </div>

        <!-- ملخص التبرعات -->
        {{-- <div class="w-100 d-md-none"></div> --}}
        <div class="col-md-4">
            <div class="card text-white bg-success mt-20  mb-10 p-3">
                <div class="card-header">إدارة التبرعات</div>
                  <div class="card-body">
                    <h5 class="card-title mt-3">عدد التبرعات: {{ $donationsCount }}</h5>
                    <a href="{{ route('dashboard.donations') }}" class="btn btn-light mt-3">عرض التبرعات</a>
                  </div>
            </div>
        </div>

        <!-- ملخص طلبات الحوجات -->
        {{-- <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">إدارة طلبات الحوجات</div>
                  <div class="card-body">
                    <h5 class="card-title">عدد الطلبات: {{ $requestsCount }}</h5>
                    <a href="{{ route('admin.requests') }}" class="btn btn-light">عرض الطلبات</a>
                  </div>
               </div>
          </div>--}}
       </div> 

@endsection