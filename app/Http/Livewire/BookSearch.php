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

    public function books()
    {
        return $books = Book::where('title','LIKE', '%'.$this->book.'%')->paginate(20);
    }

    public function render()
    {
        return view('livewire.book-search')
            ->with('books',$this->books())
            ->with('bookLivewire',$this->bookLivewire);
    }
}