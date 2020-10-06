<?php

namespace App\Http\Controllers;

use App\ClubActivity;
use App\ClubActivityFeedback;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function template(){
        return view('TEMPLATE.TEMPLATE');
    }
    public function ctemplate(){
        return view('CTEMPLATE.CTEMPLATE');
    }
    public function feedback(){
        $getActFeedback = ClubActivityFeedback::select('activity_id')->where([['club_member_id','127']])->get()->toArray();
        $getActivity = ClubActivity::select('activity_id','activity_name','activity_end_time')->where([['club_id','1']])->get()->toArray();
        $i=0;
        foreach ($getActivity as $index=>$activity){
            if(strtotime($activity['activity_end_time'])>strtotime(now())){
                array_splice($getActivity,$index-$i,1);
                $i++;
            }
        }
        $i=0;
        foreach ($getActFeedback as $actFeedback){
            foreach ($getActivity as $index=>$activity){
                if($actFeedback['activity_id'] === $activity['activity_id']){
                    array_splice($getActivity,$index,1);
                    $i++;
                }
            }
        }
        return response($getActivity,200);
    }
    public function feedbackInput(Request $request){
        $val = $request->validate([
            'id'=>'required',
            'range'=>'required'
        ]);
        if($val){
            ClubActivityFeedback::insert([
                'club_member_id'=>'127',
                'activity_range'=>$request['range'],
                'feedback_comment'=>$request['comment'],
                'activity_id'=>$request['id'],
                'created_time'=>date("Y-m_d H-i-sa"),
            ]);
            $getActFeedback = ClubActivityFeedback::select('activity_id')->where([['club_member_id','127']])->get()->toArray();
            $getActivity = ClubActivity::select('activity_id','activity_name')->where([['club_id','1']])->get()->toArray();
            foreach ($getActFeedback as $actFeedback){
                foreach ($getActivity as $index=>$activity){
                    if($actFeedback['activity_id'] === $activity['activity_id']){
                        array_splice($getActivity,$index,1);
                        break;
                    }
                }
            }
            return response($getActivity,200);
        }
        else
            return response('fail',200);
    }
}
