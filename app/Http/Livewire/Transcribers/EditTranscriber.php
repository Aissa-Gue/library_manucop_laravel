<?php

namespace App\Http\Livewire\Transcribers;

use App\Models\City;
use App\Models\Country;
use App\Models\Transcriber;
use Livewire\Component;

class EditTranscriber extends Component
{
    public $transcriber;

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
        $this->currentDescent = 5;
        $this->currentOtherName = 4;

        $this->full_name = $this->transcriber->full_name;
        $this->descent1 = $this->transcriber->descent1;
        $this->descent2 = $this->transcriber->descent2;
        $this->descent3 = $this->transcriber->descent3;
        $this->descent4 = $this->transcriber->descent4;
        $this->descent5 = $this->transcriber->descent5;
        $this->other_name1 = $this->transcriber->other_name1;
        $this->other_name2 = $this->transcriber->other_name2;
        $this->other_name3 = $this->transcriber->other_name3;
        $this->other_name4 = $this->transcriber->other_name4;

        $this->last_name = $this->transcriber->last_name;
        $this->nickname = $this->transcriber->nickname;
        $this->city = $this->transcriber->city->name ?? '';
        $this->city_id = $this->transcriber->city_id;
        $this->country = $this->transcriber->country->name ?? '';
        $this->country_id = $this->transcriber->country_id;
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

    public function setCityId($data_id)
    {
        return $this->city_id = $data_id;
    }

    public function setCountryId($data_id)
    {
        return $this->country_id = $data_id;
    }

    public function render()
    {
        $transComp = [
            'is_update' => true,
            'btn_title' => 'تعديل',
            'btn_color' => 'btn-primary',
            'btn_icon' => 'fas fa-pencil-alt',
        ];
        return view('livewire.transcribers.create-edit-transcriber')
            ->with('countries', $this->countries())
            ->with('cities', $this->cities())
            ->with('transComp', $transComp);
    }


    public function update()
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
            $transcriber = Transcriber::where('id', $this->transcriber->id)
                ->update($validated);
            $message = [
                "label" => "تم تعديل معلومات الناسخ بنجاح",
                "bg" => "bg-success",
            ];
        } catch (\Exception $e) {
            $message = [
                "label" => "حدثت مشكلة، لم يتم تعديل معلومات الناسخ",
                "bg" => "bg-danger",
            ];
        }

        return redirect()->route('transcribers.show', $this->transcriber->id)
            ->with('message', $message);
    }
}