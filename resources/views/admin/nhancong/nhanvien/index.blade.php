<section class="content-header">
    <h1>
        DANH SÁCH NHÂN VIÊN
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/quan-ly/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/quan-ly/nhan-cong/') }}">Quản lý nhân công</a></li>
        <li class="active">Quản lý nhân viên</li>
    </ol>
</section>
<section class="content">
    <div class="row">        
        <div class="col-md-12">            
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                    <div class="box-btn-header" style="float:right;">
                        <a href="{{url('/quan-ly/nhan-cong/nhan-vien/them-moi')}}" class="btn btn-danger">Thêm mới</a>
                    </div>
                </div>                
                <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <caption>Danh sách nhân viên</caption>
                        <thead>
                            <tr class="bg-primary">
                                <th scope="col" class="text-center" style="width: 3%">#</th>
                                <th scope="col" class="text-center" style="width: 25%">Họ tên</th>
                                <th scope="col" class="text-center" style="width: 10%">Giới tính</th>
                                <th scope="col" class="text-center" style="width: 10%">Ngày sinh</th>
                                <th scope="col" class="text-center" style="width: 15%">Số CMND</th>
                                <th scope="col" class="text-center" style="width: 10%">SĐT</th>
                                <th scope="col" class="text-center" style="width: 12%">Tình trạng</th>
                                <th scope="col" class="text-center" style="width: 15%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $rowIndex = 0; ?>
                            @foreach ($nhanvien as $row)
                            <tr>
                                <td class="text-center">
                                    <?php $rowIndex++; echo $rowIndex ?>
                                </td>
                                <td>{{$row->nhanvien_hoten}}</td>
                                <td><?php echo $row->nhanvien_gioitinh == 1 ? 'Nam' : 'Nữ'; ?></td>
                                <td class="text-center">{{$row->nhanvien_ngaysinh}}</td>
                                <td class="text-center">{{$row->nhanvien_cmnd}}</td>
                                <td class="text-center">{{$row->nhanvien_sodienthoai}}</td>
                                <td class="text-center">
                                    <?php if ($row->nhanvien_tinhtrang == 1) : ?>
                                        Hoạt động
                                    <?php elseif ($row->nhanvien_tinhtrang == 0) : ?>
                                        Đã khóa
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">                                      
                                    <div class="list-action-icon">
                                        <a href="{{url('/quan-ly/nhan-cong/nhan-vien/thong-tin/')}}/{{csrf_token()}}/{{$row->nhanvien_id}}">
                                            <i class="fa fa-eye text-blue"></i>
                                        </a>
                                        <a href="{{url('/quan-ly/nhan-cong/nhan-vien/chinh-sua/')}}/{{csrf_token()}}/{{$row->nhanvien_id}}">
                                            <i class="fa fa-edit text-light-blue"></i>
                                        </a>
                                        <?php if($row->nhanvien_tinhtrang == 1) :?>
                                        <a href="{{url('/quan-ly/nhan-cong/nhan-vien/khoa/')}}/{{csrf_token()}}/{{$row->nhanvien_id}}">
                                            <i class="fa fa-lock text-red" onclick="selectRow({{$row->nhanvien_id}},'lockButton',true)"></i>
                                        </a>
                                        <?php elseif ($row->nhanvien_tinhtrang == 0) :?>
                                        <a href="{{url('/quan-ly/nhan-cong/nhan-vien/mo-khoa/')}}/{{csrf_token()}}/{{$row->nhanvien_id}}">
                                            <i class="fa fa-unlock text-success" onclick="selectRow({{$row->nhanvien_id}},'unlockButton',true)"></i>
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">

                </div>
                <form action="{{url('/quan-ly/nhan-cong/nhan-vien/')}}" role="form" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_nhanvienID" value="0" id="hiddenNhanVienID" />
                    <button type="submit" class="btn btn-warning" id="lockButton" name="lockButton" style="display:none;"/>
                    <button type="submit" class="btn btn-warning" id="unlockButton" name="unlockButton" style="display:none;"/>
                    <button type="submit" class="btn btn-warning" id="editButton" name="editButton" style="display:none;"/>
                    <button type="submit" class="btn btn-warning" id="viewButton" name="viewButton" style="display:none;"/>
                </form>
            </div>            
        </div>        
    </div>
    <script>
        function selectRowDelete(nvID, actionCallBack, verify){
            if(verify){
                if(!confirm('Xác nhận kết thúc hợp đồng với nhân viên này?')){
                    return false;
                }
            }
            $('#hiddenNhanVienID').val(nvID);
            $('#'+actionCallBack).click();
        }        
    </script>
</section>