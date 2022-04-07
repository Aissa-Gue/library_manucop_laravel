<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;

class CitySearch extends Component
{
    use WithPagination;

    public $cityLivewire;
    public $city;

    public function cities()
    {
        return $cities = City::where('name', 'LIKE', '%' . $this->city . '%')->paginate(25);
    }

    public function render()
    {
        return view('livewire.city-search')
            ->with('cities', $this->cities())
            ->with('cityLivewire', $this->cityLivewire);
    }
}