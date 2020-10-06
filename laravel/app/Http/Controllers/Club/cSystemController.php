<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;

class cSystemController extends CommonController
{
    public function cSystem(){
        return view('CLUB.COOPERATE_SYSTEM.COOPERATE_SYSTEM');
    }
}
