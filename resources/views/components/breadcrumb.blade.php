@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h5 class="content-title mb-0 my-auto">{{ $pervPage }}</h5>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                {{ $currentPage }}</span>
        </div>
    </div>
</div>
@endsection