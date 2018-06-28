<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as Controller;

class NhanVienController extends Controller{
    
    public function index() {
       $data['title'] = 'DANH SÁCH NHÂN VIÊN';
       $data['page'] = 'admin.nhancong.nhanvien.index';
       return view('admin/layout', $data);
    }

    public function add() {
       $data['title'] = 'DANH SÁCH NHÂN VIÊN';
       $data['page'] = 'admin.nhancong.nhanvien.index';
       return view('admin/layout', $data);
    }
}

