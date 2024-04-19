<?php

namespace App\Livewire;

use App\Livewire\Forms\DoctorForm;
use App\Models\Clinic\Clinic;
use App\Models\Department\Department;
use App\Models\Permission;
use App\Models\Users\Doctor as UsersDoctor;
use App\Models\Users\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\String_;

class Doctor extends Component
{

    public DoctorForm $form;

    public $clinics;
    public $cities;

    public $selectedClinic = false;
    public $selectedDepartment;
    public $departments;

    public $doctor;
    public $updateMode = false;

    public function mount()
    {
        $this->clinics = Clinic::where('status', 1)->get();
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
        if ($this->form->department) {
            $this->form->reset('permissions');
            $this->selectedDepartment = Department::findOrFail($this->form->department);
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
        if(array_key_exists($permission,$this->form->permissions)){
            if(!$this->form->permissions[$permission]){
                unset($this->form->permissions[$permission]);
                array_values($this->form->permissions);
            }
        }

    }


    public function editDoctor(String $doctor)
    {

        $this->updateMode = true;
        $doctor = UsersDoctor::find($doctor);

        $form = $this->form;
        if ($doctor) {

            foreach (config('translatable.locales') as $value) {
                $form->names[$value] = $doctor->profile->translate($value)->name;
            }
            $form->civil_id = $doctor->civil_id;
            $form->email = $doctor->email;
            $form->clinic = $doctor->clinic_id;
            $this->selectClinic();
            $form->department = $doctor->department_id;
            $this->selectDepartment();
            foreach ($doctor->allPermissions() as $permission) {
                $form->permissions[$permission->name] = true;
            }
            $form->address = $doctor->profile->address;
            $form->city = $doctor->profile->city;
            $form->phone = $doctor->profile->phone;
            $form->gender = $doctor->profile->gender;
            $form->dob = $doctor->profile->birth_date;
        } else {
            session()->flash('no-id');
            redirect()->route('doctors.index');
        }
    } //end of edit Doctor

    public function save()
    {
        DB::beginTransaction();
        $this->form->validate();
        try {
            if ($this->updateMode) {
                $doctor = UsersDoctor::find($this->form->doctor_id);

                $doctor->update([
                    "civil_id" => $this->form->civil_id,
                    "email" => $this->form->email,
                    'clinic_id' => $this->form->clinic,
                    'department_id' => $this->form->department,
                ]);

                $doctor->profile()->update([
                    'gender' => $this->form->gender,
                    'birth_date' => $this->form->dob,
                    'phone' => $this->form->phone,
                    'city' => $this->form->city,
                    'address' => $this->form->address,
                    'profile_id' => $doctor->id,
                    'profile_type' => UsersDoctor::class,
                ]);

                Profile::find($doctor->profile->id)->update([
                    "ar" => [
                        "name" => $this->form->names['ar'],
                    ],
                    "en" => [
                        "name" => $this->form->names['en'],
                    ],
                ]);

            } else {
                $doctor = UsersDoctor::create([
                    "civil_id" => $this->form->civil_id,
                    "email" => $this->form->email,
                    "password" => Hash::make($this->form->password),
                    'clinic_id' => $this->form->clinic,
                    'department_id' => $this->form->department,
                ]);

                $doctor->profile()->create([
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
                ]);
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
