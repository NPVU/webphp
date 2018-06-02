/* <video id = "video-player" /> */
var videoID = document.getElementById("video-player");
$(document).ready(function(){
        videoID.onloadstart = function(){          
          
        };
        videoID.onloadeddata = function() {
            $('.duration-time').html(fancyTimeFormat(videoID.duration));
            $('.video-control').css('z-index', 1000);            
        };
        videoID.onplaying = function(){
            progressTime();
        };
        $('#video-player').click(function(){
           playVideo();
        });
        $('#video-player, .video-control').hover(function(){
            $('.video-control').css('z-index', 1000);
        }, function(){
            if(!videoID.paused){
                $('.video-control').css('z-index', -1);
            }            
        });
	$('.btn-play').click(function(){
            playVideo();
	});
        $('.btn-replay').click(function(){
            videoID.currentTime = 0;
            if(videoID.paused){
                $('.btn-play').addClass('fa-pause');
                $('.btn-play').removeClass('fa-play'); 
                videoID.play(); 
            }
        });
        $('.btn-screen').click(function(){
            if (videoID.requestFullscreen) {
            videoID.requestFullscreen();
            } else if (videoID.mozRequestFullScreen) {
                videoID.mozRequestFullScreen();
            } else if (videoID.webkitRequestFullscreen) {
                videoID.webkitRequestFullscreen();
            }
        });        
});
function playVideo(){
    if(videoID.paused){
	$('.btn-play').addClass('fa-pause');
	$('.btn-play').removeClass('fa-play');                    
	videoID.play();                        
    } else {
	$('.btn-play').addClass('fa-play');
	$('.btn-play').removeClass('fa-pause');
        videoID.pause();
    }
}
function progressTime(){
   $('.current-time').html(fancyTimeFormat(videoID.currentTime));
   $('.progress-current-time').css('width',getRateCurrentPerDuration(videoID.currentTime, videoID.duration));
   if(videoID.currentTime === videoID.duration){
       $('.btn-play').addClass('fa-play');
       $('.btn-play').removeClass('fa-pause');
   }
   if(!videoID.paused){
       console.log('Video is playing ...');
       $('.btn-play').addClass('fa-pause');
       $('.btn-play').removeClass('fa-play');
       setTimeout(progressTime,100);
   } else {
       console.log('Video is stoped.');
       $('.btn-play').addClass('fa-play');
       $('.btn-play').removeClass('fa-pause');
   }
}
function fancyTimeFormat(time)
{   
    // Hours, minutes and seconds
    var hrs = ~~(time / 3600);
    var mins = ~~((time % 3600) / 60);
    var secs = Math.floor(time % 60);

    // Output like "1:01" or "4:03:59" or "123:03:59"
    var ret = "";

    if (hrs > 0) {
        ret += "" + hrs + ":" + (mins < 10 ? "0" : "");
    }

    ret += "" + mins + ":" + (secs < 10 ? "0" : "");
    ret += "" + secs;
    return ret;
}
function getRateCurrentPerDuration(current, duration){
    return parseFloat((current/duration)*100)+"%";
}