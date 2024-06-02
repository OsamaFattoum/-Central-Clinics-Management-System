<div class="modal fade" id="edit{{ $record->id }}" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">@lang('modal.edit') ({{ $record->caseType->name }}) @lang('records.in_date') ({{ $record->date }})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('records.update',['patient' => $patient->id,'department' => $department->id,'record'=>$record->id]) }}" method="post" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="case_type">@lang('records.case_type')<span class="tx-danger">*</span></label>
                            <select name="case_type" id="case_type" class="form-control">
                                @foreach ($caseTypes as $caseType)
                                <option {{ old('case_type',$record->case_type_id) ==$caseType->id ? 'selected' : '' }} value="{{ $caseType->id
                                    }}">{{ $caseType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="measurement_unit">@lang('records.measurement_unit')</label>
                            <input id='measurement_unit' class="form-control" type="text" name="measurement_unit"
                                value="{{ old('measurement_unit',$record->measurement_unit) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="result">@lang('records.result')<span class="tx-danger">*</span></label>
                            <select name="result" id="result" class="form-control">
                                <option {{ old('result',$record->result)== 0 ? 'selected' : '' }} value="0">@lang('records.res_abnormal')</option>
                                <option {{ old('result',$record->result)== 1 ? 'selected' : '' }} value="1">@lang('records.res_normal')</option>
                                <option {{ old('result',$record->result)== 2 ? 'selected' : '' }} value="2">@lang('records.res_positive')</option>
                                <option {{ old('result',$record->result)== 3 ? 'selected' : '' }} value="3">@lang('records.res_negative')</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="reference_range">@lang('records.reference_range')</label>
                            <input id='reference_range' class="form-control" type="text" name="reference_range"
                                value="{{ old('reference_range',$record->reference_range) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="value">@lang('records.value')<span class="tx-danger">*</span></label>
                        <textarea style="resize: none" name="value" rows="5"
                            class="form-control">{{ old('value',$record->value) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <p class="text text-danger">@lang('modal.chack-data')</p>

                    <div class="">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">@lang('modal.btn_close')</button>
                        <button type="submit" class="btn btn-primary">@lang('modal.btn_submit')</button>

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>