<?php

namespace App\Http\Livewire\Manuscripts;

use App\Models\Transcriber;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Manuscript;
use App\Models\Book;
use App\Models\Cabinet;
use App\Models\City;
use App\Models\Color;
use App\Models\Country;
use App\Models\ManuscriptColor;
use App\Models\ManuscriptManutype;
use App\Models\ManuscriptMotif;
use App\Models\ManuscriptTranscriber;
use App\Models\Manutype;
use App\Models\MatchingFont;
use App\Models\Motif;
use Illuminate\Support\Facades\DB;

class CreateManuscript extends Component
{
    use WithFileUploads;
    /*** Step 01 ***/
    public $transcriber1;
    public $transcriber1_id;
    public $name_in_manu1;
    public $fontMatcher1;
    public $transcriber1_matchers = [];

    public $transcriber2;
    public $transcriber2_id;
    public $name_in_manu2;
    public $fontMatcher2;
    public $transcriber2_matchers = [];

    public $transcriber3;
    public $transcriber3_id;
    public $name_in_manu3;
    public $fontMatcher3;
    public $transcriber3_matchers = [];

    public $transcriber4;
    public $transcriber4_id;
    public $name_in_manu4;
    public $fontMatcher4;
    public $transcriber4_matchers = [];


    /*** Step 02 ***/
    public $book;
    public $book_id;
    public $book_part;
    public $trans_day;
    public $trans_day_nbr;
    public $trans_month;
    public $trans_syear;
    public $trans_day_nbr_m;
    public $trans_month_m;
    public $trans_syear_m;
    public $trans_eyear;
    public $trans_eyear_m;
    public $trans_place;
    public $city;
    public $city_id;
    public $country;
    public $country_id;
    public $signed_in;
    public $cabinet;
    public $cabinet_id;
    public $nbr_in_index;
    public $nbr_in_cabinet;
    public $manu_type;


    /*** Step 03 ***/
    public $font;
    public $font_style;
    public $manuscript_level;
    public $paper_size;
    public $size_notes;
    public $regular_lines;
    public $lines_notes;
    public $is_truncated;
    public $truncation_notes;
    public $nbr_of_papers;
    public $save_status;
    public $motif;
    public $motifsArray = [];
    public $color;
    public $colorsArray = [];


    /*** Step 04 ***/
    public $manutype;
    public $manutypesArray = [];
    public $transcriber_level;


    /*** Step 05 ***/
    public $transcribed_from;
    public $transcribed_to;
    public $is_to_himself;
    public $rost_completion;
    public $notes;


    /*** General ***/
    public $nbrOfTranscribers;
    public $totalSteps = 5;
    public $currentStep = 1;

    public function mount()
    {
        $this->currentStep = 1;
        $this->nbrOfTranscribers = 1;
    }

    public function transcribers1()
    {
        return $transcribers = Transcriber::where('full_name', 'LIKE', '%' . $this->transcriber1 . '%')->paginate(40);
    }

    public function fontMatchers1()
    {
        return $fontMatchers = Transcriber::where('full_name', 'LIKE', '%' . $this->fontMatcher1 . '%')->paginate(40);
    }

    public function transcribers2()
    {
        return $transcribers = Transcriber::where('full_name', 'LIKE', '%' . $this->transcriber2 . '%')->paginate(40);
    }

    public function fontMatchers2()
    {
        return $fontMatchers = Transcriber::where('full_name', 'LIKE', '%' . $this->fontMatcher2 . '%')->paginate(40);
    }

    public function transcribers3()
    {
        return $transcribers = Transcriber::where('full_name', 'LIKE', '%' . $this->transcriber3 . '%')->paginate(40);
    }

    public function fontMatchers3()
    {
        return $fontMatchers = Transcriber::where('full_name', 'LIKE', '%' . $this->fontMatcher3 . '%')->paginate(40);
    }


    public function transcribers4()
    {
        return $transcribers = Transcriber::where('full_name', 'LIKE', '%' . $this->transcriber4 . '%')->paginate(40);
    }

