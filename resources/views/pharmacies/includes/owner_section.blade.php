<div class="row">
    <div class="form-group col-lg-6">
        <label for="owner_name">@lang('facility.owner_name')<span class="tx-danger">*</span></label>
        <input  id="owner_name" type="text" name="owner_name" value="{{ old('owner_name',isset($pharmacy) ? $pharmacy->facilityProfile->owner_name  : '') }}" class="form-control @error('owner_name') parsley-error @enderror">
        @include('components.input-error',['input'=> 'owner_name'])
    </div>
 

    <div class="form-group col-lg-6">
        <label for="owner_phone">@lang('facility.phone')<span class="tx-danger">*</span></label>
        <input  id="owner_phone" type="text" name="owner_phone" value="{{ old('owner_phone',isset($pharmacy) ? $pharmacy->facilityProfile->owner_phone : '') }}" class="form-control @error('owner_phone') parsley-error @enderror">
        @include('components.input-error',['input'=> 'owner_phone'])
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-6">
        <label for="owner_email">@lang('facility.email')<span class="tx-danger">*</span></label>
        <input  id="owner_email" type="email" name="owner_email" value="{{ old('owner_email',isset($pharmacy) ? $pharmacy->facilityProfile->owner_email : '') }}" class="form-control @error('owner_email') parsley-error @enderror">
        @include('components.input-error',['input'=> 'owner_email'])
    </div>
</div>