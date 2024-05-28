<div class="modal fade" id="status{{ $medication->id }}" tabindex="-1" role="dialog" aria-labelledby="addLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">@lang('modal.edit') @lang('dropdown_op.drop_down_status_medication')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('medications.status',['patient' => $patient->id,'medication'=>$medication->id]) }}"
                method="post" autocomplete="off">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="medication_taken">@lang('medications.medication_taken')</label>
                        <select id="medication_taken" class="form-control" name="medication_taken">
                            <option {{ $medication->medication_taken == '0' ? 'selected' : '' }} value="0">@lang('medications.undispensed')</option>
                            <option {{ $medication->medication_taken == '1' ? 'selected' : '' }}  value="1">@lang('medications.dispensed')</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="has_alternative">@lang('medications.has_alternative')</label>
                        <select id="has_alternative" class="form-control" name="has_alternative">
                            <option {{ $medication->has_alternative == '0' ? 'selected' : '' }} value="0">@lang('medications.not_taken')</option>
                            <option {{ $medication->has_alternative == '1' ? 'selected' : '' }}  value="1">@lang('medications.taken')</option>
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