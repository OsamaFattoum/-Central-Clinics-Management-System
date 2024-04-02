<div class="modal fade" id="edit{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">@lang('modal.edit') {{ $department->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('departments.update',$department->id) }}" method="post" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body">
                
                  
                    <div class="row">
                        @foreach (config('translatable.locales') as $index => $local)
                        <div class="form-group col">
                            <label for="name_dep_{{ $local }}">@lang('departments.name_department_'. $local )<span
                                    class="tx-danger">*</span></label>
                            <input id="name_dep_{{ $local }}" required type="text"  name="{{ $local }}[name]" value="{{ $department->translate($local)->name }}"
                                class="form-control">
                        </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="scientfic_n">@lang('departments.scientific_name')<span
                                    class="tx-danger">*</span></label>
                            <input id="scientfic_n" required type="text" name="scientific_name" value="{{ $department->scientific_name }}" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="give_drug">@lang('departments.given_drug')<span class="tx-danger">*</span></label>
                            <select id="give_drug" required name="status" class="form-control">
                                <option value="0" {{ $department->status === 0 ? 'selected' : '' }}>@lang('departments.not_give_drug')</option>
                                <option value="1" {{ $department->status === 1 ? 'selected' : '' }}>@lang('departments.give_drug')</option>
                                
                            </select>
                        </div>  
                    </div>


                    @foreach (config('translatable.locales') as  $local)
                    <div class="form-group ">
                        <label for="desc_{{ $local }}">@lang('departments.description_'. $local)</label>
                        <textarea style="resize: none" name="{{ $local }}[description]" id="desc_{{ $local }}" rows="5"
                            class="form-control {{ $local == 'ar' ? 'text-right' : 'text-left' }}">{{ $department->translate($local)->description }}</textarea>
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