<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class CountrySearch extends Component
{
    use WithPagination;

    public $countryLivewire;
    public $country;

    public function countries()
    {
        return $countries = Country::where('name', 'LIKE', '%' . $this->country . '%')->paginate(40);
    }

    public function render()
    {
        return view('livewire.country-search')
            ->with('countries', $this->countries())
            ->with('countryLivewire', $this->countryLivewire);
    }
}