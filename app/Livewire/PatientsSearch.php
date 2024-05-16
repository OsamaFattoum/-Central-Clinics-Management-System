<?php

namespace App\Livewire;

use App\Models\Users\Patient;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;

class PatientsSearch extends Component
{

    #[Url(as: 's', history: true)]
    public $searchTerm = '';


    public $patients = [];


    public function search()
    {
        $this->validate([
            'searchTerm' => ['min:5']
        ]);

        if (!empty($this->searchTerm)) {
            $this->patients = Patient::where('civil_id', 'like','%' . $this->searchTerm . '%')->get();
        }else{
            $this->reset();
        }
    } //end of search

    public function render()
    {
        
        if (request('s')) {
        
            $this->patients = Patient::where('civil_id', 'like', request('s'))->get();
        }
       
        return view('livewire.patients-search');
    } //end of render
}
