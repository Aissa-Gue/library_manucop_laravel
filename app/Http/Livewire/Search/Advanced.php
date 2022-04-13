<?php

namespace App\Http\Livewire\Search;

use App\Models\Author;
use App\Models\Book;
use App\Models\City;
use App\Models\Country;
use App\Models\Transcriber;
use Livewire\Component;

class Advanced extends Component
{
    public $country;
    public $city;
    public $author;
    public $book;
    public $transcriber;

    public function countries()
    {
        return Country::where('name', 'LIKE', '%' . $this->country . '%')->paginate(25);
    }

    public function cities()
    {
        return City::where('name', 'LIKE', '%' . $this->city . '%')->paginate(25);
    }

    public function authors()
    {
        return Author::where('name', 'LIKE', '%' . $this->author . '%')->paginate(25);
    }

    public function books()
    {
        return Book::where('title', 'LIKE', '%' . $this->book . '%')->paginate(25);
    }

    public function transcribers()
    {
        return Transcriber::where('full_name', 'LIKE', '%' . $this->transcriber . '%')->paginate(25);
    }

    public function render()
    {
        return view('livewire.search.advanced-search');
    }
}