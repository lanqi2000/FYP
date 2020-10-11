<?php

namespace App\Http\Controllers\Club\CMS;

use App\ClubActivity;
use App\ClubAdvertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CMSAdvertisementController extends CMSCommonController
{
    public function CMSAdvertisement(){
        $getAct = ClubActivity::select('activity_id','activity_name')->where('club_id','1')->get();
        $getAds = ClubAdvertisement::select('*')->where('club_id','1')->get();
        return view('CLUB.MANAGEMENT_SYSTEM.ADVERTISEMENT_MANAGEMENT',compact('getAct','getAds'));
    }
    public function input(Request $request){
        $media = $request['image'];
        $getData = ClubAdvertisement::latest('advertisement_id')->first();
        if(!empty($getData)){
            $id = $getData['advertisement_id']+1;
        }else{
            $id = 1;
        }
        $name = $id.".".$request->file('image')->getClientOriginalExtension();
        Storage::disk('public')->putFileAs("advertisement",$media,$name);

        ClubAdvertisement::insert([
            'advertisement_picture'=>$name,
            'activity_id'=>$request['link'],
            'activity_name'=>$request['name'],
            'advertisement_created_at'=>date("Y-m_d H-i-sa"),
            'club_id'=>'1'
        ]);
        return response($request, 200);
    }
    public function delete(Request $request){
        ClubAdvertisement::where('advertisement_id',$request['id'])->delete();
        Storage::disk('public')->delete('advertisement'.'/'.$request['image']);
        $getData = ClubAdvertisement::select('*')->where('club_id','1')->get();
        return response($getData, 200);
    }
}
