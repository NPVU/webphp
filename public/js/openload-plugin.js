var key         = "bvLaLh9-";
var login       = "d6e334799f9a673d";
var fileID      = "XTF_HzjcVWo";
var ticket      = "";
var captcha_url = "";
var website     = "http://192.168.1.6/";

function getTicket(){
    $("#messageErrorCaptcha").addClass("display-none");
    $("#txtCaptcha").val("");
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", website+"webphp/public/services/ticket/" + fileID + "/" + login + "/" + key, false);
    xhttp.send();
    var response = JSON.parse(xhttp.responseText);
    console.log(response);
	if(response.result.captcha_url === false){
		ticket = response.result.ticket;
		getVideo();
	} else if((captcha_url !== response.result.captcha_url)){
            $('#modal-captcha').iziModal('open');
            captcha_url = response.result.captcha_url;
            $("#captcha").attr("src", captcha_url);    
            ticket = response.result.ticket;   
            $("#iconLoadingCaptcha").addClass("display-none");
    } else {
        $("#iconLoadingCaptcha").removeClass("display-none");
        setTimeout(getTicket,1000);
    }
}

function getVideo(){
    var txtCaptcha = $("#txtCaptcha").val();
    if(!txtCaptcha){
        console.log("txtCaptcha is null");
        txtCaptcha = "null";
    }
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", website+"webphp/public/services/download/" + fileID + "/" + ticket + "/" + txtCaptcha, false);
    xhttp.send();
    var response = JSON.parse(xhttp.responseText);
    console.log(response);
    if(response.status === 200){
        $("#messageErrorCaptcha").addClass("display-none");
        $("#video-player").attr("src", response.result.url);        
        $('#modal-captcha').iziModal('close');
        $('#modal-video').iziModal('open');
    } else {
        $("#messageErrorCaptcha").removeClass("display-none");
        return false;
    }  
}
function refreshCaptcha(){
    $("#btnRefreshCaptcha").click();
}

$('#video-player').mousemove(function(){
    showToast();
    var toast = document.querySelector('#toastVideoControl');
    iziToast.progress({}, toast).pause();
});
$('#video-player').click(function(){
    showToast();
    var toast = document.querySelector('#toastVideoControl');
    iziToast.progress({}, toast).pause();
});
function showToast(){
    iziToast.show({
    id:'toastVideoControl',
    theme: 'dark',
    icon: 'icon-person',
    title: 'Điều khiển',
    toastOnce: true,
    target:'.video-control',
    message: '',
    resetOnHover: true,
    position: 'bottomLeft', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
    progressBarColor: 'rgb(0, 255, 184)',
    buttons: [
        ['<button><i class="fa fa-play"></i></button>', function (instance, toast) {
            alert("Hello world!");
        }, true],
        ['<button><i class="fa fa-redo"></i></button>', function (instance, toast) {
            alert("Hello world!");
        }, false],
        ['<button><i class="fa fa-volume-up"></i></button>', function (instance, toast) {
            alert("Hello world!");
        }, false],
        ['<button><i class="fab fa-whmcs"></i></button>', function (instance, toast) {
            alert("Hello world!");
        }, false],
        ['<button><i class="fa fa-expand"></i></button>', function (instance, toast) {
            alert("Hello world!");
        }, false]
    ],
    onOpening: function(instance, toast){
        console.info('callback abriu!');
    },
    onClosing: function(instance, toast, closedBy){
        console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
    }
});    
}
