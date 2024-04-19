<div class="row">
    <div class="form-group col-lg-6">
        <label for="address">@lang('users.address')<span class="tx-danger">*</span></label>
        <input id="address" type="text" wire:model="form.address" 
            class="form-control @error('form.address') parsley-error @enderror">
        @include('components.input-error',['input'=> 'form.address'])
    </div>
    <div class="form-group col-lg-6">
        <label for="cities">@lang('users.city')<span class="tx-danger">*</span></label>
        <select  wire:model="form.city" id="cities" class="form-control @error('form.city') custom-select2-border @enderror"
            data-parsley-error="#slErrorContainer" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
            <option value="">@lang('site.select_package_placeholder')</option>
            @foreach ($cities as $city)
            <option value="{{ $city['id'] }}">{{
                $city['name_' . app()->getLocale()] }}</option>
            @endforeach
        </select>
        @include('components.input-error',['input'=> 'form.city','is_select'=>true])
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-4">
        <label  for="phone">@lang('users.phone')<span class="tx-danger">*</span></label>
        <input id="phone" type="text" wire:model="form.phone"
            class="form-control @error('form.phone') parsley-error @enderror">
        @include('components.input-error',['input'=> 'form.phone'])
    </div>
    <div class="form-group col-lg-4">
        <label for="gender">@lang('users.gender')<span class="tx-danger">*</span></label>
        <select wire:model="form.gender" id="gender"
            class="form-control @error('form.gender') custom-select2-border @enderror" data-parsley-error="#slErrorContainer"
            dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
            <option value="">@lang('site.select_package_placeholder')</option>
            <option value="1">@lang('users.male')</option>
            <option value="0">@lang('users.female')</option>
        </select>
        @include('components.input-error',['input'=> 'form.gender','is_select'=>true])
    </div>
    <div class="form-group col-lg-4">
        <label  for="dob">@lang('users.dob')<span class="tx-danger">*</span></label>
        <input id="dob" type="date" wire:model="form.dob"
            class="form-control @error('form.dob') parsley-error @enderror">
        @include('components.input-error',['input'=> 'form.dob'])
    </div>
</div>

