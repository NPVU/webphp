<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as Controller;

class SanPhamController extends Controller{
    
    public function getDanhSachSanPham(){
        $data['title'] = 'test';
        $data['page'] = 'admin.sanpham.add';
        return view('admin/layout', $data);
    }
}
