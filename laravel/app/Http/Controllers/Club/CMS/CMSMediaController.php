<?php

namespace App\Http\Controllers\Club\CMS;

use App\ClubActivity;
use App\ClubPicture;
use App\ClubVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CMSMediaController extends CMSCommonController
{
    public function CMSMedia(){
        return view('CLUB.MANAGEMENT_SYSTEM.MEDIA_MANAGEMENT');
    }
    public function getActivity(){
        $getData = ClubActivity::select('activity_id','activity_name')->where([['club_id',1]])->get();
        return response($getData,200);
    }
    public function upload(Request $request,$c){
        $array = [];
        if($c==1){
            Storage::disk('public')->deleteDirectory("club/picture/temp");
            foreach ($request->allFiles() as $key => $media){
                $name = $key.'M'.strtotime(now()).".".$media->getClientOriginalExtension();
                array_push($array,$name);
                Storage::disk('public')->putFileAs("club/picture/temp",$media,$name);
            }
        }
        elseif($c==2){
            Storage::disk('public')->deleteDirectory("club/video/temp");
            foreach ($request->allFiles() as $key => $media){
                $name = $key.'M'.strtotime(now()).".".$media->getClientOriginalExtension();
                array_push($array,$name);
                Storage::disk('public')->putFileAs("club/video/temp",$media,$name);
            }
        }
        return response($array,200);
    }
    public function inputMedia(Request $request,$c){
        $array = [];
        if($c==1){
            Storage::disk('public')->deleteDirectory("club/picture/temp");
            foreach ($request->allFiles() as $key => $media){
                $name = $key.'M'.strtotime(now()).".".$media->getClientOriginalExtension();
                array_push($array,$name);
                Storage::disk('public')->putFileAs("club1/picture/",$media,$name);
            }
        }
        elseif($c==2){
            Storage::disk('public')->deleteDirectory("club/video/temp");
            foreach ($request->allFiles() as $key => $media){
                $name = $key.'M'.strtotime(now()).".".$media->getClientOriginalExtension();
                array_push($array,$name);
                Storage::disk('public')->putFileAs("club1/video/",$media,$name);
            }
        }
        return response($array,200);

    }
    public function input(Request $request,$c){
        if($c==1){
            $imageval = $request->validate([
                'imageActivity' => 'required',
                'imageSet' => 'required'
            ]);
            if($imageval){
                foreach ($request['imageSet'] as $data){
                    ClubPicture::insert([
                        'picture_name'=>$data,
                        'activity_id'=>$request['imageActivity'],
                        'picture_created_at'=>date("Y-m_d H-i-sa"),
                        'club_id'=>1,
                    ]);
                }
                return response('ok',200);
            }else{
                return response('no ok',200);
            }
        }
        elseif($c==2){
            $videoval = $request->validate([
                'videoActivity' => 'required',
                'videoSet' => 'required'
            ]);
            if($videoval){
                foreach ($request['videoSet'] as $data){
                    ClubVideo::insert([
                        'video_name'=>$data,
                        'activity_id'=>$request['videoActivity'],
                        'video_created_at'=>date("Y-m_d H-i-sa"),
                        'club_id'=>1,
                    ]);
                }
                return response('ok',200);
            }else{
                return response('no ok',200);
            }
        }

    }
    public function deleteMedia(Request $request,$c){
        if ($c == 1){
            foreach ($request['ImageSet'] as $name){
                Storage::disk('public')->delete("club1/picture/$name");
            }
        }
        elseif ($c == 2){
            foreach ($request['VideoSet'] as $name){
                Storage::disk('public')->delete("club1/video/$name");
            }
        }
    }
}
