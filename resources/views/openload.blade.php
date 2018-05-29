<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="{{ app()->getLocale() }}">
    @include('template.head') 
    <body>        
        <button onclick="getTicket()">view video</button>           
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
                                title="Làm mới mã xác nhận" onclick="getTicket()"/>                                                    
                        <button type="button" class="btn btn-outline-secondary fa fa-2x fa-check-circle btn-api-video" title="Xác nhận" onclick="getVideo()"/>                                                                         
                    </div>
                </div>                         
            </div>
        </div>
        <div id="modal-video" class="display-none" data-izimodal-transitionin="fadeInDown">
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="video-player">
                            <video id="video-player" src="" width="100%" poster="{{ asset('img/poster-video.png') }}"></video>                             
                        </div>
                        <div class="video-control">
<!--                            <div class="player-control btn-play ">
                                <i class="fa fa-play-circle"></i>
                            </div>
                            <div class="player-control btn-replay ">
                                <i class="fa fa-redo-alt"></i>
                            </div>
                            <div class="player-control btn-volume">
                                <i class="fa fa-volume-up"></i>
                            </div>
                            <div class="player-control btn-setting">
                                <i class="fab fa-whmcs"></i>
                            </div>
                            <div class="player-control btn-screen">
                                <i class="fa fa-expand"></i>
                            </div>-->
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="list-episode">
                            <div class="title">
                                Danh sách tập
                                <span>19/24</span>
                            </div>
                            
                            <ul>
                                <li>
                                    <img src="http://images6.fanpop.com/image/photos/38700000/esdeath-akame-ga-kill-anime-girl-art-picture-sword-edsese-esdeath-38784542-1920-1080.jpg" >
                                    <h5>The Grasslands</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent euismod ultrices ante, ac laoreet nulla vestibulum adipiscing. Nam quis justo in augue auctor imperdiet.</p>
                                </li>

                                <li>
                                    <img src="http://images6.fanpop.com/image/photos/38700000/esdeath-akame-ga-kill-anime-girl-art-picture-sword-edsese-esdeath-38784542-1920-1080.jpg" >
                                    <h5>Paradise Found</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent euismod ultrices ante, ac laoreet nulla vestibulum adipiscing. Nam quis justo in augue auctor imperdiet.</p>
                                </li>

                                <li>
                                    <img src="http://images6.fanpop.com/image/photos/38700000/esdeath-akame-ga-kill-anime-girl-art-picture-sword-edsese-esdeath-38784542-1920-1080.jpg" >
                                    <h5>Smoke On The Water</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent euismod ultrices ante, ac laoreet nulla vestibulum adipiscing. Nam quis justo in augue auctor imperdiet.</p>
                                </li>

                                <li>
                                    <img src="http://images6.fanpop.com/image/photos/38700000/esdeath-akame-ga-kill-anime-girl-art-picture-sword-edsese-esdeath-38784542-1920-1080.jpg" >
                                    <h5>Headline</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent euismod ultrices ante, ac laoreet nulla vestibulum adipiscing. Nam quis justo in augue auctor imperdiet.</p>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="chaxbox">
                            1312421
                        </div>
                    </div>
                </div>

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
</html>
