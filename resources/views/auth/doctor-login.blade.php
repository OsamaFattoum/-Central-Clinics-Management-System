@extends('layouts.guest')

@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}"
    rel="stylesheet">
@endsection


@section('content')
@include('components.messages_alert')
<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-6 col-lg-6 col-xl-6 d-none d-md-flex bg-primary-transparent">
            <div class="row wd-100p mx-auto text-center">
                <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                    <img src="{{URL::asset('assets/img/login_doctor.svg')}}"
                        class="my-auto ht-xl-80p wd-md-100p wd-xl-70p mx-auto" alt="logo">
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
                                <div class="mb-4 d-flex"> <a href="{{ route('welcome') }}"><img
                                            src="{{URL::asset('assets/img/brand/logo_'. app()->getLocale() .'.png')}}"
                                            class="sign-favicon ht-60" alt="logo"></a></div>
                                <div class="card-sigin">
                                    <div class="main-signup-header">
                                        <h2>@lang('site.caption_welcome')</h2>
                                        <h5 class="font-weight-semibold mb-4">@lang('users.sub_caption_welcome')</h5>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <input type="hidden" name="type" value="doctor">
                                            <div class="form-group">
                                                <label for="job_number">@lang('doctors.job_number')</label>
                                                <input class="form-control @error('job_number') parsley-error @enderror"
                                                    placeholder="{{ __('doctors.placeholder_job_number') }}"
                                                    type="text" name="job_number" id="job_number"
                                                    value="{{ old('job_number') }}">
                                                @include('components.input-error',['input' => 'job_number'])
                                            </div>
                                            <div class="form-group">
                                                <label for="doctor_password">@lang('users.password')</label>
                                                <input class="form-control @error('password') parsley-error @enderror"
                                                    placeholder="{{ __('users.placeholder_users_password') }}"
                                                    id="doctor_password" name="password" type="password">
                                                @include('components.input-error',['input' => 'password'])
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="ckbox"><input name="remember"
                                                        type="checkbox"><span>@lang('users.l_remember')</span></label>
                                            </div>

                                            <button
                                                class="btn btn-primary btn-block">@lang('users.btn_login')</button>

                                        </form>
                                        {{-- <div class="main-signin-footer mt-3">
                                            <p><a href="">@lang('users.t_forgot_password')</a></p>
                                        </div> --}}
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


