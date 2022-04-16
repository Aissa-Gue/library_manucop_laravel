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

class EditBook extends Component
{
    use WithPagination;

    public $bookInfo;
    public $book;
    public $author;
    public $authorsArray = [];
    public $subject;
    public $subjectsArray = [];

    public function mount()
    {
        $this->book = $this->bookInfo->title;
        if ($this->bookInfo->authors->count() > 0) {
            foreach ($this->bookInfo->authors as $author) {
                $this->pushToAuthors($author->id, $author->name);
            }
        }
        if ($this->bookInfo->subjects->count() > 0) {
            foreach ($this->bookInfo->subjects as $subject) {
                $this->pushToSubjects($subject->id, $subject->name);
            }
        }
    }

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
        return view('livewire.books.edit-book')
            ->with('subjects', $this->subjects())
            ->with('authors', $this->authors());
    }

    public function update()
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
            $book = Book::where('id', $this->bookInfo->id)->update([
                'title' => $this->book,
            ]);

            BookAuthor::where('book_id', $this->bookInfo->id)->delete();
            foreach ($this->authorsArray as $author) {
                BookAuthor::where('book_id', $this->bookInfo->id)->create([
                    'book_id' => $this->bookInfo->id,
                    'author_id' => $author['id'],
                ]);
            }

            BookSubject::where('book_id', $this->bookInfo->id)->delete();
            foreach ($this->subjectsArray as $subject) {
                BookSubject::where('book_id', $this->bookInfo->id)->create([
                    'book_id' => $this->bookInfo->id,
                    'subject_id' => $subject['id'],
                ]);
            }

            DB::commit();
            $message = [
                "label" => "تم تعديل معلومات الكتاب بنجاح",
                "bg" => "bg-success",
            ];
            return redirect()->route('books.show', $this->bookInfo->id)
                ->with('message', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = [
                "label" => "حدثت مشكلة، لم يتم تعديل معلومات الكتاب",
                "bg" => "bg-danger",
            ];
            return redirect()->back()->with('message', $message);
        }
    }
}