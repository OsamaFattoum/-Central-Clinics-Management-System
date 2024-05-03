<div class="row">
    <div class="form-group col-lg-6">
        <label for="address">@lang('facility.address')<span class="tx-danger">*</span></label>
        <input  id="address" type="text" name="address" 
            value="{{ old('address',isset($clinic) ? $clinic->facilityProfile->address : '') }}"
            class="form-control @error('address') parsley-error @enderror">
        @include('components.input-error',['input'=> 'address'])
    </div>
    <div class="form-group col-lg-6">
        <label for="cities">@lang('facility.city')<span class="tx-danger">*</span></label>
        <select  name="city" id="cities" class="form-control @error('city') custom-select2-border @enderror"
            data-parsley-error="#slErrorContainer" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
            @foreach ($cities as $city)
            <option {{ isset($clinic) ? ($city['id']== $clinic->facilityProfile->city ? 'selected' : '') : '' }} value="{{ $city['id'] }}">{{
                $city['name_' . app()->getLocale()] }}</option>
            @endforeach
        </select>
        @include('components.input-error',['input'=> 'city','is_select'=>true])
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-6">
        <label for="postal_code">@lang('facility.postal_code')<span class="tx-danger">*</span></label>
        <input  id="postal_code" type="text" name="postal_code"
            value="{{ old('postal_code',isset($clinic) ? $clinic->facilityProfile->postal_code : '') }}"
            class="form-control @error('postal_code') parsley-error @enderror">
        @include('components.input-error',['input'=> 'postal_code'])
    </div>
    <div class="form-group col-lg-6">
        <label  for="phone">@lang('facility.phone')<span class="tx-danger">*</span></label>
        <input id="phone" type="text" name="phone" value="{{ old('phone',isset($clinic) ? $clinic->facilityProfile->phone : '') }}"
            class="form-control @error('phone') parsley-error @enderror">
        @include('components.input-error',['input'=> 'phone'])
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-6">
        <label for="open_hours">@lang('facility.open_hours')<span class="tx-danger">*</span></label>
        <input  id="open_hours" type="time" name="open_hours"
            value="{{ old('open_hours',isset($clinic) ? $clinic->facilityProfile->open_hours : '') }}"
            class="form-control @error('open_hours') parsley-error @enderror">
        @include('components.input-error',['input'=> 'open_hours'])
    </div>
    <div class="form-group col-lg-6">
        <label for="close_hours">@lang('facility.close_hours')<span class="tx-danger">*</span></label>
        <input  id="close_hours" type="time" name="close_hours"
            value="{{ old('close_hours',isset($clinic) ? $clinic->facilityProfile->close_hours : '') }}"
            class="form-control @error('close_hours') parsley-error @enderror">
        @include('components.input-error',['input'=> 'close_hours'])
    </div>
</div>
