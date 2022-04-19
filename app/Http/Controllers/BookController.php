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
                ->paginate(80)
                ->withQueryString();
        } else {
            $books = Book::Where('title', 'LIKE', '%' . $request->title . '%')
                ->paginate(80)
                ->withQueryString();
        }
        return view('books.index')->with('books', $books);
    }


    public function quickSearch(Request $request)
    {
        $books = Book::with('authors', 'subjects')
            ->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->book . '%');
            })
            ->where(function ($query) use ($request) {
                if ($request->authors !== null)
                    foreach ($request->authors as $author) {
                        $query->whereHas('authors', function ($query) use ($author) {
                            $query->where('name', $author);
                        });
                        //->OrDoesntHave('authors');
                    }
            })
            ->where(function ($query) use ($request) {
                if ($request->subjects !== null)
                    foreach ($request->subjects as $subject) {
                        $query->whereHas('subjects', function ($query) use ($subject) {
                            $query->where('name', $subject);
                        });
                        //->OrDoesntHave('subjects');
                    }
            })
            ->paginate(35)
            ->withQueryString();

        return view('search.results')->with('books', $books);
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
        $bookInfo = Book::with('authors', 'subjects')->find($id);
        return view('books.edit')->with('bookInfo', $bookInfo);
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