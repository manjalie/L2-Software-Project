<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ImageController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('image-view');
    }


    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        uploading file into server
        $imageName = request()->file->getClientOriginalName();
        $file_extension = request()->file->getClientOriginalExtension();
        $new_name = Auth::user()->id.'.'.$file_extension;
        request()->file->move(public_path('Profilepic'), $new_name);

//        updating database to set file name
        $user = User::find(Auth::user()->id);
        $user->avatar = $new_name;
        $user->save();
        return response()->json(['uploaded' => '/Profilepic/'.$new_name]);
    }
}