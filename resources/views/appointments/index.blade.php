@extends('layouts.app')

@section('css')
@include('layouts.table-head')
@endsection

@include('components.breadcrumb',['route' => route('patients.show',['patient' => $patient->id]),'pervPage' =>
$patient->name , 'currentPage' => __('appointments.appointments')])

@section('content')
@include('components.messages_alert')


<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="">
                        @permission('create-appointments')
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                            @lang('appointments.btn_add_appointment')
                        </button>
                        @endpermission
                        @permission('delete-appointments')
                        <button type="button" class="btn btn-danger"
                            id="btn_delete_all">@lang('delete.btn_delete_selected_data')</button>
                        @endpermission
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
                                <th class="pr-2">@lang('appointments.clinic')</th>
                                <th class="pr-2">@lang('appointments.department')</th>
                                <th class="pr-2">@lang('appointments.doctor')</th>
                                <th class="pr-2">@lang('appointments.notes')</th>
                                <th class="pr-2">@lang('appointments.date')</th>
                                <th class="pr-2">@lang('appointments.time')</th>
                                <th class="pr-2">@lang('appointments.status')</th>
                                <th class="pr-2">@lang('dropdown_op.processes')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                            <tr>
                                <td class="pr-2">
                                    <label class="ckbox">
                                        <input type="checkbox" name="delete_select" value="{{ $appointment->id }}">
                                        <span></span>
                                    </label>
                                </td>
                                <td class="pr-2">
                                    <span class="badge badge-primary">{{$appointment->clinic->name}}</span>
                                </td>
                                <td class="pr-2">
                                    <span class="badge badge-light">{{$appointment->department->name}}</span>
                                </td>
                                <td class="pr-2">
                                    <span class="badge badge-dark">{{$appointment->doctor->name}}</span>
                                </td>
                                <td class="pr-2">
                                    @include('components.description_data_table',['description'=>$appointment->notes,'id'=>$appointment->id])
                                </td>
                                <td class="pr-2">{{ $appointment->date }}</td>
                                <td class="pr-2">{{ \Carbon\Carbon::parse($appointment->time)->format('h:iA') }}
                                </td>
                                <td class="pr-2">
                                    <span
                                        class="badge badge-{{$appointment->status == 0  ? 'secondary' : ($appointment->status == 1 ? 'info' : 'danger')}}">{{$appointment->status_value}}</span>
                                </td>

                                <td class="pr-2">
                                    @if (Auth::user()->hasPermission('update-appointments') ||
                                    Auth::user()->hasPermission('delete-appointments') ||
                                    Auth::user()->hasPermission('status-appointments'))
                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true"
                                            class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                            type="button">@lang('dropdown_op.processes')<i
                                                class="fas fa-caret-down mx-1"></i></button>
                                        <div class="dropdown-menu tx-13">
                                            @permission('update-appointments')
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit{{ $appointment->id }}"><i style="color: #0ba360"
                                                    class="text-success ti-pencil-alt"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_edit')</a>
                                            @endpermission
                                            @permission('status-appointments')
                                            <a class="dropdown-item" data-toggle="modal"
                                                data-target="#status{{ $appointment->id }}" href="#"><i
                                                    class="text-warning ti-back-right"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_status')</a>
                                            @endpermission
                                            @permission('delete-appointments')
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete{{$appointment->id}}"><i
                                                    class="text-danger  ti-trash"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_delete')</a>
                                            @endpermission
                                        </div>
                                    </div>
                                    @else
                                    <span class="text-center">-</span>
                                    @endif
                                </td>

                                @permission('update-appointments')
                                @include('appointments._edit')
                                @endpermission
                                @permission('status-appointments')
                                @include('appointments._status')
                                @endpermission
                                @permission('delete-appointments')
                                @include('appointments._delete',['id'=>$appointment->id,'name' =>
                                __('appointments.appointment'),'route'=>'appointments','parameters'=>[$patient->id,$appointment->id]])
                                @endpermission
                                @include('components.desc',['id'=>$appointment->id,'name' =>
                                __('appointments.notes'),'desc'=>$appointment->notes])
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@permission('create-appointments')
@include('appointments._create')
@endpermission
@permission('delete-appointments')
@include('appointments._delete_select',['route' => 'appointments','parameters'=>$patient->id])
@endpermission


</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')
@include('layouts.table-footer',['orderIndex'=>1,'targetsNotOrdered' => [0,2,3,4,5,6,7,8]])
@endsection