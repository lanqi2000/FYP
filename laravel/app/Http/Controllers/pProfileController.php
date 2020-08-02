<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pProfileController extends Controller
{
    public function pProfile(){
        return view('PERSONAL_PROFILE');
    }
}
