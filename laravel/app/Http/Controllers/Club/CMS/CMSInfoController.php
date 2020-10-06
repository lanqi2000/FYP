<?php

namespace App\Http\Controllers\Club\CMS;

use Illuminate\Http\Request;

class CMSInfoController extends CMSCommonController
{
    public function CMSInfo(){
        return view('CLUB.MANAGEMENT_SYSTEM.INFO_MANAGEMENT');
    }
}
