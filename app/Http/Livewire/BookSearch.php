<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class BookSearch extends Component
{
    use WithPagination;

    public $bookLivewire;
    public $book;
    public $book_id;

    public function setBookId($data_id)
    {
        return $this->book_id = $data_id;
    }

    public function books()
    {
        return $books = Book::where('title', 'LIKE', '%' . $this->book . '%')->paginate(25);
    }

    public function render()
    {
        return view('livewire.book-search')
            ->with('books', $this->books())
            ->with('bookLivewire', $this->bookLivewire);
    }
}