<?php

namespace App\Http\Livewire\Search;

use App\Models\Author;
use App\Models\Book;
use App\Models\Subject;
use Livewire\Component;

class QuickSearchBooks extends Component
{
    public $book;
    public $author;
    public $subject;
    public $subjectsArray = [];
    public $authorsArray = [];


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

    public function render()
    {
        return view('livewire.search.quick-search-books')
            ->with('books', $this->books())
            ->with('authors', $this->authors())
            ->with('subjects', $this->subjects());
    }

    public function resetForm()
    {
        return $this->reset();
    }
}