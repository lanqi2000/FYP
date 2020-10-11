<?php

namespace App\Http\Controllers\Club;

use App\ClubAdvertisement;
use App\ClubPost;
use App\ClubPostComment;
use App\ClubPostLike;
use App\ClubPostMedia;
use Illuminate\Http\Request;

class ClubController extends CommonController
{
    public function club(){
        $user = session()->all();
        dd($user);
        $getAds = ClubAdvertisement::select('*')->where('club_id','1')->get();
        $getData = ClubPost::all()->toArray();
        $getLike = ClubPostLike::select('post_like_status','post_id')->where('club_member_id','=','127')->get();
        $getComment = ClubPostComment::select()->where('club_member_id','127')->orWhere('club_admin_id','1')->get();

        if($getData!=[]){
            foreach($getData as $key => $data){
                $getData[$key]['updated_at']=date("Y-m_d H-i-sa",strtotime($data['updated_at']));
                //set default post_like
                $getData[$key]["post_like"]=0;
                foreach ($getLike as $like){
                    if($data['post_id']===$like['post_id']){
                        $getData[$key]["post_like"]=$like['post_like_status'];
                    }
                }
                $getTotalLike = ClubPostLike::select('post_like_status','post_id')->where([['post_id',$data['post_id']],['post_like_status','1']])->count();
                $getData[$key]["post_total_like"] = $getTotalLike;

                //set default post_comment
                $getData[$key]["post_comment"]=null;
                $commentSet = [];
                foreach ($getComment as $comment){
                    if($data['post_id']===$comment['post_id']){
                        if($comment['club_member_id']){
                            $id = $comment['club_member_id'];
                        }
                        elseif ($comment['club_admin_id']){
                            $id = $comment['club_admin_id'];
                        }
                        array_push($commentSet,$comment['comment_content'].'!@##@!'.$id);
                    }
                }
                $commentSet =collect($commentSet);
                $getData[$key]["post_comment"]=$commentSet;
            }
        }
        return view('CLUB.CLUB')->with('dataset',$getData)->with('getAds',$getAds);
    }
    public function inputLike(Request $request){
        $data = $request->all();

        ClubPostLike::updateOrInsert(['club_member_id'=>'127','post_id'=>$data['post_id']],[
            'post_like_status'=>$data['love']
        ]);
    }
    public function inputComment(Request $request){
        $data = $request->all();
        ClubPostComment::insert([
            'comment_content'=>$data['post_comment'],
            'post_id'=>$data['post_id'],
            'club_member_id'=>127,
            'created_time'=>date("Y-m_d H-i-sa")
        ]);
    }
}
