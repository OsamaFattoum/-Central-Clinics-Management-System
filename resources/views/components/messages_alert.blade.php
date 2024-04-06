@if (count($errors) > 0)
<div class="alert alert-danger">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>@lang('messages.error')</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session()->has('add'))

<script>
    window.onload = function() {
                notif({
                    msg:  "{{ __('messages.add') }}",
                    type: "success"
                });
            }

</script>
@endif
@if (session()->has('archive'))
<script>
    window.onload = function() {
                notif({
                    msg: "The data has been archived successfully",
                    type: "success"
                });
            }

</script>
@endif

@if (session()->has('unArchive'))
<script>
    window.onload = function() {
                notif({
                    msg: "The data has been UnArchived successfully",
                    type: "success"
                });
            }

</script>
@endif
@if (session()->has('change_status'))
<script>
    window.onload = function() {
                notif({
                    msg: "{{ __('messages.status') }}",
                    type: "success"
                });
            }

</script>
@endif


@if (session()->has('no-product'))
<script>
    window.onload = function() {
                notif({
                    msg: "You must added at least one Product",
                    type: "dark"
                });
            }

</script>
@endif


@if (session()->has('edit'))
<script>
    window.onload = function() {
                notif({
                    msg: "{{ __('messages.edit') }}",
                    type: "success"
                });
            }

</script>
@endif

@if (session()->has('delete'))
<script>
    window.onload = function() {
                notif({
                    msg: "{{ __('messages.delete') }}",
                    type: "success"
                });
            }

</script>
@endif
@if (session()->has('no-id'))
<script>
    window.onload = function() {
                notif({
                    msg: "This Entity doesn't Exist",
                    type: "error"
                });
            }

</script>
@endif