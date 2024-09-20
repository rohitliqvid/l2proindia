function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    if(typeof exdays != 'undefined'){
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+d.toUTCString();
    }else{
        expires = '';
    }
    
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function deleteCookie(cname){
    document.cookie = cname+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
}


function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}

function  checkInternet(){
    
    if( typeof internet_status != 'undefined' ){
        if( internet_status === 1 ){
            return true;
        }
    }
    
    return false;
}

function updateInternetStatus(){
    
    $.ajax({
        url: "http://www.google.com",
        context: document.body,
        async : true,
        error: function(jqXHR, exception) {
            internet_status = 0;
            updateInternetStatus();
        },
        success: function() {
           internet_status = 1;
           updateInternetStatus();
        }
    });
    
    console.log(internet_status);
}


/*  overview popup   */
function overviewPopup(){
    $("#overviewModel").modal({backdrop: "static"});
}

function showLoader(){
	$("#loaderDiv").delay(0).fadeIn();
}

function hideLoader(){
	$("#loaderDiv").delay(0).fadeOut();
}
$(document).ready(function(){

  $("#preLoaderPage").delay(0).fadeOut();
  $("#loaderDiv").delay(0).fadeOut();
});
/*  common msg /alert popup   */
function alertPopup(msg){
    $("#common-msg-text").text(msg);
    $("#common-msg").modal({backdrop: "static"});
}

function exitFullScreen(){
    
    
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    }
    
    
}

/*    right click stop with hide crt + shift+i,crt + shift+c and f12      */
var showContextmenu = 1;

if(showContextmenu==0){
	$(document).ready(function(){
		$(this).bind("contextmenu", function() {
			//e.preventDefault();
			return false;
		});
	
    });
	
}
else if(showContextmenu==1){
	$(document).ready(function(){
		$(this).bind("contextmenu", function() {
			//e.preventDefault();
			return true;
		});
	
    });
	
}

$(document).keydown(function(event){
    if(event.keyCode==123){
    return false;
   }
else if(event.ctrlKey && event.shiftKey && event.keyCode==73){        
      return false;  //Prevent from ctrl+shift+i
   }
   else if(event.ctrlKey && event.shiftKey && event.keyCode==67){        
      return false;  //Prevent from ctrl+shift+i
   }
});