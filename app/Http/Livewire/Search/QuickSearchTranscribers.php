<?php

namespace App\Http\Livewire\Search;

use App\Models\Author;
use App\Models\Book;
use App\Models\City;
use App\Models\Country;
use App\Models\Transcriber;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class QuickSearchTranscribers extends Component
{
    public $country;
    public $city;
    public $author;
    public $book;
    public $transcriber;
    public $last_name;
    public $nickname;

    public function transcribers()
    {
        $other_name1 = Transcriber::select('other_name1');
        $other_name2 = Transcriber::select('other_name2');
        $other_name3 = Transcriber::select('other_name3');
        $other_name4 = Transcriber::select('other_name4');

        return Transcriber::select(DB::raw("CONCAT(full_name, ' ', IFNULL(descent1,''),' ', IFNULL(descent2,''),' ', IFNULL(descent3,''),' ',IFNULL(descent4,''), ' ',IFNULL(descent5,'')) as full_name_descent"))
            ->unionAll($other_name1)->unionAll($other_name2)->unionAll($other_name3)->unionAll($other_name4)
            ->having('full_name_descent', 'LIKE', '%' . $this->transcriber . '%')
            ->paginate(40);
    }

    public function last_names()
    {
        return Transcriber::where('last_name', 'LIKE', '%' . $this->last_name . '%')->paginate(40);
    }

    public function nicknames()
    {
        return Transcriber::where('nickname', 'LIKE', '%' . $this->nickname . '%')->paginate(40);
    }


    public function countries()
    {
        return Country::where('name', 'LIKE', '%' . $this->country . '%')->paginate(40);
    }

    public function cities()
    {
        return City::where('name', 'LIKE', '%' . $this->city . '%')->paginate(40);
    }

    public function render()
    {
        return view('livewire.search.quick-search-transcribers')
            ->with('transcribers', $this->transcribers())
            ->with('last_names', $this->last_names())
            ->with('nicknames', $this->nicknames())
            ->with('countries', $this->countries())
            ->with('cities', $this->cities());
    }


    public function resetForm()
    {
        return $this->reset();
    }
}