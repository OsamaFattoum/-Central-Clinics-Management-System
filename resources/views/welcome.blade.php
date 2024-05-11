@extends('layouts.website.front')

@section('content')

<!--First Section-->
<section id="banner" class="mb-5">
    <div class="container-xxl text-center" id="first-section">
        <div class="row align-items-center py-5">
            <div class="col-md-12">
                <img src="{{ URL::asset('assets/website/images/favicon.png') }}" alt="favicon" width="200px"
                    height="140px" class="img-fluid">
                <div class="mb-4">
                    <p class="text-center fs-lg-1 fs-2 fw-semibold" id="favicon-text" data-cursor-char=""></p>
                </div>
                @if (isset($guardName) && auth()->guard($guardName)->check())
                <div class="my-3">
                    <a href="{{ route('dashboard') }}" class="btn-login">الملف الشخصي</a>
                </div>
                @else
               
                <div class="my-3">
                    <a href="{{ route('patient.login') }}" class="btn-login">تسجيل الدخول</a>
                </div>
                
                @endif
                
                <a href="#about-us-link" class="about-us-link mt-3">من نحن؟</a>


            </div>
        </div>
    </div>
    <img src="{{ URL::asset('assets/website/images/wave1.png') }}" class="vector-image">
</section>
<!--End First Section-->

<!--about us section-->
<section class="container py-5 py-lg-0" id="about-us-link">
    <div class="row align-items-center px-lg-0 px-5">
        <div class="col-lg-6 about-us-image">
            <img class="img-fluid" src="{{ URL::asset('assets/website/images/one.png') }}" alt="..." loading="lazy" />
        </div>
        <div class="col-lg-6 pt-lg-0 pt-3 about-us-text">
            <h2 class="fw-bold mb-3">ما هو نظام العيادات المركزي؟</h2>
            <p class="lh-lg fs-5">هو نظام شامل لربط العيادات و الصيدليات و مقدمي الرعاية الصحية, يسهل النظام ادارة
                سجلات
                المرضى و
                المواعيد
                و الوصفات الطبيه و الصيدليات و يبسط التواصل بين العيادات و الاطباء و الصيادلة </p>
        </div>

    </div>
    </div>
</section>
<!-- End about us section-->

<!--Features Section-->
<section id="features">
    <img src="{{ URL::asset('assets/website/images/wave2.png') }}" class="vector-image">
    <div class="container py-5 py-lg-0">
        <!--Feature One-->
        <div class="row align-items-center py-lg-5 px-lg-0 px-5">
            <div class="col-lg-5 feature-one-image">
                <img class="img-fluid" src="{{ URL::asset('assets/website/images/823_generated.png') }}" alt="..."
                    loading="lazy" />
            </div>
            <div class="col-1"></div>
            <div class="col-lg-6 pt-3 feature-one-text">
                <h2 class="fw-bold mb-3">الاطلاع على السجل الطبي</h2>
                <p class="lh-lg fs-5">يمكنك النظام بالاطلاع على معلومات سجلك الطبي اذا كنت تراجع العيادات و
                    الصيدليات التي
                    تتبع لشبكة العيادات
                    المركزية ومن ضمنها : المواعيد الطبية في عيادات الاختصاص , الادوية الفعالة , المطاعيم , تقارير
                    الاشعة ,
                    الجراحة ,نتائج التحاليل </p>
            </div>
        </div>
        <!--End Feature One-->

        <!--Feature Two-->
        <div class="row align-items-center pb-lg-5 px-lg-0 px-5">
            <div class="col-lg-6 pt-3 order-lg-1 order-3 feature-two-text">
                <h2 class="fw-bold mb-3">صرف دواء للمريض في السجل</h2>
                <p class="lh-lg fs-5">يتم وصف دواء مناسب من الطبيب على حسب حالة المريض ويتم اضافتها بالسجل الخاص به
                    وعن طريقه
                    يتم
                    صرفه من
                    الصيدلاني للمريض عن طريق النظام الخاص بنا</p>
            </div>
            <div class="col-1 order-2"></div>
            <div class="col-lg-5 order-lg-3 order-1 feature-two-image">
                <img class="img-fluid" src="{{ URL::asset('assets/website/images/812_generated.png') }}" alt=""
                    loading="lazy">
            </div>
        </div>
        <!--End Feature Two-->

        <!--Feature Three-->
        <div class="row align-items-center pb-lg-5 px-lg-0 px-5">
            <div class="col-lg-5 feature-three-image">
                <img class="img-fluid" src="{{ URL::asset('assets/website/images/804_generated.png') }}" alt=""
                    loading="lazy">
            </div>
            <div class="col-1"></div>
            <div class="col-lg-6 pt-3 feature-three-text">
                <h2 class="fw-bold mb-3">حجز موعد متابعة </h2>
                <p class="lh-lg fs-5">تمكنك هذه الخدمة بحجز موعد عند الطبيب او القسم الذي تحتاجه و عرض جدول زمني
                    لمواعيد
                    الطبيب المتاحة و تحديد
                    الوقت الذي يناسب الطبيب من بين الأوقات المتاحة ويمكنك إدارة المواعيد المحجوزة مثل تعديلها او
                    الغائها اذا
                    لزم الامر </p>
            </div>

        </div>
        <!--End Feature Three-->
    </div>
    <img src="{{ URL::asset('assets/website/images/wave1.png') }}" class="vector-image">
</section>
<!-- End Features Section-->

@endsection