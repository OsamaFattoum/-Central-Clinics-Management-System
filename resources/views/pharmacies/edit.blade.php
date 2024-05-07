@extends('layouts.app')

@section('css')


<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">




@error('days')
<style>
    .days-select2>span .select2-selection--multiple {
        border-color: #ee335e !important;
    }
</style>
@enderror




@endsection

@include('components.breadcrumb',['route' => route('pharmacies.index'),'pervPage' => __('sidebar.pharmacies_t') , 'currentPage' => $pharmacy->translate(app()->getLocale())->name])

@section('content')

<div class="row row-sm">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <form action="{{ route('pharmacies.update',$pharmacy->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card  box-shadow-0 ">
                <div class="card-header pb-3">
                    <div class="d-flex justify-content-between ">
                        <div class="">
                            <h4>@lang('facility.title_main_info')</h4>
                        </div>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @include('pharmacies.includes.main_section')
                </div>
            </div>
            <div class="card  box-shadow-0 ">
                <div class="card-header pb-3">
                    <div class="d-flex justify-content-between ">
                        <div class="">
                            <h4>@lang('facility.title_general_info')</h4>
                        </div>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @include('pharmacies.includes.general_section')
                </div>
            </div>
            <div class="card  box-shadow-0 ">
                <div class="card-header pb-3">
                    <div class="d-flex justify-content-between ">
                        <div class="">
                            <h4>@lang('facility.title_owner_info')</h4>
                        </div>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @include('pharmacies.includes.owner_section')
                </div>
            </div>
            <div class="card  box-shadow-0 ">
                <div class="card-body pt-0">
                    <button type="submit" class="btn w-25 btn-primary mt-3 mb-0">@lang('modal.btn_submit')</button>
                </div>
            </div>

        </form>
    </div>
</div>

</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>

@include('components.select_multi')


@endsection