<?php

namespace App\Http\Controllers\Club;

use App\ClubActivity;
use App\ClubActivityApply;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends CommonController
{
    public function activity(){
        $getData = ClubActivity::select('activity_id','activity_image','activity_name','activity_end_time')->where('club_id',1)->get();
        $currentActivity = [];
        $passedActivity = [];
        foreach ($getData as $data){
            if (strtotime($data['activity_end_time'])>strtotime(now())){
                array_push($currentActivity,$data);
            }else{
                array_push($passedActivity,$data);
            }
        }
        return view('CLUB.ACTIVITY.ACTIVITY',compact('currentActivity','passedActivity'));
    }
    public function aActivity($id){
        $rawData = ClubActivity::select('activity_application_form')->where([['club_id',1],['activity_id',$id]])->get();
        $getData = json_decode($rawData[0]['activity_application_form']);
        $getDefaultData = UserProfile::select('*')->where([['user_id',127]])->get();
        $getForm = ClubActivityApply::select('*')->where([['activity_id',$id],['user_id',127]])->get();
        if(!empty($getForm[0])){
            return redirect('/club');
        }else{
            return view('CLUB.ACTIVITY.APPLY_ACTIVITY')->with('getData',$getData)->with('id',$id)->with('getDefaultData',$getDefaultData[0]);
        }
    }
    public function pActivity($id){
        $getData = ClubActivity::select('activity_id','activity_image','activity_name','activity_caption','activity_apply_open','activity_apply_close','activity_participant_condition','activity_participant_max','activity_end_time')->where([['club_id',1],['activity_id',$id]])->get();
        if(strtotime($getData[0]['activity_end_time'])>strtotime(now())){
            return redirect('/club');
        }else
            return view('CLUB.ACTIVITY.PASSED_ACTIVITY')->with('getData',$getData);
    }
    public function rActivity($id){
        $getData = ClubActivity::select('*')->where([['club_id',1],['activity_id',$id]])->get();
        if(strtotime($getData[0]['activity_end_time'])<strtotime(now())){
            return redirect('/club');
        }
        else{
            $getStatus = ClubActivityApply::select('activity_apply_status')->where([['activity_id',$id],['user_id',127]])->get();
            if(!empty($getStatus[0]['activity_apply_status'])){
                $status = $getStatus[0]['activity_apply_status'];
            }else{
                $status = '0';
            }
            return view('CLUB.ACTIVITY.RECENT_ACTIVITY')->with('getData',$getData)->with('getStatus',$status);
        }

    }
    public function input($id,Request $request){
        $getData = $request->toArray();
        $array = [];

        if($request['jsonData']){
            ClubActivityApply::updateOrInsert(['user_id'=>'127','activity_id'=>$id],[
                'activity_id'=>$id,
                'activity_apply_data'=>$request['jsonData'],
                'user_id'=>'127',
                'member_id'=>'127',
                'created_time'=>date("Y-m_d H-i-sa"),
            ]);
            return response('ok', 200);
        }
        else{
            $actApplyId = ClubActivityApply::count();
            $applyId = 1+$actApplyId;
            Storage::disk('public')->deleteDirectory("activity/$id/form$applyId");
            foreach ($request->allFiles() as $key => $media){
                $name = $key.".".$media->getClientOriginalExtension();
                array_push($array,$name);
                Storage::disk('public')->putFileAs("activity/$id/form$applyId",$media,$name);
            }
            return response($actApplyId, 200);
        }
    }
}
