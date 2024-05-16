<select wire:model="form.gender" id="gender" class="form-control @error('form.gender') custom-select2-border @enderror"
    data-parsley-error="#slErrorContainer" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
    <option value="">@lang('site.select_package_placeholder')</option>
    <option value="1">@lang('users.male')</option>
    <option value="0">@lang('users.female')</option>
</select>
@include('components.input-error',['input'=> 'form.gender','is_select'=>true])