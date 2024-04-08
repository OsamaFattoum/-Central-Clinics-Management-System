<div class="row">
    @foreach (config('translatable.locales') as $index => $local)
    <div class="control-group form-group col-lg-6">
        <label for="name_clinic_{{ $local }}">@lang('clinics.name_clinic_'. $local )<span
                class="tx-danger">*</span></label>
        <input {{ $index==0 ? 'autofocus' : '' }}  id="name_clinic_{{ $local }}" type="text"
            value="{{ old($local . '.name',isset($clinic) ? $clinic->translate($local)->name : '') }}" name="{{ $local
        }}[name]"
        class="form-control @error($local.".name") parsley-error @enderror">
        @include('components.input-error',['input'=> $local.".name"])
    </div>
    @endforeach
</div>
<div class="row">
    <div class="control-group form-group col-lg-6">
        <label for="number_input">@lang('facility.number_facility')<span class="tx-danger">*</span></label>
        <input id="number_input" type="text" name="number"
            value="{{ old('number',isset($clinic) ? $clinic->number : '') }}"
            class="form-control @error('number') parsley-error @enderror">
        @include('components.input-error',['input'=> 'number'])
    </div>
    <div class="control-group form-group col-lg-6">
        <label for="email">@lang('facility.email')<span class="tx-danger">*</span></label>
        <input id="email" type="email" name="email" value="{{ old('email',isset($clinic) ? $clinic->email: '') }}"
            class="form-control @error('email') parsley-error @enderror">
        @include('components.input-error',['input'=> 'email'])
    </div>
</div>
@if (request()->route()->getName() == 'clinics.create')
<div class="row">
    <div class="control-group form-group col-lg-6">
        <label for="password">@lang('facility.password')<span class="tx-danger">*</span></label>
        <input id="password" type="password" name="password"
            class="form-control @error('password') parsley-error @enderror">
        @include('components.input-error',['input'=> 'password'])
    </div>
    <div class="control-group form-group col-lg-6">
        <label for="password_confirmation">@lang('facility.password_confirmation')<span
                class="tx-danger">*</span></label>
        <input id="password_confirmation" type="password" name="password_confirmation"
            class="form-control  @error('password_confirmation') parsley-error @enderror">
        @include('components.input-error',['input'=> 'password_confirmation'])
    </div>
</div>
@endif

<div class="row">
    <div class="control-group form-group col-lg-6 days-select2">
        <label for="days">@lang('facility.open_days')<span class="tx-danger">*</span></label>
        <select name="days[]" id="days" class="form-control select2"
            dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}" multiple="multiple">
            @foreach ($days as $day)
            @php
            $selected = false;
            if (old('days')) {
            $selected = in_array($day->id, (array) old('days'));
            } elseif (isset($clinic)) {
            $selected = $clinic->facilityDays->contains('day_id', $day->id);
            }
            @endphp
            <option {{ $selected ? 'selected' : '' }} value="{{ $day->id }}">{{ $day->day }}</option>
            @endforeach
        </select>
        @include('components.input-error',['input'=> 'days','is_select'=>true])
    </div>
    <div class="control-group form-group col-lg-6 department-select2">
        <label for="departments">@lang('clinics.department')<span class="tx-danger">*</span></label>
        <select name="departments[]" id="departments" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}"
            class="form-control select2 text-left" multiple="multiple">

            @foreach ($departments as $department)
            @php
            $selected = false;
            if (old('departments')) {
                $selected = in_array($department->id, (array) old('departments'));
            } elseif (isset($clinic)) {
                $selected = $clinic->departments->contains('id', $department->id);
            }
            @endphp
            <option {{ $selected ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
        @include('components.input-error',['input'=> 'departments','is_select'=> true])
    </div>
</div>

<div class="row">
    @foreach (config('translatable.locales') as $local)
    <div class="control-group form-group col-lg-6">
        <label for="desc_{{ $local }}">@lang('facility.description_'. $local)</label>
        <textarea style="resize: none" name="{{ $local }}[description]" id="desc_{{ $local }}" rows="5"
            class="form-control {{ $local == 'ar' ? 'text-right' : 'text-left' }}">{{ old($local . '.description',isset($clinic) ? $clinic->translate($local)->description: '') }}</textarea>
    </div>
    @endforeach
</div>