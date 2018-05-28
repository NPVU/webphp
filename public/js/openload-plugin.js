var key         = "bvLaLh9-";
var login       = "d6e334799f9a673d";
var fileID      = "wRXaJ75lVtM";
var ticket      = "";
var captcha_url = "";

function getTicket(){
    $("#messageErrorCaptcha").addClass("display-none");
    $("#txtCaptcha").val("");
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "http://192.168.1.6/webphp/public/services/ticket/" + fileID + "/" + login + "/" + key, false);
    xhttp.send();
    var response = JSON.parse(xhttp.responseText);
    console.log(response);
    if(captcha_url !== response.result.captcha_url){
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
    xhttp.open("GET", "http://192.168.1.6/webphp/public/services/download/" + fileID + "/" + ticket + "/" + txtCaptcha, false);
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

function showToast(){
    iziToast.info({
    timeout: 20000,
    overlay: false,
    toastOnce: true,
    id: 'inputs',
    zindex: 999,   
    position: 'center',
    drag: false,
    inputs: [
        ['<img id="toastCaptcha" src="">', 'keydown', function (instance, toast, input, e) {
            console.info(input.value);
        }],
        ['<input id="toastTxtCaptcha" type="text">', 'keyup', function (instance, toast, input, e) {
            console.info(input.value);
        }, true],
        ['<input type="button" onclick="getVideo()" value="send">', 'click', function (instance, toast, input, e) {
            
        }, true]
    ]
    });
}