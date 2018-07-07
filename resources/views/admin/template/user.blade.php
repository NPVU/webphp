<div id="modal-avatar" data-izimodal-transitionin="fadeInDown">
    <div class="modal-body">        
        <div class="row">
            <div class="col-md-12 form-group notify-change-avatar-error has-error display-none">
                   <label class="control-label">
                       <i class="fa fa-times-circle-o"></i>
                       <span class="msg-change-avatar-error"></span>
                   </label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <input type="file" name="avatar" class="form-control display-none" id="selectFileAvatar"/>
                <div class="boxUpdateAvatar">
                    <img src="{{asset('public/img/themes/jquery-file-upload-scripts.png')}}" width="100%"
                         onclick="$('#selectFileAvatar').click()" 
                         class="img-select-file" id="imgDragDrop" ondrop="onDropFile();" ondrag="true"/>
                </div>                
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <button type="button" class="btn btn-danger" >Cập nhật</button>
            </div>
        </div>        
    </div>
</div>
<div id="modal-name" data-izimodal-transitionin="fadeInDown">
    <div class="modal-body">        
        <div class="row">
            <div class="col-md-12 form-group notify-change-display-username-error has-error display-none">
                   <label class="control-label">
                       <i class="fa fa-times-circle-o"></i>
                       <span class="msg-change-display-username-error"></span>
                   </label>
            </div>
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
    $('#modal-avatar').iziModal({
             overlayClose:false,
             width:500,
             onOpening: function(modal){
                 modal.startLoading();                 
             },
             onOpened: function(modal){
                 modal.stopLoading();                 
             },
             onClosing: function(modal){
                 $('.notify-change-avatar-error').addClass('display-none');                 
             }
    });
    $('#modal-avatar').iziModal('setTitle', 'Thay đổi ảnh đại diện');
    $('#modal-avatar').iziModal('setTop', 50);
    
    $('#modal-name').iziModal({
             overlayClose:false,
             onOpening: function(modal){
                 modal.startLoading();
                 $('#txtDisplayUserName').val('{{ Auth::user()->name }}');
             },
             onOpened: function(modal){
                 modal.stopLoading();                 
             },
             onClosing: function(modal){
                 $('.notify-change-display-username-error').addClass('display-none');                 
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
             },
             onClosing: function(modal){
                 $('#oldPassword').val('');$('#newPassword').val('');$('#renewPassword').val('');
                 $('.notify-change-password-success').addClass('display-none'); 
                 $('.notify-change-password-error').addClass('display-none');
                 $('.renew-password').removeClass('has-error');
                 $('.msg_renewpassword_error').html('');
             }
    });
    $('#modal-password').iziModal('setTitle', 'Thay đổi mật khẩu');
    $('#modal-password').iziModal('setTop', 100);
    
    function updateDisplayUserName(){       
        $.ajax({
            type: "GET",
            url: "{{url('/quan-ly/tai-khoan/doi-ten-hien-thi')}}/{{csrf_token()}}/"+$('#txtDisplayUserName').val(),
            success: function (data) {
              if(data.status === 1){
                    $('.displayUserName').html(data.msg);
                    $('#modal-name').iziModal('close');
              } else if(data.status === 0){                    
                    $('.msg-change-display-username-error').html(data.msg);
                    $('.notify-change-display-username-error').removeClass('display-none');                    
              }              
            }
        });
    }
    function updateChangePassword(){
        $.ajax({
            type: "GET",
            url: "{{url('/quan-ly/tai-khoan/doi-mat-khau')}}/{{csrf_token()}}/"+$('#oldPassword').val()+"/"+$('#newPassword').val(),
            success: function (data) {
                console.log(data);
                if(data.status === 1){
                    $('.notify-change-password-error').addClass('display-none');
                    $('.notify-change-password-success').removeClass('display-none');
                } else if(data.status === 0){
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