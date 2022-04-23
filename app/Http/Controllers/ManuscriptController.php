<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Manuscript;
use App\Models\ManuscriptColor;
use App\Models\ManuscriptManutype;
use App\Models\ManuscriptMotif;
use App\Models\ManuscriptTranscriber;
use App\Models\Manutype;
use App\Models\MatchingFont;
use App\Models\Motif;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ManuscriptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id && !$request->title) {
            $manuscripts = Manuscript::where('id', $request->id)->paginate(25);
        } else {
            $manuscripts = Manuscript::with('book')
                ->WhereHas('book', function (Builder $query) use ($request) {
                    $query->where('title', 'like', '%' . $request->title . '%');
                })
                ->paginate(80)
                ->withQueryString();
        }
        return view('manuscripts.index')->with('manuscripts', $manuscripts);
    }



    public function quickSearch(Request $request)
    {
        $manuscripts = Manuscript::with('transcribers', 'book', 'country', 'city', 'book.authors')
            ->whereHas('book', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->book . '%');
            })
            ->where(function ($query) use ($request) {
                if ($request->author !== null)
                    $query->whereHas('book.authors', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->author . '%');
                    });
                //->orDoesntHave('book.authors');
            })
            ->whereHas('transcribers', function ($query) use ($request) {
                $query->select(DB::raw("CONCAT(full_name,
                IFNULL(concat(' ',descent1),''),
                IFNULL(concat(' ',descent2),''),
                IFNULL(concat(' ',descent3),''),
                IFNULL(concat(' ',descent4),''),
                IFNULL(concat(' ',descent5),''),
                IFNULL(concat(' ',last_name),''),
                IFNULL(concat(' ',nickname),''),
                IFNULL(concat(' ',other_name1),''),
                IFNULL(concat(' ',other_name2),''),
                IFNULL(concat(' ',other_name3),''),
                IFNULL(concat(' ',other_name4),''))
                as full_name_all"))
                    ->having('full_name_all', 'LIKE', '%' . $request->transcriber . '%');
            })
            ->where(function ($query) use ($request) {
                if ($request->country !== null)
                    $query->whereHas('country', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->country . '%');
                    }); //->orDoesntHave('country');
            })
            ->where(function ($query) use ($request) {
                if ($request->city !== null)
                    $query->whereHas('city', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->city . '%');
                    });
                //->orDoesntHave('city');
            })
            ->where(function ($query) use ($request) {
                if ($request->trans_syear !== null)
                    $query->where('trans_syear', '>=', $request->trans_syear);
                //->orWhereNull('trans_syear');
            })
            ->where(function ($query) use ($request) {
                if ($request->trans_eyear !== null)
                    $query->where('trans_eyear', '<=', $request->trans_eyear);
                //->orWhereNull('trans_eyear');
            })
            ->where(function ($query) use ($request) {
                if ($request->trans_syear_m !== null)
                    $query->where('trans_syear_m', '>=', $request->trans_syear_m);
                //->orWhereNull('trans_syear_m');
            })
            ->where(function ($query) use ($request) {
                if ($request->trans_eyear_m !== null)
                    $query->where('trans_eyear_m', '<=', $request->trans_eyear_m);
                //->orWhereNull('trans_eyear_m');
            })
            ->paginate(35)
            ->withQueryString();

        return view('search.results')->with('manuscripts', $manuscripts);
    }

    public function advancedSearch(Request $request)
    {
        $manuscripts = Manuscript::with('transcribers', 'book', 'country', 'city', 'book.authors')
            ->whereHas('book', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->book . '%');
            })
            ->where(function ($query) use ($request) {
                if ($request->authors !== null)
                    foreach ($request->authors as $author) {
                        $query->whereHas('book.authors', function ($query) use ($author) {
                            $query->where('name', $author);
                        });
                        //->OrDoesntHave('book.authors');
                    }
            })
            ->where(function ($query) use ($request) {
                if ($request->subjects !== null)
                    foreach ($request->subjects as $subject) {
                        $query->whereHas('book.subjects', function ($query) use ($subject) {
                            $query->where('name', $subject);
                        });
                        //->OrDoesntHave('book.subjects');
                    }
            })
            ->whereHas('transcribers', function ($query) use ($request) {
                $query->select(DB::raw("CONCAT(full_name,
                IFNULL(concat(' ',descent1),''),
                IFNULL(concat(' ',descent2),''),
                IFNULL(concat(' ',descent3),''),
                IFNULL(concat(' ',descent4),''),
                IFNULL(concat(' ',descent5),''),
                IFNULL(concat(' ',last_name),''),
                IFNULL(concat(' ',nickname),''),
                IFNULL(concat(' ',other_name1),''),
                IFNULL(concat(' ',other_name2),''),
                IFNULL(concat(' ',other_name3),''),
                IFNULL(concat(' ',other_name4),''))
                as full_name_all"))
                    ->having('full_name_all', 'LIKE', '%' . $request->transcriber . '%');
            })
            ->where(function ($query) use ($request) {
                if ($request->transCountry !== null)
                    $query->whereHas('transcribers.country', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->transCountry . '%');
                    });
                //->orDoesntHave('transcribers.country');
            })
            ->where(function ($query) use ($request) {
                if ($request->transCity !== null)
                    $query->whereHas('transcribers.city', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->transCity . '%');
                    });
                //->orDoesntHave('transcribers.city');
            })
            ->where(function ($query) use ($request) {
                if ($request->cabinet !== null)
                    $query->whereHas('cabinet', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->cabinet . '%');
                    });
                //->orDoesntHave('cabinet');
            })
            ->where(function ($query) use ($request) {
                if ($request->transcribed_from !== null)
                    $query->where('transcribed_from', 'like', '%' . $request->transcribed_from . '%');
                //->orWhereNull('transcribed_from');
            })
            ->where(function ($query) use ($request) {
                if ($request->transcribed_to !== null)
                    $query->where('transcribed_to', 'like', '%' . $request->transcribed_to . '%');
                //->orWhereNull('transcribed_to');
            })
            ->where(function ($query) use ($request) {
                if ($request->regular_lines !== null)
                    $query->where('regular_lines', $request->regular_lines);
                //->orWhereNull('regular_lines');
            })
            ->where(function ($query) use ($request) {
                if ($request->is_not_truncated !== null)
                    $query->where('is_not_truncated', $request->is_not_truncated);
                //->orWhereNull('is_not_truncated');
            })
            ->where(function ($query) use ($request) {
                if ($request->signed_in !== null)
                    $query->where('signed_in', $request->signed_in);
                //->orWhereNull('signed_in');
            })
            ->where(function ($query) use ($request) {
                if ($request->rost_completion !== null)
                    $query->where('rost_completion', $request->rost_completion);
                //->orWhereNull('rost_completion');
            })
            ->where(function ($query) use ($request) {
                if ($request->font !== null)
                    $query->where('font', $request->font);
                //->orWhereNull('font');
            })
            ->where(function ($query) use ($request) {
                if ($request->font_style !== null)
                    $query->where('font_style', $request->font_style);
                //->orWhereNull('font_style');
            })
            ->where(function ($query) use ($request) {
                if ($request->manuscript_level !== null)
                    $query->where('manuscript_level', $request->manuscript_level);
                //->orWhereNull('manuscript_level');
            })
            ->where(function ($query) use ($request) {
                if ($request->transcriber_level !== null)
                    $query->where('transcriber_level', $request->transcriber_level);
                //->orWhereNull('transcriber_level');
            })
            ->where(function ($query) use ($request) {
                if ($request->paper_size !== null)
                    $query->where('paper_size', $request->paper_size);
                //->orWhereNull('paper_size');
            })
            ->where(function ($query) use ($request) {
                if ($request->save_status !== null)
                    $query->where('save_status', $request->save_status);
                //->orWhereNull('save_status');
            })
            ->where(function ($query) use ($request) {
                if ($request->nbr_in_index !== null)
                    $query->where('nbr_in_index', $request->nbr_in_index);
                //->orWhereNull('nbr_in_index');
            })
            ->where(function ($query) use ($request) {
                if ($request->nbr_in_cabinet !== null)
                    $query->where('nbr_in_cabinet', $request->nbr_in_cabinet);
                //->orWhereNull('nbr_in_cabinet');
            })
            ->where(function ($query) use ($request) {
                if ($request->manu_type !== null)
                    $query->where('manu_type', $request->manu_type);
                //->orWhereNull('manu_type');
            })
            ->where(function ($query) use ($request) {
                if ($request->country !== null)
                    $query->whereHas('country', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->country . '%');
                    }); //->orDoesntHave('country');
            })
            ->where(function ($query) use ($request) {
                if ($request->city !== null)
                    $query->whereHas('city', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->city . '%');
                    });
                //->orDoesntHave('city');
            })
            ->where(function ($query) use ($request) {
                if ($request->trans_syear !== null)
                    $query->where('trans_syear', '>=', $request->trans_syear);
                //->orWhereNull('trans_syear');
            })
            ->where(function ($query) use ($request) {
                if ($request->trans_eyear !== null)
                    $query->where('trans_eyear', '<=', $request->trans_eyear);
                //->orWhereNull('trans_eyear');
            })
            ->where(function ($query) use ($request) {
                if ($request->trans_syear_m !== null)
                    $query->where('trans_syear_m', '>=', $request->trans_syear_m);
                //->orWhereNull('trans_syear_m');
            })
            ->where(function ($query) use ($request) {
                if ($request->trans_eyear_m !== null)
                    $query->where('trans_eyear_m', '<=', $request->trans_eyear_m);
                //->orWhereNull('trans_eyear_m');
            })
            ->where(function ($query) use ($request) {
                if ($request->manutypes !== null)
                    foreach ($request->manutypes as $manutype) {
                        $query->whereHas('manutypes', function ($query) use ($manutype) {
                            $query->where('name', $manutype);
                        });
                        //->OrDoesntHave('manutypes');
                    }
            })
            ->where(function ($query) use ($request) {
                if ($request->colors !== null)
                    foreach ($request->colors as $color) {
                        $query->whereHas('colors', function ($query) use ($color) {
                            $query->where('name', $color);
                        });
                        //->OrDoesntHave('colors');
                    }
            })
            ->where(function ($query) use ($request) {
                if ($request->motifs !== null)
                    foreach ($request->motifs as $motif) {
                        $query->whereHas('motifs', function ($query) use ($motif) {
                            $query->where('name', $motif);
                        });
                        //->orDoesntHave('motifs');
                    }
            })

            ->paginate(35)
            ->withQueryString();

        return view('search.results')->with('manuscripts', $manuscripts);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manuscripts.create');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fontMatchers = MatchingFont::where('manuscript_id', $id)->get();
        $manuscript = Manuscript::with('transcribers', 'book', 'country', 'city')->find($id);

        return view('manuscripts.show')
            ->with('manuscript', $manuscript)
            ->with('fontMatchers', $fontMatchers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manuscript = Manuscript::find($id);
        $transcriberMatchers = MatchingFont::where('manuscript_id', $id)->get();
        return view('manuscripts.edit')
            ->with('manuscript', $manuscript)
            ->with('transcriberMatchers', $transcriberMatchers);
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
            ManuscriptColor::where('manuscript_id', $id)->delete();
            ManuscriptManutype::where('manuscript_id', $id)->delete();
            ManuscriptMotif::where('manuscript_id', $id)->delete();
            ManuscriptTranscriber::where('manuscript_id', $id)->delete();
            MatchingFont::where('manuscript_id', $id)->delete();
            Manuscript::destroy($id);
            DB::commit();

            $message = [
                "label" => "تم حذف الاستمارة بنجاح",
                "bg" => "bg-success",
            ];
            return redirect()->route('manuscripts.index')->with('message', $message);
        } catch (\Exception $e) {
            $message = [
                "label" => "حدثت مشكلة، لم يتم حذف الاستمارة",
                "bg" => "bg-danger",
            ];

            DB::rollBack();
            return redirect()->route('manuscripts.index')->with('message', $message);
        }
    }
}