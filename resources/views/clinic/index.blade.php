@include('components.breadcrumb',['pervPage' => __('sidebar.main_l') ,'currentPage' => ''])

@section('content')
@include('components.messages_alert')
@livewire('clinic.appointments-calendar')
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection