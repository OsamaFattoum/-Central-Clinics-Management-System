<div class="row">
    <div class="form-group col-lg-6">
        <label for="address">@lang('clinics.address')<span class="tx-danger">*</span></label>
        <input id="address" type="text" name="address" 
            value="{{ old('address',isset($clinic) ? $clinic->facilityProfile->address : '') }}"
            class="form-control @error('address') parsley-error @enderror">
        @include('components.input-error',['input'=> 'address'])
    </div>
    <div class="form-group col-lg-6">
        <label for="cities">@lang('clinics.city')<span class="tx-danger">*</span></label>
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
        <label for="postal_code">@lang('clinics.postal_code')<span class="tx-danger">*</span></label>
        <input  id="postal_code" type="text" name="postal_code"
            value="{{ old('postal_code',isset($clinic) ? $clinic->facilityProfile->postal_code : '') }}"
            class="form-control @error('postal_code') parsley-error @enderror">
        @include('components.input-error',['input'=> 'postal_code'])
    </div>
    <div class="form-group col-lg-6">
        <label  for="phone">@lang('clinics.phone')<span class="tx-danger">*</span></label>
        <input id="phone" type="text" name="phone" value="{{ old('phone',isset($clinic) ? $clinic->facilityProfile->phone : '') }}"
            class="form-control @error('phone') parsley-error @enderror">
        @include('components.input-error',['input'=> 'phone'])
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-6">
        <label for="open_hours">@lang('clinics.open_hours')<span class="tx-danger">*</span></label>
        <input  id="open_hours" type="time" name="open_hours"
            value="{{ old('open_hours',isset($clinic) ? $clinic->facilityProfile->open_hours : '') }}"
            class="form-control @error('open_hours') parsley-error @enderror">
        @include('components.input-error',['input'=> 'open_hours'])
    </div>
    <div class="form-group col-lg-6">
        <label for="close_hours">@lang('clinics.close_hours')<span class="tx-danger">*</span></label>
        <input  id="close_hours" type="time" name="close_hours"
            value="{{ old('close_hours',isset($clinic) ? $clinic->facilityProfile->close_hours : '') }}"
            class="form-control @error('close_hours') parsley-error @enderror">
        @include('components.input-error',['input'=> 'close_hours'])
    </div>
</div>
@isset($clinic)
    <div class="row d-block mx-1">
        <label class="d-block">@lang('clinics.image')</label>
        <img alt="" class="img-thumbnail wd-100p wd-sm-200"
            src="{{ $clinic->image ? URL::asset('uploads/'.$clinic->image->url) : URL::asset('uploads/clinic.png') }}">
        <label class="ckbox mt-2 mb-4"><input type="checkbox"
                id="check_edit"><span>@lang('clinics.edit_image')</span></label>
    </div>
@endisset
<div class="row {{ isset($clinic) ? 'd-none' : '' }}" @isset($clinic) id="image_uploade" @endisset>
    <div class="col-12"> 
        <label for="image">@if(!isset($clinic)) @lang('clinics.image') @endif</label>
        <input type="file" name="image" accept="image/jpeg,image/png,image/gif" id="image" class="dropify"
            data-height="150" />
        @error('image')<span class="error text-danger text-xs">{{$message}}</span>@enderror
    </div>
    <span class="text-success font-weight-bold mt-2 mx-3">* @lang('clinics.image_note') :
        jpg,png,gif</span>


</div>