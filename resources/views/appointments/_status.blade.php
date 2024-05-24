<div class="modal fade" id="status{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="addLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">@lang('modal.edit') @lang('appointments.status')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('appointments.status',['patient' => $patient->id,'appointment'=>$appointment->id]) }}"
                method="post" autocomplete="off">
                @csrf
                
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="status">@lang('appointments.status')</label>
                        <select id="status" class="form-control" name="status">
                            <option {{ $appointment->status == '0' ? 'selected' : '' }} value="0">@lang('appointments.pending')</option>
                            <option {{ $appointment->status == '1' ? 'selected' : '' }}  value="1">@lang('appointments.confirmed')</option>
                            <option {{ $appointment->status == '2' ? 'selected' : '' }}  value="2">@lang('appointments.cancelled')</option>
                        </select>
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