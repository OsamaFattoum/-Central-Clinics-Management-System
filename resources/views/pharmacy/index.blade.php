@include('components.breadcrumb',['pervPage' => __('sidebar.main_l') ,'currentPage' => ''])

@section('content')


@livewire('patients-search')

<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection