<?php

namespace App\Http\Controllers;

use App\Models\Manuscript;
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
                ->paginate(25);
        } else {
            $transcribers = Transcriber::Where('full_name', 'LIKE', '%' . $request->full_name . '%')
                ->paginate(25);
        }

        return view('transcribers.index')->with('transcribers', $transcribers);
    }

    public function quickSearch(Request $request)
    {
        $transcribers = Transcriber::with('manuscripts', 'country', 'city')
            ->where(function ($query) use ($request) {
                $query->select(DB::raw("CONCAT(full_name, ' ', IFNULL(descent1,''),' ', IFNULL(descent2,''),' ', IFNULL(descent3,''),' ',IFNULL(descent4,''), ' ',IFNULL(descent5,''), ' ',IFNULL(other_name1,''),' ',IFNULL(other_name2,''),' ',IFNULL(other_name3,''),' ',IFNULL(other_name4,'')) as full_name_descent_other"))
                    ->having('full_name_descent_other', 'LIKE', '%' . $request->transcriber . '%');
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'descent1' => 'nullable|string|max:255',
            'descent2' => 'nullable|string|max:255',
            'descent3' => 'nullable|string|max:255',
            'descent4' => 'nullable|string|max:255',
            'descent5' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'other_name1' => 'nullable|string|max:255',
            'other_name2' => 'nullable|string|max:255',
            'other_name3' => 'nullable|string|max:255',
            'other_name4' => 'nullable|string|max:255',
            'country_id' => 'nullable|integer|exists:countries,id',
            'city_id' => 'nullable|integer|exists:cities,id',
        ]);

        try {
            $transcriber = Transcriber::create($validated);
            $message = [
                "label" => "تم إضافة الناسخ بنجاح",
                "bg" => "bg-success",
            ];
        } catch (\Exception $e) {
            $message = [
                "label" => "حدثت مشكلة، لم يتم إضافة الناسخ",
                "bg" => "bg-danger",
            ];
        }

        return redirect()->route('transcribers.show', $transcriber->id)
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
        $transcriber = Transcriber::with('country', 'city')->find($id);

        //min trans_syear
        $minManu_syear = Manuscript::whereNotNull('trans_syear')
            ->min('trans_syear');
        $minManu_syear_m = Manuscript::whereNotNull('trans_syear_m')
            ->min('trans_syear_m');

        // min trans_eyear
        $minManu_eyear = Manuscript::whereNotNull('trans_eyear')
            ->min('trans_eyear');
        $minManu_eyear_m = Manuscript::whereNotNull('trans_eyear_m')
            ->min('trans_eyear_m');

        return view('transcribers.show')
            ->with('transcriber', $transcriber)
            ->with('minManu_syear', $minManu_syear)
            ->with('minManu_syear_m', $minManu_syear_m)
            ->with('minManu_eyear', $minManu_eyear)
            ->with('minManu_eyear_m', $minManu_eyear_m);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transcriber = Transcriber::with('country', 'city')->find($id);
        return view('transcribers.edit')->with('transcriber', $transcriber);
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
            'full_name' => 'required|string|max:255',
            'descent1' => 'nullable|string|max:255',
            'descent2' => 'nullable|string|max:255',
            'descent3' => 'nullable|string|max:255',
            'descent4' => 'nullable|string|max:255',
            'descent5' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'other_name1' => 'nullable|string|max:255',
            'other_name2' => 'nullable|string|max:255',
            'other_name3' => 'nullable|string|max:255',
            'other_name4' => 'nullable|string|max:255',
            'country_id' => 'nullable|integer|exists:countries,id',
            'city_id' => 'nullable|integer|exists:cities,id',
        ]);

        try {
            $transcriber = Transcriber::where('id', $id)->update($validated);
            $message = [
                "label" => "تم تعديل معلومات الناسخ بنجاح",
                "bg" => "bg-success",
            ];
        } catch (\Exception $e) {
            $message = [
                "label" => "حدثت مشكلة، لم يتم تعديل معلومات الناسخ",
                "bg" => "bg-danger",
            ];
        }

        return redirect()->route('transcribers.show', $id)
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
            Transcriber::destroy($id);
            $message = [
                "label" => "تم حذف الناسخ بنجاح",
                "bg" => "bg-success",
            ];
            return redirect()->back()->with('message', $message);
        } catch (\Exception $e) {
            if (Transcriber::find($id)->manuscripts->count() > 0 || Transcriber::find($id)->matchers->count() > 0) {
                $message = [
                    "label" => "خطأ، للناسخ استمارات يجب حذفها أولا",
                    "bg" => "bg-danger",
                ];
            } else {
                $message = [
                    "label" => "حدثت مشكلة، لم يتم حذف الناسخ",
                    "bg" => "bg-danger",
                ];
            }
            return redirect()->back()->with('message', $message);
        }
    }
}