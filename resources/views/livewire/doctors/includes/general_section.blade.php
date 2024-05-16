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
    <div class="form-group col-lg-6">
        <label  for="phone">@lang('users.phone')<span class="tx-danger">*</span></label>
        <input id="phone" type="text" wire:model="form.phone"
            class="form-control @error('form.phone') parsley-error @enderror">
        @include('components.input-error',['input'=> 'form.phone'])
    </div>
    <div class="form-group col-lg-6">
        <label for="gender">@lang('users.gender')<span class="tx-danger">*</span></label>
        @if ($updateMode)
            @auth('clinic')
                <input type="text" id="gender" value="{{ $form->gender == 1 ? __('users.male') : __('users.female') }}"
                class="form-control @error('form.gender') parsley-error @enderror" readonly>
                @include('components.input-error',['input'=> 'form.gender'])
            @else
                @include('livewire.doctors.includes._gender_input')
            @endauth
        @else
            @include('livewire.doctors.includes._gender_input')
        @endif
    </div>
   
</div>
<div class="row">
    <div class="control-group form-group col-lg-6">
        <label for="email">@lang('users.email')<span class="tx-danger">*</span></label>
        <input id="email" type="email" wire:model='form.email'
            class="form-control @error('form.email') parsley-error @enderror">
        @include('components.input-error',['input'=> 'form.email'])
    </div>
    <div class="form-group col-lg-6">
        <label  for="dob">@lang('users.dob')<span class="tx-danger">*</span></label>
        @if ($updateMode)
        @auth('clinic')
            <input type="text" id="dob" value="{{ $form->dob }}"
            class="form-control @error('form.dob') parsley-error @enderror" readonly>
            @include('components.input-error',['input'=> 'form.dob'])
        @else
            @include('livewire.doctors.includes._dob_input')
        @endauth
    @else
        @include('livewire.doctors.includes._dob_input')
    @endif
      
    </div>
</div>

