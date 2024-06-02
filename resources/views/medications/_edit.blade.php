<div class="modal fade" id="edit{{ $medication->id }}" tabindex="-1" role="dialog" aria-labelledby="addLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">@lang('modal.edit') ({{ $medication->name }})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('medications.update',['patient' => $patient->id,'medication'=>$medication->id]) }}"
                method="post" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    @livewire('select-department-cases',['department'=>$medication->department_id,'case_type'=>$medication->case_type_id,'selectedDepartment'=>true])

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="name">@lang('medications.name')<span class="tx-danger">*</span></label>
                            <input id="name" type="text" name="name" value="{{ old('name',$medication->name) }}"
                                class="form-control">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="dosage">@lang('medications.dosage')<span class="tx-danger">*</span></label>
                            <input id="dosage" type="text" value="{{ old('dosage',$medication->dosage) }}" name="dosage"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="med-taken">@lang('medications.medication_taken')<span
                                    class="tx-danger">*</span></label>
                            <select name="medication_taken" id="med-taken" class="form-control"
                                dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
                                <option {{ $medication->medication_taken == 0 ? 'selected' : '' }} value="0">@lang('medications.undispensed')</option>
                                <option  {{ $medication->medication_taken == 1 ? 'selected' : '' }} value="1">@lang('medications.dispensed')</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="has-alt">@lang('medications.has_alternative')<span
                                    class="tx-danger">*</span></label>
                            <select name="has_alternative" id="has-alt" class="form-control"
                                dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
                                <option {{ $medication->has_alternative == 0 ? 'selected' : '' }} value="0">@lang('medications.not_taken')</option>
                                <option  {{ $medication->has_alternative == 1 ? 'selected' : '' }} value="1">@lang('medications.taken')</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="instructions">@lang('medications.instructions')<span
                                class="tx-danger">*</span></label>
                        <textarea style="resize: none" name="instructions" rows="5"
                            class="form-control">{{ old('instructions',$medication->instructions) }}</textarea>
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