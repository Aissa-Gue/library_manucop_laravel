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
                ->paginate(25);
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
                $query->doesntHave('book.authors')
                    ->orWhereHas('book.authors', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->author . '%');
                    });
            })
            ->whereHas('transcribers', function ($query) use ($request) {
                $query->select(DB::raw("CONCAT(full_name, ' ', IFNULL(descent1,''),' ', IFNULL(descent2,''),' ', IFNULL(descent3,''),' ',IFNULL(descent4,''), ' ',IFNULL(descent5,''), ' ',IFNULL(other_name1,''),' ',IFNULL(other_name2,''),' ',IFNULL(other_name3,''),' ',IFNULL(other_name4,'')) as full_name_descent_other"))
                    ->having('full_name_descent_other', 'LIKE', '%' . $request->transcriber . '%');
            })
            ->where(function ($query) use ($request) {
                $query->doesntHave('country')
                    ->orWhereHas('country', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->country . '%');
                    });
            })
            ->where(function ($query) use ($request) {
                $query->doesntHave('city')
                    ->orWhereHas('city', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->city . '%');
                    });
            })
            ->where(function ($query) use ($request) {
                $query->where('trans_syear', '>=', $request->trans_syear ?? 0)
                    ->orWhereNull('trans_syear');
            })
            ->where(function ($query) use ($request) {
                $query->where('trans_eyear', '<=', $request->trans_eyear ?? 999999)
                    ->orWhereNull('trans_eyear');
            })
            ->where(function ($query) use ($request) {
                $query->where('trans_syear_m', '>=', $request->trans_syear_m ?? 0)
                    ->orWhereNull('trans_syear_m');
            })
            ->where(function ($query) use ($request) {
                $query->where('trans_eyear_m', '<=', $request->trans_eyear_m ?? 999999)
                    ->orWhereNull('trans_eyear_m');
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


    public function validateForm(Request $request)
    {
        $validated = $this->validate($request, [
            //Transcriber names in manu
            'transcriber1_id' => 'required|integer|different:transcriber2_id|different:transcriber3_id|different:transcriber4_id|exists:transcribers,id',
            'transcriber2_id' => 'nullable|required_with:name_in_manu2|integer|different:transcriber1_id|different:transcriber3_id|different:transcriber4_id|exists:transcribers,id',
            'transcriber3_id' => 'nullable|required_with:name_in_manu3|integer|different:transcriber1_id|different:transcriber2_id|different:transcriber4_id|exists:transcribers,id',
            'transcriber4_id' => 'nullable|required_with:name_in_manu4|integer|different:transcriber1_id|different:transcriber2_id|different:transcriber3_id|exists:transcribers,id',
            'name_in_manu1' => 'required|required_with:transcriber1_id|max:255',
            'name_in_manu2' => 'nullable|required_with:transcriber2_id|max:255',
            'name_in_manu3' => 'nullable|required_with:transcriber3_id|max:255',
            'name_in_manu4' => 'nullable|required_with:transcriber4_id|max:255',

            // transcriber matchers
            'fontMatchers1' => 'nullable|array',
            'fontMatchers1.*' => 'nullable|distinct|different:transcriber1_id|integer|exists:transcribers,id',
            'fontMatchers2' => 'nullable|array',
            'fontMatchers2.*' => 'nullable|distinct|different:transcriber2_id|integer|exists:transcribers,id',
            'fontMatchers3' => 'nullable|array',
            'fontMatchers3.*' => 'nullable|distinct|different:transcriber3_id|integer|exists:transcribers,id',
            'fontMatchers4' => 'nullable|array',
            'fontMatchers4.*' => 'nullable|distinct|different:transcriber4_id|integer|exists:transcribers,id',

            //book
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
            'signed_in' => 'required|boolean',
            'cabinet_id' => 'nullable|integer|exists:cabinets,id',
            'nbr_in_cabinet' => 'nullable|integer',
            'manu_type' => 'nullable|string|in:مج,مص,دغ', //مجلد، مصحف، دون غلاف
            'nbr_in_index' => 'nullable|integer',

            'font' => 'nullable|string|max:255|in:مغربي,مشرقي',
            'font_style' => 'nullable|string|max:255|in:الكوفي المغربي,الثلث المغربي,المدمج,المسند (الزمامي),المبسوط,المجوهر',
            'regular_lines' => 'nullable|boolean',
            'lines_notes' => 'required_with:regular_lines|max:255',

            'nbr_of_papers' => 'nullable|integer',
            'paper_size' => 'nullable|integer|between:1,3',
            'size_notes' => 'required_with:paper_size|max:255',

            'save_status' => 'nullable|string|max:255|in:حسنة,متوسطة,رديئة,من حسنة إلى متوسطة,من متوسطة إلى رديئة',
            'is_truncated' => 'nullable|boolean',
            'truncation_notes' => 'required_with:is_truncated|max:255',

            'transcribed_from' => 'nullable|string|max:255',
            'transcribed_to' => 'nullable|string|max:255',

            'manuscript_level' => 'nullable|string|max:255|in:رديئة,متوسطة,حسنة,جيدة', //مستوى النسخة من حيث الجودة والضبط
            'transcriber_level' => 'nullable|string|max:255|in:رديئة,متوسطة,حسنة,جيدة', //مستوى النسخة من حيث الوضوح والرداءة

            'rost_completion' => 'nullable|boolean',

            'country_id' => 'nullable|integer|exists:countries,id',
            'city_id' => 'nullable|integer|exists:cities,id',

            'notes' => 'nullable|string|max:65535',

            'color_ids' => 'required|array',
            'color_ids.*' => 'required|integer|distinct|exists:colors,id',

            'manutype_ids' => 'nullable|array',
            'manutype_ids.*' => 'nullable|integer|distinct|exists:manutypes,id',

            'motif_ids' => 'nullable|array',
            'motif_ids.*' => 'nullable|integer|distinct|exists:motifs,id',
        ]);
        return $validated;
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
            return redirect()->back()->with('message', $message);
        } catch (\Exception $e) {
            $message = [
                "label" => "حدثت مشكلة، لم يتم حذف الاستمارة",
                "bg" => "bg-danger",
            ];

            DB::rollBack();
            return redirect()->back()->with('message', $message);
        }
    }
}