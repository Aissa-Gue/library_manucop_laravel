<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Manuscript;
use App\Models\Transcriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('settings.users.index')
            ->with('users', $users);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = User::find(Auth::id());
        if (Hash::check($request->admin_pwd, $admin->password)) {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255|unique:users,username',
                'is_admin' => 'required|boolean',
                'password' => 'required|string|min:5',
                'password_confirmation' => 'required|min:5|same:password'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator, 'store')
                    ->withInput();
            } else {
                User::create([
                    'username' => $request->username,
                    'is_admin' => $request->is_admin,
                    'password' => Hash::make($request->password)
                ]);
                $message = [
                    "label" => "تم إضافة المستخدم بنجاح",
                    "bg" => "bg-success",
                ];
                return redirect()->back()->with('message', $message);
            }
        } else {
            $message = [
                "label" => "لم يتم إضافة المستخدم",
                "bg" => "bg-danger",
            ];
            return redirect()->back()->with('message', $message);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = User::find(Auth::id());
        if (Hash::check($request->admin_pwd, $admin->password)) {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer|exists:users,id',
                'username' => 'required|string|max:255|unique:users,username,' . $id,
                'is_admin' => 'required|boolean',
                'password' => 'required|string|min:5',
                'password_confirmation' => 'required|min:5|same:password'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator, 'update')
                    ->withInput();
            } else {

                User::where('id', $request->id)->Update([
                    'username' => $request->username,
                    'is_admin' => $request->is_admin,
                    'password' => Hash::make($request->password)
                ]);
                $message = [
                    "label" => "تم تعديل المستخدم بنجاح",
                    "bg" => "bg-success",
                ];
                return redirect()->back()->with('message', $message);
            }
        } else {
            $message = [
                "label" => "لم يتم تعديل المستخدم",
                "bg" => "bg-danger",
            ];
            return redirect()->back()->with('message', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $admin = User::find(Auth::id());
        //test if user has data
        $userAuthors = Author::where('created_by', $id)->orWhere('update_by', $id)->get();
        $userBooks = Book::where('created_by', $id)->orWhere('update_by', $id)->get();
        $userTranscribers = Transcriber::where('created_by', $id)->orWhere('update_by', $id)->get();
        $userManuscripts = Manuscript::where('created_by', $id)->orWhere('update_by', $id)->get();


        if ($admin->is_admin == true && $userAuthors->isEmpty() && $userBooks->isEmpty() && $userTranscribers->isEmpty() && $userManuscripts->isEmpty()) {
            User::destroy($id);
            $message = [
                "label" => "تم حذف المستخدم بنجاح",
                "bg" => "bg-success",
            ];
            return redirect()->back()->with('message', $message);
        } else {
            $message = [
                "label" => "لم يتم حذف المستخدم",
                "bg" => "bg-danger",
            ];
            return redirect()->back()->with('message', $message);
        }
    }
}