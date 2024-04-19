<div class="row">
    @foreach (config('translatable.locales') as $index => $local)
    <div class="control-group form-group col-lg-6">
        <label for="name_doctor_{{ $local }}">@lang('doctors.name_doctor_'. $local )<span
                class="tx-danger">*</span></label>
        <input {{ $index==0 ? 'autofocus' : '' }}
            class="form-control @error('form.names.' . $local ) parsley-error @enderror" id="name_doctor_{{ $local }}"
            type="text" wire:model='form.names.{{ $local }}'>
        @include('components.input-error',['input'=> 'form.names.' . $local])
    </div>
    @endforeach

</div>
<div class="row">
    <div class="control-group form-group col-lg-6">
        <label for="civil_input">@lang('users.civil_id')<span class="tx-danger">*</span></label>
        <input id="civil_input" type="text" wire:model='form.civil_id'
            class="form-control @error('form.civil_id') parsley-error @enderror">
        @include('components.input-error',['input'=> 'form.civil_id'])
    </div>
    <div class="control-group form-group col-lg-6">
        <label for="email">@lang('users.email')<span class="tx-danger">*</span></label>
        <input id="email" type="email" wire:model='form.email'
            class="form-control @error('form.email') parsley-error @enderror">
        @include('components.input-error',['input'=> 'form.email'])
    </div>
</div>
@if (!$updateMode)
<div class="row">
    <div class="control-group form-group col-lg-6">
        <label for="password">@lang('users.password')<span class="tx-danger">*</span></label>
        <input id="password" type="password" wire:model="form.password"
            class="form-control @error('form.password') parsley-error @enderror">
        @include('components.input-error',['input'=> 'form.password'])
    </div>
    <div class="control-group form-group col-lg-6">
        <label for="password_confirmation">@lang('users.password_confirmation')<span class="tx-danger">*</span></label>
        <input id="password_confirmation" type="password" wire:model="form.password_confirmation"
            class="form-control  @error('form.password_confirmation') parsley-error @enderror">
        @include('components.input-error',['input'=> 'form.password_confirmation'])
    </div>
</div>

@endif

<div class="row">
    <div class="form-group col-lg-6">
        <label for="clinics">@lang('users.clinics')<span class="tx-danger">*</span></label>
        <select wire:model.live="form.clinic" id="clinics" wire:change='selectClinic'
            class="form-control @error('form.clinic') custom-select2-border @enderror"
            data-parsley-error="#slErrorContainer" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
            <option value="">@lang('site.select_package_placeholder')</option>
            @foreach ($clinics as $clinic)
            <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
            @endforeach
        </select>
        @include('components.input-error',['input'=> 'form.clinic','is_select'=>true])
    </div>

    <div class="form-group col-lg-6">
        <label for="departments">@lang('users.departments')<span class="tx-danger">*</span></label>
        @if ($selectedClinic)
        <select wire:model.live="form.department" id="departments" wire:change='selectDepartment'
            class="form-control @error('form.department') custom-select2-border @enderror"
            data-parsley-error="#slErrorContainer" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
            <option value="">@lang('site.select_package_placeholder')</option>
            @foreach ($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
        @else
        <input type="text" class="form-control" readonly placeholder="{{ __('site.select_package_placeholder') }}">
        @endif
        @include('components.input-error',['input'=> 'form.department','is_select'=>true])
    </div>
</div>
@if ($selectedDepartment)

<label>@lang('users.permissions')<span class="tx-danger">*</span></label>
@error('form.permissions')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="form-group">
    <div class="panel panel-primary tabs-style-2">
        <div class=" tab-menu-heading">
            <div class="tabs-menu1">
                <!-- Tabs -->
                <ul class="nav panel-tabs main-nav-line">
                    <li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">{{
                            $selectedDepartment->name }}</a>
                    </li>
                    @if ($selectedDepartment->status)
                    <li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">@lang('doctors.drugs')</a>
                    </li>
                    @endif


                </ul>
            </div>
        </div>
        <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
            <div class="tab-content">
                <div  class="tab-pane active" id="tab1">
                    <div class="d-flex">
                        @foreach (config('laratrust_seeder.permissions_map') as $map)
                        <label class="ckbox mt-2 mb-2 mx-2">
                            <input wire:key='{{$map}}-{{$selectedDepartment->scientific_name}}' type="checkbox" wire:click="toggleChecked('{{$map}}-{{$selectedDepartment->scientific_name}}')" wire:model='form.permissions.{{$map . '-' .
                            $selectedDepartment->scientific_name }}' id="{{$selectedDepartment->scientific_name .
                            $map}}">
                            <span>@lang('doctors.'. $map)</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @if ($selectedDepartment->status)
                <div  class="tab-pane" id="tab2">
                    <div class="d-flex">
                        @foreach (config('laratrust_seeder.permissions_map') as $map)
                        <label for="drug{{$map}}" class="ckbox mt-2 mb-2 mx-2">
                            <input wire:key='{{$map}}-drug' wire:click="toggleChecked('{{$map}}-drug')" wire:model='form.permissions.{{$map . '-drug'}}' id="drug{{$map}}"
                                type="checkbox"><span>@lang('doctors.'. $map)</span></label>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endif