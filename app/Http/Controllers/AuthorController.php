<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id && !$request->name) {
            $authors = Author::where('id', $request->id)
                ->paginate(80)
                ->withQueryString();
        } else {
            $authors = Author::Where('name', 'LIKE', '%' . $request->name . '%')
                ->paginate(80)
                ->withQueryString();
        }

        return view('authors.index')->with('authors', $authors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
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
            'name' => 'required',
        ]);
        $author = Author::create($validated);
        $message = [
            "label" => "تم إضافة المؤلف بنجاح",
            "bg" => "bg-success",
        ];

        return redirect()->route('authors.show', $author->id)
            ->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::find($id);
        return view('authors.show')->with('author', $author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::find($id);
        return view('authors.edit')->with('author', $author);
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
            'name' => 'required',
        ]);
        $author = Author::where('id', $id)->update($validated);
        $message = [
            "label" => "تم تعديل معلومات المؤلف بنجاح",
            "bg" => "bg-success",
        ];
        return redirect()->route('authors.show', $id)
            ->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Author::destroy($id);
            $message = [
                "label" => "تم حذف المؤلف بنجاح",
                "bg" => "bg-success",
            ];
            return redirect()->back()->with('message', $message);
        } catch (\Exception $e) {
            if (Author::find($id)->books->count() > 0) {
                $message = [
                    "label" => "خطأ، توجد كتب للمؤلف يجب حذفها أولا",
                    "bg" => "bg-danger",
                ];
            } else {
                $message = [
                    "label" => "حدثت مشكلة، لم يتم حذف المؤلف",
                    "bg" => "bg-danger",
                ];
            }
            return redirect()->back()->with('message', $message);
        }
    }
}