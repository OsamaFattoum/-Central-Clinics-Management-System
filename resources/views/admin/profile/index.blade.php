@include('components.breadcrumb',['pervPage' => __('sidebar.main_l') , 'currentPage' => __('header.l_profile')])

@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-3">@lang('profile.title_profile')</h4>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" value="admin">

                    <div class="form-group">
                        <label for="l_image">@lang('profile.image')<span class="tx-danger">*</span></label>
                        <div class="img-thumbnail @error('image') border-danger @enderror">
                            <input type="file" name="image" class="dropify" accept="image/jpeg,image/jpg,image/png" id="l_image"
                                data-default-file="{{URL::asset(auth()->user()->image_path)}}" data-height="150" />
                        </div>
                        @include('components.input-error',['input' => 'image','is_select'=>true])

                    </div>
                    <div class="form-group">
                        <label for="name">@lang('profile.name')<span class="tx-danger">*</span></label>
                        <input type="name" name="name" value="{{ old('name',$user->name) }}"
                            class="form-control @error('name') is-invalid @enderror" id="name">
                        @include('components.input-error',['input' => 'name'])
                    </div>
                    <div class="form-group">
                        <label for="email">@lang('profile.email')<span class="tx-danger">*</span></label>
                        <input type="email" name="email" value="{{ old('email',$user->email) }}"
                            class="form-control @error('email') is-invalid @enderror" id="email">
                        @include('components.input-error',['input' => 'email'])
                    </div>
                    <div class="form-group">
                        <label for="phone">@lang('profile.phone')<span class="tx-danger">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="form-control @error('phone') is-invalid @enderror" id="phone">
                        @include('components.input-error',['input' => 'phone'])
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
                        <label for="update_password_current_password">@lang('profile.current_password')<span class="tx-danger">*</span></label>
                        <input type="password" name="current_password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            id="update_password_current_password">
                        @include('components.input-error',['input' => 'current_password'])
                    </div>
                    <div class="form-group">
                        <label for="update_password_password">@lang('profile.new_password')<span class="tx-danger">*</span></label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="update_password_password">
                        @include('components.input-error',['input' => 'password'])
                    </div>
                    <div class="form-group">
                        <label for="update_password_password_confirmation">@lang('profile.confirm_password')<span class="tx-danger">*</span></label>
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