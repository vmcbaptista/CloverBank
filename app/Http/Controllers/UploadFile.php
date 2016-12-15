<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use App\Client;

class UploadFile extends Controller
{
    // create function for our upload page
    public function index(){
        return view('uploadfile');
    }
    // create new function for show uploaded page
    public function showfileupload(Request $request){
        $filename = \Auth::guard('client')->user()->username;
        $file = $request->file('photo_file');
        if($file != null) {
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $path = 'images/client_images';
            $file = $file->move($path, $filename . '.' . $extension);

            $getUser = Client::find(\Auth::guard('client')->user()->id);
            $path = '/' . $path . '/' . $filename . '.' . $extension;
            $getUser->image_path = $path;
            $getUser->save();

            return view("client.my_profile", compact("path"));
        }else{
            $path = \Auth::guard('client')->user()->image_path;
            return view("client.my_profile", compact("path"));
        }
    }
}
