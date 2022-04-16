<?php

namespace App\Http\Livewire\Search;

use App\Models\Author;
use App\Models\Book;
use App\Models\City;
use App\Models\Country;
use App\Models\Transcriber;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class QuickSearchManuscripts extends Component
{
    public $country;
    public $city;
    public $author;
    public $book;
    public $transcriber;


    public function countries()
    {
        return Country::where('name', 'LIKE', '%' . $this->country . '%')->paginate(40);
    }

    public function cities()
    {
        return City::where('name', 'LIKE', '%' . $this->city . '%')->paginate(40);
    }

    public function authors()
    {
        return Author::where('name', 'LIKE', '%' . $this->author . '%')->paginate(40);
    }

    public function books()
    {
        return Book::where('title', 'LIKE', '%' . $this->book . '%')->paginate(40);
    }

    public function transcribers()
    {
        $other_name1 = Transcriber::select('other_name1');
        $other_name2 = Transcriber::select('other_name2');
        $other_name3 = Transcriber::select('other_name3');
        $other_name4 = Transcriber::select('other_name4');

        return Transcriber::select(DB::raw("CONCAT(full_name, ' ', IFNULL(descent1,''),' ', IFNULL(descent2,''),' ', IFNULL(descent3,''),' ',IFNULL(descent4,''), ' ',IFNULL(descent5,'')) as full_name_descent"))
            ->unionAll($other_name1)->unionAll($other_name2)->unionAll($other_name3)->unionAll($other_name4)
            ->having('full_name_descent', 'LIKE', '%' . $this->transcriber . '%')
            ->paginate(35);
    }

    public function render()
    {
        return view('livewire.search.quick-search-manuscripts')
            ->with('books', $this->books())
            ->with('authors', $this->authors())
            ->with('transcribers', $this->transcribers())
            ->with('countries', $this->countries())
            ->with('cities', $this->cities());
    }


    public function resetForm()
    {
        return $this->reset();
    }
}