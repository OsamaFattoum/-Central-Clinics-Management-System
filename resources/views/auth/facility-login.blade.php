@extends('layouts.guest')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}"
    rel="stylesheet">
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
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
                                        <h2>@lang('site.caption_welcome')</h2>
                                        <h5 class="font-weight-semibold mb-4">@lang('facility.sub_caption_welcome')</h5>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="facility_type">@lang('facility.l_select_type')</label>
                                                <select name="type" class="form-control select2-no-search" id="facility_type">
                                                    <option value="clinic">@lang('facility.option_clinic')</option>
                                                    <option value="pharmacy">@lang('facility.option_pharmacy')</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="number_facility">@lang('facility.l_facility_number')</label>
                                                <input class="form-control @error('number') parsley-error @enderror"
                                                    placeholder="{{ __('facility.placeholder_facility_number') }}"
                                                    type="text" name="number" id="number_facility"
                                                    value="{{ old('number') }}">
                                                @include('components.input-error',['input' => 'number'])
                                            </div>
                                            <div class="form-group">
                                                <label for="facility_password">@lang('facility.password')</label>
                                                <input class="form-control @error('password') parsley-error @enderror"
                                                    placeholder="{{ __('facility.placeholder_facility_password') }}"
                                                    id="facility_password" name="password" type="password">
                                                @include('components.input-error',['input' => 'password'])
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="ckbox"><input name="remember"
                                                        type="checkbox"><span>@lang('facility.l_remember')</span></label>
                                            </div>

                                            <button
                                                class="btn btn-primary btn-block">@lang('facility.btn_login')</button>

                                        </form>
                                        <div class="main-signin-footer mt-3">
                                            <p><a href="">@lang('facility.t_forgot_password')</a></p>
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
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@include('components.select_multi')
@endsection