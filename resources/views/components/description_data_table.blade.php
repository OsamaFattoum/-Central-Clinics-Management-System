@if($description)
{{ \Str::limit($description,20, '...') }}
@if (Str::length($description) > 20)
<a href="#" data-toggle="modal" data-target="#desc{{ $id }}">@lang('modal.show_more')</a>
@endif
@else
...
@endif