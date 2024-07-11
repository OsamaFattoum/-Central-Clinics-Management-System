@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h5 class="content-title mb-0 my-auto">{{ $pervPage }}</h5>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0"> {{ empty($currentPage) ? '' : '/' }}
                {{ $currentPage }}</span>
        </div>
    </div>
    @if (!Request::is('dashboard'))
    <div class="d-flex my-xl-auto mt-lg-0 mt-2">
        <div class="pr-1 mb-3 mb-xl-0">
            <a href="{{ isset($route) ? $route : route('dashboard') }}" class="btn btn-sm btn-primary {{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2' }}">@lang('site.back')<i class="fa fa-{{ app()->getLocale() == 'ar' ? 'backward  mr-2' : 'forward  ml-2' }}" aria-hidden="true"></i></a>
        </div>
    </div>
    @endif
   
</div>
@endsection