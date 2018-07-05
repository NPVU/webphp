<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Support\Facades\Hash;
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
    
    public function changePassword($oldPassword, $newPassword){        
        if (!(Hash::check($oldPassword, Auth::user()->password))) {
           $data['status'] = 101;
           $data['msg'] = 'Mật khẩu cũ không đúng !';
           return $data;
        }     
        if(strcmp($oldPassword, $newPassword) == 0){ 
           $data['status'] = 102;
           $data['msg'] = 'Mật khẩu cũ và mật khẩu mới không được giống nhau !';
           return $data;
        }
        
        $user = Auth::user();
        $user->password = bcrypt($newPassword);
        $user->save();
        $data['status'] = 200;
        return $data;
    }
}

