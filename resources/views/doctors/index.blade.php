@extends('layouts.app')

@section('css')
@include('layouts.table-head')
@endsection

@include('components.breadcrumb',['pervPage' => __('sidebar.main_l') , 'currentPage' => __('sidebar.doctors_t')])

@section('content')
@include('components.messages_alert')
<div class="row row-sm">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <a href="{{route('doctors.manage')}}" class="btn btn-primary">
                                @lang('doctors.btn_create_doctor')
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
                                    <th class="pr-2">@lang('doctors.name_doctor')</th>
                                    <th class="pr-2">@lang('users.email')</th>
                                    <th class="pr-2">@lang('users.phone')</th>
                                    <th class="pr-2">@lang('users.gender')</th>
                                    <th class="pr-2">@lang('users.city')</th>
                                    <th class="pr-2">@lang('users.status')</th>
                                    <th class="pr-2">@lang('dropdown_op.processes')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctors as $doctor)
                                <tr>
                                    <td class="pr-2">
                                        <label class="ckbox">
                                            <input type="checkbox" name="delete_select" value="{{ $doctor->id }}">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="pr-2"><a href="{{ route('doctors.show',$doctor->id) }}">{{
                                            $doctor->profile->name }}</a></td>
                                    <td class="pr-2">{{ $doctor->email }}</td>
                                    <td class="pr-2">{{ $doctor->profile->phone }}</td>
                                    <td class="pr-2">{{ $doctor->gender }}</td>
                                    <td class="pr-2">{{ $doctor->city_name }}</td>
                                    <td class="pr-2">
                                        <span class="badge badge-{{ $doctor->status ? 'success' : 'danger' }}">{{
                                            $doctor->status ? __('users.enabled') : __('users.not_enabled')}}
                                        </span>
                                    </td>
                                    <td class="pr-2">
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                type="button">@lang('dropdown_op.processes')<i
                                                    class="fas fa-caret-down mx-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item"
                                                    href="{{route('doctors.manage',$doctor->id)}}"><i
                                                        style="color: #0ba360"
                                                        class="text-success ti-pencil-alt"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_edit')</a>
                                                <a class="dropdown-item"
                                                    href="{{route('doctors.status',$doctor->id)}}"><i
                                                        class="text-warning ti-back-right"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_status')</a>

                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete{{$doctor->id}}"><i
                                                        class="text-danger  ti-trash"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_delete')</a>

                                            </div>
                                        </div>

                                    </td>
                                    @include('components.delete',['id'=>$doctor->id,'name' =>
                                    $doctor->name,'route'=>'doctors'])
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

@include('components.delete_select',['route' => 'doctors'])
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')
@include('layouts.table-footer',['orderIndex'=>1,'targetsNotOrdered' => [0,2,3,5,7]])
@endsection