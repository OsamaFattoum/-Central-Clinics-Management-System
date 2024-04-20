@extends('layouts.app')

@section('css')
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@include('components.breadcrumb',['pervPage' => __('sidebar.doctors_t') , 'currentPage' => __('doctors.manage_doctor')])

@section('content')

    @livewire('doctor')

</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

