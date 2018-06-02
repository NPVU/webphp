<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="{{ app()->getLocale() }}">
    @include('template.head') 
    <body>        
        <div onclick="getTicket()" data-toggle="tooltip" title="xem video">view video</div>           
        <div id="modal-captcha" class="display-none" data-izimodal-transitionin="fadeInUp">            
            <div class="modal-body">                
                <div>
                    <img id="captcha" src="" alt="captcha" data-toggle="tooltip" data-placement="right" title="Mã xác nhận" width="25%"/> 
                    <i id="iconLoadingCaptcha" class="fa fa-refresh fa-spin display-none" data-toggle="tooltip" data-placement="top" title="Loading..."></i>                                                   
                    <label id="messageErrorCaptcha" class="text-danger display-none">Mã xác nhận không đúng, vui lòng nhập lại !</label>
                </div>
                <div class="input-group">
                    <input type="text" id="txtCaptcha" class="form-control" placeholder="Nhập mã xác nhận" aria-label="Nhập mã xác nhận" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary fa fa-2x fa-redo-alt"                                
                                title="Làm mới mã xác nhận" onclick="getTicket()"
                                data-toggle="tooltip"/>                                                    
                        <button type="button" class="btn btn-outline-secondary fa fa-2x fa-check-circle btn-api-video" title="Xác nhận" onclick="getVideo()"/>                                                                         
                    </div>
                </div>                         
            </div>
        </div>
        <div id="modal-video" class="display-none" data-izimodal-transitionin="fadeInDown">
            <div class="modal-body">
                @include('plugin.video')
            </div>
        </div>        
    </body>   
    
    <script>                        
         $('#modal-captcha').iziModal({
             overlayClose:false,
             onOpening: function(modal){
                 modal.startLoading();                 
             },
             onOpened: function(modal){
                 modal.stopLoading();                 
             }
         });
         $('#modal-captcha').iziModal('setTitle', 'Nhập captcha để xem video');
         $('#modal-captcha').iziModal('setTop', 100);                  
         
         $('#modal-video').iziModal({
             fullscreen: true,
             overlayClose:false,
             onOpening: function(modal){
                 modal.startLoading();                  
             },
             onOpened: function(modal){
                 modal.stopLoading();
             }
         });
         $('#modal-video').iziModal('setTitle', 'Xem video trực tuyến');
         $('#modal-video').iziModal('setFullscreen', true);           
    </script>
    
    <script type="text/javascript" src="{{ asset('js/openload-plugin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/video-player.js') }}"></script>
</html>
