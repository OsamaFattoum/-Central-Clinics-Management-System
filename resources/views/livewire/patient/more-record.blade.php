{{-- <div wire:ignore.self class="modal fade" id="showMoreRecords" tabindex="-1" wire:click='resetModal'
    aria-labelledby="showMoreRecordsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showMoreRecordsLabel">@lang('site.search') @lang('site.in_department') ({{
                    $departmentName }})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click='resetModal'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @session('error_search')
                <div class="alert alert-danger" role="alert">
                    {{ session('error_search') }}
                </div>
                @endsession
                <form wire:submit="searchRecords">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group d-flex align-items-center">
                                <label for="fromDate">@lang('records.form')<span class="tx-danger">*</span></label>
                                <input type="date" id="fromDate"
                                    class="form-control mx-2 @error('fromDate') is-invalid @enderror"
                                    wire:model='fromDate' max="{{ $toDate }}">
                            </div>
                            @include('components.input-error',['input'=>'fromDate'])

                        </div>
                        <div class="col-lg-5">
                            <div class="form-group d-flex align-items-center">
                                <label for="toDate">@lang('records.to')<span class="tx-danger">*</span></label>
                                <input type="date" id="toDate"
                                    class="form-control mx-2 @error('toDate') is-invalid @enderror" wire:model='toDate'
                                    max="{{  $toDate }}">
                            </div>
                            @include('components.input-error',['input'=>'toDate'])
                        </div>
                        <div class="col-lg-1 mt-2 mt-lg-0">
                            <label for=""></label>
                            <button class="btn btn-primary" type="submit">@lang('site.search')</button>
                        </div>
                    </div>


                </form>

                @if (!empty($records))
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

                            @foreach ($records as $record)
                            <tr>
                                <td class="pr-2">{{ $record->caseType->name }}</td>
                                <td class="pr-2">
                                    @include('components.description_data_table',['description'=>$record->value,'id'=>'record'
                                    . $record->id])
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

                            @include('components.desc',['id'=>'record' . $record->id,'name' =>
                            $record->caseType->name,'desc'=>$record->value])

                            @endforeach
                        </tbody>

                    </table>

                </div>
                @else
                <h6 class="text-center">@lang('records.no_records')</h6>
                @endif




            </div>



        </div>
    </div>
</div>
--}}

<div class="row row-sm">
    @session('error_search')
    <div class="alert alert-danger col-lg-12 " role="alert">
        {{ session('error_search') }}
    </div>
    @endsession
    <div class="col-lg-3">
        <div class="card mg-b-20">
            <div class="card-body">
                <form wire:submit='searchRecords'>
                    <div class="form-group">
                        <label for="startDate">@lang('records.start_date'):<span class="tx-danger">*</span></label>
                        <input type="date" id="startDate" class="form-control @error('startDate') is-invalid @enderror"
                            wire:model='startDate' max="{{ $endDate }}">
                        @include('components.input-error',['input'=>'startDate'])
                    </div>
                    <div class="form-group">
                        <label for="endDate">@lang('records.end_date'):<span class="tx-danger">*</span></label>
                        <input type="date" id="endDate" class="form-control @error('endDate') is-invalid @enderror"
                            wire:model='endDate' max="{{ $endDate }}">
                        @include('components.input-error',['input'=>'endDate'])
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">@lang('site.search')</button>
                    <a href="" wire:click.prevent='clearData' class="text text-primary tx-12 mt-3">محو البحث</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card mg-b-20">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h4 class="card-title">{{ $departmentName }}</h4>
                        <p class="text-muted card-sub-title mb-0">@lang('site.search') @lang('site.in_department')
                            ({{$departmentName }})</p>
                    </div>
                    <div class="">
                        <button class="btn btn-dark btn-sm" wire:click='back'>@lang('site.back')</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (!empty($recordsSearch))
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

                            @forelse ($recordsSearch as $record)
                            <tr>
                                <td class="pr-2">{{ $record->caseType->name }}</td>
                                <td class="pr-2">
                                    @include('components.description_data_table',['description'=>$record->value,'id'=>'record'
                                    . $record->id])
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

                            @include('components.desc',['id'=>'record' . $record->id,'name' =>
                            $record->caseType->name,'desc'=>$record->value])
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">@lang('records.no_records')</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>
                @else
                <h6 class="text-center">@lang('records.no_records')</h6>
                @endif
            </div>
        </div>
    </div>
</div>