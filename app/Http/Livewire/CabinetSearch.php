<?php

namespace App\Http\Livewire;

use App\Models\Cabinet;
use Livewire\Component;
use Livewire\WithPagination;

class CabinetSearch extends Component
{
    use WithPagination;

    public $cabinetLivewire;
    public $cabinet;

    public function cabinets()
    {
      return Cabinet::where('name', 'LIKE', '%' . $this->cabinet . '%')->paginate(20);
    }


    public function render()
    {
        return view('livewire.cabinet-search')
            ->with('cabinets', $this->cabinets())
            ->with('cabinetLivewire', $this->cabinetLivewire);
    }
}
