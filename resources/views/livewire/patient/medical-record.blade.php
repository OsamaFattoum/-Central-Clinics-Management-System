{{-- @push('medical-record')
<script>
    $(function(){
        @this.on('openModal',()=>{
            $('#showMoreRecords').modal('show');
        }); 
    });
</script>

@endpush --}}

<div class="">
    @if (!$showMoreStatus)
    <div aria-multiselectable="true" class="accordion row" id="accordion2" role="tablist">
        @foreach ($departments as $department)
        <div class=" mb-0 col-lg-6 mt-3">
            <div class="card-header" id="heading{{ $department->id }}" role="tab">
                <a class="bg-white rounded-top p-5 d-flex justify-content-between align-items-center"
                    aria-controls="collapse{{ $department->id }}" aria-expanded="false" data-toggle="collapse"
                    href="#collapse{{ $department->id }}">
                    <div class="">
                        <h4 class="text-dark">{{ $department->name }}</h4>
                        <p class="op-5 tx-12">@lang('patients.text_last_record') {{ $department->name }}</p>
                    </div>

                    <div class="">
                        <img alt="" src="{{URL::asset($department->image_path)}}" class="wd-100"
                            style="filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">
                    </div>
                </a>
            </div>
            <div aria-labelledby="heading{{ $department->id }}" class="collapse " data-parent="#accordion2"
                id="collapse{{ $department->id }}" role="tabpanel">
                <div class="card-body bg-white p-2">
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
                    @else
                    <h6 class="text-center">@lang('records.no_records')</h6>

                    @endisset
                </div>


            </div>
            <div class="card-footer bg-white">

                <a href="" wire:click.prevent='showMoreRecordModal({{ $department }})'
                    class="text text-primary">@lang('modal.show_more')</a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    @include('livewire.patient.more-record')
    @endif
</div>