@extends('layouts.app')

@section('css')
<!-- Interenal Accordion Css -->
<link href="{{URL::asset('assets/plugins/accordion/accordion.css')}}" rel="stylesheet" />
@endsection

@include('components.breadcrumb',['route' => route('patients.index'),'pervPage' =>
$profile->translate(app()->getLocale())->name , 'currentPage' =>
__('sidebar.patients_t')])

@section('content')
@include('components.messages_alert')
<div class="row row-sm">
    <div class="col-lg-3">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="pl-0">
                    <div class="main-profile-overview">
                        <div class="main-img-user profile-user bd bd-1">
                            <img alt="" src="{{URL::asset($patient->image_path)}}">
                            <a class="fas fa-edit profile-edit" href="{{ route('patients.edit',$patient->id) }}"></a>
                        </div>
                        <div class="d-flex justify-content-between mg-b-20">
                            <div>
                                <h5 class="main-profile-name">{{ $profile->translate(app()->getLocale())->name }}</h5>
                                <p class="main-profile-name-text">{{ $patient->email }}</p>
                                <span class="badge op-5 badge-{{ $patient->status ? 'success' : 'danger' }}">{{
                                    $patient->status ? __('users.enabled') : __('users.not_enabled') }}</span>
                            </div>
                        </div>
                        <!-- main-profile-bio -->

                        <hr class="mg-y-30">
                        <label class="main-content-label tx-13 mg-b-20">@lang('users.contact')</label>
                        <div class="main-profile-social-list">
                            <div class="media">
                                <div class="media-icon bg-primary-transparent text-primary">
                                    <ion-icon name="call"></ion-icon>
                                </div>
                                <div class="media-body">
                                    <span>@lang('users.phone')</span> <a href="tel:{{ $patient->profile->phone }}">{{
                                        $patient->profile->phone }}</a>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-icon bg-info-transparent text-info">
                                    <ion-icon name="mail"></ion-icon>
                                </div>
                                <div class="media-body">
                                    <span>@lang('users.email')</span> <a href="mailto:{{ $patient->email }}">{{
                                        $patient->email }}</a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- main-profile-overview -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="row row-sm">
            @permission('read-medications')
            <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                <div class="card bg-whi">
                    <a class="tx-dark" href="{{ route('medications.index',['patient'=>$patient->id]) }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="icon1 mt-2 text-center">
                                        <i class="las la-pills tx-40"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-0 text-center">
                                        <span>@lang('patients.medications')</span>
                                        <h2>{{ $medications }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endpermission
            @permission('read-medications')
            <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                <div class="card bg-whi">
                    <a class="tx-dark" href="{{ route('medications.index',['patient'=>$patient,'taken'=> 0]) }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="icon1 mt-2 text-center">
                                        <i class="las la-capsules tx-40"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-0 text-center">
                                        <span>@lang('patients.medications_taken')</span>
                                        <h2>{{ $medications_undispensed }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endpermission
            @permission('read-appointments')
            <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                <div class="card bg-whi">
                    <a class="tx-dark" href="{{ route('appointments.index',['patient'=>$patient->id]) }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="icon1 mt-2 text-center">
                                        <i class="las la-calendar tx-40"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-0 text-center">
                                        <span>@lang('patients.appointments')</span>
                                        <h2>{{ $appointments }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endpermission
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 mb-lg-0 mb-1">
                        <h6 class="text-secondary tx-13">@lang('users.civil_id')</h6>
                        <span class="tx-13 tx-bold">{{ $patient->civil_id }}</span>
                    </div>
                    <div class="col-lg-4 mb-lg-0 mb-1">
                        <h6 class="text-secondary tx-13">@lang('users.gender')</h6>
                        <span class="tx-13 tx-bold">{{ $patient->gender }}</span>
                    </div>
                    <div class="col-lg-4 mb-lg-0 mb-1">
                        <h6 class="text-secondary tx-13">@lang('patients.age')</h6>
                        <span class="tx-13 tx-bold">{{ $patient->age}}</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 mb-lg-0 mb-1">
                        <h6 class="text-secondary tx-13">@lang('patients.blood_type')</h6>
                        <span class="badge badge-info tx-13 tx-bold">{{ $patient->bloodType->name }}</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 mb-lg-0 mb-1">
                        <h6 class="text-secondary tx-13">@lang('users.address')</h6>
                        <span class="tx-13 tx-bold">{{ $patient->profile->address }}</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-4 mb-lg-0 mb-2">
                        <h6 class="text-secondary tx-13">@lang('users.city')</h6>
                        <span class="tx-13 tx-bold">{{ $patient->city_name }}</span>
                    </div>
                    <div class="col-lg-4 mb-lg-0 mb-2">
                        <h6 class="text-secondary tx-13">@lang('users.dob')</h6>
                        <span class="tx-13 tx-bold">{{ $patient->profile->birth_date }}</span>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card overflow-hidden">
            <div class="card-header pb-0">
                <h3 class="card-title">@lang('patients.record_title')</h3>
                <p class="text-muted card-sub-title mb-0">@lang('patients.record_p')</p>
            </div>
            <div class="card-body">
                <div class="panel-group1" id="accordion11">
                    @foreach ($departments as  $department)
                    @permission('read-' . $department->scientific_name)
                    <div class="panel panel-default  mb-4">
                        <div class="panel-heading1 bg-primary ">
                            <h4 class="panel-title1">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion11"
                                    href="#collapseFour{{ $department->id }}" aria-expanded="false">{{ $department->name }}</a>
                            </h4>
                        </div>
                        <div id="collapseFour{{ $department->id }}" class="panel-collapse collapse" role="tabpanel"
                            aria-expanded="false">
                            <div class="panel-body border p-7">
                                @isset($records[$department->id])


                                @if(!$records[$department->id]->isEmpty())
                                <div class="table-responsive">
                                    <table class="table table-bordered mg-b-0 text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="pr-2">@lang('records.case_type')</th>
                                                <th class="pr-2">@lang('records.value')</th>
                                                <th class="pr-2">@lang('records.measurement_unit')</th>
                                                <th class="pr-2">@lang('records.result')</th>
                                                <th class="pr-2">@lang('records.reference_range')</th>
                                                <th class="pr-2">@lang('records.date')</th>
                                                <th class="pr-2">@lang('records.time')</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($records[$department->id] as $record)
                                            <tr>
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
                                            </tr>
                                            @include('components.desc',['id'=>$record->id,'name' =>
                                            $record->caseType->name,'desc'=>$record->value])
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                @else
                                <h6 class="text-center">@lang('records.no_records')</h6>
                                @endif
                                @else
                                <h6 class="text-center">@lang('records.no_records')</h6>

                                @endisset
                            </div>
                            <div class="panel-footer border">
                               
                                <a href="{{ route('records.index',['patient'=>$patient->id,'department'=>$department->id]) }}"
                                    class="text text-primary">@lang('modal.show_more')</a>
                            </div>
                        </div>
                    </div>
                    @endpermission
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>



</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')

<!--- Internal Accordion Js -->
<script src="{{URL::asset('assets/plugins/accordion/accordion.min.js')}}"></script>
<script src="{{URL::asset('assets/js/accordion.js')}}"></script>

@endsection