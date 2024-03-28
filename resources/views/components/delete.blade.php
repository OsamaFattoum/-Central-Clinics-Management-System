<div class="modal fade" id="delete{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('delete.title_delete') ({{ $name }})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route( $route .'.destroy',$id) }}" method="post">
                @method('delete')
                @csrf
                <div class="modal-body">
                    <h5>@lang('delete.p_delete')</h5>
                    @isset($fromProduct)
                    @if ($fromProduct)
                    <span class="text-sm text-danger">{{ '*Warning: All invoices related to this product will be deleted!' }}</span>
                    @endif
                    @endisset
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('modal.btn_close')</button>
                    <button type="submit" class="btn btn-danger">@lang('modal.btn_submit')</button>
                </div>
            </form>

        </div>
    </div>
</div>