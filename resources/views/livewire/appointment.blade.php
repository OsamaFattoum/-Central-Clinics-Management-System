<div class="row">
    <div class="form-group col-lg-4">
        <label for="clinics">@lang('appointments.clinics')<span class="tx-danger">*</span></label>
        <select wire:model='clinic' id="clinics" class="form-control" name="clinic" wire:change='selectClinic'>
            <option value="">@lang('site.select_package_placeholder')</option>
            @foreach ($clinics as $clinic)
            <option value="{{ $clinic->id
                    }}">{{ $clinic->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-lg-4">
        <label for="departments">@lang('appointments.departments')<span class="tx-danger">*</span></label>
        @if ($selectedClinic)
        <select wire:model='department' id="departments" class="form-control" name="department"
            wire:change='selectDepartment'>
            <option value="">@lang('site.select_package_placeholder')</option>
            @foreach ($departments as $department)
            <option value="{{ $department->id
                    }}">{{ $department->name }}</option>
            @endforeach
        </select>
        @else
        <input type="text" class="form-control" readonly placeholder="{{ __('site.select_package_placeholder') }}">
        @endif
    </div>
    <div class="form-group col-lg-4">
        <label for="doctors">@lang('appointments.doctors')<span class="tx-danger">*</span></label>
        @if ($selectedDepartment)
        <select wire:model='doctor' id="doctors" class="form-control" name="doctor">
            <option value="">@lang('site.select_package_placeholder')</option>
            @foreach ($doctors as $doctor)
            <option value="{{ $doctor->id
                    }}">{{ $doctor->name }}</option>
            @endforeach
        </select>
        @else
        <input type="text" class="form-control" readonly placeholder="{{ __('site.select_package_placeholder') }}">
        @endif
    </div>
</div>