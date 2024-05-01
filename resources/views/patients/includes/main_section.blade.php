<div class="row">
    @foreach (config('translatable.locales') as $index => $local)
    <div class="control-group form-group col-lg-6">
        <label for="name_patient_{{ $local }}">@lang('patients.name_patient_'. $local )<span
                class="tx-danger">*</span></label>
        <input {{ $index==0 ? 'autofocus' : '' }}  id="name_patient_{{ $local }}" type="text"
            value="{{ old($local . '.name',isset($patient) && isset($profile) ? $profile->translate($local)->name : '') }}" name="{{ $local
        }}[name]"
        class="form-control @error($local.".name") parsley-error @enderror">
        @include('components.input-error',['input'=> $local.".name"])
    </div>
    @endforeach
</div>
 <div class="row">
    <div class="control-group form-group col-lg-6">
        <label for="civil_id">@lang('users.civil_id')<span class="tx-danger">*</span></label>
        <input id="civil_id" type="text" name="civil_id"
            value="{{ old('civil_id',isset($patient) ? $patient->civil_id : '') }}"
            class="form-control @error('civil_id') parsley-error @enderror">
        @include('components.input-error',['input'=> 'civil_id'])
    </div>
    <div class="control-group form-group col-lg-6">
        <label for="email">@lang('users.email')<span class="tx-danger">*</span></label>
        <input id="email" type="email" name="email" value="{{ old('email',isset($patient) ? $patient->email: '') }}"
            class="form-control @error('email') parsley-error @enderror">
        @include('components.input-error',['input'=> 'email'])
    </div>
</div>
@if (request()->route()->getName() == 'patients.create')
<div class="row">
    <div class="control-group form-group col-lg-6">
        <label for="password">@lang('users.password')<span class="tx-danger">*</span></label>
        <input id="password" type="password" name="password"
            class="form-control @error('password') parsley-error @enderror">
        @include('components.input-error',['input'=> 'password'])
    </div>
    <div class="control-group form-group col-lg-6">
        <label for="password_confirmation">@lang('users.password_confirmation')<span
                class="tx-danger">*</span></label>
        <input id="password_confirmation" type="password" name="password_confirmation"
            class="form-control  @error('password_confirmation') parsley-error @enderror">
        @include('components.input-error',['input'=> 'password_confirmation'])
    </div>
</div>
@endif
