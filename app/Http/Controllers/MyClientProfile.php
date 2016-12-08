<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyClientProfile extends Controller
{
    public function showMyProfile(){


        return view('/client/my_profile');
    }
}
