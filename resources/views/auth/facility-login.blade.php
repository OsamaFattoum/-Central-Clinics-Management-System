
@extends('layouts.guest')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}"
    rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-6 col-lg-6 col-xl-6 d-none d-md-flex bg-primary-transparent">
            <div class="row wd-100p mx-auto text-center">
                <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                    <img src="{{URL::asset('assets/img/login_facility.svg')}}"
                        class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                </div>
            </div>
        </div>
        <!-- The content half -->
        <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
            <div class="login d-flex align-items-center py-2">
                <!-- Demo content-->
                <div class="container p-0">
                    <div class="row">
                        <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                            <div class="card-sigin">
                                <div class="mb-5 d-flex"> <a href="{{ route('welcome') }}"><img
                                            src="{{URL::asset('assets/img/brand/logo_'. app()->getLocale() .'.png')}}"
                                            class="sign-favicon ht-60" alt="logo"></a></div>
                                <div class="card-sigin">
                                    <div class="main-signup-header">
                                        <h2>مرحبا بعودتك</h2>
                                        <h5 class="font-weight-semibold mb-4">من فضلك سجل دخولك للمتابعة.</h5>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <input type="hidden" name="type" value="clinic">
                                            <div class="form-group">
                                                <label>رقم العيادة</label>
                                                <input class="form-control @error('number') parsley-error @enderror"
                                                    placeholder="أدخل رقم العيادة" type="text" name="number"
                                                    value="{{ old('number') }}">
                                                @include('components.input-error',['input' => 'number'])
                                            </div>
                                            <div class="form-group">
                                                <label>كلمة السر</label>
                                                <input class="form-control @error('password') parsley-error @enderror"
                                                    placeholder="أدخل كلمة السر" name="password" type="password">
                                                @include('components.input-error',['input' => 'password'])
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="ckbox"><input name="remember"
                                                        type="checkbox"><span>تذكرني</span></label>
                                            </div>

                                            <button class="btn btn-primary btn-block">تسجيل الدخول</button>

                                        </form>
                                        <div class="main-signin-footer mt-3">
                                            <p><a href="">هل نسيت كلمه السر؟</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End -->
            </div>
        </div><!-- End -->
    </div>
</div>
@endsection


@section('js')
@endsection