@extends('layouts.app')

@section('css')
@include('layouts.table-head')
@endsection

@include('components.breadcrumb',['route' => route('departments.index'),'pervPage' => $department->translate(app()->getLocale())->name , 'currentPage' => __('case_type.case_type')])

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
                                @lang('case_type.btn_create_case_type')
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
                                    <th class="pr-2">@lang('case_type.name_case_type')</th>
                                    <th class="pr-2">@lang('case_type.created_at')</th>
                                    <th class="pr-2">@lang('dropdown_op.processes')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($caseTypes as $caseType)
                                <tr>
                                    <td class="pr-2">
                                        <label class="ckbox">
                                            <input type="checkbox" name="delete_select" value="{{ $caseType->id }}">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="pr-2">{{ $caseType->name }}</td>
                                    <td class="pr-2">{{ $caseType->created_at->diffForHumans()}}</td>
                                    <td class="pr-2">
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                type="button">@lang('dropdown_op.processes')<i
                                                    class="fas fa-caret-down mx-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit{{ $caseType->id }}"><i style="color: #0ba360"
                                                    class="text-success ti-pencil-alt"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_edit')</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete{{$caseType->id}}"><i
                                                        class="text-danger  ti-trash"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_delete')</a>

                                            </div>
                                        </div>

                                    </td>
                                    @include('departments.caseTypes._edit')
                                    @include('components.delete',['id'=>$caseType->id,'name' =>
                                    $caseType->name,'route'=>'case_types','parameters'=>[$department->id,$caseType->id]])
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
@include('departments.caseTypes._create')
@include('components.delete_select',['route' => 'case_types','parameters'=>$department->id])
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')
@include('layouts.table-footer',['orderIndex'=>1,'targetsNotOrdered' => [0,2,3]])
@endsection