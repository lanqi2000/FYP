<?php

namespace App\Http\Controllers\Club\CMS;

use App\ClubActivity;
use App\ClubActivityApply;
use App\ClubActivityFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CMSActivityController extends CMSCommonController
{
    public function CMSActivity(){
        $getActivity = ClubActivity::all()->toArray();
        return view('CLUB.MANAGEMENT_SYSTEM.ACTIVITY_MANAGEMENT',compact('getActivity'));
    }
    //create
    public function input(Request $request){
        $data = json_decode($request['jsonData'],true);
        $rule = [
            'actName'=>'required',
            'actCaption'=>'required',
            'actOpenTime'=>'required',
            'actCloseTime'=>'required',
            'actTarget'=>'required',
            'actLimit'=>'required',
            'actForm'=>'required',
            'actForm.*'=>'required',
            'actForm.*.*'=>'required',
            'actForm.*.*.*'=>'required',
            'actEndTime'=>'required',
        ];
        $validator = validator($data,$rule);
        if($validator->passes() && !empty($request->allFiles())){
            $media = $request['actImage'];
            $getData = ClubActivity::latest('activity_id')->first();
            if(!empty($getData)){
                $id = $getData['activity_id']+1;
            }else{
                $id = 1;
            }
            $name = $id.".".$request->file('actImage')->getClientOriginalExtension();
            Storage::disk('public')->putFileAs("activity",$media,$name);
            ClubActivity::insert([
                'activity_image'=>$name,
                'activity_name'=>$data['actName'],
                'activity_caption'=>$data['actCaption'],
                'activity_apply_open'=>$data['actOpenTime'],
                'activity_apply_close'=>$data['actCloseTime'],
                'activity_end_time'=>$data['actEndTime'],
                'activity_participant_condition'=>$data['actTarget'],
                'activity_participant_max'=>$data['actLimit'],
                'activity_application_form'=>json_encode($data['actForm']),
                'activity_created_at'=>date("Y-m_d H-i-sa"),
                'club_id'=>1,
            ]);
            $res = ClubActivity::latest('activity_id')->first();
        }else{
            $res = '0';
        }
        return response($res,200);
    }
    //edit
    public function editGet(Request $request){
        $getData = ClubActivity::select('*')->where('activity_id',$request['actId'])->get();
        return response($getData,200);
    }
    public function editSave(Request $request){
        $data = json_decode($request['jsonData'],true);
        $id = $data['actId'];
        $rule = [
            'actName'=>'required',
            'actCaption'=>'required',
            'actOpenTime'=>'required',
            'actCloseTime'=>'required',
            'actTarget'=>'required',
            'actLimit'=>'required',
            'actEndTime'=>'required',
        ];
        $validator = validator($data,$rule);
        if($validator->passes()){
            if($request['actImage']!='empty'){
                $media = $request['actImage'];
                $name = $id.".".$request->file('actImage')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs("activity",$media,$name);
                ClubActivity::where('activity_id',$id)->update([
                    'activity_image'=>$name,
                ]);
            }
            ClubActivity::where('activity_id',$id)->update([
                'activity_name'=>$data['actName'],
                'activity_caption'=>$data['actCaption'],
                'activity_apply_open'=>$data['actOpenTime'],
                'activity_apply_close'=>$data['actCloseTime'],
                'activity_end_time'=>$data['actEndTime'],
                'activity_participant_condition'=>$data['actTarget'],
                'activity_participant_max'=>$data['actLimit'],
                'activity_created_at'=>date("Y-m_d H-i-sa"),
                'club_id'=>1,
            ]);
            $res = ClubActivity::latest('activity_id')->first();
        }else{
            $res = '0';
        }
        return response($res,200);
    }
    public function delete(Request $request){
        $actid = $request['actId'];
        ClubActivity::where('activity_id',$actid)->delete();
        Storage::disk('public')->delete(["activity/$actid.png","activity/$actid.jpg"]);
        return response($request,200);
    }
    //response
    public function getResponse(Request $request){
        $getData = ClubActivityApply::select('*')->where([['activity_id',$request['id']]])->get();
        return response($getData,200);
    }
    public function updateResponse(Request $request){
        ClubActivityApply::where('activity_apply_id',$request['actApplyId'])->update(['activity_apply_status'=>$request['status']]);
        return response($request['status'],200);
    }
    public function checkResponse(Request $request){
        $getData = ClubActivity::select('activity_application_form')->where('activity_id',$request['actId'])->get();
        return response($getData[0]['activity_application_form'],200);
    }
    //feedback
    public function getActivity(){
        $getActivity = ClubActivity::select('activity_id','activity_name','activity_end_time')->where([['club_id','1']])->get()->toArray();
        $i=0;
        foreach ($getActivity as $index=>$activity){
            if(strtotime($activity['activity_end_time'])>strtotime(now())){
                array_splice($getActivity,$index-$i,1);
                $i++;
            }
        }
        return response($getActivity,200);
    }
    public function getFeedback(Request $request){
        $array = [];
        foreach ($request['array'] as $data){
            $check = ClubActivityFeedback::where([['activity_id',$data['activity_id']]])->exists();
            if($check==1){
                $getRangeAvg = ClubActivityFeedback::where([['activity_id',$data['activity_id']]])->avg('activity_range');
                $getFeedBackTotal = ClubActivityFeedback::where([['activity_id',$data['activity_id']]])->count();
                $getFeedBackContents = ClubActivityFeedback::select('activity_range','feedback_comment')->where([['activity_id',$data['activity_id']]])->get();
                $getFeedback = array("avg"=>round($getRangeAvg,1),"total"=>$getFeedBackTotal,"contents"=>$getFeedBackContents);
                $json = json_encode($getFeedback);
            }else   $json='empty';
            array_push($array,$json);
        }
        return response($array,200);
    }
}
