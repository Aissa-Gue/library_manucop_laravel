<?php

namespace App\Http\Livewire\Search;

use App\Models\Author;
use App\Models\Book;
use App\Models\Cabinet;
use App\Models\City;
use App\Models\Color;
use App\Models\Country;
use App\Models\Manuscript;
use App\Models\Manutype;
use App\Models\Motif;
use App\Models\Subject;
use App\Models\Transcriber;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdvancedSearchManuscripts extends Component
{
    public $font;
    public $book;
    public $author;
    public $subject;
    public $transcriber;
    public $transcribed_from;
    public $transcribed_to;
    public $manutype;
    public $motif;
    public $color;
    public $cabinet;
    public $country;
    public $city;
    public $transCity;
    public $transCountry;

    public $subjectsArray = [];
    public $authorsArray = [];
    public $transcribersArray = [];
    public $manutypesArray = [];
    public $colorsArray = [];
    public $motifsArray = [];
    public $cabinetsArray = [];

    public function books()
    {
        return Book::where('title', 'LIKE', '%' . $this->book . '%')->paginate(40);
    }

    public function authors()
    {
        return Author::where('name', 'LIKE', '%' . $this->author . '%')->paginate(40);
    }

    public function subjects()
    {
        return Subject::where('name', 'LIKE', '%' . $this->subject . '%')->paginate(40);
    }

    public function motifs()
    {
        return Motif::where('name', 'LIKE', '%' . $this->motif . '%')->paginate(40);
    }

    public function colors()
    {
        return Color::where('name', 'LIKE', '%' . $this->color . '%')->paginate(40);
    }

    public function manutypes()
    {
        return Manutype::where('name', 'LIKE', '%' . $this->manutype . '%')->paginate(40);
    }

    public function cabinets()
    {
        return Cabinet::where('name', 'LIKE', '%' . $this->cabinet . '%')->paginate(40);
    }

    public function transcribers()
    {
        $other_name1 = Transcriber::select('other_name1');
        $other_name2 = Transcriber::select('other_name2');
        $other_name3 = Transcriber::select('other_name3');
        $other_name4 = Transcriber::select('other_name4');

        return Transcriber::select(DB::raw("CONCAT(full_name,
         IFNULL('',concat(' ',descent1)),
         IFNULL('',concat(' ',descent2)),
         IFNULL('',concat(' ',descent3)),
         IFNULL('',concat(' ',descent4)),
         IFNULL('',concat(' ',descent5)),
         IFNULL('',concat(' ',last_name)),
         IFNULL('',concat(' ',nickname)))
         as full_name_all"))
            ->unionAll($other_name1)->unionAll($other_name2)->unionAll($other_name3)->unionAll($other_name4)
            ->having('full_name_all', 'LIKE', '%' . $this->transcriber . '%')
            ->paginate(35);
    }

    public function transcribedFromList()
    {
        return Manuscript::select('transcribed_from')
            ->where('transcribed_from', 'LIKE', '%' . $this->transcribed_from . '%')
            ->paginate(35);
    }

    public function transcribedToList()
    {
        return Manuscript::select('transcribed_to')
            ->where('transcribed_to', 'LIKE', '%' . $this->transcribed_to . '%')
            ->paginate(35);
    }

    public function countries()
    {
        return Country::where('name', 'LIKE', '%' . $this->country . '%')->paginate(35);
    }

    public function cities()
    {
        return City::where('name', 'LIKE', '%' . $this->city . '%')->paginate(35);
    }

    public function transCountries()
    {
        return Country::where('name', 'LIKE', '%' . $this->transCountry . '%')->paginate(35);
    }

    public function transCities()
    {
        return City::where('name', 'LIKE', '%' . $this->transCity . '%')->paginate(35);
    }

    /***** Subjects *****/
    public function pushToSubjects($name)
    {
        if ($name != null && !in_array($name, $this->subjectsArray)) {
            array_push($this->subjectsArray,  $name);
            $this->subject = null;
        }
    }

    public function deleteSubject($name)
    {
        $i = 0;
        foreach ($this->subjectsArray as $subject) {
            if ($subject == $name) {
                unset($this->subjectsArray[$i]);
            }
            $i++;
        }
    }

    /***** Authors *****/
    public function pushToAuthors($name)
    {
        if ($name != null && !in_array($name, $this->authorsArray)) {
            array_push($this->authorsArray,  $name);
            $this->author = null;
        }
    }

    public function deleteAuthor($name)
    {
        $i = 0;
        foreach ($this->authorsArray as $author) {
            if ($author == $name) {
                unset($this->authorsArray[$i]);
            }
            $i++;
        }
    }

    /***** Motifs *****/
    public function pushToMotifs($name)
    {
        if ($name != null && !in_array($name, $this->motifsArray)) {
            array_push($this->motifsArray,  $name);
            $this->motif = null;
        }
    }

    public function deleteMotif($name)
    {
        $i = 0;
        foreach ($this->motifsArray as $motif) {
            if ($motif == $name) {
                unset($this->motifsArray[$i]);
            }
            $i++;
        }
    }

    /***** Colors *****/
    public function pushToColors($name)
    {
        if ($name != null && !in_array($name, $this->colorsArray)) {
            array_push($this->colorsArray,  $name);
            $this->color = null;
        }
    }

    public function deleteColor($name)
    {
        $i = 0;
        foreach ($this->colorsArray as $color) {
            if ($color == $name) {
                unset($this->colorsArray[$i]);
            }
            $i++;
        }
    }

    /***** Manutypes *****/
    public function pushToManutypes($name)
    {
        if ($name != null && !in_array($name, $this->manutypesArray)) {
            array_push($this->manutypesArray,  $name);
            $this->manutype = null;
        }
    }

    public function deleteManutype($name)
    {
        $i = 0;
        foreach ($this->manutypesArray as $manutype) {
            if ($manutype == $name) {
                unset($this->manutypesArray[$i]);
            }
            $i++;
        }
    }


    /***** Cabinets *****/
    public function pushToCabinets($name)
    {
        if ($name != null && !in_array($name, $this->cabinetsArray)) {
            array_push($this->cabinetsArray,  $name);
            $this->cabinet = null;
        }
    }

    public function deleteCabinet($name)
    {
        $i = 0;
        foreach ($this->cabinetsArray as $cabinet) {
            if ($cabinet == $name) {
                unset($this->cabinetsArray[$i]);
            }
            $i++;
        }
    }

    public function render()
    {
        return view('livewire.search.advanced-search-manuscripts')
            ->with('books', $this->books())
            ->with('authors', $this->authors())
            ->with('subjects', $this->subjects())
            ->with('transcribers', $this->transcribers())
            ->with('cabinets', $this->cabinets())
            ->with('manutypes', $this->manutypes())
            ->with('colors', $this->colors())
            ->with('motifs', $this->motifs())
            ->with('transcribedFromList', $this->transcribedFromList())
            ->with('transcribedToList', $this->transcribedToList())
            ->with('transCountries', $this->transCountries())
            ->with('transCities', $this->transCities())
            ->with('countries', $this->countries())
            ->with('cities', $this->cities());
    }


    public function resetForm()
    {
        return $this->reset();
    }
}