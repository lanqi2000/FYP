<?php

namespace App\Http\Controllers\Club\CMS;

use Illuminate\Http\Request;

class CMSCooperationController extends CMSCommonController
{
    public function CMSCooperation(){
        return view('CLUB.MANAGEMENT_SYSTEM.COOPERATION_MANAGEMENT');
    }
}
