<div aria-multiselectable="true" class="accordion row mb-5" id="accordion2" role="tablist">
    <div class=" mb-0 col-lg-6 mt-3">
        <div class="card-header" id="headingMedicaition" role="tab">
            <a class="bg-white rounded-top p-5 d-flex justify-content-between align-items-center"
                aria-controls="collapseMedicaition" aria-expanded="false" data-toggle="collapse"
                href="#collapseMedicaition">
                <h4 class="text-dark">@lang('patients.medications_taken')</h4>

                <div class="">
                    <img alt="" src="{{URL::asset('assets/img/medicine.png')}}" class="wd-100"
                        style="filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">
                </div>
            </a>
        </div>
        <div aria-labelledby="headingMedicaition" class="collapse" data-parent="#accordion2" id="collapseMedicaition"
            role="tabpanel">
            <div class="card-body bg-white p-2">
                @empty(!$medications)
                <div class="table-responsive">
                    <table class="table table-bordered mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="pr-2">@lang('medications.name')</th>
                                <th class="pr-2">@lang('medications.case_type')</th>
                                <th class="pr-2">@lang('medications.dosage')</th>
                                <th class="pr-2">@lang('medications.instructions')</th>
                                <th class="pr-2">@lang('medications.date')</th>
                                <th class="pr-2">@lang('medications.time')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medications as $medication)
                            <tr>
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

                            </tr>
                            @include('components.desc',['id'=>$medication->id,'name' =>
                            $medication->name,'desc'=>$medication->instructions])
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <h6 class="text-center">@lang('records.no_records')</h6>
                @endempty
            </div>


        </div>
        <div class="card-footer bg-white ">

            <a aria-controls="collapseMedicaition" aria-expanded="false" data-toggle="collapse"
                href="#collapseMedicaition" class="text text-primary">@lang('site.show')
                @lang('patients.medications_taken')</a>
        </div>
    </div>
    <div class=" mb-0 col-lg-6 mt-3">
        <div class="card-header" id="headingAppointment" role="tab">
            <a class="bg-white rounded-top p-5 d-flex justify-content-between align-items-center"
                aria-controls="collapseAppointment" aria-expanded="false" data-toggle="collapse"
                href="#collapseAppointment">
                <h4 class="text-dark">@lang('appointments.appointments')</h4>

                <div class="">
                    <img alt="" src="{{URL::asset('assets/img/appointment.png')}}" class="wd-100"
                        style="filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">
                </div>
            </a>
        </div>
        <div aria-labelledby="headingAppointment" class="collapse " data-parent="#accordion2" id="collapseAppointment"
            role="tabpanel">
            <div class="card-body bg-white p-2">
                @empty(!$appointments)

                <div class="table-responsive">
                    <table class="table table-bordered mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="pr-2">@lang('appointments.clinic')</th>
                                <th class="pr-2">@lang('appointments.department')</th>
                                <th class="pr-2">@lang('appointments.doctor')</th>
                                <th class="pr-2">@lang('appointments.notes')</th>
                                <th class="pr-2">@lang('appointments.date')</th>
                                <th class="pr-2">@lang('appointments.time')</th>
                                <th class="pr-2">@lang('appointments.status')</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($appointments as $appointment)
                            <tr>
                                <td class="pr-2">
                                    <span class="badge badge-primary">{{$appointment->clinic->name}}</span>
                                </td>
                                <td class="pr-2">
                                    <span class="badge badge-light">{{$appointment->department->name}}</span>
                                </td>
                                <td class="pr-2">
                                    <span class="badge badge-dark">{{$appointment->doctor->name}}</span>
                                </td>
                                <td class="pr-2">
                                    @include('components.description_data_table',['description'=>$appointment->notes,'id'=>$appointment->id])
                                </td>
                                <td class="pr-2">{{ $appointment->date }}</td>
                                <td class="pr-2">{{ \Carbon\Carbon::parse($appointment->time)->format('h:iA') }}
                                </td>
                                <td class="pr-2">
                                    <span
                                        class="badge badge-{{$appointment->status == 0  ? 'secondary' : ($appointment->status == 1 ? 'info' : 'danger')}}">{{$appointment->status_value}}</span>
                                </td>
                            </tr>
                            @include('components.desc',['id'=>$appointment->id,'name' =>
                            __('appointments.notes'),'desc'=>$appointment->notes]) @endforeach
                        </tbody>

                    </table>

                </div>

                @else
                <h6 class="text-center">@lang('records.no_records')</h6>

                @endempty
            </div>


        </div>
        <div class="card-footer d-flex justify-content-between align-items-center bg-white">
            <a href="#collapseAppointment" class="text text-primary" aria-controls="collapseAppointment"
                aria-expanded="false" data-toggle="collapse">@lang('site.show') @lang('appointments.appointments')</a>
            <a href="" wire:click.prevent='addAppointment'
                class="text text-primary">@lang('appointments.btn_add_appointment')</a>
        </div>
    </div>


    @include('livewire.patient._add-appointment')





</div>

@push('appointment-medication')

<script>
    $(function(){
        @this.on('openModal',()=>{
            $('#addAppointmentModal').modal('show');
        });
       
        @this.on('addedAppointment',()=>{
            $('#addAppointmentModal').modal('hide');
            notif({
                msg:  "{{ __('messages.add') }}",
                type: "success"
            }); 
        });

    });
</script>

@endpush