    public function fontMatchers4()
    {
        return $fontMatchers = Transcriber::where('full_name', 'LIKE', '%' . $this->fontMatcher4 . '%')->paginate(40);
    }

    public function books()
    {
        return $books = Book::where('title', 'LIKE', '%' . $this->book . '%')->paginate(40);
    }

    public function cabinets()
    {
        return Cabinet::where('name', 'LIKE', '%' . $this->cabinet . '%')->paginate(40);
    }

    public function cities()
    {
        return $cities = City::where('name', 'LIKE', '%' . $this->city . '%')->paginate(40);
    }

    public function countries()
    {
        return $countries = Country::where('name', 'LIKE', '%' . $this->country . '%')->paginate(40);
    }

    public function motifs()
    {
        return $motifs = Motif::all();
    }

    public function colors()
    {
        return $colors = Color::all();
    }

    public function manutypes()
    {
        return $manutypes = Manutype::all();
    }


    public function pushToTranscriberMatchers($transcriber, $id, $value)
    {
        if ($id != null && $value != null) {

            if ($transcriber == 1 && !in_array(['id' => $id, 'name' => $value], $this->transcriber1_matchers)) {
                array_push($this->transcriber1_matchers, ['id' => $id, 'name' => $value]);
                $this->fontMatcher1 = null;
            } elseif ($transcriber == 2 && !in_array(['id' => $id, 'name' => $value], $this->transcriber2_matchers)) {
                array_push($this->transcriber2_matchers, ['id' => $id, 'name' => $value]);
                $this->fontMatcher2 = null;
            } elseif ($transcriber == 3 && !in_array(['id' => $id, 'name' => $value], $this->transcriber3_matchers)) {
                array_push($this->transcriber3_matchers, ['id' => $id, 'name' => $value]);
                $this->fontMatcher3 = null;
            } elseif ($transcriber == 4 && !in_array(['id' => $id, 'name' => $value], $this->transcriber4_matchers)) {
                array_push($this->transcriber4_matchers, ['id' => $id, 'name' => $value]);
                $this->fontMatcher4 = null;
            }
        }
    }

    public function deleteFontMatcher($transcriber, $id)
    {
        if ($transcriber == 1) {
            $i = 0;
            foreach ($this->transcriber1_matchers as $transcriber1_matcher) {
                if ($transcriber1_matcher['id'] == $id) {
                    unset($this->transcriber1_matchers[$i]);
                }
                $i++;
            }
        } elseif ($transcriber == 2) {
            $i = 0;
            foreach ($this->transcriber2_matchers as $transcriber2_matcher) {
                if ($transcriber2_matcher['id'] == $id) {
                    unset($this->transcriber2_matchers[$i]);
                }
                $i++;
            }
        } elseif ($transcriber == 3) {
            $i = 0;
            foreach ($this->transcriber3_matchers as $transcriber3_matcher) {
                if ($transcriber3_matcher['id'] == $id) {
                    unset($this->transcriber3_matchers[$i]);
                }
                $i++;
            }
        } elseif ($transcriber == 4) {
            $i = 0;
            foreach ($this->transcriber4_matchers as $transcriber4_matcher) {
                if ($transcriber4_matcher['id'] == $id) {
                    unset($this->transcriber4_matchers[$i]);
                }
                $i++;
            }
        }
    }

    public function pushToMotifs($id, $value)
    {
        if ($id != null && $value != null && !in_array(['id' => $id, 'name' => $value], $this->motifsArray)) {
            array_push($this->motifsArray, ['id' => $id, 'name' => $value]);
            $this->motif = null;
        }
    }

    public function deleteMotif($id)
    {
        $i = 0;
        foreach ($this->motifsArray as $motif) {
            if ($motif['id'] == $id) {
                unset($this->motifsArray[$i]);
            }
            $i++;
        }
    }

    public function pushToColors($id, $value)
    {
        if ($id != null && $value != null && !in_array(['id' => $id, 'name' => $value], $this->colorsArray)) {
            array_push($this->colorsArray, ['id' => $id, 'name' => $value]);
            $this->color = null;
        }
    }

