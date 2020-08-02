<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;

class ClubController extends CommenController
{
    public function club(){
        return view('CLUB.CLUB');
    }
    public function history(){
        return view('CLUB.CLUB_HISTORY');
    }
    public function about(){
        return view('CLUB.ABOUT_CLUB');
    }
}
