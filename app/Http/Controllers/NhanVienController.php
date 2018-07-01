<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as Controller;


class NhanVienController extends Controller{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
       $list = DB::table('nhanvien')->where('nhanvien_tinhtrang', '=', 1)->get();
       $data['nhanvien'] =  $list;
       
       $data['hotenFilter'] = "";
       $data['cmndFilter'] = "";
       $data['tinhtrangFilter'] = 1;
        
       $data['title'] = 'Quản Lý Nhân Viên - '.config('constants.company_name');
       $data['page'] = 'admin.nhancong.nhanvien.index';
       return view('admin/layout', $data);
    }
    
    public function actionIndex(Request $request){        
        if(strcmp($request->btnFilter,'btnFilter') == 0){
            return $this->actionFilter($request);
        }
    }
    
    public function actionFilter(Request $request){
        $hotenFilter     = $request->hotenFilter;
        $cmndFilter      = $request->cmndFilter;
        $tinhtrangFilter = $request->tinhtrangFilter;
        if($tinhtrangFilter == -1){
            $where = " nhanvien_tinhtrang <> $tinhtrangFilter ";
        } else {
            $where = " nhanvien_tinhtrang = $tinhtrangFilter ";
        }
        if(!parent::nullOrEmptyString($hotenFilter)){
            $where .= " AND nhanvien_hoten like '%$hotenFilter%' ";
        }
        if(!parent::nullOrEmptyString($cmndFilter)){
            $where .= " AND nhanvien_cmnd like '%$cmndFilter%' ";
        }
        $list = DB::table('nhanvien')
                ->whereRaw($where)
                ->get();

       $data['nhanvien'] =  $list;
       $data['title'] = 'Quản Lý Nhân Viên - '.config('constants.company_name');
       $data['page'] = 'admin.nhancong.nhanvien.index';
       return view('admin/layout', $data, $request->all());
    }

    public function preAdd() {
       date_default_timezone_set("Asia/Ho_Chi_Minh");
       $data['hoten']               = "";
       $data['msg_error_hoten']     = "";
       
       $data['cmnd']                = "";
       $data['msg_error_cmnd']      = "";
       
       $data['gioitinh']            = 1;
       
       $ngaysinh=date_create("1970-01-01");
       $data['ngaysinh']            = date_format($ngaysinh, "d/m/Y");
       $data['msg_error_ngaysinh']  = "";
       
       $data['diachi']              = "";
       $data['sodienthoai']         = "";
       $data['email']               = "";
       $data['ngaybatdaulam']       = date('d/m/Y');
        
       $data['title'] = 'Thêm Nhân Viên - '.config('constants.company_name');
       $data['page'] = 'admin.nhancong.nhanvien.add';
       return view('admin/layout', $data);
    }
    public function actionAdd(Request $request) {
       $valid = true;
       
       $hoten       = $request->hoten;
       $cmnd        = $request->cmnd;
       $gioitinh    = $request->gioitinh;
       $ngaysinh    = $request->ngaysinh;
       $diachi      = $request->diachi;
       $sodienthoai = $request->sodienthoai;
       $email       = $request->email;       
       
       $data['msg_error_hoten']     = "";
       $data['msg_error_cmnd']      = "";
       $data['msg_error_ngaysinh']  = "";
       
       if(empty($hoten)){
           $valid = false;
           $data['msg_error_hoten'] = "Họ tên nhân viên là bắt buộc";
       } else if(strlen($hoten) <= 2) {
           $valid = false;
           $data['msg_error_hoten'] = "Họ tên nhân viên phải có ít nhất 2 ký tự";
       }
       
       if(strlen($cmnd) != 9 && strlen($cmnd) != 12) {
           $valid = false;
           $data['msg_error_cmnd'] = "Số CMND phải có 9 hoặc 12 ký tự";
       }
       
       if($ngaysinh == null) {
           $valid = false;
           $data['msg_error_ngaysinh'] = "Ngày sinh là bắt buộc";
       }
       
       if($valid){
            DB::table('nhanvien')->insert(
                [
                    'nhanvien_hoten'        => $hoten,
                    'nhanvien_gioitinh'     => $gioitinh,
                    'nhanvien_ngaysinh'     => $ngaysinh,
                    'nhanvien_diachi'       => $diachi,
                    'nhanvien_cmnd'         => $cmnd,
                    'nhanvien_sodienthoai'  => $sodienthoai,
                    'nhanvien_email'        => $email,
                    'nhanvien_hinhanh'      => '',
                    'nhanvien_ngaybatdaulam'=> $request->ngaybatdaulam,
                    'nhanvien_ngaytao'      => date('Y-m-d')
                ]
            );
           return $this->index();
       } else{
           $data['title'] = 'Thêm Nhân Viên - '.config('constants.company_name');
           $data['page'] = 'admin.nhancong.nhanvien.add';
           return view('admin/layout', $data, $request->all());
       }       
    }       
}

