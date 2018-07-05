<div id="modal-name" data-izimodal-transitionin="fadeInDown">
    <div class="modal-body">        
        <div class="row">
            <div class="col-xs-10 col-sm-10 col-md-8 col-lg-8">
                <input type="text" id="txtDisplayUserName" class="form-control" value="{{ Auth::user()->name }}" />
            </div>
            <div class="col-xs-2 col-sm-2 col-md-4 col-lg-4">
                <button type="button" class="btn btn-danger" onclick="updateDisplayUserName()">Cập nhật</button>
            </div>
        </div>        
    </div>
</div>
<div id="modal-password" data-izimodal-transitionin="fadeInDown">
    <div class="modal-body">        
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3"></div>
                <div class="col-md-6 form-group notify-change-password-success has-success display-none">
                   <label class="control-label">
                       <i class="fa fa-check"></i>
                       Thay đổi mật khẩu thành công !
                   </label>
                </div>
                <div class="col-md-6 form-group notify-change-password-error has-error display-none">
                   <label class="control-label">
                       <i class="fa fa-times-circle-o"></i>
                       <span class="msg-change-password-error"></span>
                   </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <label>Mật khẩu cũ</label>
                    <input type="password" id="oldPassword" class="form-control required" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <label>Mật khẩu mới</label>
                    <input type="password" id="newPassword" class="form-control required" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-3"></div>
                <div class="col-md-6 renew-password">
                    <label>Xác nhận mật khẩu mới</label>
                    <input type="password" id="renewPassword" class="form-control required" />
                    <span class="help-block msg_renewpassword_error"></span>
                </div>
            </div>
            <div class="col-md-12 text-center" style="margin-top:20px">
                <button type="button" class="btn btn-danger" onclick="validForm()">Đổi mật khẩu</button>
            </div>
        </div>        
    </div>
</div>


<script>
    $('#modal-name').iziModal({
             overlayClose:false,
             onOpening: function(modal){
                 modal.startLoading();                 
             },
             onOpened: function(modal){
                 modal.stopLoading();                 
             }
    });
    $('#modal-name').iziModal('setTitle', 'Thay đổi tên hiển thị');
    $('#modal-name').iziModal('setTop', 100);
    
    $('#modal-password').iziModal({
             overlayClose:false,
             onOpening: function(modal){
                 modal.startLoading();                 
             },
             onOpened: function(modal){
                 modal.stopLoading();                 
             }
    });
    $('#modal-password').iziModal('setTitle', 'Thay đổi mật khẩu');
    $('#modal-password').iziModal('setTop', 100);
    
    function updateDisplayUserName(){       
        $.ajax({
            type: "GET",
            url: "{{url('/quan-ly/tai-khoan/doi-ten-hien-thi')}}/"+$('#txtDisplayUserName').val(),
            success: function (data) {
              $('.displayUserName').html(data);
              $('#modal-name').iziModal('close');
            }
        });
    }
    function updateChangePassword(){
        $.ajax({
            type: "GET",
            url: "{{url('/quan-ly/tai-khoan/doi-mat-khau')}}/"+$('#oldPassword').val()+"/"+$('#newPassword').val(),
            success: function (data) {
                console.log(data);
                if(data.status === 200){
                    $('.notify-change-password-error').addClass('display-none');
                    $('.notify-change-password-success').removeClass('display-none');
                } else if(data.status === 101){
                    $('.notify-change-password-success').addClass('display-none');
                    $('.msg-change-password-error').html(data.msg);
                    $('.notify-change-password-error').removeClass('display-none');
                } else if(data.status === 102){
                    $('.notify-change-password-success').addClass('display-none');
                    $('.msg-change-password-error').html(data.msg);
                    $('.notify-change-password-error').removeClass('display-none');
                }
            }
        });
    }
    function validForm(){
        $('.renew-password').removeClass('has-error');
        $('.msg_renewpassword_error').html('');
        if($('#newPassword').val() === $('#renewPassword').val()){
            updateChangePassword();
        } else {
            $('.renew-password').addClass('has-error');
            $('.msg_renewpassword_error').html('Xác nhận mật khẩu không khớp');
        }
    }
</script>