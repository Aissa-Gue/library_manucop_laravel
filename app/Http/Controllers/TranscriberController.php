<?php

namespace App\Http\Controllers;

use App\Models\MatchingFont;
use App\Models\Transcriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TranscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id && !$request->full_name) {
            $transcribers = Transcriber::with('country', 'city')
                ->where('id', $request->id)
                ->paginate(80)
                ->withQueryString();
        } else {
            $transcribers = Transcriber::Where('full_name', 'LIKE', '%' . $request->full_name . '%')
                ->paginate(80)
                ->withQueryString();
        }

        return view('transcribers.index')->with('transcribers', $transcribers);
    }

    public function quickSearch(Request $request)
    {
        $transcribers = Transcriber::with('manuscripts', 'country', 'city')
            ->where(function ($query) use ($request) {
                $query->select(DB::raw("CONCAT(full_name,
                IFNULL('',concat(' ',descent1)),
                IFNULL('',concat(' ',descent2)),
                IFNULL('',concat(' ',descent3)),
                IFNULL('',concat(' ',descent4)),
                IFNULL('',concat(' ',descent5)),
                IFNULL('',concat(' ',last_name)),
                IFNULL('',concat(' ',nickname)),
                IFNULL('',concat(' ',other_name1)),
                IFNULL('',concat(' ',other_name2)),
                IFNULL('',concat(' ',other_name3)),
                IFNULL('',concat(' ',other_name4)))
                as full_name_all"))
                    ->having('full_name_all', 'LIKE', '%' . $request->transcriber . '%');
            })
            ->where(function ($query) use ($request) {
                if ($request->last_name !== null)
                    $query->where('last_name', 'like', '%' . $request->last_name . '%');
                //->orWhereNull('last_name');
            })
            ->where(function ($query) use ($request) {
                if ($request->nickname !== null)
                    $query->where('nickname', 'like', '%' . $request->nickname . '%');
                //->orWhereNull('nickname');
            })
            ->where(function ($query) use ($request) {
                if ($request->country !== null)
                    $query->whereHas('country', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->country . '%');
                    });
                //->orDoesntHave('country');
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
                    $query->whereHas('manuscripts', function ($query) use ($request) {
                        $query->where('trans_syear', '>=', $request->trans_syear);
                        //->orWhereNull('trans_syear');
                    });
                //->orDoesntHave('manuscripts')
            })
            ->where(function ($query) use ($request) {
                if ($request->trans_eyear !== null)
                    $query->whereHas('manuscripts', function ($query) use ($request) {
                        $query->where('trans_eyear', '<=', $request->trans_eyear);
                        //->orWhereNull('trans_eyear');
                    });
                //->orDoesntHave('manuscripts');
            })
            ->where(function ($query) use ($request) {
                if ($request->trans_syear_m !== null)
                    $query->whereHas('manuscripts', function ($query) use ($request) {
                        $query->where('trans_syear_m', '>=', $request->trans_syear_m);
                        //->orWhereNull('trans_syear_m');
                    });
                //->orDoesntHave('manuscripts');
            })
            ->where(function ($query) use ($request) {
                if ($request->trans_eyear_m !== null)
                    $query->whereHas('manuscripts', function ($query) use ($request) {
                        $query->where('trans_eyear_m', '<=', $request->trans_eyear_m);
                        //->orWhereNull('trans_eyear_m');
                    });
                //->orDoesntHave('manuscripts');
            })
            ->paginate(35)
            ->withQueryString();

        return view('search.results')->with('transcribers', $transcribers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transcribers.create');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transcriber = Transcriber::with('country', 'city')->find($id);

        //min trans_syear
        $minManu_syear = Transcriber::join('manuscript_transcribers', 'manuscript_transcribers.transcriber_id', 'transcribers.id')
            ->join('manuscripts', 'manuscripts.id', 'manuscript_transcribers.manuscript_id')
            ->where('transcriber_id', $id)
            ->whereNotNull('trans_syear')
            ->min('trans_syear');

        $minManu_syear = Transcriber::join('manuscript_transcribers', 'manuscript_transcribers.transcriber_id', 'transcribers.id')
            ->join('manuscripts', 'manuscripts.id', 'manuscript_transcribers.manuscript_id')
            ->where('transcriber_id', $id)
            ->whereNotNull('trans_syear')
            ->min('trans_syear');

        $minManu_syear_m = Transcriber::join('manuscript_transcribers', 'manuscript_transcribers.transcriber_id', 'transcribers.id')
            ->join('manuscripts', 'manuscripts.id', 'manuscript_transcribers.manuscript_id')
            ->where('transcriber_id', $id)
            ->whereNotNull('trans_syear_m')
            ->min('trans_syear_m');

        // max trans_eyear
        $maxManu_eyear = Transcriber::join('manuscript_transcribers', 'manuscript_transcribers.transcriber_id', 'transcribers.id')
            ->join('manuscripts', 'manuscripts.id', 'manuscript_transcribers.manuscript_id')
            ->where('transcriber_id', $id)
            ->whereNotNull('trans_eyear')
            ->max('trans_eyear');

        $maxManu_eyear_m = Transcriber::join('manuscript_transcribers', 'manuscript_transcribers.transcriber_id', 'transcribers.id')
            ->join('manuscripts', 'manuscripts.id', 'manuscript_transcribers.manuscript_id')
            ->where('transcriber_id', $id)
            ->whereNotNull('trans_eyear_m')
            ->max('trans_eyear_m');

        $fontMatchers = MatchingFont::where('transcriber_id', $id)->get();

        return view('transcribers.show')
            ->with('transcriber', $transcriber)
            ->with('fontMatchers', $fontMatchers)
            ->with('minManu_syear', $minManu_syear)
            ->with('minManu_syear_m', $minManu_syear_m)
            ->with('maxManu_eyear', $maxManu_eyear)
            ->with('maxManu_eyear_m', $maxManu_eyear_m);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transcriber = Transcriber::find($id);
        return view('transcribers.edit')->with('transcriber', $transcriber);
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
            Transcriber::destroy($id);
            $message = [
                "label" => "???? ?????? ???????????? ??????????",
                "bg" => "bg-success",
            ];
            return redirect()->route('transcribers.index')->with('message', $message);
        } catch (\Exception $e) {
            if (Transcriber::find($id)->manuscripts->count() > 0 || Transcriber::find($id)->matchers->count() > 0) {
                $message = [
                    "label" => "???????????? ???????????????? ?????? ?????????? ????????",
                    "bg" => "bg-danger",
                ];
            } else {
                $message = [
                    "label" => "???????? ???????????? ???? ?????? ?????? ????????????",
                    "bg" => "bg-danger",
                ];
            }
            return redirect()->route('transcribers.index')->with('message', $message);
        }
    }
}