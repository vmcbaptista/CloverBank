<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyManagerProfile extends Controller
{
    public function showMyProfile(){


        return view('/manager/my_profile');
    }
}
