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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        DB::beginTransaction();
        try {
            $manuscript = Manuscript::create($request->except([
                'transcriber1_id', 'transcriber2_id',
                'transcriber3_id', 'transcriber4_id',
                'name_in_manu1', 'name_in_manu2',
                'name_in_manu3', 'name_in_manu4',
                'fontMatchers1', 'fontMatchers2', 'fontMatchers3', 'fontMatchers4',
                'color_ids',
                'manutype_ids',
                'motif_ids'
            ]));

            // update colors
            ManuscriptColor::where('manuscript_id', $id)->delete();
            if (!empty($request->color_ids)) {
                foreach ($request->color_ids as $color_id) {
                    ManuscriptColor::where('manuscript_id', $id)->create([
                        'manuscript_id' => $id,
                        'color_id' => $color_id,
                    ]);
                }
            }

            // update manutypes
            ManuscriptManutype::where('manuscript_id', $id)->delete();
            if (!empty($request->manutype_ids)) {
                foreach ($request->manutype_ids as $manutype_id) {
                    ManuscriptManutype::create([
                        'manuscript_id' => $id,
                        'manutype_id' => $manutype_id,
                    ]);
                }
            }

            // update motifs
            ManuscriptMotif::where('manuscript_id', $id)->delete();
            if (!empty($request->motif_ids)) {
                foreach ($request->motif_ids as $motif_id) {
                    ManuscriptMotif::create([
                        'manuscript_id' => $id,
                        'motif_id' => $motif_id,
                    ]);
                }
            }

            // update Transcribers & FontMatchers
            $transcriber_id1 = $request->transcriber1_id;
            $transcriber_id2 = $request->transcriber2_id;
            $transcriber_id3 = $request->transcriber3_id;
            $transcriber_id4 = $request->transcriber4_id;
            $name_in_manu1 = $request->name_in_manu1;
            $name_in_manu2 = $request->name_in_manu2;
            $name_in_manu3 = $request->name_in_manu3;
            $name_in_manu4 = $request->name_in_manu4;

            $fontMatchers1 = $request->fontMatchers1;
            $fontMatchers2 = $request->fontMatchers2;
            $fontMatchers3 = $request->fontMatchers3;
            $fontMatchers4 = $request->fontMatchers4;

            ManuscriptTranscriber::where('manuscript_id', $id)->delete();
            for ($i = 1; $i <= 4; $i++) {
                if (${'transcriber_id' . $i} != null) {
                    ManuscriptTranscriber::create([
                        'manuscript_id' => $manuscript->id,
                        'transcriber_id' => ${'transcriber_id' . $i},
                        'name_in_manu' => $request->{'name_in_manu' . $i},
                    ]);
                }
            }

            MatchingFont::where('manuscript_id', $id)->delete();
            for ($i = 1; $i <= 4; $i++) {
                if (!empty(${'fontMatchers' . $i})) {
                    foreach (${'fontMatchers' . $i} as $fontMatcher) {
                        MatchingFont::create([
                            'manuscript_id' => $manuscript->id,
                            'transcriber_id' => ${'transcriber_id' . $i},
                            'transcriber2_id' => $fontMatcher,
                        ]);
                    }
                }
            }

            DB::commit();
            $message = [
                "label" => "تم تعديل الاستمارة بنجاح",
                "bg" => "bg-success",
            ];
            return redirect()->route('manuscripts.show', $id)
                ->with('message', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = [
                "label" => "حدثت مشكلة، لم يتم تعديل الاستمارة",
                "bg" => "bg-danger",
            ];
            return redirect()->back()->with('message', $message);
        }
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