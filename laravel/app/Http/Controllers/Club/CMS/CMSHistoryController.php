<?php

namespace App\Http\Controllers\Club\CMS;

use Illuminate\Http\Request;

class CMSHistoryController extends CMSCommonController
{
    public function CMSHistory(){
        return view('CLUB.MANAGEMENT_SYSTEM.HISTORY_MANAGEMENT');
    }
}
