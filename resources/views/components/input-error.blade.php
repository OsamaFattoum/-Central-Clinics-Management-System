@error($input)
@isset($is_select)
<span id="slErrorContainer" class="parsley-errors-list">
    <strong>{{ $message }}</strong>
</span>
@else
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@endif
@enderror