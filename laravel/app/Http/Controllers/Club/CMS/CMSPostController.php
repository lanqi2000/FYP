<?php

namespace App\Http\Controllers\Club\CMS;

use App\ClubPicture;
use App\ClubPost;
use App\ClubPostMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\File;

class CMSPostController extends CMSCommonController
{
    public function CMSPost(){
        $getPost = ClubPost::all()->toArray();
        return view('CLUB.MANAGEMENT_SYSTEM.POST_MANAGEMENT',compact('getPost'));
    }
    public function input(Request $request){

        $mediaPath = [];

        $getData = ClubPost::latest('post_id')->first();

        //new id
        if(!empty($getData)){
            $id = $getData['post_id']+1;
        }else{
            $id = 1;
        }

//         Attach Image info
        foreach ($request->allFiles() as $key => $media){
            $name = $key.".".$media->getClientOriginalExtension();
            array_push($mediaPath,Storage::disk('public')->putFileAs("post/p-$id",$media,$name));
        }
        ClubPost::insert([
            'club_id'=>1,
            'post_title'=>$request['title'],
            'post_media'=>json_encode($mediaPath),
            'post_caption'=>$request['caption'],
            'created_time'=>date("Y-m_d H-i-sa")
        ]);
        return response(ClubPost::latest('post_id')->first(),200);
    }

    public  function editGet(Request $request){
        $getData = ClubPost::select('*')->where('post_id',$request['postId'])->get();
        return response($getData,200);
    }
    public function editSave(Request $request){
        $mediaPath = [];
        $postId = (int)$request['postid'];

//         Attach Image info
        if($request->allFiles()){
            Storage::disk('public')->deleteDirectory("post/p-$postId");
            foreach ($request->allFiles() as $key => $media){
                $name = $key.".".$media->getClientOriginalExtension();
                array_push($mediaPath,Storage::disk('public')->putFileAs("post/p-$postId",$media,$name));
            }
            ClubPost::where('post_id',$postId)->update([
                'post_media'=>json_encode($mediaPath),
            ]);
        }
        ClubPost::where('post_id',$postId)->update([
            'club_id'=>1,
            'post_title'=>$request['title'],
            'post_caption'=>$request['caption'],
        ]);
        return response($request,200);
    }

    public function delete(Request $request){
        $postid = $request['postId'];
        ClubPost::where('post_id',$postid)->delete();
        Storage::disk('public')->deleteDirectory("post/p-$postid");
        return response($request,200);
    }
}
