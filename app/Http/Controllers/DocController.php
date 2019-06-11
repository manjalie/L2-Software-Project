<?php

namespace App\Http\Controllers;

use App\Lecturer;
use App\moderator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        uploading file into server

        $type = $request->input('type');

        if ($type=='moderator')
        {
            $moderator = Moderator::where('user_id','=',Auth::user()->id)->first();

            $file_extension = request()->file->getClientOriginalExtension();
            $new_name = "CV".$moderator->id.'.'.$file_extension;
            request()->file->move(public_path('Docs/Moderator'), $new_name);

//        updating database to set file name
            $mod = Moderator::find($moderator->id);
            $mod->cv = $new_name;
            $mod->save();
            return response()->json(['uploaded' => '/Docs/Moderator'.$new_name]);
        }
        else {

            $lecturer = Lecturer::where('user_id', '=', Auth::user()->id)->first();

            $file_extension = request()->file->getClientOriginalExtension();
            $new_name = "CV" . $lecturer->id . '.' . $file_extension;
            request()->file->move(public_path('Docs/Lecturer'), $new_name);

//        updating database to set file name
            $lec = Lecturer::find($lecturer->id);
            $lec->cv = $new_name;
            $lec->save();
            return response()->json(['uploaded' => '/Docs/Lecturer' . $new_name]);
        }
    }
}
