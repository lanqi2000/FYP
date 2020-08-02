<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;

class ActivityController extends CommenController
{
    public function activity(){
        return view('CLUB.ACTIVITY.ACTIVITY');
    }
    public function aActivity(){
        return view('CLUB.ACTIVITY.APPLY_ACTIVITY');
    }
    public function pActivity(){
        return view('CLUB.ACTIVITY.PASSED_ACTIVITY');
    }
    public function rActivity(){
        return view('CLUB.ACTIVITY.RECENT_ACTIVITY');
    }
}
