@extends('layouts.app')


@include('components.breadcrumb',['pervPage' => __('sidebar.patients_t') , 'currentPage' => __('sidebar.patients_add_t')])

@section('content')

<div class="row row-sm">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <form action="{{ route('patients.store') }}" method="post" autocomplete="off">
            @csrf
            
            <div class="card  box-shadow-0 ">
                <div class="card-header pb-3">
                    <div class="d-flex justify-content-between ">
                        <div class="">
                            <h4>@lang('users.title_main_info')</h4>
                        </div>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @include('patients.includes.main_section')
                </div>
            </div>
            <div class="card  box-shadow-0 ">
                <div class="card-header pb-3">
                    <div class="d-flex justify-content-between ">
                        <div class="">
                            <h4>@lang('users.title_general_info')</h4>
                        </div>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @include('patients.includes.general_section')
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

