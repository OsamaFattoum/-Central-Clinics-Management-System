<div>
    <!-- Box Count -->
    <div class="row row-sm">
        <div class="col-lg-6 col-xl-3 col-md-6 col-12">
            <div class="card bg-primary-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-layer-group tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white d-block">@lang('sidebar.departments_t')</span>
                                <div wire:loading.class.remove='d-none'
                                    class="spinner-grow text-white spinner-grow-sm d-none" role="status">
                                </div>
                                <h2 wire:loading.class='d-none' class="text-white mb-0 counter">{{ $departmentCount }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-lg-6 col-xl-3 col-md-6 col-12">
            <div class="card bg-info-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-user-doctor tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white d-block">@lang('sidebar.doctors_t')</span>
                                <div wire:loading.class.remove='d-none'
                                    class="spinner-grow text-white spinner-grow-sm d-none" role="status">
                                </div>
                                <h2 wire:loading.class='d-none' class="text-white mb-0 counter">{{ $doctorsCount }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 col-md-6 col-12">
            <div class="card bg-teal text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-calendar-check tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white d-block">@lang('appointments.appointments')</span>
                                <div wire:loading.class.remove='d-none'
                                    class="spinner-grow text-white spinner-grow-sm d-none" role="status">
                                </div>
                                <h2 wire:loading.class='d-none' class="text-white mb-0 counter">{{ $appointmentsCount }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 col-md-6 col-12">
            <a class="tx-dark" href="{{route('accreditations.index',auth()->user()->id)}}">
            <div class="card bg-purple-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-book-open tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white d-block">@lang('clinic_accreditations.accreditions')</span>
                                <div wire:loading.class.remove='d-none'
                                    class="spinner-grow text-white spinner-grow-sm d-none" role="status">
                                </div>
                                <h2 wire:loading.class='d-none' class="text-white mb-0 counter">{{ $accreditationsCount }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    <!-- End Box Count -->

    <!-- Chart -->
    <div class="row row-sm">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('charts.title_doctors_chart')</h4>
                    <p class="tx-12 text-muted mb-0">@lang('charts.p_doctors_chart')</p>
                </div>
                <div class="card-body">
                    <div wire:loading.class='d-flex' class="d-none justify-content-center align-items-center">
                        <div class="spinner-grow text-black" role="status"></div>
                    </div>
                    <canvas wire:loading.class='d-none' height="134" id="doctorsChart"></canvas>
                </div>
            </div>

        </div>
        <div class="col-sm-12 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('charts.title_status_appointment_total')</h4>
                    <p class="tx-12 text-muted mb-0">@lang('charts.p_status_appointment_total')</p>
                </div>
                <div class="card-body">
                    <div wire:loading.class='d-flex' class="d-none justify-content-center align-items-center">
                        <div class="spinner-grow text-black" role="status"></div>
                    </div>
                    <canvas wire:loading.class='d-none' id="totalAppointmentStatusChart"></canvas>
                </div>
            </div>

        </div>
        <div class="col-sm-12 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('charts.title_doctor_status_total')</h4>
                    <p class="tx-12 text-muted mb-0">@lang('charts.p_doctor_status_total')</p>
                </div>
                <div class="card-body">
                    <div wire:loading.class='d-flex' class="d-none justify-content-center align-items-center">
                        <div class="spinner-grow text-black" role="status"></div>
                    </div>
                    <canvas wire:loading.class='d-none' id="doctorStatusChart"></canvas>
                </div>
            </div>

        </div>
    </div>
    <!-- End Chart -->
</div>

@push('charts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="{{URL::asset('assets/plugins/counters/waypoints.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/counters/counterup.min.js')}}"></script>

{{-- counter --}}
<script>
	$('.counter').countUp();
</script>



{{-- Total Doctors as Department Chart --}}
<script>
    const ctx2 = document.getElementById('doctorsChart');
    new Chart(ctx2, {
        type: 'bar',
        data: {
                labels: @json($doctorDepartmentLabels),
                datasets: [{
                    label: @json(__('charts.title_doctors_chart')),
                    data: @json($doctorDepartmentData),
                    backgroundColor: 'rgba(14, 41, 84,0.7)',
                    borderColor: 'rgba(14, 41, 84,1)',
                    borderWidth: 1
                }]
            },
            options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },  
            }
            },
    });
</script>

{{-- Status Appointments Chart --}}
<script>
    const ctx3 = document.getElementById('totalAppointmentStatusChart');
    new Chart(ctx3, {
        type: 'doughnut',
        data: {
                labels: @json($appointmentStatusLabels),
                datasets: [{
                    data: @json($appointmentStatusData),
                    backgroundColor: [
                        'rgba(255, 99, 132,0.7)',
                        'rgba(169, 169, 169,0.7)',
                        'rgba(54, 162, 235,0.7)',
                    ],
                    borderColor: [ 
                        'rgb(255, 99, 132)',
                        'rgb(169, 169, 169)',
                        'rgb(54, 162, 235)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                   
                }
            },
    });
</script>


{{-- Status Doctors Chart --}}
<script>
    const ctx4 = document.getElementById('doctorStatusChart');
    new Chart(ctx4, {
        type: 'doughnut',
        data: {
                labels: ["{{ __('users.enabled') }}","{{ __('users.not_enabled') }}"],
                datasets: [{
                    data: [{{ $activeDoctors }}, {{ $inactiveDoctors }}],
                    backgroundColor: [
                        'rgba(65, 176, 110,0.7)',
                        'rgba(255, 99, 132,0.7)'
                    ],
                    borderColor: [
                        'rgba(65, 176, 110,1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                   
                }
            },
    });
</script>


@endpush