@include('components.breadcrumb',['pervPage' => __('sidebar.main_l') ,'currentPage' => ''])

@section('content')

@livewire('patient.appointment-medication')
@livewire('patient.medical-record')

<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection


@section('js')


@stack('appointment-medication')

@stack('medical-record')

@endsection