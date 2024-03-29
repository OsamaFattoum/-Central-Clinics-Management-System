<div class="modal  fade" id="create" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">@lang('departments.btn_create_department')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('departments.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        @foreach (config('translatable.locales') as $local)
                        <div class="form-group col">
                            <label for="name_dep_{{ $local }}">@lang('departments.name_department_'. $local )<span
                                    class="tx-danger">*</span></label>
                            <input id="name_dep_{{ $local }}" type="text" name="{{ $local }}[name]"
                                class="form-control">
                        </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="scientfic_n">@lang('departments.scientific_name')<span
                                    class="tx-danger">*</span></label>
                            <input id="scientfic_n" type="text" name="scientific_name" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="give_drug">@lang('departments.given_drug')<span
                                    class="tx-danger">*</span></label>
                            <select id="give_drug" name="status" class="form-control">
                                <option value="0" selected>@lang('departments.not_give_drug')</option>
                                <option value="1">@lang('departments.give_drug')</option>

                            </select>
                        </div>
                    </div>


                    @foreach (config('translatable.locales') as $local)
                    <div class="form-group ">
                        <label for="desc_{{ $local }}">@lang('departments.description_'. $local)</label>
                        <textarea style="resize: none" name="{{ $local }}[description]" id="desc_{{ $local }}" rows="5"
                            class="form-control {{ $local == 'en' ? 'text-left' : '' }}"></textarea>
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