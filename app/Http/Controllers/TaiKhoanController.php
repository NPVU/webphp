<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as Controller;
use App\Http\Controllers\ClassCommon as ClassCommon;
use Illuminate\Support\Facades\Auth;

class TaiKhoanController extends Controller{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function changeDisplayUserName($displayUserName){
        $user = Auth::user();
        $user->name = $displayUserName;
        $user->save();
        return $displayUserName;
    }
}

