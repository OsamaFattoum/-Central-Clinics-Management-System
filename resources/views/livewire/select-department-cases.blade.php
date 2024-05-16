<div class="row">
    <div class="form-group col-lg-6">
        <label for="departments">@lang('medications.departments')<span class="tx-danger">*</span></label>
        <select wire:model='department' id="departments" class="form-control" name="department" wire:change='selectDepartment'>
            <option value="">@lang('site.select_package_placeholder')</option>
            @foreach ($departments as $department)
            <option value="{{ $department->id
                }}">{{ $department->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-lg-6">
        <label for="case_type">@lang('medications.case_type')<span class="tx-danger">*</span></label>
        @if ($selectedDepartment)
            <select wire:model='case_type' id="case_type" name="case_type" class="form-control">
                <option value="">@lang('site.select_package_placeholder')</option>
                @foreach ($caseTypes as $caseType)
                <option  value="{{ $caseType->id
                    }}">{{ $caseType->name }}</option>
                @endforeach
            </select>
        @else
            <input type="text" class="form-control" readonly placeholder="{{ __('site.select_package_placeholder') }}">
        @endif

    </div>

</div>