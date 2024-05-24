<?php

namespace App\Livewire\Clinic;

use App\Models\Appointment;
use App\Models\Clinic\Clinic;
use App\Models\Department\Department;
use App\Models\Users\Doctor;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Statistics extends Component
{

    private function statistics(): array
    {
        // Appointments By Status
        $appointmentsByStatus = Appointment::select('status', DB::raw('count(*) as total'))
            ->where('clinic_id', auth()->user()->id)
            ->groupBy('status')
            ->get();


        // Doctors Per Department
        $doctorsPerDepartment = Doctor::select('department_translations.name as department_name', DB::raw('count(*) as total'))
            ->where('clinic_id', auth()->user()->id)
            ->join('departments', 'doctors.department_id', '=', 'departments.id')
            ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')->where('locale', app()->getLocale())
            ->groupBy('department_translations.name')
            ->get();


        // Number of Active vs Inactive Doctors
        $activeDoctors = Doctor::where('status', 1)->where('clinic_id', auth()->user()->id)->count();
        $inactiveDoctors = Doctor::where('status', 0)->where('clinic_id', auth()->user()->id)->count();


        $appointmentStatusLabels = $appointmentsByStatus->pluck('status_value');
        $appointmentStatusData = $appointmentsByStatus->pluck('total');


        $doctorDepartmentLabels = $doctorsPerDepartment->pluck('department_name');
        $doctorDepartmentData = $doctorsPerDepartment->pluck('total');

        $departmentCount = Clinic::where('id', auth()->user()->id)->withCount('departments')->first()->departments_count;

        return [
            'departmentCount' => $departmentCount,
            'doctorsCount' => Doctor::where('clinic_id', auth()->user()->id)->count(),
            'appointmentsCount' => Appointment::where('clinic_id', auth()->user()->id)->count(),
            'appointmentStatusLabels' => $appointmentStatusLabels,
            'appointmentStatusData' => $appointmentStatusData,
            'doctorDepartmentLabels' => $doctorDepartmentLabels,
            'doctorDepartmentData' => $doctorDepartmentData,
            'activeDoctors' => $activeDoctors,
            'inactiveDoctors' => $inactiveDoctors,

        ];
    }



    public function render()
    {
        return view('livewire.clinic.statistics', $this->statistics());
    }
}
