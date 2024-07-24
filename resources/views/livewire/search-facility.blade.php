<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card custom-card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="cities">@lang('users.city')<span class="tx-danger">*</span></label>
                        <select wire:model="city" id="cities"
                            class="form-control @error('city') custom-select2-border @enderror"
                            data-parsley-error="#slErrorContainer"
                            dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr'  }}">
                            <option value="">@lang('site.select_package_placeholder')</option>

                            @foreach ($cities as $city)
                            <option value="{{ $city['id'] }}">{{
                                $city['name_' . app()->getLocale()] }}</option>
                            @endforeach
                        </select>
                        @include('components.input-error',['input'=> 'city','is_select'=>true])
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="type">@lang('users.type_facility')<span class="tx-danger">*</span></label>
                        <select wire:model="type" class="form-control @error('type') custom-select2-border @enderror"
                            id="facility_type">
                            <option value="">@lang('site.select_package_placeholder')</option>
                            <option value="clinic">@lang('facility.option_clinic')</option>
                            <option value="pharmacy">@lang('facility.option_pharmacy')</option>
                        </select>
                        @include('components.input-error',['input'=> 'type','is_select'=>true])

                    </div>
                    <div class="col-lg-1 mt-2 mt-lg-0">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <button wire:click="search" class="btn btn-primary"
                                    type="button">@lang('site.search')</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-body p-3">
                @include('components.custom-loader')
                <div class="row">
                    @foreach ($results as $result)
                    <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class=" avatar-lg">
                                            <img alt="avatar" class="rounded-circle"
                                                src="{{URL::asset($result->image_path)}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <h4>{{ $result->name }}</h4>
                                        @if ($result->departments)
                                        <div class="row">
                                            <div class="col mb-lg-0 mb-2">
                                                @foreach ($result->departments as $department)
                                                <span class="tag tag-info tx-10 mt-lg-0 mt-3">{{ $department->name
                                                    }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <h6>@lang('facility.description')</h6>
                                <div class="">
                                    @include('components.description_data_table',['description'=>$result->description,'id'=>$result->id,'count'
                                    => 20])
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-12 mb-1">
                                        <h6 class="text-secondary tx-10">@lang('facility.address')</h6>
                                        <span class="tx-13 tx-bold">{{ $result->facilityProfile->address }}</span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-4 col-md-4 col-4 col-sm-12 mb-1">
                                        <h6 class="text-secondary tx-10">@lang('facility.open_hours')</h6>
                                        <span class="tag tag-secondary tx-10">{{
                                            \Carbon\Carbon::parse($result->facilityProfile->open_hours)->format('h:iA')
                                            }}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-4 col-sm-12 mb-1">
                                        <h6 class="text-secondary tx-10">@lang('facility.close_hours')</h6>
                                        <span class="tag tag-secondary tx-10">{{
                                            \Carbon\Carbon::parse($result->facilityProfile->close_hours)->format('h:iA')
                                            }}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-4 col-sm-12 mb-1">
                                        <h6 class="text-secondary tx-10">@lang('facility.status_open')</h6>
                                        <span
                                            class="tag tag-{{ $result->checkOpenStatus() ? 'green' : 'red' }} tx-10">{{
                                            $result->openStatusLabel() }}</span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col mb-2">

                                        <h6 class="text-secondary tx-10">@lang('facility.open_days')</h6>
                                        @foreach($result->facilityDays as $day)

                                        <span class="tag tag-indigo tx-12 mt-lg-0 mt-3">{{ $day->day->day }}</span>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="tel:{{ $result->facilityProfile->phone }}" class="btn btn-sm btn-outline-dark">
                                    <span>{{ $result->facilityProfile->phone }}</span>
                                </a>
                                <span class="mx-1"></span>
                                <a href="mailto:{{ $result->email }}" class="btn btn-sm btn-outline-primary">
                                    <span>{{ $result->email }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    @include('components.desc',['id'=>$result->id,'name' =>
                    $result->name,'desc'=>$result->description])

                    @endforeach
                </div>

            </div>
        </div>
    </div>

</div>