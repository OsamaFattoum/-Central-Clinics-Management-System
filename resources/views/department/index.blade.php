@extends('layouts.app')

@section('css')
@include('layouts.table-head')
@endsection

@include('components.breadcrumb',['pervPage' => __('sidebar.main_l') , 'currentPage' => __('sidebar.departments_t')])

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
                                @lang('departments.btn_create_department')
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
                                    <th class="pr-2">@lang('departments.name_department')</th>
                                    <th class="pr-2">@lang('departments.scientific_name')</th>
                                    <th class="pr-2">@lang('departments.description')</th>
                                    <th class="pr-2">@lang('departments.given_drug')</th>
                                    <th class="pr-2">@lang('departments.created_at')</th>
                                    <th class="pr-2">@lang('dropdown_op.processes')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $department)
                                <tr>
                                    <td class="pr-2">
                                        <label class="ckbox">
                                            <input type="checkbox" name="delete_select" value="{{ $department->id }}">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="pr-2">{{ $department->name }}</td>
                                    <td class="pr-2">
                                        <span class="badge badge-info">{{$department->scientific_name}}</span>
                                    </td>
                                    <td class="pr-2">
                                        @include('components.description_data_table',['description'=>$department->description,'id'=>$department->id])
                                    </td>
                                    <td class="pr-2">
                                        <span
                                            class="badge badge-{{$department->status == 0 ? 'danger' : 'success'}}">{{$department->status
                                            == 0 ? __('departments.not_give_drug') :
                                            __('departments.give_drug')}}</span>
                                    </td>
                                    <td class="pr-2">{{ $department->created_at->diffForHumans()}}</td>
                                    <td class="pr-2">
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                type="button">@lang('dropdown_op.processes')<i
                                                    class="fas fa-caret-down mx-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#edit{{ $department->id }}"><i style="color: #0ba360"
                                                        class="text-success ti-pencil-alt"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_edit')</a>


                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete{{$department->id}}"><i
                                                        class="text-danger  ti-trash"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_delete')</a>

                                            </div>
                                        </div>

                                    </td>
                                    @include('components.delete',['id'=>$department->id,'name' =>
                                    $department->name,'route'=>'departments'])
                                    @include('department._edit')
                                    @include('components.desc',['id'=>$department->id,'name' =>
                                    $department->name,'desc'=>$department->description])
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
@include('department._create')
@include('components.delete_select',['route' => 'departments'])
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')
@include('layouts.table-footer',['orderIndex' => 1,'targetsNotOrdered' => [0,2,3,4,5,6]])
@endsection