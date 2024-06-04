<div class="modal fade" id="delete_select" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @lang('delete.title_delete_all')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($route . '.bulk',$parameters) }}" method="post">
                @method('delete')
                @csrf
                <div class="modal-body">
                    <h5>@lang('delete.p_delete')</h5>
                    <input type="hidden" id="delete_select_id" name="delete_select_id" value=''>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">@lang('modal.btn_close')</button>
                    <button type="submit" class="btn btn-danger">@lang('modal.btn_submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>