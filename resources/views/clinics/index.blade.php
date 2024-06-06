@extends('layouts.app')

@section('css')
@include('layouts.table-head')
@endsection

@include('components.breadcrumb',['pervPage' => __('sidebar.main_l') , 'currentPage' => __('sidebar.clinics_t')])

@section('content')
@include('components.messages_alert')
<div class="row row-sm">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <a href="{{route('clinics.create')}}" class="btn btn-primary">
                                @lang('clinics.btn_create_clinic')
                            </a>
                            <button type="button" class="btn btn-danger"
                                id="btn_delete_all">@lang('delete.btn_delete_selected_data')</button>
                        </div>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="pr-2 wd-5p"> <label class="ckbox"><input type="checkbox"
                                                name="select_all"><span></span></label>
                                    </th>
                                    <th class="pr-2">@lang('clinics.name_clinic')</th>
                                    <th class="pr-2">@lang('clinics.department')</th>
                                    <th class="pr-2">@lang('facility.phone')</th>
                                    <th class="pr-2">@lang('facility.city')</th>
                                    <th class="pr-2">@lang('facility.status_open')</th>
                                    <th class="pr-2">@lang('facility.status')</th>
                                    <th class="pr-2">@lang('dropdown_op.processes')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clinics as $clinic)
                                <tr>
                                    <td class="pr-2">
                                        <label class="ckbox">
                                            <input type="checkbox" name="delete_select" value="{{ $clinic->id }}">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="pr-2"><a href="{{ route('clinics.show',$clinic->id) }}">{{
                                            $clinic->name }}</a></td>
                                    <td class="pr-2">
                                        @foreach ($clinic->departments as $department )
                                        <span class="badge badge-info">{{
                                            $department->translate(app()->getLocale())->name}}</span><br>
                                        @endforeach
                                    </td>
                                    <td class="pr-2"><a href="tel:{{ $clinic->facilityProfile->phone }}">{{ $clinic->facilityProfile->phone }}</a></td>

                                    <td class="pr-2"><span class="badge badge-dark">{{ $clinic->cityName() }}</span> </td>
                                    <td class="pr-2"> <span class="badge badge-{{ $clinic->checkOpenStatus() ? 'success' : 'danger' }}">{{
                                        $clinic->openStatusLabel() }}</span></td>
                                    <td class="pr-2"> <span
                                            class="badge badge-{{ $clinic->status ? 'success' : 'danger' }}">{{
                                            $clinic->status ? __('facility.enabled') : __('facility.not_enabled')
                                            }}</span></td>


                                    <td class="pr-2">
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                type="button">@lang('dropdown_op.processes')<i
                                                    class="fas fa-caret-down mx-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="{{route('clinics.edit',$clinic->id)}}"><i
                                                        style="color: #0ba360"
                                                        class="text-success ti-pencil-alt"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_edit')</a>
                                                <a class="dropdown-item"
                                                    href="{{route('clinics.status',$clinic->id)}}"><i
                                                        class="text-warning ti-back-right"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_status')</a>

                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete{{$clinic->id}}"><i
                                                        class="text-danger  ti-trash"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_delete')</a>

                                            </div>
                                        </div>

                                    </td>
                                    @include('components.delete',['id'=>$clinic->id,'name' =>
                                    $clinic->name,'route'=>'clinics','parameters'=> $clinic->id])

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
</div>

@include('components.delete_select',['route' => 'clinics'])
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')
@include('layouts.table-footer',['orderIndex'=>1,'targetsNotOrdered' => [0,2,3,7]])
@endsection