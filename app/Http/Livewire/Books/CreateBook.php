<?php

namespace App\Http\Livewire\Books;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\BookSubject;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class CreateBook extends Component
{
    use WithPagination;

    public $book;
    public $author;
    public $authorsArray = [];
    public $subject;
    public $subjectsArray = [];


    public function authors()
    {
        return $authors = Author::where('name', 'LIKE', '%' . $this->author . '%')->paginate(40);
    }

    public function subjects()
    {
        return $subjects = Subject::where('name', 'LIKE', '%' . $this->subject . '%')->get();
    }

    public function pushToAuthors($id, $value)
    {
        if ($id != null && $value != null && !in_array(['id' => $id, 'name' => $value], $this->authorsArray)) {
            array_push($this->authorsArray, ['id' => $id, 'name' => $value]);
            $this->author = null;
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

    //Subjects
    public function pushToSubjects($id, $value)
    {
        if ($id != null && $value != null && !in_array(['id' => $id, 'name' => $value], $this->subjectsArray)) {
            array_push($this->subjectsArray, ['id' => $id, 'name' => $value]);
            $this->subject = null;
        }
    }

    public function deleteSubject($id)
    {
        $i = 0;
        foreach ($this->subjectsArray as $subject) {
            if ($subject['id'] == $id) {
                unset($this->subjectsArray[$i]);
            }
            $i++;
        }
    }


    public function render()
    {
        return view('livewire.books.create-book')
            ->with('subjects', $this->subjects())
            ->with('authors', $this->authors());
    }

    public function store()
    {
        $validated = $this->validate([
            'book' => 'required',
            'authorsArray' => 'required|array',
            'authorsArray.*.id' => 'required|distinct|integer|exists:authors,id',
            'subjectsArray' => 'required|array',
            'subjectsArray.*.id' => 'required|distinct|integer|exists:subjects,id'
        ]);

        DB::beginTransaction();
        try {
            $book = Book::create([
                'title' => $this->book,
            ]);
            foreach ($this->authorsArray as $author) {
                BookAuthor::create([
                    'book_id' => $book->id,
                    'author_id' => $author['id'],
                ]);
            }
            foreach ($this->subjectsArray as $subject) {
                BookSubject::create([
                    'book_id' => $book->id,
                    'subject_id' => $subject['id'],
                ]);
            }

            DB::commit();

            $message = [
                "label" => "تم إضافة الكتاب بنجاح",
                "bg" => "bg-success",
            ];
            return redirect()->route('books.show', $book->id)
                ->with('message', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = [
                "label" => "حدثت مشكلة، لم يتم إضافة الكتاب",
                "bg" => "bg-danger",
            ];
            return redirect()->back()->with('message', $message);
        }
    }
}