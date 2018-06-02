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
        $('#video-player, .video-control').hover(function(){
            $('.video-control').css('z-index', 1000);
        }, function(){
            if(!videoID.paused){
                $('.video-control').css('z-index', -1);
            }            
        });
	$('.btn-play').click(function(){
		if(videoID.paused){
			$('.btn-play').addClass('fa-pause');
			$('.btn-play').removeClass('fa-play');                    
			videoID.play();                        
		} else {
			$('.btn-play').addClass('fa-play');
			$('.btn-play').removeClass('fa-pause');
                        videoID.pause();
		}
	});
        $('.btn-replay').click(function(){
            videoID.currentTime = 0;
            if(videoID.paused){
                $('.btn-play').addClass('fa-pause');
                $('.btn-play').removeClass('fa-play'); 
                videoID.play(); 
            }
        });
});
function progressTime(){
   $('.current-time').html(fancyTimeFormat(videoID.currentTime));
   $('.progress-current-time').css('width',getRateCurrentPerDuration(videoID.currentTime, videoID.duration));
   if(videoID.currentTime === videoID.duration){
       $('.btn-play').addClass('fa-play');
       $('.btn-play').removeClass('fa-pause');
   }
   if(!videoID.paused){
       console.log('Video is playing ...');
       setTimeout(progressTime,900);
   } else {
       console.log('Video is stoped.');
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