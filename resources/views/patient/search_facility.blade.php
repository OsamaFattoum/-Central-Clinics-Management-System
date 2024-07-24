@extends('layouts.app')




@include('components.breadcrumb',['pervPage' => __('sidebar.main_l') ,'currentPage' => __('sidebar.facility_search')])

@section('content')

@livewire('search-facility')

<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection


