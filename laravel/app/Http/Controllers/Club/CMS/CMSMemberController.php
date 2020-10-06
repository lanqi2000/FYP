<?php

namespace App\Http\Controllers\Club\CMS;

use Illuminate\Http\Request;

class CMSMemberController extends CMSCommonController
{
    public function CMSMember(){
        return view('CLUB.MANAGEMENT_SYSTEM.MEMBER_MANAGEMENT');
    }
}
