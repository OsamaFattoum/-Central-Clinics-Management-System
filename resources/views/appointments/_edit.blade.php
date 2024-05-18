<div class="modal fade" id="edit{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="addLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">@lang('modal.edit') @lang('appointments.appointment')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('appointments.update',['patient' => $patient->id,'appointment'=>$appointment->id]) }}"
                method="post" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    
                    @livewire('appointment',['clinic' => $appointment->clinic_id,'selectedClinic'=>true,'department'=>$appointment->department_id,'selectedDepartment' => true,'doctor'=>$appointment->doctor_id])
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="date">@lang('appointments.date')</label>
                            <input id="date" type="date" name="date" value="{{ $appointment->date }}" class="form-control">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="time">@lang('appointments.time')</label>
                            <input id="time" type="time" name="time" value="{{ $appointment->time }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes">@lang('appointments.notes')</label>
                        <textarea style="resize: none" name="notes" rows="5"
                            class="form-control">{{ $appointment->notes }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">@lang('modal.btn_close')</button>
                    <button type="submit" class="btn btn-primary">@lang('modal.btn_submit')</button>
                </div>
            </form>

        </div>
    </div>
</div>