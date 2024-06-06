
@if (!Request::is('*/login') && !Request::is('profile') )

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
@if (session()->has('send'))
<script>
    window.onload = function() {
                notif({
                    msg:  "{{ __('messages.send') }}",
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

@if (session()->has('status_unathorized'))
<script>
    window.onload = function() {
                notif({
                    msg: "{{ __('messages.status_unathorized') }}",
                    type: "error"
                });
            }

</script>
@endif



@if (session()->has('no-case_type'))
<script>
    window.onload = function() {
                notif({
                    msg: "{{ __('messages.no-case_type') }}",
                    type: "dark"
                });
            }

</script>
@endif

@if (session()->has('no-department'))
<script>
    window.onload = function() {
                notif({
                    msg: "{{ __('messages.no-department') }}",
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
                    msg: "{{ __('messages.no-id') }}",
                    type: "error"
                });
            }

</script>
@endif