<div class="modal  fade" id="create" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">@lang('case_type.btn_create_case_type')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('case_types.store',$department->id) }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">

                    @foreach (config('translatable.locales') as $index => $local)
                    <div class="form-group">
                        <label for="name_case_{{ $local }}">@lang('case_type.name_case_'. $local )<span
                                class="tx-danger">*</span></label>
                        <input {{ $index==0 ? 'autofocus' : '' }} id="name_case_{{ $local }}" type="text"
                            name="{{ $local }}[name]" class="form-control">
                    </div>
                    @endforeach
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