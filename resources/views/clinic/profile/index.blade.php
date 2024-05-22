@include('components.breadcrumb',['pervPage' => __('sidebar.main_l') , 'currentPage' => __('header.l_profile')])


@section('content')

<div class="row">
    <div class="col-lg-7">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-3">@lang('profile.title_profile')</h4>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" value="clinic">

                    <div class="form-group">
                        <label for="l_image">@lang('profile.image')<span class="tx-danger">*</span></label>
                        <div class="img-thumbnail @error('image') border-danger @enderror">
                            <input type="file" name="image" class="dropify" accept="image/jpeg,image/jpg,image/png"
                                id="l_image" data-default-file="{{URL::asset(auth()->user()->image_path)}}"
                                data-height="150" />
                        </div>
                        @include('components.input-error',['input' => 'image','is_select'=>true])

                    </div>
                    <div class="row">
                        @foreach (config('translatable.locales') as $index => $local)
                        <div class="form-group col-lg-6">
                            <label for="profile.name.{{ $local }}">@lang('profile.name.'. $local )<span
                                    class="tx-danger">*</span></label>
                            <input {{ $index==0 ? 'autofocus' : '' }} id="profile.name.{{ $local }}" type="text"
                                value="{{ old($local . '.name',isset($user) ? $user->translate($local)->name : '') }}"
                                name="{{ $local
                            }}[name]" class="form-control @error($local." .name") parsley-error @enderror">
                            @include('components.input-error',['input'=> $local.".name"])
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group days-select2">
                        <label for="days">@lang('profile.open_days')<span class="tx-danger">*</span></label>
                        <select name="days[]" id="days" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}"
                            class="form-control select2" multiple="multiple">
                            @foreach ($days as $day)
                            @php
                            $selected = false;
                            if (old('days')) {
                            $selected = in_array($day->id, (array) old('days'));
                            } elseif (isset($user)) {
                            $selected = $user->facilityDays->contains('day_id', $day->id);
                            }
                            @endphp
                            <option {{ $selected ? 'selected' : '' }} value="{{ $day->id }}">{{ $day->day }}</option>
                            @endforeach

                        </select>
                        @include('components.input-error',['input'=> 'days','is_select'=>true])
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="email">@lang('profile.email')<span class="tx-danger">*</span></label>
                            <input type="email" name="email" value="{{ old('email',$user->email) }}"
                                class="form-control @error('email') is-invalid @enderror" id="email">
                            @include('components.input-error',['input' => 'email'])
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="cities">@lang('profile.city')<span class="tx-danger">*</span></label>
                            <select  name="city" id="cities" class="form-control @error('city') custom-select2-border @enderror"
                                data-parsley-error="#slErrorContainer" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
                                @foreach ($cities as $city)
                                <option {{ isset($user) ? ($city['id']== $user->facilityProfile->city ? 'selected' : '') : '' }} value="{{ $city['id'] }}">{{
                                    $city['name_' . app()->getLocale()] }}</option>
                                @endforeach
                            </select>
                            @include('components.input-error',['input'=> 'city','is_select'=>true])
                        </div>
                    </div>
                   


                    @foreach (config('translatable.locales') as $local)
                    <div class="form-group">
                        <label for="description.{{ $local }}">@lang('profile.description.'. $local)</label>
                        <textarea style="resize: none" name="{{ $local }}[description]" id="description.{{ $local }}"
                            rows="5"
                            class="form-control {{ $local == 'ar' ? 'text-right' : 'text-left' }}">{{ old($local . '.description',isset($user) ? $user->translate($local)->description: '') }}</textarea>
                    </div>
                    @endforeach


                    <div class="form-group">
                        <label for="address">@lang('profile.address')<span class="tx-danger">*</span></label>
                        <input id="address" type="text" name="address"
                            value="{{ old('address',isset($user) ? $user->facilityProfile->address : '') }}"
                            class="form-control @error('address') parsley-error @enderror">
                        @include('components.input-error',['input'=> 'address'])
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="postal_code">@lang('profile.postal_code')<span class="tx-danger">*</span></label>
                            <input  id="postal_code" type="text" name="postal_code"
                                value="{{ old('postal_code',isset($user) ? $user->facilityProfile->postal_code : '') }}"
                                class="form-control @error('postal_code') parsley-error @enderror">
                            @include('components.input-error',['input'=> 'postal_code'])
                        </div>
                        <div class="form-group col-lg-6">
                            <label  for="phone">@lang('profile.phone')<span class="tx-danger">*</span></label>
                            <input id="phone" type="text" name="phone" value="{{ old('phone',isset($user) ? $user->facilityProfile->phone : '') }}"
                                class="form-control @error('phone') parsley-error @enderror">
                            @include('components.input-error',['input'=> 'phone'])
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="open_hours">@lang('profile.open_hours')<span class="tx-danger">*</span></label>
                            <input  id="open_hours" type="time" name="open_hours"
                                value="{{ old('open_hours',isset($user) ? $user->facilityProfile->open_hours : '') }}"
                                class="form-control @error('open_hours') parsley-error @enderror">
                            @include('components.input-error',['input'=> 'open_hours'])
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="close_hours">@lang('profile.close_hours')<span class="tx-danger">*</span></label>
                            <input  id="close_hours" type="time" name="close_hours"
                                value="{{ old('close_hours',isset($user) ? $user->facilityProfile->close_hours : '') }}"
                                class="form-control @error('close_hours') parsley-error @enderror">
                            @include('components.input-error',['input'=> 'close_hours'])
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="owner_name">@lang('profile.owner_name')<span class="tx-danger">*</span></label>
                            <input  id="owner_name" type="text" name="owner_name" value="{{ old('owner_name',isset($user) ? $user->facilityProfile->owner_name  : '') }}" class="form-control @error('owner_name') parsley-error @enderror">
                            @include('components.input-error',['input'=> 'owner_name'])
                        </div>
                     
                    
                        <div class="form-group col-lg-6">
                            <label for="owner_phone">@lang('profile.owner_phone')<span class="tx-danger">*</span></label>
                            <input  id="owner_phone" type="text" name="owner_phone" value="{{ old('owner_phone',isset($user) ? $user->facilityProfile->owner_phone : '') }}" class="form-control @error('owner_phone') parsley-error @enderror">
                            @include('components.input-error',['input'=> 'owner_phone'])
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="owner_email">@lang('profile.email')<span class="tx-danger">*</span></label>
                        <input  id="owner_email" type="email" name="owner_email" value="{{ old('owner_email',isset($user) ? $user->facilityProfile->owner_email : '') }}" class="form-control @error('owner_email') parsley-error @enderror">
                        @include('components.input-error',['input'=> 'owner_email'])
                    </div>


                    <button type="submit" class="btn btn-primary mt-2 mb-0">@lang('profile.save')</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
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