@include('components.breadcrumb',['pervPage' => __('sidebar.main_l') ,'currentPage' => ''])

@section('content')
<!-- row -->
@livewire('admin.statistics')

<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection