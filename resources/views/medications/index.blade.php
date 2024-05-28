@extends('layouts.app')

@section('css')
@include('layouts.table-head')
@endsection

@include('components.breadcrumb',['route' => route('patients.show',['patient' => $patient->id]),'pervPage' =>
$profile->translate(app()->getLocale())->name , 'currentPage' => __('medications.medications')])

@section('content')
@include('components.messages_alert')
<div class="row row-sm">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            @permission('create-medications')
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                                @lang('medications.btn_add_medication')
                            </button>
                            @endpermission
                            @permission('delete-medications')
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
                                    <th class="pr-2">@lang('medications.name')</th>
                                    <th class="pr-2">@lang('medications.case_type')</th>
                                    <th class="pr-2">@lang('medications.dosage')</th>
                                    <th class="pr-2">@lang('medications.instructions')</th>

                                    <th class="pr-2">@lang('medications.date')</th>
                                    <th class="pr-2">@lang('medications.time')</th>
                                    <th class="pr-2">@lang('medications.medication_taken')</th>
                                    <th class="pr-2">@lang('medications.has_alternative')</th>
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
                                    <td class="pr-2">
                                        <span class="badge badge-info">{{$medication->caseType->name}}</span>
                                    </td>
                                    <td class="pr-2">{{ $medication->dosage }}</td>
                                    <td class="pr-2">
                                        @include('components.description_data_table',['description'=>$medication->instructions,'id'=>$medication->id])
                                    </td>

                                    <td class="pr-2">{{ $medication->date }}</td>
                                    <td class="pr-2">{{ $medication->created_at->format('h:iA') }}</td>
                                    <td class="pr-2">
                                        <span
                                            class="badge badge-{{$medication->medication_taken == 0  ? 'danger' : 'success'}}">{{$medication->medication_taken_value}}</span>
                                    </td>
                                    <td class="pr-2">
                                        <span
                                            class="badge badge-{{$medication->has_alternative == 0  ? 'danger' : 'success'}}">{{$medication->has_alternative_value}}</span>
                                    </td>
                                    <td class="pr-2">
                                        @if (Auth::user()->hasPermission('update-medications') ||
                                        Auth::user()->hasPermission('delete-medications') ||
                                        Auth::user()->hasPermission('status-medications'))


                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                type="button">@lang('dropdown_op.processes')<i
                                                    class="fas fa-caret-down mx-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                @permission('update-medications')
                                                @if (auth()->guard()->name == 'admin' ||
                                                !Carbon\Carbon::parse($medication->created_at)->addMinutes(5)->isPast())
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#edit{{ $medication->id }}"><i style="color: #0ba360"
                                                        class="text-success ti-pencil-alt"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_edit')</a>
                                                @endif
                                                @endpermission
                                                @permission('status-medications')
                                                @if (!$medication->medication_taken)
                                                @if(!Carbon\Carbon::parse($medication->created_at)->addMonth(3)->isPast())
                                                <a class="dropdown-item" data-toggle="modal"
                                                    data-target="#status{{ $medication->id }}" href="#"><i
                                                        class="text-warning ti-back-right"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_status_medication')</a>
                                                @endif
                                                @endif
                                                @endpermission
                                                @permission('delete-medications')
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete{{$medication->id}}"><i
                                                        class="text-danger  ti-trash"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_delete')</a>
                                                @endpermission
                                            </div>
                                        </div>
                                        @else
                                        <span class="text-center">-</span>
                                        @endif
                                    </td>

                                    @permission('update-medications')
                                    @if (auth()->guard()->name == 'admin' ||
                                    !Carbon\Carbon::parse($medication->created_at)->addMinutes(5)->isPast())
                                    @include('medications._edit')
                                    @endif
                                    @endpermission
                                    @permission('status-medications')
                                    @if (!$medication->medication_taken)
                                    @if(!Carbon\Carbon::parse($medication->created_at)->addMonth(3)->isPast())
                                    @include('medications._status')
                                    @endif
                                    @endif
                                    @endpermission
                                    @permission('delete-medications')
                                    @include('medications._delete',['id'=>$medication->id,'name' =>
                                    $medication->name,'route'=>'medications','parameters'=>[$patient->id,$medication->id]])
                                    @endpermission
                                    @include('components.desc',['id'=>$medication->id,'name' =>
                                    $medication->name,'desc'=>$medication->instructions])
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
@permission('create-medications')
@include('medications._create')
@endpermission
@permission('delete-medications')
@include('medications._delete_select',['route' => 'medications','parameters'=>$patient->id])
@endpermission
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')
@include('layouts.table-footer',['orderIndex'=>1,'targetsNotOrdered' => [0,2,3,4,5,6,7,8,9]])
@endsection