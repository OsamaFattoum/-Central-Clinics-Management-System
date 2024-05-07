@extends('layouts.app')

@section('css')
@include('layouts.table-head')
@endsection

@include('components.breadcrumb',['route' => route('patients.show',['patient'=>$patient->id]),'pervPage' => $profile->name , 'currentPage' => __('records.records') . " (" .
$department->name . ")"])

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
                                @lang('records.btn_add_record')
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
                                    <th class="pr-2">@lang('records.case_type')</th>
                                    <th class="pr-2">@lang('records.value')</th>
                                    <th class="pr-2">@lang('records.measurement_unit')</th>
                                    <th class="pr-2">@lang('records.result')</th>
                                    <th class="pr-2">@lang('records.reference_range')</th>
                                    <th class="pr-2">@lang('records.date')</th>
                                    <th class="pr-2">@lang('records.time')</th>
                                    <th class="pr-2">@lang('dropdown_op.processes')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $record)
                                <tr>
                                    <td class="pr-2">
                                        <label class="ckbox">
                                            <input type="checkbox" name="delete_select" value="{{ $record->id }}">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="pr-2">{{ $record->caseType->name }}</td>
                                    <td class="pr-2">
                                        @include('components.description_data_table',['description'=>$record->value,'id'=>$record->id])
                                    </td>
                                    <td class="pr-2">{{ $record->measurement_unit }}</td>

                                    <td class="pr-2">
                                        <span
                                            class="badge badge-{{$record->result == 0 || $record->result == 3 ? 'danger' : 'success'}}">{{$record->result_value}}</span>
                                    </td>

                                    <td class="pr-2">{{ $record->reference_range }}</td>
                                    <td class="pr-2">{{ $record->date }}</td>
                                    <td class="pr-2">{{ $record->created_at->format('h:iA') }}</td>

                                    <td class="pr-2">
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                type="button">@lang('dropdown_op.processes')<i
                                                    class="fas fa-caret-down mx-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#edit{{ $record->id }}"><i style="color: #0ba360"
                                                        class="text-success ti-pencil-alt"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_edit')</a>


                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete{{$record->id}}"><i
                                                        class="text-danger  ti-trash"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_delete')</a>

                                            </div>
                                        </div>

                                    </td>
                                    @include('records._delete',['id'=>$record->id,'name' =>
                                    '(' . $record->caseType->name .') ' . __('records.in_date') . ' (' . ( $record->date
                                    ) . ')','route'=>'records','parameters'=> ['patient' => $patient->id,'department' =>
                                    $department->id,'record'=>$record->id]])
                                    @include('records._edit')
                                    @include('components.desc',['id'=>$record->id,'name' =>
                                    $record->caseType->name,'desc'=>$record->value])
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
@include('records._create')
@include('records._delete_select',['route' => 'records','parameters'=>['patient' => $patient->id,'department' =>
$department->id]])
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')
@include('layouts.table-footer',['orderIndex' => 1,'targetsNotOrdered' => [0,2,3,4,5,6,7,8]])
@endsection