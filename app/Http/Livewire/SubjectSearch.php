<?php

namespace App\Http\Livewire;

use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;

class SubjectSearch extends Component
{
    use WithPagination;

    public $subjectLivewire;
    public $subject;

    public function subjects()
    {
        return $subjects = Subject::where('name', 'LIKE', '%' . $this->subject . '%')->paginate(40);
    }

    public function render()
    {
        return view('livewire.subject-search')
            ->with('subjects', $this->subjects())
            ->with('subjectLivewire', $this->subjectLivewire);
    }
}