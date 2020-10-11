<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        var_dump(session()->all());
        return view('HOME');
    }
}
