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
                                <h2 wire:loading.class='d-none' class="text-white mb-0">{{ $departmentCount }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 col-md-6 col-12">
            <div class="card bg-purple-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-briefcase-medical tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white d-block">@lang('sidebar.clinics_t')</span>
                                <div wire:loading.class.remove='d-none'
                                    class="spinner-grow text-white spinner-grow-sm d-none" role="status">
                                </div>
                                <h2 wire:loading.class='d-none' class="text-white mb-0">{{ $clinicsCount }}</h2>
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
                                <h2 wire:loading.class='d-none' class="text-white mb-0">{{ $doctorsCount }}</h2>
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
                                <i class="fa fa-hospital-user tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white d-block">@lang('sidebar.patients_t')</span>
                                <div wire:loading.class.remove='d-none'
                                    class="spinner-grow text-white spinner-grow-sm d-none" role="status">
                                </div>
                                <h2 wire:loading.class='d-none' class="text-white mb-0">{{ $patientsCount }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Box Count -->

    <!-- Line & Bar Chart -->
    <div class="row row-sm">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('charts.title_new_patients')</h4>
                    <p class="tx-12 text-muted mb-0">@lang('charts.p_new_patients')</p>
                </div>
                <div class="card-body">
                    <div wire:loading.class='d-flex' class="d-none justify-content-center align-items-center">
                        <div class="spinner-grow text-black" role="status"></div>
                    </div>
                    <canvas wire:loading.class='d-none' id="newPatientChart"></canvas>
                </div>
            </div>

        </div>
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
                    <canvas wire:loading.class='d-none' id="doctorsChart"></canvas>
                </div>
            </div>

        </div>

    </div>
    <!-- End Line & Bar Chart -->

    <!-- Pie & Doughnut Chart -->
    <div class="row row-sm">
        <div class="col-sm-12 col-md-4">
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
        <div class="col-sm-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('charts.title_blood_type_distribution')</h4>
                    <p class="tx-12 text-muted mb-0">@lang('charts.p_blood_type_distribution')</p>
                </div>
                <div class="card-body">
                    <div wire:loading.class='d-flex' class="d-none justify-content-center align-items-center">
                        <div class="spinner-grow text-black" role="status"></div>
                    </div>
                    <canvas wire:loading.class='d-none' id="bloodTypeChart"></canvas>
                </div>
            </div>

        </div>
        <div class="col-sm-12 col-md-4">
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
    <!-- End Pie & Doughnut Chart -->
</div>

@push('charts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- new Patient Total Chart --}}
<script>
    const ctx = document.getElementById('newPatientChart');
  
    new Chart(ctx, {
      type: 'line',
      data: {
            labels: @json($monthlyPatientLabels),
            datasets: [{
                label: @json(__('charts.title_new_patients')),
                data: @json($monthlyPatientData),
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
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


{{-- Total Doctors as Department Chart --}}
<script>
    const ctx2 = document.getElementById('doctorsChart');
    new Chart(ctx2, {
        type: 'bar',
        data: {
                labels: @json($doctorDepartmentLabels),
                datasets: [{
                    label: @json(__('charts.title_doctors_chart')),
                    data: @json($appointmentStatusData),
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
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
                        'rgba(169, 169, 169,0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [ 
                        'rgba(169, 169, 169,1)',
                        'rgba(54, 162, 235,1)',
                        'rgba(255, 99, 132, 1)',
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


{{-- Distributed Blood Type as Number of Patients Chart --}}
<script>
    const ctx4 = document.getElementById('bloodTypeChart');
    new Chart(ctx4, {
        type: 'pie',
        data: {
                labels: @json($bloodTypeLabels),
                datasets: [{
                    data: @json($bloodTypeData),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                     
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                     
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
    const ctx5 = document.getElementById('doctorStatusChart');
    new Chart(ctx5, {
        type: 'doughnut',
        data: {
                labels: ["{{ __('users.enabled') }}","{{ __('users.not_enabled') }}"],
                datasets: [{
                    data: [{{ $activeDoctors }}, {{ $inactiveDoctors }}],
                    backgroundColor: [
                        'rgba(34 ,192, 60,0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(34 ,192, 60,1)',
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