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
    public $authorsArray = [];

    public function authors()
    {
        return $authors = Author::where('name', 'LIKE', '%' . $this->author . '%')->paginate(25);
    }

    public function pushToAuthors($id, $value)
    {
        if ($id != null && $value != null && !in_array(['id' => $id, 'name' => $value], $this->authorsArray)) {
            return array_push($this->authorsArray, ['id' => $id, 'name' => $value]);
        }
    }

    public function deleteAuthor($id)
    {
        $i = 0;
        foreach ($this->authorsArray as $author) {
            if ($author['id'] == $id) {
                unset($this->authorsArray[$i]);
            }
            $i++;
        }
    }

    public function render()
    {
        return view('livewire.author-search')
            ->with('authors', $this->authors())
            ->with('authorLivewire', $this->authorLivewire);
    }
}