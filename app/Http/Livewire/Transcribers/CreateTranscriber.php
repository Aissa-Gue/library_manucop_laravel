<?php

namespace App\Http\Livewire\Transcribers;

use App\Models\City;
use App\Models\Country;
use App\Models\Transcriber;
use Livewire\Component;

class CreateTranscriber extends Component
{
    public $full_name;

    public $currentDescent;
    public $descent1;
    public $descent2;
    public $descent3;
    public $descent4;
    public $descent5;

    public $last_name;
    public $nickname;

    public $currentOtherName;
    public $other_name1;
    public $other_name2;
    public $other_name3;
    public $other_name4;

    public $city;
    public $city_id;
    public $country;
    public $country_id;

    public function mount()
    {
        $this->currentDescent = 1;
        $this->currentOtherName = 1;
    }

    public function countries()
    {
        return $countries = Country::where('name', 'LIKE', '%' . $this->country . '%')->paginate(40);
    }

    public function cities()
    {
        return $cities = City::whereHas('country', function ($query) {
            $query->where('name', $this->country);
        })
            ->where('name', 'LIKE', '%' . $this->city . '%')
            ->paginate(40);
    }

    public function increaseDescent()
    {
        $this->currentDescent++;
        if ($this->currentDescent > 5) {
            $this->currentDescent = 5;
        }
    }

    public function increaseOtherName()
    {
        $this->currentOtherName++;
        if ($this->currentOtherName > 4) {
            $this->currentOtherName = 4;
        }
    }

    public function setCountryId($data_id)
    {
        $this->reset('city', 'city_id');
        return $this->country_id = $data_id;
    }

    public function setCityId($data_id)
    {
        return $this->city_id = $data_id;
    }



    public function render()
    {
        $transComp = [
            'is_update' => false,
            'btn_title' => 'إضافة',
            'btn_color' => 'btn-success',
            'btn_icon' => 'fas fa-plus',
        ];
        return view('livewire.transcribers.create-edit-transcriber')
            ->with('countries', $this->countries())
            ->with('cities', $this->cities())
            ->with('transComp', $transComp);
    }

    public function store()
    {
        $validated = $this->validate([
            'full_name' => 'required|string|max:255',
            'descent1' => 'nullable|string|max:255',
            'descent2' => 'nullable|string|max:255',
            'descent3' => 'nullable|string|max:255',
            'descent4' => 'nullable|string|max:255',
            'descent5' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'other_name1' => 'nullable|string|max:255',
            'other_name2' => 'nullable|string|max:255',
            'other_name3' => 'nullable|string|max:255',
            'other_name4' => 'nullable|string|max:255',
            'country_id' => 'nullable|integer|exists:countries,id',
            'city_id' => 'nullable|integer|exists:cities,id',
        ]);

        try {
            $transcriber = Transcriber::create($validated);
            $message = [
                "label" => "تم إضافة الناسخ بنجاح",
                "bg" => "bg-success",
            ];
        } catch (\Exception $e) {
            $message = [
                "label" => "حدثت مشكلة، لم يتم إضافة الناسخ",
                "bg" => "bg-danger",
            ];
        }

        return redirect()->route('transcribers.show', $transcriber->id)
            ->with('message', $message);
    }
}