@extends('layouts.guest')


@section('content')

<section class="py-5">
    <div class="container">
        <div class="card">
            <div class="row g-0">
                <div
                    class="col-md-6 col-lg-6 col-xl-6 bg-gray-100 d-none d-md-flex justify-content-center align-items-center">
                    <a href="{{ route('welcome') }}"> <img src="{{ URL::asset('assets/website/images/trans_logo_ar.png') }}" alt="">
                    </a>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center align-items-center">
                    <div class="card-body p-md-5 mx-md-4">
                        <div class="text-center">
                            <h4 class="mt-1 mb-5 pb-1">
                                <span>@lang('users.t_patient_login')</span><i class="fa fa-user mx-2" aria-hidden="true"></i>
                            </h4>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input type="hidden" name="type" value="patient">
                            <div class="form-group">
                                <label for="civil_id">@lang('users.civil_id')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text  bg-gray-100" id="basic-addon1">
                                            <i class="fa fa-hashtag"></i>
                                        </span>
                                    </div>
                                    <input type="text" placeholder="{{ __('users.placeholder_civil_id') }}" id="civil_id" name="civil_id" aria-describedby="basic-addon1"
                                        class="form-control @error('civil_id') parsley-error @enderror" placeholder="">
                                    @include('components.input-error',['input' => 'civil_id'])

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">@lang('users.password')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gray-100" id="basic-addon1">
                                            <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                                        </span>
                                    </div>
                                    <input type="password" placeholder="{{ __('users.password') }}" name="password" aria-describedby="basic-addon1"
                                        class="form-control id_password @error('password') parsley-error @enderror"
                                        placeholder="">
                                    @include('components.input-error',['input' => 'password'])

                                </div>
                            </div>

                            <div class="form-group my-3">
                                <label class="ckbox"><input name="remember"
                                        type="checkbox"><span>@lang('users.l_remember')</span></label>
                            </div>

                            <button class="btn btn-primary btn-block">@lang('users.btn_login')</button>



                        </form>
                        {{-- <div class="main-signin-footer mt-3">
                            <p><a href="">@lang('users.t_forgot_password')</a></p>
                        </div> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<script>
    const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('.id_password');

        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
</script>
@endsection