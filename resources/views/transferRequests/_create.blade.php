<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">@lang('transfer.btn_add_request')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('transferRequests.store',['patient' => $patient->id]) }}" method="post"
                autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="from-group mb-2">
                        <label for="departments">@lang('transfer.department')<span class="tx-danger">*</span></label>
                        <select id="departments" class="form-control" name="department_id">
                            <option value="">@lang('site.select_package_placeholder')</option>
                            @foreach ($departments as $department)
                            <option {{ old('department_id') == $department->id ? 'selected' : '' }} value="{{ $department->id
                            }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="information">@lang('transfer.information')<span class="tx-danger">*</span></label>
                        <textarea style="resize: none" name="information" rows="5"
                            class="form-control">{{ old('information') }}</textarea>
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