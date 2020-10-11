<?php

namespace App\Http\Controllers\Club;

use App\ClubActivity;
use App\ClubPicture;
use App\ClubVideo;
use Illuminate\Http\Request;

class MediaController extends CommonController
{
    public function media(){
        $getPic = ClubPicture::select('activity_id')->where([['club_id','1']])->distinct()->orderBy('activity_id')->get()->toArray();
        $getActPic = [];
        $getActVid = [];
        if($getPic!=[]){
            foreach ($getPic as $id){
                if($id['activity_id']!=0) {
                    array_push($getActPic, [
                        'id' => $id['activity_id'],
                        'name' => ClubActivity::select('activity_name')->where([['activity_id', $id]])->get()->toArray()[0]['activity_name']
                    ]);
                }
            }
            $getVid = ClubVideo::select('activity_id')->where([['club_id','1']])->distinct()->orderBy('activity_id')->get()->toArray();
            foreach ($getVid as $id){
                if($id['activity_id']!=0){
                    array_push($getActVid,[
                        'id' => $id['activity_id'],
                        'name' => ClubActivity::select('activity_name')->where([['activity_id',$id]])->get()->toArray()[0]['activity_name']
                    ]);
                }
            }
        }
        return view('CLUB.MEDIA.MEDIA',compact('getActPic','getActVid'));
    }
    public function picture($id=null){
        if(!empty($id)){
            $getPic = ClubPicture::select('*')->where([['club_id','1'],['activity_id',$id]])->get()->toArray();
        }
        else{
            $getPic = ClubPicture::select('*')->where([['club_id','1']])->get()->toArray();
        }
        return view('CLUB.MEDIA.PICTURE',compact('getPic'));
    }
    public function video($id=null){
        if(!empty($id)){
            $getVid = ClubVideo::select('*')->where([['club_id','1'],['activity_id',$id]])->get()->toArray();
        }
        else{
            $getVid = ClubVideo::select('*')->where([['club_id','1']])->get()->toArray();
        }
        return view('CLUB.MEDIA.VIDEO',compact('getVid'));
    }
}
