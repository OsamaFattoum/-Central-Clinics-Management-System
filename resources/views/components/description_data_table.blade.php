@if($description)
{{ \Str::limit($description,(isset($count) ? $count : 20), '...') }}
@if (Str::length($description) > (isset($count) ? $count : 20))
<a href="#" data-toggle="modal" data-target="#desc{{ $id }}">@lang('modal.show_more')</a>
@endif
@else
...
@endif