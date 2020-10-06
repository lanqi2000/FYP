<?php

namespace App\Http\Controllers;

use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class pProfileController extends Controller
{
    public function pProfile(){
        $getData = UserProfile::all()->toArray();
        $data = $getData[0];
        return view('PERSONAL_PROFILE',compact('data'));
    }
    public function input(Request $request){
        if($request['picture']){
            $name = '127'.".".$request['picture']->getClientOriginalExtension();
            Storage::disk('public')->putFileAs("profilePic",$request['picture'],$name);
            UserProfile::updateOrInsert(['user_id'=>'127'],[
                'user_picture'=>$name,
            ]);
        }
        UserProfile::updateOrInsert(['user_id'=>'127'],[
            'user_name'=>$request['name'],
            'user_gender'=>$request['gender'],
            'student_id'=>$request['studentId'],
            'user_hp'=>$request['contactNumber'],
        ]);
        return response($request,200);
    }
}
