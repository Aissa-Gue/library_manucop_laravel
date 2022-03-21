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

    public function transcribers1()
    {
        return $transcribers = Transcriber::where('full_name', 'LIKE', '%' . $this->transcriber1 . '%')->paginate(20);
    }
    public function transcribers2()
    {
        return $transcribers = Transcriber::where('full_name', 'LIKE', '%' . $this->transcriber2 . '%')->paginate(20);
    }
    public function transcribers3()
    {
        return $transcribers = Transcriber::where('full_name', 'LIKE', '%' . $this->transcriber3 . '%')->paginate(20);
    }
    public function transcribers4()
    {
        return $transcribers = Transcriber::where('full_name', 'LIKE', '%' . $this->transcriber4 . '%')->paginate(20);
    }


    public function render()
    {
        return view('livewire.transcriber-search')
            ->with('transcribers1', $this->transcribers1())
            ->with('transcribers2', $this->transcribers2())
            ->with('transcribers3', $this->transcribers3())
            ->with('transcribers4', $this->transcribers4());
    }
}
