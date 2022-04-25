<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id && !$request->name) {
            $cities = City::where('id', $request->id)
                ->paginate(80)
                ->withQueryString();
        } else {
            $cities = City::with('country')
                ->where('name', 'LIKE', '%' . $request->name . '%')
                ->whereHas('country', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->country . '%');
                })
                ->paginate(80)
                ->withQueryString();
        }

        return view('cities.index')->with('cities', $cities);
    }

    public function cityExists($country_id, $city_name)
    {
        //test if city exists
        $cities = City::where('country_id', $country_id)
            ->where('name', $city_name)
            ->get();
        if ($cities->count() > 0) {
            return true;
        } else {
            return false;
        }
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
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|max:255',
        ]);

        //test if city exists
        if ($this->cityExists($request->country_id, $request->name)) {
            $messageFail = [
                "label" => "المدينة موجودة مسبقا",
                "bg" => "bg-danger",
            ];
            return redirect()->back()->with('message', $messageFail);
        }

        $city = City::create($validated);
        $message = [
            "label" => "تم إضافة المدينة بنجاح",
            "bg" => "bg-success",
        ];

        return redirect()->route('cities.index', $city->id)
            ->with('message', $message);
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
            'country_id' => 'required|exists:countries,id',
            'name1' => 'required|max:255',
        ]);

        //test if city exists
        if ($this->cityExists($request->country_id, $request->name1)) {
            $messageFail = [
                "label" => "المدينة موجودة مسبقا",
                "bg" => "bg-danger",
            ];
            return redirect()->back()->with('message', $messageFail);
        }

        $messageFail = [
            "label" => "حدثت مشكلة، لم يتم تعديل اسم المدينة",
            "bg" => "bg-danger",
        ];

        $messageSuccess = [
            "label" => "تم تعديل اسم المدينة بنجاح",
            "bg" => "bg-success",
        ];

        if ($validator->fails()) {
            return redirect()->back()->with('message', $messageFail);
        } else {
            try {
                City::where('id', $id)
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
            City::destroy($id);
            $message = [
                "label" => "تم حذف المدينة بنجاح",
                "bg" => "bg-success",
            ];
            return redirect()->back()->with('message', $message);
        } catch (\Exception $e) {
            if (City::find($id)->manuscripts->count() > 0) {
                $message = [
                    "label" => "توجد منسوخات بهذه المدينة يجب حذفها أولا",
                    "bg" => "bg-danger",
                ];
            } elseif (City::find($id)->transcribers->count() > 0) {
                $message = [
                    "label" => "يوجد نساخ بهذه المدينة يجب حذفهم أولا",
                    "bg" => "bg-danger",
                ];
            } else {
                $message = [
                    "label" => "حدثت مشكلة، لم يتم حذف المدينة",
                    "bg" => "bg-danger",
                ];
            }
            return redirect()->back()->with('message', $message);
        }
    }
}