    public function deleteColor($id)
    {
        $i = 0;
        foreach ($this->colorsArray as $color) {
            if ($color['id'] == $id) {
                unset($this->colorsArray[$i]);
            }
            $i++;
        }
    }


    public function pushToManutypes($id, $value)
    {
        if ($id != null && $value != null && !in_array(['id' => $id, 'name' => $value], $this->manutypesArray)) {
            array_push($this->manutypesArray, ['id' => $id, 'name' => $value]);
            $this->manutype = null;
        }
    }
    public function deleteManutype($id)
    {
        $i = 0;
        foreach ($this->manutypesArray as $manutype) {
            if ($manutype['id'] == $id) {
                unset($this->manutypesArray[$i]);
            }
            $i++;
        }
    }


    public function setTranscriberId($transcriber, $dataId)
    {
        if ($transcriber == 1) $this->transcriber1_id = $dataId;
        elseif ($transcriber == 2) $this->transcriber2_id = $dataId;
        elseif ($transcriber == 3) $this->transcriber3_id = $dataId;
        elseif ($transcriber == 4) $this->transcriber4_id = $dataId;
        //return dd($dataId);
    }

    public function setBookId($data_id)
    {
        return $this->book_id = $data_id;
    }

    public function setCabinetId($data_id)
    {
        return $this->cabinet_id = $data_id;
    }

    public function setCityId($data_id)
    {
        return $this->city_id = $data_id;
    }

    public function setCountryId($data_id)
    {
        return $this->country_id = $data_id;
    }


    public function increaseNbrOfTranscribers()
    {
        $this->nbrOfTranscribers++;
        if ($this->nbrOfTranscribers > 4) {
            $this->nbrOfTranscribers = 4;
        }
    }
    public function decreaseNbrOfTranscribers()
    {
        $this->nbrOfTranscribers--;
        if ($this->nbrOfTranscribers < 1) {
            $this->nbrOfTranscribers = 1;
        }
    }



