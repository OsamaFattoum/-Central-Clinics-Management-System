@extends('layouts.app')

@include('components.breadcrumb',['pervPage' => __('sidebar.main_l') , 'currentPage' => __('sidebar.patients_t')])

@section('content')

@include('components.messages_alert')

@livewire('patients-search')

@permission('delete-patients')
@include('components.delete_select',['route' => 'patients'])
@endpermission


</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')
<script src="{{URL::asset('assets/js/bulk-delete.js')}}"></script>
@endsection