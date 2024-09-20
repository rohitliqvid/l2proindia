function beginSlider() {
	  $("#introMainDiv").hide();
	  $("#sliderMainDiv").show();
	 
}
function show(cid,tid){
 $("#"+cid).hide(); 
 $("#"+tid).show();
}

var winHt,winWd,docH,docWd,srnWd,srnHt,midHeight,backnextTop,marginTop,midImgContent,imgContent,midBgContent,imgRight,spanTitle;

function winResize(){
	winHt=$(window).height();
	winWd=$(window).width();
	docHt=$(document).height();
	docWd=$(document).width();
	srnWd = screen.width;
	srnHt = screen.height;
	spanTitle= $(".skew > span").height(); 
	if(winWd > 991){
		midHeight=winHt-65;
		backnextTop=midHeight/2;
		marginTop=midHeight/5;
		midBgContent =midHeight-60;
		midContent =midHeight-120;
		midDivContent =midContent-20;
		midImgContent =midContent/4;
		imgContent =midContent/2;
		$(".popupImgBg").css("height","70%");
	   //alert(midContent)
	   
		//$(".contentBg").css("height",midContent+"px"); 
		//$(".popupMarginTop").css("margin-top",marginTop+"px"); 
		//$(".introBgImg").css("max-height",midHeight+"px"); 
		//$(".contentDiv").css("max-height",midDivContent-10+"px"); 
		//$(".popupImgRightBg").css("height",midContent+"px");
		//$(".popupImgBg").css("height","70%");
	   // $(".contentImgDiv").css("height","30%");
		//$(".contentImgDiv").css("height","20%");
       // $(".imgBottom").css("height","100%"); 
	$(".title,.skew").css("height",spanTitle+"px"); 
	$(".containMainDiv").css("height",midHeight+"px");
	$(".containDiv").css("height",midHeight+"px");
	$(".iframe").css("height",midHeight+"px");
	$(".backNext").css("top",backnextTop+"px"); 
	$(".introBgImg").css("height",midHeight+"px");
	$(".contentBg").css("height",midBgContent+"px"); 
   	$(".contentDiv").css("height","auto"); 
	//$(".contentWithOutBdr").css("height","15%");
	$(".contentLeftDiv").css("height","100%");
	
	  
	}
	else{ 
	  
		midHeight=winHt-46;
		backnextTop=midHeight/2;
		marginTop=midHeight/5;
		midBgContent =midHeight-20;
		midContent=midHeight-spanTitle;
		midContent =midContent-20;
		midDivContent =midContent-20;
		midImgContent =midContent/4;
	    imgContent =midContent/2;
		$(".popupImgBg").css("height","70%");
	
		//$(".contentLeftDiv").css("height","auto");
		
	$(".title,.skew").css("height",spanTitle+5+"px"); 
	$(".containMainDiv").css("height",midHeight+"px");
	$(".containDiv").css("height",midHeight+"px");
	$(".iframe").css("height",midHeight+"px");
	$(".backNext").css("top",backnextTop+"px"); 
	$(".introBgImg").css("height",midHeight+"px");
	$(".contentBg").css("height",midBgContent+"px"); 
   	$(".contentDiv").css("height",midContent-20+"px"); 


	} 
	
     //alert(midContent) 

	 
   }

$(window).resize(function(){
  winResize();
  
});
 winResize();
$(document).ready(function(){

});
window.onresize = function (event) {
  applyOrientation();
}

function applyOrientation() {
  if (window.innerHeight > window.innerWidth) {
    console.log("You are now in portrait");
	winResize();
	spanTitle= $(".skew > span").css("min-height"); 
	$(".title,.skew").css("height",spanTitle+5+"px"); 

  } else {
    console.log("You are now in landscape");
	winResize();
	spanTitle= $(".skew > span").height(); 
	$(".title,.skew").css("height",spanTitle+"px"); 
  }
}



 function menuBar(){
	  $(".gn-menu").slideToggle();
	}
function showMode(cid,tid){
	  $("#"+cid).hide(); 
      $("#"+tid).show();
	  $(".logo").hide();

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
