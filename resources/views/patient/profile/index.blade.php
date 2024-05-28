@include('components.breadcrumb',['pervPage' => __('sidebar.main_l') , 'currentPage' => __('header.l_profile')])


@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-3">@lang('profile.title_profile')</h4>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" value="patient">

                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-6">
                            <img src="{{URL::asset($user->image_path)}}" alt="" class="img-thumbnail">
                        </div>
                        <div class="col-lg-7 d-flex justify-content-start align-items-center mt-3 mt-lg-0">
                            <div class="">
                                <h5>{{ $user->name }}</h5>
                                <p class="op-5">{{ $user->email }}</p>
                                <span class="badge op-7 badge-{{ $user->status ? 'success' : 'danger' }}">{{
                                    $user->status ? __('users.enabled') : __('users.not_enabled') }}</span>

                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="form-group col-lg-6">
                            <label for="civil_id">@lang('profile.civil_id')</label>
                            <input type="text" id="civil_id" class="form-control" readonly
                                value="{{ $user->civil_id }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="dob">@lang('profile.dob')</label>
                            <input type="text" id="dob" class="form-control" readonly
                                value="{{ $user->profile->birth_date }}">
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-lg-6">
                            <label for="gender">@lang('profile.gender')</label>
                            <input type="text" id="gender" class="form-control" readonly value="{{ $user->gender }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="blood_type">@lang('profile.blood_type')</label>
                            <input type="text" id="blood_type" class="form-control" readonly
                                value="{{ $user->bloodType->name }}">
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-lg-6">
                            <label for="age">@lang('profile.age')</label>
                            <input type="text" id="age" class="form-control" readonly value="{{ $user->age }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="phone">@lang('profile.phone')<span class="tx-danger">*</span></label>
                            <input id="phone" type="text" name="phone"
                                value="{{ old('phone',isset($user) ? $user->profile->phone : '') }}"
                                class="form-control @error('phone') parsley-error @enderror">
                            @include('components.input-error',['input'=> 'phone'])
                        </div>
                    </div>







                    <button type="submit" class="btn btn-primary mt-2 mb-0">@lang('profile.save')</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-3">@lang('profile.title_password')</h4>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')
                    <input type="hidden" name="type" value="admin">
                    <div class="form-group">
                        <label for="update_password_current_password">@lang('profile.current_password')<span
                                class="tx-danger">*</span></label>
                        <input type="password" name="current_password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            id="update_password_current_password">
                        @include('components.input-error',['input' => 'current_password'])
                    </div>
                    <div class="form-group">
                        <label for="update_password_password">@lang('profile.new_password')<span
                                class="tx-danger">*</span></label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="update_password_password">
                        @include('components.input-error',['input' => 'password'])
                    </div>
                    <div class="form-group">
                        <label for="update_password_password_confirmation">@lang('profile.confirm_password')<span
                                class="tx-danger">*</span></label>
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="update_password_password_confirmation">
                        @include('components.input-error',['input' => 'password_confirmation'])
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 mb-0">@lang('profile.save')</button>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection