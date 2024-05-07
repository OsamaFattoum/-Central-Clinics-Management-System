@extends('layouts.app')


@include('components.breadcrumb',['route' => route('pharmacies.index'),'pervPage' => $pharmacy->translate(app()->getLocale())->name , 'currentPage' =>
__('sidebar.pharmacies_t')])

@section('content')

<div class="row row-sm">
    <div class="col-lg-4">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="pl-0">
                    <div class="main-profile-overview">
                        <div class="main-img-user profile-user bd bd-1">
                            <img alt="" src="{{URL::asset($pharmacy->image_path)}}">
                            <a class="fas fa-edit profile-edit" href="{{ route('pharmacies.edit',$pharmacy->id) }}"></a>
                        </div>
                        <div class="d-flex justify-content-between mg-b-20">
                            <div>
                                <h5 class="main-profile-name">{{ $pharmacy->name }}</h5>
                                <p class="main-profile-name-text">{{ $pharmacy->email }}</p>
                                <span class="badge op-5 badge-{{ $pharmacy->status ? 'success' : 'danger' }}">{{ $pharmacy->status ? __('facility.enabled') : __('facility.not_enabled') }}</span>
                            </div>
                        </div>
                        <h6>@lang('facility.description')</h6>
                        <div class="main-profile-bio">
                            @include('components.description_data_table',['description'=>$pharmacy->description,'id'=>$pharmacy->id,'count'
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
                                    <span>@lang('pharmacy.phone_contact')</span> <a
                                        href="tel:{{ $pharmacy->facilityProfile->phone }}">{{
                                        $pharmacy->facilityProfile->phone }}</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-icon bg-success-transparent text-success">
                                    <ion-icon name="call"></ion-icon>
                                </div>
                                <div class="media-body">
                                    <span>@lang('pharmacy.phone_owner_contact')</span> <a
                                        href="tel:{{ $pharmacy->facilityProfile->owner_phone }}">{{
                                        $pharmacy->facilityProfile->owner_phone }}</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-icon bg-info-transparent text-info">
                                    <ion-icon name="mail"></ion-icon>
                                </div>
                                <div class="media-body">
                                    <span>@lang('facility.email')</span> <a href="mailto:{{ $pharmacy->email }}">{{
                                        $pharmacy->email }}</a>
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
                <div class="py-2 px-3">
                    <div class="row">
                        <div class="col-lg-4 mb-lg-0 mb-1">
                            <h6 class="text-secondary tx-13">@lang('facility.address')</h6>
                            <span class="tx-13 tx-bold">{{ $pharmacy->facilityProfile->address }}</span>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4 mb-lg-0 mb-2">
                            <h6 class="text-secondary tx-13">@lang('facility.city')</h6>
                            <span class="tx-13 tx-bold">{{ $pharmacy->cityName() }}</span>
                        </div>
                        <div class="col-lg-4 mb-lg-0 mb-2">
                            <h6 class="text-secondary tx-13">@lang('facility.postal_code')</h6>
                            <span class="tx-13 tx-bold">{{ $pharmacy->facilityProfile->postal_code }}</span>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-5 mb-lg-0 mb-1">
                            <h6 class="text-secondary tx-13">@lang('pharmacy.name_owner_profile')</h6>
                            <span class="tx-13 tx-bold">{{ $pharmacy->facilityProfile->owner_name }}</span>
                        </div>
                        <div class="col-lg-6 mb-lg-0 mb-1">
                            <h6 class="text-secondary tx-13">@lang('pharmacy.email_owner_profile')</h6>
                            <span class="tx-13 tx-bold">{{ $pharmacy->facilityProfile->owner_email }}</span>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4 mb-lg-0 mb-1">
                            <h6 class="text-secondary tx-13">@lang('facility.open_hours')</h6>
                            <span class="tag tag-secondary tx-11">{{
                                \Carbon\Carbon::parse($pharmacy->facilityProfile->open_hours)->format('h:iA') }}</span>
                        </div>
                        <div class="col-lg-4 mb-lg-0 mb-1">
                            <h6 class="text-secondary tx-13">@lang('facility.close_hours')</h6>
                            <span class="tag tag-secondary tx-11">{{
                                \Carbon\Carbon::parse($pharmacy->facilityProfile->close_hours)->format('h:iA') }}</span>
                        </div>
                        <div class="col-lg-4 mb-lg-0 mb-1">
                            <h6 class="text-secondary tx-13">@lang('facility.status')</h6>
                            <span class="tag tag-{{ $pharmacy->checkOpenStatus() ? 'green' : 'red' }} tx-11">{{
                                $pharmacy->openStatusLabel() }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col mb-lg-0 mb-2">

                            <h6 class="text-secondary tx-13">@lang('facility.open_days')</h6>
                            @foreach($pharmacy->facilityDays as $day)

                            <span class="tag tag-indigo tx-12 mt-lg-0 mt-3">{{ $day->day->day }}</span>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@include('components.desc',['id'=>$pharmacy->id,'name' =>
$pharmacy->name,'desc'=>$pharmacy->description])

</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection