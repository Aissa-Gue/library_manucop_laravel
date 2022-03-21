<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\BookSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id && !$request->title) {
            $books = Book::where('id', $request->id)
                ->paginate(25);
        } else {
            $books = Book::Where('title', 'LIKE', '%' . $request->title . '%')
                ->paginate(25);
        }
        return view('books.index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'authors' => 'required|array',
            'authors.*' => 'required|distinct|integer|exists:authors,id',
            'subjects' => 'required|array',
            'subjects.*' => 'required|distinct|integer|exists:subjects,id'
        ]);

        DB::beginTransaction();
        try {
            $book = Book::create([
                'title' => $request->title,
            ]);
            foreach ($request->authors as $author) {
                BookAuthor::create([
                    'book_id' => $book->id,
                    'author_id' => $author,
                ]);
            }
            foreach ($request->subjects as $subject) {
                BookSubject::create([
                    'book_id' => $book->id,
                    'subject_id' => $subject,
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
                "bg" => "bg-success",
            ];
            return redirect()->back()->with('message', $message);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::with('authors', 'subjects')->find($id);
        return view('books.show')->with('book', $book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::with('authors', 'subjects')->find($id);
        return view('books.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'authors' => 'required|array',
            'authors.*' => 'required|distinct|integer|exists:authors,id',
            'subjects' => 'required|array',
            'subjects.*' => 'required|distinct|integer|exists:subjects,id'
        ]);

        DB::beginTransaction();
        try {
            $book = Book::where('id', $id)->update([
                'title' => $request->title,
            ]);

            BookAuthor::where('book_id', $id)->delete();
            foreach ($request->authors as $author) {
                BookAuthor::where('book_id', $id)->create([
                    'book_id' => $id,
                    'author_id' => $author,
                ]);
            }

            BookSubject::where('book_id', $id)->delete();
            foreach ($request->subjects as $subject) {
                BookSubject::where('book_id', $id)->create([
                    'book_id' => $id,
                    'subject_id' => $subject,
                ]);
            }

            DB::commit();
            $message = [
                "label" => "تم تعديل معلومات الكتاب بنجاح",
                "bg" => "bg-success",
            ];
            return redirect()->route('books.show', $id)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            BookAuthor::where('book_id', $id)->delete();
            BookSubject::where('book_id', $id)->delete();
            Book::destroy($id);
            DB::commit();

            $message = [
                "label" => "تم حذف الكتاب بنجاح",
                "bg" => "bg-success",
            ];
            return redirect()->back()->with('message', $message);

        } catch (\Exception $e) {

            if (Book::find($id)->manuscripts->count() > 0) {
                $message = [
                    "label" => "خطأ، للكتاب استمارات يجب حذفها أولا",
                    "bg" => "bg-danger",
                ];
            } else {
                $message = [
                    "label" => "حدثت مشكلة، لم يتم حذف الكتاب",
                    "bg" => "bg-danger",
                ];
            }

            DB::rollBack();
            return redirect()->back()->with('message', $message);
        }
    }
}
