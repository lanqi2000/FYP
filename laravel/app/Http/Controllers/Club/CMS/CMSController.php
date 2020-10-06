<?php

namespace App\Http\Controllers\Club\CMS;

use Illuminate\Http\Request;

class CMSController extends CMSCommonController
{
    public function CMS(){
        return view('CLUB.MANAGEMENT_SYSTEM.CLUB_MANAGEMENT_SYSTEM');
    }
}
