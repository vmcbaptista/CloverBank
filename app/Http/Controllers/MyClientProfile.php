<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyClientProfile extends Controller
{
    public function showMyProfile(){
        $path = \Auth::guard('client')->user()->image_path;
        return view('/client/my_profile',compact("path"));
    }
}
