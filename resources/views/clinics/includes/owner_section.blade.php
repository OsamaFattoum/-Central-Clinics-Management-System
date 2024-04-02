<div class="row">
    <div class="form-group col-lg-6">
        <label for="owner_name">@lang('clinics.owner_name')<span class="tx-danger">*</span></label>
        <input  id="owner_name" type="text" name="owner_name" value="{{ old('owner_name',isset($clinic) ? $clinic->facilityProfile->owner_name  : '') }}" class="form-control @error('owner_name') parsley-error @enderror">
        @include('components.input-error',['input'=> 'owner_name'])
    </div>
    <div class="form-group col-lg-6">
        <label for="owner_phone">@lang('clinics.phone')<span class="tx-danger">*</span></label>
        <input  id="owner_phone" type="text" name="owner_phone" value="{{ old('owner_phone',isset($clinic) ? $clinic->facilityProfile->owner_phone : '') }}" class="form-control @error('owner_phone') parsley-error @enderror">
        @include('components.input-error',['input'=> 'owner_phone'])
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-6">
        <label for="owner_email">@lang('clinics.email')<span class="tx-danger">*</span></label>
        <input  id="owner_email" type="email" name="owner_email" value="{{ old('owner_email',isset($clinic) ? $clinic->facilityProfile->owner_email : '') }}" class="form-control @error('owner_email') parsley-error @enderror">
        @include('components.input-error',['input'=> 'owner_email'])
    </div>
</div>