    public function render()
    {
        $this->dispatchBrowserEvent('reloadScripts');
        $manuComp = [
            'is_update' => false,
            'btn_title' => 'إضافة',
            'btn_color' => 'btn-success',
            'btn_icon' => 'fas fa-plus',
        ];

        return view('livewire.manuscripts.create-edit-manuscript')
            ->with('transcribers1', $this->transcribers1())
            ->with('fontMatchers1', $this->fontMatchers1())
            ->with('transcriber1_matchers', $this->transcriber1_matchers)
            ->with('transcribers2', $this->transcribers2())
            ->with('fontMatchers2', $this->fontMatchers2())
            ->with('transcriber2_matchers', $this->transcriber2_matchers)
            ->with('transcribers3', $this->transcribers3())
            ->with('fontMatchers3', $this->fontMatchers3())
            ->with('transcriber3_matchers', $this->transcriber3_matchers)
            ->with('transcribers4', $this->transcribers4())
            ->with('fontMatchers4', $this->fontMatchers4())
            ->with('transcriber4_matchers', $this->transcriber4_matchers)
            ->with('cities', $this->cities())
            ->with('countries', $this->countries())
            ->with('books', $this->books())
            ->with('cabinets', $this->cabinets())
            ->with('motifs', $this->motifs())
            ->with('colors', $this->colors())
            ->with('manutypes', $this->manutypes())
            ->with('manuComp', $manuComp);
    }



    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function validateData()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'transcriber1_id' => 'required|integer|exists:transcribers,id',
                'name_in_manu1' => 'required|string',
                'transcriber1_matchers' => 'nullable|array',
                'transcriber1_matchers.*.id' => 'nullable|integer|different:transcriber1_id|exists:transcribers,id',
            ]);
            if ($this->nbrOfTranscribers >= 2) {
                $this->validate([
                    'transcriber2_id' => 'required|integer|exists:transcribers,id',
                    'name_in_manu2' => 'required|string',
                    'transcriber2_matchers' => 'nullable|array',
                    'transcriber2_matchers.*.id' => 'nullable|integer|different:transcriber2_id|exists:transcribers,id',
                ]);
            }
            if ($this->nbrOfTranscribers >= 3) {
                $this->validate([
                    'transcriber3_id' => 'required|integer|exists:transcribers,id',
                    'name_in_manu3' => 'required|string',
                    'transcriber3_matchers' => 'nullable|array',
                    'transcriber3_matchers.*.id' => 'nullable|integer|different:transcriber3_id|exists:transcribers,id',
                ]);
            }
            if ($this->nbrOfTranscribers >= 4) {
                $this->validate([
                    'transcriber4_id' => 'required|integer|exists:transcribers,id',
                    'name_in_manu4' => 'required|string',
                    'transcriber4_matchers' => 'nullable|array',
                    'transcriber4_matchers.*.id' => 'nullable|integer|different:transcriber4_id|exists:transcribers,id',
                ]);
            }
        } elseif ($this->currentStep == 2) {

            $this->validate([
                'book_id' => 'required|integer|exists:books,id',
                'book_part' => 'nullable|integer',
                //Day of transcription
                'trans_day' => 'nullable|numeric|between:1,7',
                //Hijri date
                'trans_day_nbr' => 'nullable|integer|between:1,31',
                'trans_month' => 'nullable|integer|between:1,12',
                'trans_syear' => 'nullable|integer',
                'trans_eyear' => 'nullable|integer',
                //Miladi date
                'trans_day_nbr_m' => 'nullable|integer|between:1,31',
                'trans_month_m' => 'nullable|integer|between:1,12',
                'trans_syear_m' => 'nullable|integer',
                'trans_eyear_m' => 'nullable|integer',

                'trans_place' => 'nullable|string|max:255',
                'country_id' => 'nullable|integer|exists:countries,id',
                'city_id' => 'nullable|integer|exists:cities,id',

                'signed_in' => 'required|boolean',
                'cabinet_id' => 'required|integer|exists:cabinets,id',
                'nbr_in_cabinet' => 'required|integer',
                'manu_type' => 'required|string|in:مج,مص,دغ', //مجلد، مصحف، دون غلاف
                'nbr_in_index' => 'nullable|integer',
            ]);
        } elseif ($this->currentStep == 3) {
            return $this->validate([
                'font' => 'nullable|string|max:255|in:مغربي,مشرقي',
                'font_style' => 'nullable|string|max:255|in:الكوفي المغربي,الثلث المغربي,المدمج,المسند (الزمامي),المبسوط,المجوهر,النسخ,الثلث,الكوفي,التعليق,الديواني,الرقعة',
                'manuscript_level' => 'nullable|string|max:255|in:رديئة,متوسطة,حسنة,جيدة', //مستوى النسخة من حيث الجودة والضبط

                'regular_lines' => 'nullable|boolean',
                'lines_notes' => 'required_with:regular_lines|max:255',

                'nbr_of_papers' => 'nullable|integer',
                'paper_size' => 'required|integer|between:1,3',
                'size_notes' => 'required_with:paper_size|max:255',

                'save_status' => 'nullable|string|max:255|in:حسنة,متوسطة,رديئة,من حسنة إلى متوسطة,من متوسطة إلى رديئة',
                'is_truncated' => 'nullable|boolean',
                'truncation_notes' => 'required_with:is_truncated|max:255',

                'colorsArray' => 'required|array',
                'colorsArray.*.id' => 'required|integer|distinct|exists:colors,id',

                'motifsArray' => 'nullable|array',
                'motifsArray.*.id' => 'nullable|integer|distinct|exists:motifs,id',
            ]);
        } elseif ($this->currentStep == 3) {
            $this->validate([
                'manutypesArray' => 'nullable|array',
                'manutypesArray.*.id' => 'nullable|integer|distinct|exists:manutypes,id',
                'transcriber_level' => 'nullable|string|max:255|in:رديئة,متوسطة,حسنة,جيدة', //مستوى النسخة من حيث الوضوح والرداءة
            ]);
        }
    }

    public function store()
    {
        $this->resetErrorBag();

        if ($this->currentStep == $this->totalSteps) {
            $this->validate([
                'transcribed_from' => 'nullable|string|max:255',
                'transcribed_to' => 'nullable|string|max:255',
                'rost_completion' => 'nullable|boolean',
                'notes' => 'nullable|string|max:65535'
            ]);
        }

        DB::beginTransaction();
        try {
            $manuscript = Manuscript::create($this->except([
                'transcriber1_id', 'transcriber2_id',
                'transcriber3_id', 'transcriber4_id',
                'name_in_manu1', 'name_in_manu2',
                'name_in_manu3', 'name_in_manu4',
                'transcriber1_matchers', 'transcriber2_matchers', 'transcriber3_matchers', 'transcriber4_matchers',
                'colors',
                'manutypes',
                'motifs'
            ]));

            if ($this->is_to_himself == 1) {
                Manuscript::where('id', $manuscript->id)->update([
                    'transcribed_to' => 'لنفسه'
                ]);
            }

            // add colors
            if (!empty($this->colorsArray)) {
                foreach ($this->colorsArray as $color) {
                    ManuscriptColor::create([
                        'manuscript_id' => $manuscript->id,
                        'color_id' => $color['id'],
                    ]);
                }
            }

            // add manutypes
            if (!empty($this->manutypesArray)) {
                foreach ($this->manutypesArray as $manutype) {
                    ManuscriptManutype::create([
                        'manuscript_id' => $manuscript->id,
                        'manutype_id' => $manutype['id'],
                    ]);
                }
            }

            // add motifs
            if (!empty($this->motifsArray)) {
                foreach ($this->motifsArray as $motif) {
                    ManuscriptMotif::create([
                        'manuscript_id' => $manuscript->id,
                        'motif_id' => $motif['id'],
                    ]);
                }
            }

            // add Transcribers and FontMatchers
            $transcriber_id1 = $this->transcriber1_id;
            $transcriber_id2 = $this->transcriber2_id;
            $transcriber_id3 = $this->transcriber3_id;
            $transcriber_id4 = $this->transcriber4_id;
            $name_in_manu1 = $this->name_in_manu1;
            $name_in_manu2 = $this->name_in_manu2;
            $name_in_manu3 = $this->name_in_manu3;
            $name_in_manu4 = $this->name_in_manu4;

            $fontMatchers1 = $this->transcriber1_matchers;
            $fontMatchers2 = $this->transcriber2_matchers;
            $fontMatchers3 = $this->transcriber3_matchers;
            $fontMatchers4 = $this->transcriber4_matchers;

            for ($i = 1; $i <= 4; $i++) {
                if (${'transcriber_id' . $i} != null) {
                    ManuscriptTranscriber::create([
                        'manuscript_id' => $manuscript->id,
                        'transcriber_id' => ${'transcriber_id' . $i},
                        'name_in_manu' => $this->{'name_in_manu' . $i},
                    ]);
                }
            }

            for ($i = 1; $i <= 4; $i++) {
                if (!empty(${'fontMatchers' . $i})) {
                    foreach (${'fontMatchers' . $i} as $fontMatcher) {
                        MatchingFont::create([
                            'manuscript_id' => $manuscript->id,
                            'transcriber_id' => ${'transcriber_id' . $i},
                            'transcriber_id2' => $fontMatcher['id']
                        ]);
                    }
                }
            }

            DB::commit();
            $message = [
                "label" => "تم إضافة الاستمارة بنجاح",
                "bg" => "bg-success",
            ];

            return redirect()->route('manuscripts.show', $manuscript->id)
                ->with('message', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
            $message = [
                "label" => "حدثت مشكلة، لم يتم إضافة الاستمارة",
                "bg" => "bg-danger",
            ];
            return back()->with('message', $message);
        }


        //   $this->reset();
        //   $this->currentStep = 1;
    }
}