<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function template(){
        return view('TEMPLATE.TEMPLATE');
    }
    public function ctemplate(){
        return view('CTEMPLATE.CTEMPLATE');
    }
}
