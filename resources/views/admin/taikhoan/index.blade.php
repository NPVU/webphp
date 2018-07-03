<section class="content-header">
    <h1>
        QUẢN LÝ TÀI KHOẢN
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/quan-ly/') }}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">Quản lý tài khoản</li>
    </ol>
</section>
<section class="content">
    <div class="row">        
        <div class="col-md-12">            
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                    <div class="box-btn-header" style="float:right;">                        
                        <a href="{{url('/quan-ly/tai-khoan/doi-mat-khau')}}" class="btn btn-warning">Đổi mật khẩu</a>
                    </div>
                </div>
                <form role="form">                    
                    <div class="box-body">
                        <div class="col-md-2"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
                            <table class="table">
                                <tr>
                                    <td><label>Tên tài khoản:</label></td>
                                    <td>{{ Auth::user()->email }}</td>
                                </tr>
                                <tr>
                                    <td><label style="margin-top: 5px;">Tên người dùng:</label></td>
                                    <td><input type="text" class="form-control" value="{{ Auth::user()->name }}"/></td>
                                </tr>
                            </table>                            
                        </div>
                    </div>
                    <div class="box-footer">
                        
                    </div>
                </form>
            </div>            
        </div>        
    </div>    
</section>
