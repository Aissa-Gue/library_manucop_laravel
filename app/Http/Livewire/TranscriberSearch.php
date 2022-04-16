<?php

namespace App\Http\Livewire;

use App\Models\Transcriber;
use Livewire\Component;
use Livewire\WithPagination;

class TranscriberSearch extends Component
{
    use WithPagination;

    public $transcriber1;
    public $transcriber2;
    public $transcriber3;
    public $transcriber4;

    public $fontMatcher1;
    public $fontMatcher2;
    public $fontMatcher3;
    public $fontMatcher4;


    public function transcribers1()
    {
        return $transcribers = Transcriber::where('full_name', 'LIKE', '%' . $this->transcriber1 . '%')->paginate(40);
    }
    public function transcribers2()
    {
        return $transcribers = Transcriber::where('full_name', 'LIKE', '%' . $this->transcriber2 . '%')->paginate(40);
    }
    public function transcribers3()
    {
        return $transcribers = Transcriber::where('full_name', 'LIKE', '%' . $this->transcriber3 . '%')->paginate(40);
    }
    public function transcribers4()
    {
        return $transcribers = Transcriber::where('full_name', 'LIKE', '%' . $this->transcriber4 . '%')->paginate(40);
    }



    public function fontMatchers1()
    {
        return $fontMatchers = Transcriber::where('full_name', 'LIKE', '%' . $this->fontMatcher1 . '%')->paginate(40);
    }
    public function fontMatchers2()
    {
        return $fontMatchers = Transcriber::where('full_name', 'LIKE', '%' . $this->fontMatcher2 . '%')->paginate(40);
    }
    public function fontMatchers3()
    {
        return $fontMatchers = Transcriber::where('full_name', 'LIKE', '%' . $this->fontMatcher3 . '%')->paginate(40);
    }
    public function fontMatchers4()
    {
        return $fontMatchers = Transcriber::where('full_name', 'LIKE', '%' . $this->fontMatcher4 . '%')->paginate(40);
    }


    public function render()
    {
        return view('livewire.transcriber-search')
            ->with('transcribers1', $this->transcribers1())
            ->with('transcribers2', $this->transcribers2())
            ->with('transcribers3', $this->transcribers3())
            ->with('transcribers4', $this->transcribers4())

            ->with('fontMatchers1', $this->fontMatchers1())
            ->with('fontMatchers2', $this->fontMatchers2())
            ->with('fontMatchers3', $this->fontMatchers3())
            ->with('fontMatchers4', $this->fontMatchers4());
    }
}