@extends('layouts.app')

@section('css')
@include('layouts.table-head')
@endsection

@include('components.breadcrumb',['route' => route('records.index',['patient' => $patient->id,'department'=> $department->id]),'pervPage' => __('records.records') . " (" .
$department->name . ")" , 'currentPage' => __('medications.medications') . ' (' . $record->caseType->name . ')'])

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
                                @lang('medications.btn_add_medication')
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
                                    <th class="pr-2">@lang('medications.name')</th>
                                    <th class="pr-2">@lang('medications.dosage')</th>
                                    <th class="pr-2">@lang('medications.instructions')</th>
                                    <th class="pr-2">@lang('medications.medication_taken')</th>
                                    <th class="pr-2">@lang('medications.has_alternative')</th>
                                    <th class="pr-2">@lang('records.date')</th>
                                    <th class="pr-2">@lang('records.time')</th>
                                    <th class="pr-2">@lang('dropdown_op.processes')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medications as $medication)
                                <tr>
                                    <td class="pr-2">
                                        <label class="ckbox">
                                            <input type="checkbox" name="delete_select" value="{{ $medication->id }}">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="pr-2">{{ $medication->name }}</td>
                                    <td class="pr-2">{{ $medication->dosage }}</td>
                                    <td class="pr-2">
                                        @include('components.description_data_table',['description'=>$medication->instructions,'id'=>$medication->id])
                                    </td>
                                    <td class="pr-2">
                                        <span
                                            class="badge badge-{{$medication->medication_taken == 0  ? 'danger' : 'success'}}">{{$medication->medication_taken_value}}</span>
                                    </td>
                                    <td class="pr-2">
                                        <span
                                            class="badge badge-{{$medication->has_alternative == 0  ? 'danger' : 'success'}}">{{$medication->has_alternative_value}}</span>
                                    </td>
                                    <td class="pr-2">{{ $medication->date }}</td>
                                    <td class="pr-2">{{ $medication->created_at->format('h:iA') }}</td>
                                    <td class="pr-2">
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                type="button">@lang('dropdown_op.processes')<i
                                                    class="fas fa-caret-down mx-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit{{ $medication->id }}"><i style="color: #0ba360"
                                                    class="text-success ti-pencil-alt"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_edit')</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete{{$medication->id}}"><i
                                                        class="text-danger  ti-trash"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_delete')</a>

                                            </div>
                                        </div>

                                    </td>
                                    @include('records.medications._edit')
                                    @include('records._delete',['id'=>$accreditation->id,'name' =>
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