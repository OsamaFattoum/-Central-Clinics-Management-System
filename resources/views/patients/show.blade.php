@extends('layouts.app')


@include('components.breadcrumb',['pervPage' => $profile->translate(app()->getLocale())->name , 'currentPage' =>
__('sidebar.patients_t')])

@section('content')

<div class="row row-sm">
    <div class="col-lg-4">
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
    <div class="col-lg-8">

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
                <hr>


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