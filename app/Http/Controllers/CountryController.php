<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id && !$request->name) {
            $countries = Country::where('id', $request->id)
                ->paginate(80)
                ->withQueryString();
        } else {
            $countries = Country::Where('name', 'LIKE', '%' . $request->name . '%')
                ->paginate(80)
                ->withQueryString();
        }

        return view('countries.index')->with('countries', $countries);
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
            'name' => 'required|unique:countries,name',
        ]);
        $country = Country::create($validated);
        $message = [
            "label" => "تم إضافة البلد بنجاح",
            "bg" => "bg-success",
        ];

        return redirect()->route('countries.index')->with('message', $message);
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
        $validator = Validator::make($request->all(), [
            'name1' => 'required|max:255|unique:countries,name,' . $id,
        ]);

        $messageFail = [
            "label" => "حدثت مشكلة، لم يتم تعديل اسم البلد",
            "bg" => "bg-danger",
        ];

        $messageSuccess = [
            "label" => "تم تعديل اسم البلد بنجاح",
            "bg" => "bg-success",
        ];

        if ($validator->fails()) {
            return redirect()->back()->with('message', $messageFail);
        } else {
            try {
                Country::where('id', $id)
                    ->update(['name' => $request->name1]);
                return redirect()->back()->with('message', $messageSuccess);
            } catch (\Exception $e) {
                return redirect()->back()->with('message', $messageFail);
            }
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
        try {
            Country::destroy($id);
            $message = [
                "label" => "تم حذف البلد بنجاح",
                "bg" => "bg-success",
            ];
            return redirect()->back()->with('message', $message);
        } catch (\Exception $e) {
            if (Country::find($id)->manuscripts->count() > 0) {
                $message = [
                    "label" => "توجد منسوخات بهذا البلد يجب حذفها أولا",
                    "bg" => "bg-danger",
                ];
            } elseif (Country::find($id)->transcribers->count() > 0) {
                $message = [
                    "label" => "يوجد نساخ بهذا البلد يجب حذفهم أولا",
                    "bg" => "bg-danger",
                ];
            } else {
                $message = [
                    "label" => "حدثت مشكلة، لم يتم حذف البلد",
                    "bg" => "bg-danger",
                ];
            }
            return redirect()->back()->with('message', $message);
        }
    }
}