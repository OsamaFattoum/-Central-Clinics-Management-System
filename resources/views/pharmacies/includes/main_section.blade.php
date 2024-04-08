<div class="row">
    @foreach (config('translatable.locales') as $index => $local)
    <div class="control-group form-group col-lg-6">
        <label for="name_pharmacy_{{ $local }}">@lang('pharmacy.name_pharmacy_'. $local )<span
                class="tx-danger">*</span></label>
        <input {{ $index==0 ? 'autofocus' : '' }}  id="name_pharmacy_{{ $local }}" type="text"
            value="{{ old($local . '.name',isset($pharmacy) ? $pharmacy->translate($local)->name : '') }}" name="{{ $local
        }}[name]" class="form-control @error($local.".name") parsley-error @enderror" />
        @include('components.input-error',['input'=> $local.".name"])
    </div>
    @endforeach
  
</div>
<div class="row">
    <div class="control-group form-group col-lg-6">
        <label for="number_input">@lang('facility.number_facility')<span class="tx-danger">*</span></label>
        <input id="number_input" type="text" name="number"
            value="{{ old('number',isset($pharmacy) ? $pharmacy->number : '') }}"
            class="form-control @error('number') parsley-error @enderror">
        @include('components.input-error',['input'=> 'number'])
    </div>
    <div class="control-group form-group col-lg-6">
        <label for="email">@lang('facility.email')<span class="tx-danger">*</span></label>
        <input id="email" type="email" name="email" value="{{ old('email',isset($pharmacy) ? $pharmacy->email: '') }}"
            class="form-control @error('email') parsley-error @enderror">
        @include('components.input-error',['input'=> 'email'])
    </div>
</div>
@if (request()->route()->getName() == 'pharmacies.create')
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


<div class="control-group form-group  days-select2">
    <label for="days">@lang('facility.open_days')<span class="tx-danger">*</span></label>
    <select name="days[]" id="days" class="form-control select2"
        dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}" multiple="multiple">
        @foreach ($days as $day)
        @php
        $selected = false;
        if (old('days')) {
        $selected = in_array($day->id, (array) old('days'));
        } elseif (isset($pharmacy)) {
        $selected = $pharmacy->facilityDays->contains('day_id', $day->id);
        }
        @endphp
        <option {{ $selected ? 'selected' : '' }} value="{{ $day->id }}">{{ $day->day }}</option>
        @endforeach
    </select>
    @include('components.input-error',['input'=> 'days','is_select'=>true])
</div>


<div class="row">
    @foreach (config('translatable.locales') as $local)
    <div class="control-group form-group col-lg-6">
        <label for="desc_{{ $local }}">@lang('facility.description_'. $local)</label>
        <textarea style="resize: none" name="{{ $local }}[description]" id="desc_{{ $local }}" rows="5"
            class="form-control {{ $local == 'ar' ? 'text-right' : 'text-left' }}">{{ old($local . '.description',isset($pharmacy) ? $pharmacy->translate($local)->description: '') }}</textarea>
    </div>
    @endforeach
</div>