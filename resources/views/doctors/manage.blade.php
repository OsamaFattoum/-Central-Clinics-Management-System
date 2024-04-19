@extends('layouts.app')

@include('components.breadcrumb',['pervPage' => __('sidebar.doctors_t') , 'currentPage' => __('doctors.manage_doctor')])

@section('content')

    @livewire('doctor')

</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
