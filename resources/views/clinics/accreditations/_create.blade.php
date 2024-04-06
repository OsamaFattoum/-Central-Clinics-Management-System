<div class="modal  fade" id="create" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">@lang('clinic_accreditations.btn_create_accredition')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('accreditations.store',$clinic->id) }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">


                    <div class="form-group">
                        <label for="name_accreditation">@lang('clinic_accreditations.name_accreditions')<span
                                class="tx-danger">*</span></label>
                        <input id="name_accreditation"  type="text" name="name" class="form-control">
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

