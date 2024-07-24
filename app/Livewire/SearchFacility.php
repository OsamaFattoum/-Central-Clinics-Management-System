<?php

namespace App\Livewire;

use App\Models\Clinic\Clinic;
use App\Models\Facility\FacilityProfile;
use App\Models\Pharmacy\Pharmacy;
use Livewire\Component;

class SearchFacility extends Component
{
    public $cities;

    public $city;
    public $type;

    public $results = [];



    public function mount(){

        $citiesJson = file_get_contents(resource_path('json/cities.json'));
        $this->cities = json_decode($citiesJson, true);

    }//end of mount
    
    public function search(){

       $validated =  $this->validate([
            'city' => ['required', 'in:1,2,3,4,5,6,7,8,9,10,11,12,13'],
            'type' => ['required','in:clinic,pharmacy'],
        ]);

        $facilities = [];

        if($this->type == 'clinic'){

            $facilities = Clinic::whereHas('facilityProfile',function($query) use($validated){
                return $query->where('city',$validated['city']);
            })->with('departments')->get();

        }elseif($this->type == 'pharmacy'){
            $facilities = Pharmacy::whereHas('facilityProfile',function($query) use($validated){
                return $query->where('city',$validated['city']);
            })->get();
        }else{
            return;
        }


        $this->results = $facilities;


    }//end of search

    public function render()
    {
        
        return view('livewire.search-facility');
    }
}
