@extends('layouts.app')

@section('css')
@include('layouts.table-head')
@endsection

@include('components.breadcrumb',['pervPage' => $clinic->translate(app()->getLocale())->name , 'currentPage' => __('clinic_accreditations.accreditions')])

@section('content')
@include('components.messages_alert')
<div class="row row-sm">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                                @lang('clinic_accreditations.btn_create_accredition')
                            </button>
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
                                    <th class="pr-2">@lang('clinic_accreditations.name_accreditions')</th>
                                    <th class="pr-2">@lang('clinic_accreditations.created_at')</th>
                                    <th class="pr-2">@lang('dropdown_op.processes')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accreditations as $accreditation)
                                <tr>
                                    <td class="pr-2">
                                        <label class="ckbox">
                                            <input type="checkbox" name="delete_select" value="{{ $accreditation->id }}">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="pr-2">{{ $accreditation->name }}</td>
                                    <td class="pr-2">{{ $accreditation->created_at->diffForHumans()}}</td>
                                    <td class="pr-2">
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                type="button">@lang('dropdown_op.processes')<i
                                                    class="fas fa-caret-down mx-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit{{ $accreditation->id }}"><i style="color: #0ba360"
                                                    class="text-success ti-pencil-alt"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_edit')</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete{{$accreditation->id}}"><i
                                                        class="text-danger  ti-trash"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_delete')</a>

                                            </div>
                                        </div>

                                    </td>
                                    @include('clinics.accreditations._edit')
                                    @include('clinics.accreditations._delete',['id'=>$accreditation->id,'name' =>
                                    $accreditation->name,'route'=>'accreditations','parameters'=>[$clinic->id,$accreditation->id]])
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
@include('clinics.accreditations._create')
@include('clinics.accreditations._delete_select',['route' => 'accreditations','clinicId'=>$clinic->id])
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')
@include('layouts.table-footer',['orderIndex'=>1,'targetsNotOrdered' => [0,2,3]])
@endsection