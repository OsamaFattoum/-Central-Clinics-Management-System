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
    {{-- Job Number --}}
    <div class="control-group form-group col-lg-6">
        <label for="job_number">@lang('doctors.job_number')<span class="tx-danger">*</span></label>
        @if ($updateMode)
            @auth('clinic')
                <input type="text" id="job_number" value="{{ $form->job_number }}"
                    class="form-control @error('form.job_number') parsley-error @enderror" readonly>
                @include('components.input-error',['input'=> 'form.job_number'])
            @else
                @include('livewire.doctors.includes._job_input')
            @endauth
        @else
            @include('livewire.doctors.includes._job_input')
        @endif
      
    </div>
    {{-- End Job Number --}}
    {{-- Civil ID --}}
    <div class="control-group form-group col-lg-6">
        <label for="civil_input">@lang('users.civil_id')<span class="tx-danger">*</span></label>
        @if ($updateMode)
            @auth('clinic')
                <input type="text" id="civil_id" value="{{ $form->civil_id }}"
                    class="form-control @error('form.civil_id') parsley-error @enderror" readonly>
                @include('components.input-error',['input'=> 'form.civil_id'])
            @else
                @include('livewire.doctors.includes._civil_input')
            @endauth
        @else
            @include('livewire.doctors.includes._civil_input')
        @endif
    </div>
    {{-- End Civil ID --}}
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
    {{-- Select Clinic --}}
    <div class="form-group col-lg-6">
        <label for="clinics">@lang('users.clinics')<span class="tx-danger">*</span></label>
        @auth('clinic')
        <input type="text" id="clinics" value="{{ $clinics->name }}"
            class="form-control @error('form.clinic') parsley-error @enderror" readonly>
        @include('components.input-error',['input'=> 'form.clinic'])
        @else
        <select wire:model.live="form.clinic" id="clinics" wire:change='selectClinic'
            class="form-control  @error('form.clinic') custom-select2-border @enderror "
            dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
            <option value="">@lang('site.select_package_placeholder')</option>
            @foreach ($clinics as $clinic)
            <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
            @endforeach
        </select>
        @include('components.input-error',['input'=> 'form.clinic','is_select'=>true])
        @endauth
    </div>
    {{-- End Select Clinic --}}
    {{-- Select Department --}}
    <div class="form-group col-lg-6">
        <label for="departments">@lang('users.departments')<span class="tx-danger">*</span></label>
            @if ($updateMode)
                @auth('clinic')
                    <input type="text" id="departments" value="{{ $departments->where('id',$form->department)->first()->name }}"
                    class="form-control @error('form.department') parsley-error @enderror" readonly>
                    @include('components.input-error',['input'=> 'form.department'])
                @else
                    @include('livewire.doctors.includes._select_department')
                @endauth
            @else
                @include('livewire.doctors.includes._select_department')
            @endif
    </div>
    {{-- End Select Department --}}
</div>


@if ($selectedDepartment)
{{-- Select Permissons --}}
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
                    <li class="nav-item"><a href="#tab1" wire:click='selectTab(1)'
                            class="nav-link {{ $activeTab == 1 ? 'active' : ''}}" data-toggle="tab">{{
                            $selectedDepartment->name }}</a>
                    </li>
                    @if ($selectedDepartment->status)
                    <li class="nav-item"><a href="#tab2" wire:click='selectTab(2)'
                            class="nav-link {{ $activeTab == 2 ? 'active' : ''}}"
                            data-toggle="tab">@lang('doctors.medications')</a>
                    </li>
                    @endif


                </ul>
            </div>
        </div>
        <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
            <div class="tab-content">
                <div class="tab-pane {{ $activeTab == 1 ? 'active' : ''}}" id="tab1">
                    <div class="d-flex">
                        @foreach (config('laratrust_seeder.permissions_map') as $map)
                        @if ($map != 'delete' && $map != 'status' && $map != 'read')
                        <label class="ckbox mt-2 mb-2 mx-2">
                            <input wire:key='{{$map}}-{{$selectedDepartment->scientific_name}}' type="checkbox"
                                wire:click="toggleChecked('{{$map}}-{{$selectedDepartment->scientific_name}}')"
                                wire:model='form.permissions.{{$map . '-' . $selectedDepartment->scientific_name
                            }}'
                            id="{{$selectedDepartment->scientific_name .
                            $map}}">
                            <span>@lang('doctors.'. $map)</span>
                        </label>
                        @endif
                        @endforeach
                    </div>
                </div>
                @if ($selectedDepartment->status)
                <div class="tab-pane {{ $activeTab == 2 ? 'active' : ''}}" id="tab2">
                    <div class="d-flex">
                        @foreach (config('laratrust_seeder.permissions_map') as $map)

                        @if ($map != 'delete' && $map != 'status' && $map != 'read')
                        <label for="medications{{$map}}" class="ckbox mt-2 mb-2 mx-2">
                            <input wire:key='{{$map}}-medications' wire:click="toggleChecked('{{$map}}-medications')"
                                wire:model='form.permissions.{{$map . '-medications'}}' id="medications{{$map}}"
                                type="checkbox"><span>@lang('doctors.'. $map)</span></label>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
{{-- End Select Permissons --}}


{{-- Select Related Department --}}
<label>@lang('doctors.related_departments')</label>
<div class="form-group">
    <div class="d-flex">
        @foreach ($allDepartments as $department)
        @if ($selectedDepartment->name != $department->name)
        <label class="ckbox mt-2 mb-2 mx-2">
            <input wire:key='read-{{ $department->scientific_name }}' wire:model='form.permissions.{{'read' . '-' .
                $department->scientific_name }}'
            wire:click="toggleChecked('read-{{ $department->scientific_name }}')" type="checkbox">
            <span>{{ $department->name }}</span>
        </label>
        @endif

        @endforeach
    </div>
</div>
{{-- End Select Related Department --}}
@endif