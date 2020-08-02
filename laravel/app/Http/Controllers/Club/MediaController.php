<?php

namespace App\Http\Controllers\Club;

use Illuminate\Http\Request;

class MediaController extends CommenController
{
    public function meida(){
        return view('CLUB.MEDIA.MEDIA');
    }
    public function picture(){
        return view('CLUB.MEDIA.PICTURE');
    }
    public function video(){
        return view('CLUB.MEDIA.VIDEO');
    }
}
