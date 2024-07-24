@extends('layouts.app')

@section('css')
@include('layouts.table-head')
@endsection

@include('components.breadcrumb',['route' => route('patients.show',['patient' => $patient->id]),'pervPage' =>
$patient->name , 'currentPage' => __('transfer.transfer_requests')])

@section('content')

@include('components.messages_alert')

<div class="row row-sm">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="">
                        @permission('create-transfer-requests')
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                            @lang('transfer.btn_add_request')
                        </button>
                        @endpermission
                        @permission('delete-transfer-requests')
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
                                <th class="pr-2">@lang('transfer.department')</th>
                                <th class="pr-2">@lang('transfer.name_doctor')</th>
                                <th class="pr-2">@lang('transfer.information')</th>
                                <th class="pr-2">@lang('transfer.date')</th>
                                <th class="pr-2">@lang('transfer.time')</th>
                                <th class="pr-2">@lang('transfer.status')</th>
                                <th class="pr-2">@lang('dropdown_op.processes')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transferRequests as $transferRequest)
                            <tr>
                                <td class="pr-2">
                                    <label class="ckbox">
                                        <input type="checkbox" name="delete_select" value="{{ $transferRequest->id }}">
                                        <span></span>
                                    </label>
                                </td>
                                <td class="pr-2">
                                    <span class="badge badge-info">{{$transferRequest->doctor->department->name}}</span>
                                </td>
                                <td class="pr-2">{{ $transferRequest->doctor->name }}</td>
                                <td class="pr-2">
                                    @include('components.description_data_table',['description'=>$transferRequest->information,'id'=>$transferRequest->id])
                                </td>

                                <td class="pr-2">{{ $transferRequest->created_at->format('Y-m-d') }}</td>
                                <td class="pr-2">{{ $transferRequest->created_at->format('h:iA') }}</td>
                                <td class="pr-2">
                                    <span
                                        class="badge badge-{{$transferRequest->status == 0  ? 'secondary' : 'success'}}">{{$transferRequest->status_value}}</span>
                                </td>

                                <td class="pr-2">
                                    @if (Auth::user()->hasPermission('delete-transfer-requests') ||
                                    Auth::user()->hasPermission('status-transfer-requests'))
                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true"
                                            class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                            type="button">@lang('dropdown_op.processes')<i
                                                class="fas fa-caret-down mx-1"></i></button>
                                        <div class="dropdown-menu tx-13">

                                            @permission('status-transfer-requests')

                                            <a class="dropdown-item"
                                                href="{{route('transferRequests.status',['patient'=>$patient->id,'transferRequest' => $transferRequest->id])}}"><i
                                                    class="text-warning ti-back-right"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_status')</a>

                                            @endpermission
                                            @permission('delete-transfer-requests')
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete{{$transferRequest->id}}"><i
                                                    class="text-danger  ti-trash"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_delete')</a>
                                            @endpermission
                                        </div>
                                    </div>
                                    @else
                                    <span class="text-center">-</span>
                                    @endif
                                </td>


                                @permission('delete-transfer-requests')
                                @include('components.delete',['id'=>$transferRequest->id,'name' =>
                                __('transfer.transfer_request'),'route'=>'transferRequests','parameters'=>[$patient->id,$transferRequest->id]])
                                @endpermission
                                @include('components.desc',['id'=>$transferRequest->id,'name' =>
                                __('transfer.information'),'desc'=>$transferRequest->information])
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
</div>

@permission('create-transfer-requests')
@include('transferRequests._create')
@endpermission

@permission('delete-transfer-requests')
@include('components.delete_select',['route' => 'transferRequests','parameters'=>['patient'=>$patient->id]])
@endpermission

</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->

@endsection

@section('js')
@include('layouts.table-footer',['orderIndex'=>4,'targetsNotOrdered' => [0,2,3,6,7]])
@endsection