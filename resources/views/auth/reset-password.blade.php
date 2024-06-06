@extends('layouts.guest')


@section('content')
<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The content half -->
        <div class="col-md-6 col-lg-6 col-xl-5 bg-white mx-auto">
            <div class="login d-flex align-items-center">
                <div class="container p-0">
                    <div class="row">
                        <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                            <div class="card-sigin">
                                <div class="mb-4 d-flex"><a href="{{ route('welcome') }}">
                                    <img src="{{URL::asset('assets/img/brand/logo_' . config('app.locale') . '.png')}}"
                                        class="sign-favicon ht-60" alt="logo">
                                </a></div>
                                <div class="card-sigin">
                                    <div class="main-signup-header">
                                        <h2>@lang('auth.t_reset_password')</h2>
                                        <h5 class="font-weight-semibold mb-4">@lang('auth.p_reset_password')</h5>
                                        <form method="POST" action="{{ route('password.store') }}">
                                            @csrf
                                            
                                            <!-- Password Reset Token -->
                                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                            <div class="form-group ">
                                                <label>@lang('admin_auth.l_email')</label>
                                                <input placeholder="{{ __('admin_auth.placeholder_email') }}" id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ $email ?? $request->email }}" required
                                                    autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group ">
                                                <label>@lang('profile.new_password')</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password"
                                                    placeholder="{{ __('admin_auth.placeholder_password') }}">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group ">
                                                <label>@lang('profile.confirm_password')</label>
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password"
                                                    placeholder="{{ __('admin_auth.placeholder_password') }}">
                                            </div>
                                            <button type="submit" class="btn ripple btn-main-primary btn-block">@lang('auth.btn_reset')</button>
                                        </form>
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