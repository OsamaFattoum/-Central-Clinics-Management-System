<?php

namespace App\Livewire;

use App\Livewire\Forms\DoctorForm;
use App\Models\Clinic\Clinic;
use App\Models\Department\Department;
use App\Models\Users\Doctor as UsersDoctor;
use App\Models\Users\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;

class Doctor extends Component
{

    public DoctorForm $form;

    public $activeTab = 1;

    public $clinics;
    public $cities;

    public $selectedClinic = false;
    public $selectedDepartment;
    public $departments;

    public $allDepartments;

    public $doctor;
    public $updateMode = false;

    public function mount()
    {

        $this->allDepartments = Department::all();
        if (auth()->guard('clinic')->check()) {
            $this->clinics = Clinic::where('id', auth()->user()->id)->where('status', 1)->first();
            $this->form->clinic = auth()->user()->id;
            $this->selectClinic();
        } else {
            $this->clinics = Clinic::where('status', 1)->get();
        }
        $citiesJson = file_get_contents(resource_path('json/cities.json'));
        $this->cities = json_decode($citiesJson, true);

        if (request('doctor')) {

            $this->doctor = request('doctor');
            $this->editDoctor($this->doctor);
            $this->form->onUpdated = true;
            $this->form->doctor_id = $this->doctor;
        }
    } //end of mount


    public function selectClinic()
    {
        if ($this->form->clinic) {
            $this->form->reset('department', 'permissions');
            $this->reset('selectedDepartment');
            $this->departments = Clinic::findOrFail($this->form->clinic)->departments;
            $this->selectedClinic = true;
        } else {
            $this->form->reset('department', 'clinic', 'permissions');
            $this->reset('selectedDepartment');
            $this->selectedClinic = false;
        }
    } //end of select Clinic

    public function selectDepartment()
    {
        $this->reset('activeTab');
        if ($this->form->department) {
            $this->form->reset('permissions');
            if ($this->updateMode) {
                if (!auth()->guard('clinic')->check()) {
                    $this->selectedDepartment = Department::findOrFail($this->form->department);
                    if ($this->selectedDepartment->status) {
                        $this->form->permissions['read-medications'] = true;
                    }        
                }

            } else {

                $this->selectedDepartment = Department::findOrFail($this->form->department);
                if ($this->selectedDepartment->status) {
                    $this->form->permissions['read-medications'] = true;
                }    
            }

        } else {
            $this->form->reset('permissions', 'department');
            $this->reset('selectedDepartment');
        }
    } //end of select Department

    function convertNamePermission(string $permission): string
    {
        $permission = Str::replace('-', ' ', $permission);

        $permission = Str::title($permission);

        return $permission;
    } //end of convert Name Permission

    private function formatPermissions()
    {
        $permissions = [];
        foreach ($this->form->permissions as $permission => $enabled) {
            if ($enabled) {
                $permissions[] = $permission;
            }
        }

        return $permissions;
    } //end of formatPermissions

    public function toggleChecked(string $permission)
    {

        if (array_key_exists($permission, $this->form->permissions)) {
            if (!$this->form->permissions[$permission]) {
                unset($this->form->permissions[$permission]);
                array_values($this->form->permissions);
            }
        }
    } //end of toggleChecked

    public function getDoctorPermissionsByDepartment(UsersDoctor $doctor)
    {
        $allPermissions = $doctor->allPermissions();

        $rolesPermissions = collect();
        foreach ($doctor->roles as $role) {
            $rolesPermissions = $rolesPermissions->merge($role->permissions);
        }

        $userSpecificPermissions = $allPermissions->diff($rolesPermissions);

        return $userSpecificPermissions->pluck('name');
    } // end of get doctor permissions by department



    public function selectTab(int $index)
    {
        $this->activeTab = $index;
    } //end of selectTab


    public function editDoctor(String $doctor)
    {

        $this->updateMode = true;
        $doctor = UsersDoctor::find($doctor);

        $form = $this->form;

        if ($doctor) {

            if (auth()->guard('clinic')->check()) {
                if ($doctor->clinic_id != auth()->user()->id) {
                    abort(404);
                }
            }

            foreach (config('translatable.locales') as $value) {
                $form->names[$value] = $doctor->profile->translate($value)->name;
            }
            $form->civil_id = $doctor->civil_id;
            $form->job_number = $doctor->job_number;
            $form->email = $doctor->email;
            $form->clinic = $doctor->clinic_id;
            $this->selectClinic();
            $form->department = $doctor->department_id;
            $this->selectDepartment();

            foreach ($this->getDoctorPermissionsByDepartment($doctor) as $permission) {
                $form->permissions[$permission] = true;
            }
            $form->address = $doctor->profile->address;
            $form->city = $doctor->profile->city;
            $form->phone = $doctor->profile->phone;
            $form->gender = $doctor->profile->gender;
            $form->dob = $doctor->profile->birth_date;
        } else {
            abort(404);
        }
    } //end of edit Doctor


    public function save()
    {
        DB::beginTransaction();
        $this->form->validate();
        try {
            if ($this->updateMode) {
                $doctor = UsersDoctor::find($this->form->doctor_id);

                $data = [
                    "civil_id" => $this->form->civil_id,
                    "job_number" => $this->form->job_number,
                    "email" => $this->form->email,
                    'clinic_id' => $this->form->clinic,
                    'department_id' => $this->form->department,
                ];

                $doctor->update($data);

                $data_profile = [
                    'gender' => $this->form->gender,
                    'birth_date' => $this->form->dob,
                    'phone' => $this->form->phone,
                    'city' => $this->form->city,
                    'address' => $this->form->address,
                    'profile_id' => $doctor->id,
                    'profile_type' => UsersDoctor::class,
                ];

                $doctor->profile()->update($data_profile);

                Profile::find($doctor->profile->id)->update([
                    "ar" => [
                        "name" => $this->form->names['ar'],
                    ],
                    "en" => [
                        "name" => $this->form->names['en'],
                    ],
                ]);
            } else {
                $data = [
                    "civil_id" => $this->form->civil_id,
                    "job_number" => $this->form->job_number,
                    "email" => $this->form->email,
                    "password" => Hash::make($this->form->password),
                    'clinic_id' => $this->form->clinic,
                    'department_id' => $this->form->department,
                ];
                if (auth()->guard('clinic')->check()) {
                    $data['status'] = false;
                }
                $doctor = UsersDoctor::create($data);

                $data_profile = [
                    "ar" => [
                        "name" => $this->form->names['ar'],
                    ],
                    "en" => [
                        "name" => $this->form->names['en'],
                    ],
                    'gender' => $this->form->gender,
                    'birth_date' => $this->form->dob,
                    'phone' => $this->form->phone,
                    'city' => $this->form->city,
                    'address' => $this->form->address,
                    'profile_id' => $doctor->id,
                    'profile_type' => UsersDoctor::class,
                ];

                $doctor->profile()->create($data_profile);
                $doctor->addRole('doctor');
            }
            $doctor->syncPermissions($this->formatPermissions());
            DB::commit();
            session()->flash('add');
            return redirect()->route('doctors.index');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    } //end of save

    public function render()
    {
        return view('livewire.doctors.doctor');
    } //end of render
}
