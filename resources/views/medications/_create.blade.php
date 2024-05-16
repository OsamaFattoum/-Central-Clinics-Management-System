<div class="modal  fade" id="create" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">@lang('records.btn_add_record')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('medications.store',['patient' => $patient->id]) }}" method="post"
                autocomplete="off">
                @csrf
                <div class="modal-body">

                    @livewire('select-department-cases')
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="name">@lang('medications.name')<span class="tx-danger">*</span></label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="dosage">@lang('medications.dosage')<span class="tx-danger">*</span></label>
                            <input id="dosage" type="text" value="{{ old('dosage') }}" name="dosage" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="instructions">@lang('medications.instructions')<span class="tx-danger">*</span></label>
                        <textarea style="resize: none" name="instructions" rows="5"
                            class="form-control">{{ old('instructions') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <p class="text text-danger">ملاحظة: الرجاء التأكد من البيانات قبل الاضافة</p>

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