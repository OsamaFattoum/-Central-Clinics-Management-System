@extends('layouts.guest')

@section('content')
<div class="container-fluid">
    <div class="row no-gutter">
        <div class="col-md-6 col-lg-6 col-xl-5 bg-white mx-auto">
            <div class="login d-flex align-items-center">
                <div class="container p-0">
                    <div class="row">
                        <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                            <div class="card-sigin">
                                <div class="mb-5 d-flex">
                                    <a href="{{ route('welcome') }}">
                                        <img src="{{URL::asset('assets/img/brand/logo_' . config('app.locale') . '.png')}}"
                                            class="sign-favicon ht-70" alt="logo">
                                    </a>
                                </div>
                                <div class="card-sigin">
                                    <div class="main-signup-header">
                                        <h2>@lang('admin_auth.caption_welcome')</h2>
                                        <h5 class="font-weight-semibold mb-4">@lang('admin_auth.sub_caption_welcome')</h5>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <input type="hidden" name="type" value="admin">
                                            <div class="form-group">
                                                <label>@lang('admin_auth.l_email')</label>
                                                <input class="form-control @error('email') parsley-error @enderror"
                                                    placeholder="{{ __('admin_auth.placeholder_email') }}" type="email" required name="email"
                                                    value="{{ old('email') }}">
                                                @include('components.input-error',['input' => 'email'])
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('admin_auth.l_password')</label>
                                                <input class="form-control @error('password') parsley-error @enderror"
                                                    placeholder="{{ __('admin_auth.placeholder_password') }}" required name="password" type="password">
                                                @include('components.input-error',['input' => 'password'])
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="ckbox"><input name="remember"
                                                        type="checkbox"><span>@lang('admin_auth.l_remember')</span></label>
                                            </div>

                                            <button class="btn btn-primary btn-block">@lang('admin_auth.btn_login')</button>

                                        </form>
                                        <div class="main-signin-footer mt-3">
                                            <p><a href="">@lang('admin_auth.t_forgot_password')</a></p>
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

 