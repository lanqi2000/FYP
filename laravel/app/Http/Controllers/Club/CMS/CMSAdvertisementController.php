<?php

namespace App\Http\Controllers\Club\CMS;

use Illuminate\Http\Request;

class CMSAdvertisementController extends CMSCommonController
{
    public function CMSAdvertisement(){
            return view('CLUB.MANAGEMENT_SYSTEM.ADVERTISEMENT_MANAGEMENT');
    }
}
