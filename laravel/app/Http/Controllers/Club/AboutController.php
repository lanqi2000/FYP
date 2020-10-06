<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;

class AboutController extends CommonController
{
    public function about(){
        return view('CLUB.ABOUT_CLUB');
    }
}
