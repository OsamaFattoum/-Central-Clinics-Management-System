=
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
                    <a href="" wire:click.prevent='clearData' class="text text-primary tx-12 mt-3">@lang('records.clear_history')</a>
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