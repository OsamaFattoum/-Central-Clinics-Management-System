<div class="row">
    <div class="form-group col-lg-6">
        <label for="address">@lang('users.address')<span class="tx-danger">*</span></label>
        <input id="address" type="text" name="address"
            value="{{ old('address',isset($patient) ? $patient->profile->address : '') }}"
            class="form-control @error('address') parsley-error @enderror">
        @include('components.input-error',['input'=> 'address'])
    </div>
    <div class="form-group col-lg-6">
        <label for="cities">@lang('users.city')<span class="tx-danger">*</span></label>
        <select name="city" id="cities" class="form-control @error('city') custom-select2-border @enderror"
            data-parsley-error="#slErrorContainer" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
            @foreach ($cities as $city)
            <option {{ isset($patient) ? ($city['id']==$patient->profile->city ? 'selected' : '') : '' }} value="{{
                $city['id'] }}">{{
                $city['name_' . app()->getLocale()] }}</option>
            @endforeach
        </select>
        @include('components.input-error',['input'=> 'city','is_select'=>true])
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-6">
        <label for="phone">@lang('users.phone')<span class="tx-danger">*</span></label>
        <input id="phone" type="text" name="phone"
            value="{{ old('phone',isset($patient) ? $patient->profile->phone : '') }}"
            class="form-control @error('phone') parsley-error @enderror">
        @include('components.input-error',['input'=> 'phone'])
    </div>
    <div class="form-group col-lg-6">
        <label for="gender">@lang('users.gender')<span class="tx-danger">*</span></label>
        <select name="gender" id="gender" class="form-control @error('gender') custom-select2-border @enderror"
            data-parsley-error="#slErrorContainer" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
            <option value="">@lang('site.select_package_placeholder')</option>
            <option value="1" {{ isset($patient) ? ($patient->profile->gender == 1 ? 'selected' : '') : ''
                }}>@lang('users.male')</option>
            <option value="0" {{ isset($patient) ? ($patient->profile->gender == 0 ? 'selected' : '') : ''
                }}>@lang('users.female')</option>
        </select>
        @include('components.input-error',['input'=> 'gender','is_select'=>true])
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-6">
        <label for="dob">@lang('users.dob')<span class="tx-danger">*</span></label>
        <input id="dob" type="date" name="dob" class="form-control @error('dob') parsley-error @enderror"
            value="{{ old('dob',isset($patient) ? $patient->profile->birth_date : '') }}">
        @include('components.input-error',['input'=> 'dob'])
    </div>
    <div class="form-group col-lg-6">
        <label>{{trans('patients.blood_type')}}<span class="tx-danger">*</span></label>
        <select name="blood_type" class="form-control @error('blood_type') custom-select2-border @enderror"
            data-parsley-error="#slErrorContainer" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
            <option value="">@lang('site.select_package_placeholder')</option>
            @foreach($bloodType as $type)
            <option {{ isset($patient) ? ($type['id'] == $patient->bloodType->id ? 'selected' : '') : '' }} value="{{$type->id}}">{{$type->name}}</option>
            @endforeach
        </select>
        @include('components.input-error',['input'=> 'blood_type','is_select'=>true])
    </div>
</div>