<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Manuscript;
use App\Models\Transcriber;
use Illuminate\Http\Request;
use stdClass;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //return $this->bySubjects2();
        return view('dashboard.index')
            ->with('cards', $this->cards())
            ->with('by_save_status', $this->bySaveStatus())
            ->with('by_cabinets', $this->byCabinets())
            ->with('by_subjects1', $this->bySubjects1())
            ->with('by_subjects2', $this->bySubjects2())
            ->with('by_manutypes', $this->byManutypes())
            ->with('by_manuscript_level', $this->byManuscriptLevel())
            ->with('by_transcriber_level', $this->byTranscriberLevel());
    }


    public function cards()
    {
        $cards = new stdClass();
        $cards->manuscripts = Manuscript::count();
        $cards->transcribers = Transcriber::count();
        $cards->books = Book::count();
        $cards->authors = Author::count();
        return $cards;
    }

    public function bySaveStatus()
    {
        return Manuscript::groupBy('save_status')
            ->selectRaw('count(*) as total, save_status')
            ->get();
    }

    public function byCabinets()
    {
        return Manuscript::groupBy('cabinet_id')
            ->selectRaw('count(*) as total, cabinet_id')
            ->get();
    }

    public function bySubjects1()
    {
        return Manuscript::join('book_subjects', 'book_subjects.book_id', 'manuscripts.book_id')
            ->join('subjects', 'subjects.id', 'book_subjects.subject_id')
            ->groupBy('subject_id')
            ->orderBy('subject_id')
            ->selectRaw('count(*) as total, manuscripts.book_id, subject_id, subjects.name')
            ->get();
    }

    public function bySubjects2()
    {
        return Book::join('book_subjects', 'book_subjects.book_id', 'books.id')
            ->join('subjects', 'subjects.id', 'book_subjects.subject_id')
            ->groupBy('subject_id')
            ->orderBy('subject_id')
            ->selectRaw('count(*) as total, books.id, subject_id, subjects.name')
            ->get();
    }

    public function byManutypes()
    {
        return Manuscript::join('manuscript_manutypes', 'manuscript_manutypes.manuscript_id', 'manuscripts.id')
            ->join('manutypes', 'manutypes.id', 'manuscript_manutypes.manutype_id')
            ->groupBy('manutype_id')
            ->selectRaw('count(*) as total, manutypes.name')
            ->get();
    }

    public function byManuscriptLevel()
    {
        return Manuscript::groupBy('manuscript_level')
            ->whereNotNull('manuscript_level')
            ->orderBy('manuscript_level')
            ->selectRaw('count(*) as total, manuscript_level')
            ->get();
    }

    public function byTranscriberLevel()
    {
        return Manuscript::groupBy('transcriber_level')
            ->whereNotNull('transcriber_level')
            ->orderBy('transcriber_level')
            ->selectRaw('count(*) as total, transcriber_level')
            ->get();
    }
}