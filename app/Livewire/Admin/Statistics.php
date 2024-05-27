<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Clinic\Clinic;
use App\Models\Department\Department;
use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Statistics extends Component
{


    private function statistics(): array
    {
        // Appointments By Status
        $appointmentsByStatus = Appointment::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();


        // Monthly New Patient Registrations
        $monthlyNewPatients = Patient::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Doctors Per Department
        $doctorsPerDepartment = Doctor::select('department_translations.name as department_name', DB::raw('count(*) as total'))
            ->join('departments', 'doctors.department_id', '=', 'departments.id')
            ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')->where('locale', app()->getLocale())
            ->groupBy('department_translations.name')
            ->get();
       

        // Patients' Blood Type Distribution
        $bloodTypeDistribution = Patient::select('blood_types.name as blood_type_name', DB::raw('count(*) as total'))
            ->join('blood_types', 'patients.blood_type_id', '=', 'blood_types.id')
            ->groupBy('blood_types.name')
            ->get();

        // Number of Active vs Inactive Doctors
        $activeDoctors = Doctor::where('status', 1)->count();
        $inactiveDoctors = Doctor::where('status', 0)->count();

        $appointmentStatusLabels = $appointmentsByStatus->pluck('status_value');
        $appointmentStatusData = $appointmentsByStatus->pluck('total');

        $monthlyPatientLabels = $monthlyNewPatients->pluck('month');
        $monthlyPatientData = $monthlyNewPatients->pluck('total');

        $doctorDepartmentLabels = $doctorsPerDepartment->pluck('department_name');
        $doctorDepartmentData = $doctorsPerDepartment->pluck('total');


        $bloodTypeLabels = $bloodTypeDistribution->pluck('blood_type_name');
        $bloodTypeData = $bloodTypeDistribution->pluck('total');


        return [
            'departmentCount' => Department::count(),
            'clinicsCount' => Clinic::count(),
            'doctorsCount' => Doctor::count(),
            'patientsCount' => Patient::count(),
            'appointmentStatusLabels' => $appointmentStatusLabels,
            'appointmentStatusData' => $appointmentStatusData,
            'monthlyPatientLabels' => $monthlyPatientLabels,
            'monthlyPatientData' => $monthlyPatientData,
            'doctorDepartmentLabels' => $doctorDepartmentLabels,
            'doctorDepartmentData' => $doctorDepartmentData,
            'bloodTypeLabels' => $bloodTypeLabels,
            'bloodTypeData' => $bloodTypeData,
            'activeDoctors' => $activeDoctors,
            'inactiveDoctors' => $inactiveDoctors,

        ];
    }


    public function render()
    {
        return view('livewire.admin.statistics', $this->statistics());
    }
}
