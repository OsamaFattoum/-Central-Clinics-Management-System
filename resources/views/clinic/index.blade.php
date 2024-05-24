@include('components.breadcrumb',['pervPage' => __('sidebar.main_l') ,'currentPage' => ''])

@section('content')


@livewire('clinic.statistics')
@livewire('clinic.appointments-calendar')
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection