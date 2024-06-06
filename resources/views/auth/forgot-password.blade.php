@extends('layouts.guest')


@section('content')
<div class="container-fluid">
    <div class="row no-gutter">
        <div class="col-md-6 col-lg-6 col-xl-5 bg-white mx-auto">
            <div class="login d-flex align-items-center py-2">

                <div class="container p-0">
                    <div class="row">
                        <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                            <div class="mb-5 d-flex"> <a href="{{ route('welcome') }}">
                                    <img src="{{URL::asset('assets/img/brand/logo_' . config('app.locale') . '.png')}}"
                                        class="sign-favicon ht-60" alt="logo">
                                </a></div>
                            <div class="main-card-signin d-md-flex bg-white">
                                <div class="wd-100p">
                                    <div class="main-signin-header">
                                        <h2>@lang('auth.t_forgot_password')</h2>
                                        <h4>@lang('auth.p_forgot_password')</h4>
                                        @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                        @endif
                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label>@lang('admin_auth.l_email')</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocusclass="form-control"
                                                    placeholder="{{ __('admin_auth.placeholder_email') }}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <button class="btn btn-main-primary btn-block" type="submit">@lang('auth.send')</button>
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