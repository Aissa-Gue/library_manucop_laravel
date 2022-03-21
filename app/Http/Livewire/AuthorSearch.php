<?php

namespace App\Http\Livewire;

use App\Models\Author;
use Livewire\Component;
use Livewire\WithPagination;

class AuthorSearch extends Component
{
    use WithPagination;

    public $authorLivewire;
    public $author;

    public function authors()
    {
        return $authors = Author::where('name','LIKE', '%'.$this->author.'%')->paginate(20);
    }

    public function render()
    {
        return view('livewire.author-search')
            ->with('authors',$this->authors())
            ->with('authorLivewire',$this->authorLivewire);
    }
}
