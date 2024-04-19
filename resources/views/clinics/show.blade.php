@extends('layouts.app')


@include('components.breadcrumb',['pervPage' => $clinic->translate(app()->getLocale())->name , 'currentPage' =>
__('sidebar.clinics_t')])

@section('content')

<div class="row row-sm">
    <div class="col-lg-4">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="pl-0">
                    <div class="main-profile-overview">
                        <div class="main-img-user profile-user bd bd-1">
                            <img alt="" src="{{URL::asset($clinic->image_path)}}">
                            <a class="fas fa-edit profile-edit" href="{{ route('clinics.edit',$clinic->id) }}"></a>
                        </div>
                        <div class="d-flex justify-content-between mg-b-20">
                            <div>
                                <h5 class="main-profile-name">{{ $clinic->name }}</h5>
                                <p class="main-profile-name-text">{{ $clinic->email }}</p>
                                <span class="badge op-5 badge-{{ $clinic->status ? 'success' : 'danger' }}">{{
                                    $clinic->status ? __('facility.enabled') : __('facility.not_enabled') }}</span>
                            </div>
                        </div>
                        <h6>@lang('facility.description')</h6>
                        <div class="main-profile-bio">
                            @include('components.description_data_table',['description'=>$clinic->description,'id'=>$clinic->id,'count'
                            => 100])
                        </div><!-- main-profile-bio -->

                        <hr class="mg-y-30">
                        <label class="main-content-label tx-13 mg-b-20">@lang('facility.facility_contact')</label>
                        <div class="main-profile-social-list">
                            <div class="media">
                                <div class="media-icon bg-primary-transparent text-primary">
                                    <ion-icon name="call"></ion-icon>
                                </div>
                                <div class="media-body">
                                    <span>@lang('clinics.phone_contact')</span> <a
                                        href="tel:{{ $clinic->facilityProfile->phone }}">{{
                                        $clinic->facilityProfile->phone }}</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-icon bg-success-transparent text-success">
                                    <ion-icon name="call"></ion-icon>
                                </div>
                                <div class="media-body">
                                    <span>@lang('clinics.phone_owner_contact')</span> <a
                                        href="tel:{{ $clinic->facilityProfile->owner_phone }}">{{
                                        $clinic->facilityProfile->owner_phone }}</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-icon bg-info-transparent text-info">
                                    <ion-icon name="mail"></ion-icon>
                                </div>
                                <div class="media-body">
                                    <span>@lang('facility.email')</span> <a href="mailto:{{ $clinic->email }}">{{
                                        $clinic->email }}</a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- main-profile-overview -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="row row-sm">

            <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                <div class="card bg-whi">
                    <a class="tx-dark" href="{{route('departments.index',['clinic'=>$clinic->id])}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="icon1 mt-2 text-center">
                                        <i class="fe fe-layers tx-40"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-0 text-center">
                                        <span>@lang('clinics.department')</span>
                                        <h2>{{ $clinic->departments()->count() }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                <div class="card bg-whi ">
                    <a class="tx-dark" href="{{route('accreditations.index',$clinic->id)}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="icon1 mt-2 text-center">
                                    <i class="fe fe-book-open tx-40"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span>@lang('clinic_accreditations.accreditions')</span>
                                    <h2>{{ $clinic->accreditations()->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                <div class="card bg-whi ">
                    <a class="tx-dark" href="{{route('doctors.index',['clinic'=>$clinic->id])}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="icon1 mt-2 text-center">
                                    <i class="fe fe-users tx-40"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span>@lang('doctors.doctors')</span>
                                    <h2>{{ $clinic->doctors()->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            
        </div>
        <div class="card">
            <div class="card-body">
                <div class="py-2 px-3">
                    <div class="row">
                        <div class="col-lg-4 mb-lg-0 mb-1">
                            <h6 class="text-secondary tx-13">@lang('facility.address')</h6>
                            <span class="tx-13 tx-bold">{{ $clinic->facilityProfile->address }}</span>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4 mb-lg-0 mb-2">
                            <h6 class="text-secondary tx-13">@lang('facility.city')</h6>
                            <span class="tx-13 tx-bold">{{ $clinic->cityName() }}</span>
                        </div>
                        <div class="col-lg-4 mb-lg-0 mb-2">
                            <h6 class="text-secondary tx-13">@lang('facility.postal_code')</h6>
                            <span class="tx-13 tx-bold">{{ $clinic->facilityProfile->postal_code }}</span>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-5 mb-lg-0 mb-1">
                            <h6 class="text-secondary tx-13">@lang('clinics.name_owner_profile')</h6>
                            <span class="tx-13 tx-bold">{{ $clinic->facilityProfile->owner_name }}</span>
                        </div>
                        <div class="col-lg-6 mb-lg-0 mb-1">
                            <h6 class="text-secondary tx-13">@lang('clinics.email_owner_profile')</h6>
                            <span class="tx-13 tx-bold">{{ $clinic->facilityProfile->owner_email }}</span>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4 mb-lg-0 mb-1">
                            <h6 class="text-secondary tx-13">@lang('facility.open_hours')</h6>
                            <span class="tag tag-secondary tx-11">{{
                                \Carbon\Carbon::parse($clinic->facilityProfile->open_hours)->format('h:iA') }}</span>
                        </div>
                        <div class="col-lg-4 mb-lg-0 mb-1">
                            <h6 class="text-secondary tx-13">@lang('facility.close_hours')</h6>
                            <span class="tag tag-secondary tx-11">{{
                                \Carbon\Carbon::parse($clinic->facilityProfile->close_hours)->format('h:iA') }}</span>
                        </div>
                        <div class="col-lg-4 mb-lg-0 mb-1">
                            <h6 class="text-secondary tx-13">@lang('facility.status')</h6>
                            <span class="tag tag-{{ $clinic->checkOpenStatus() ? 'green' : 'red' }} tx-11">{{
                                $clinic->openStatusLabel() }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col mb-lg-0 mb-2">

                            <h6 class="text-secondary tx-13">@lang('facility.open_days')</h6>
                            @foreach($clinic->facilityDays as $day)

                            <span class="tag tag-indigo tx-12 mt-lg-0 mt-3">{{ $day->day->day }}</span>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@include('components.desc',['id'=>$clinic->id,'name' =>
$clinic->name,'desc'=>$clinic->description])

</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection