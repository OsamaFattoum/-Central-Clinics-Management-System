<div wire:ignore.self class="modal fade" id="addAppointmentModal" tabindex="-1"
    aria-labelledby="addAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAppointmentModalLabel">@lang('appointments.btn_add_appointment')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @session('error_appointment')
            <div class="alert alert-danger" role="alert">
                {{ session('error_appointment') }}
            </div>
            @endsession

            <form wire:submit="saveAppointment">
                <div class="modal-body">

                    <div class="row">

                        <div class="form-group col-lg-4">
                            <label for="clinics">@lang('appointments.clinics')<span class="tx-danger">*</span></label>
                            <select wire:model='form.clinic' id="clinics"
                                class="form-control @error('form.clinic') is-invalid @enderror"
                                wire:change='selectClinic'>
                                <option value="">@lang('site.select_package_placeholder')</option>

                                @foreach ($clinics as $clinic)
                                <option value="{{ $clinic->id
                                        }}">{{ $clinic->name }}</option>
                                @endforeach


                            </select>
                            @include('components.input-error',['input'=> 'form.clinic'])

                        </div>


                        <div class="form-group col-lg-4">
                            <label for="departments">@lang('appointments.departments')<span
                                    class="tx-danger">*</span></label>
                            @if ($selectedClinic)
                            <select wire:model='form.department' id="departments"
                                class="form-control  @error('form.department') is-invalid @enderror"
                                wire:change='selectDepartment'>
                                <option value="">@lang('site.select_package_placeholder')</option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id
                                        }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @include('components.input-error',['input'=> 'form.department'])
                            @else
                            <input type="text" class="form-control" readonly
                                placeholder="{{ __('site.select_package_placeholder') }}">
                            @endif
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="doctors">@lang('appointments.doctors')<span class="tx-danger">*</span></label>
                            @if ($selectedDepartment)
                            <select wire:model='form.doctor' id="doctors"
                                class="form-control  @error('form.doctor') is-invalid @enderror">
                                <option value="">@lang('site.select_package_placeholder')</option>
                                @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id
                                        }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                            @include('components.input-error',['input'=> 'form.doctor'])
                            @else
                            <input type="text" class="form-control" readonly
                                placeholder="{{ __('site.select_package_placeholder') }}">
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="date">@lang('appointments.date')</label>
                            <input type="date" id="date" class="form-control  @error('form.date') is-invalid @enderror"
                                wire:model="form.date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            @include('components.input-error',['input'=> 'form.date'])
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="time">@lang('appointments.time')</label>
                            <input type="time" id="time" class="form-control  @error('form.time') is-invalid @enderror"
                                wire:model="form.time">
                            @include('components.input-error',['input'=> 'form.time'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes">@lang('appointments.notes')</label>
                        <textarea style="resize: none" wire:model="form.notes" rows="5"
                            class="form-control @error('form.notes') is-invalid @enderror"></textarea>
                        @include('components.input-error',['input'=> 'form.notes'])

                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">@lang('modal.btn_close')</button>
                    <button type="submit" wire:loading.attr='disabled'
                        class="btn btn-primary">@lang('modal.btn_submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>