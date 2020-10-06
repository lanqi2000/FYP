<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;

class HistoryController extends CommonController
{
    public function history(){
        return view('CLUB.CLUB_HISTORY');
    }
}
