@if ($selectedClinic)
<select wire:model.live="form.department" id="departments" wire:change='selectDepartment'
    class="form-control @error('form.department') custom-select2-border @enderror"
    dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
    <option value="">@lang('site.select_package_placeholder')</option>
    @foreach ($departments as $department)
    <option value="{{ $department->id }}">{{ $department->name }}</option>
    @endforeach
</select>
@else
<input type="text" class="form-control" readonly placeholder="{{ __('site.select_package_placeholder') }}">
@endif
@include('components.input-error',['input'=> 'form.department','is_select'=>true])