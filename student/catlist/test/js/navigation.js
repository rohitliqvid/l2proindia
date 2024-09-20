//global variables
$nModuleLen = 0;
$nTopicLen = 0;
$nPageLen = 1;
$nCurrPage = 0;
$nCurrModule=0;
$nCurrTopic = 0;
$nCurrTopicName = "";
$nCurrScore = 0;
$currentXML='';
$leftPanel = 0;
$nTotalAssessmentPages = 0;
$isCurrentTopicAssessment = 'no';
$assessmentTopicId=0;
$course=1;

$currentTopicObj ={};
$pageObj={};

arrModule = [];
arrTopic = [];
arrPage=[];
arrVisited = [];
var text_truncate;
//var vid = document.getElementById("audioId");
disableBack();
$(document).ready(function(){
 text_truncate = function(str, length, ending) {
    if (length == null) {
      length = 100;
    }
    if (ending == null) {
      ending = '...';
    }
    if (str.length > length) {
      return str.substring(0, length - ending.length) + ending;
    } else {
      return str;
    }
  };

   initSco()
    Bookmark_location = get_val("cmi.core.lesson_location");
    last_score = get_val("cmi.core.score.raw");
	//alert("last_score on start:"+last_score)
    
    if (Bookmark_location != "" && Bookmark_location != undefined && Bookmark_location != null ) {
      /*  var bookmark = confirm("Would you like to start from where you left?")
		if (bookmark) {
			$nCurrPage = Bookmark_location;
		}
		else {
			$nCurrPage = 0;
		} */
        
    }
    
	$.ajax({
    url: 'xml/course.xml',
    dataType: 'xml',
    success: function(data){
       $xml_node = $('course',data);
       readXml($xml_node);
	   //alert($xml_node);
     },
    error: function(data){
        console.log('Error loading XML data');
		//alert("here");
    }
    });
   
});

function readXml(xml_node)
{
  $course=$('#cn').html(xml_node.attr('courseName'));
  $leftPanel = xml_node.attr('leftPanel');
  module(xml_node);
  topic(xml_node);
  //page(xml_node);
  createMenu();
  loadPage();
  pageCounter();
  //getCurrentTopic()
}

function module(xml_node)
{
   $nModuleLen = $(xml_node).find("module").length;
   $(xml_node).find("module").each(function(){
       if($(this).find("topic").length){
        var obj = {
        "id": $(this).attr('id'),
		"moduleId": $(this).attr('id'),
        "moduleName":$(this).attr('moduleName'),
		"moduleFirstPageId":$(this).find("topic")[0].id,
       };
       arrModule.push(obj);
       }
	    
  });
  $moduleId =arrModule[$nCurrModule].id;
   $moduleName =arrModule[$nCurrModule].moduleName;
}
function topic(xml_node)
{
   $nTopicLen = $(xml_node).find("topic").length;
   $(xml_node).find("topic").each(function(){
      var l= $(this).find("page").length;
	  //alert(l) 
      if($(this).find("page").length){
        pageArr = [];
	   $(this).find("page").each(function(index, Element){
        var obj = {
       "id": $(this).attr('id'),
       //"pagename": $(this).find("pagename").text(),
	   "pagename": $(this).attr("pagename"),
	   "pageId": $(this).attr('id'),
	   "pageTitle": $(this).attr('name'),
       "topicId": $(this).parent().attr('id'),
       "topicName": $(this).parent().attr('name'),
       "pageNum": index+1
       };
	   
       pageArr.push(obj);
	  // alert(arrPage[0].pagename);
    });
	   var _obj = {
        "topicId": $(this).attr('id'),
        "topicName":$(this).attr('name'),
		"pagename":$(this).attr('pagename'),
		"istopicAssessment" :$(this).attr('isAssessment'),
        "nTopicPageLen":$(this).find("page").length,
        "topicFirstPageId":$(this).find("page")[0].id,
		"moduleId": $(this).parent().attr('id'),
        "moduleName": $(this).parent().attr('moduleName'),
		"childArr" : pageArr,
       };
       arrTopic.push(_obj);
	   
   }
   
  });
	$currentTopicObj = arrTopic[$nCurrTopic];
    arrPage = $currentTopicObj.childArr;
}

function page(xml_node)
{
    $nPageLen = $(xml_node).find("page").length;
    if( $nPageLen){
    $(xml_node).find("page").each(function(index, Element){
        var obj = {
       "id": $(this).attr('id'),
       //"pagename": $(this).find("pagename").text(),
	   "pagename": $(this).attr("pagename"),
	   "pageId": $(this).attr('id'),
	   "pageTitle": $(this).attr('name'),
       "topicId": $(this).parent().attr('id'),
       "topicName": $(this).parent().attr('name'),
       "pageNum": index+1
       };
	   
       arrPage.push(obj);
	  // alert(arrPage[0].pagename);
    });
    
    }
    
}

function createMenu(){
	
	   if($leftPanel == 0)
		{
		  $('.gn-menu-wrapper.gn-open-all').css('display','none');
		  $('.iframe').css('margin-left','0px');
		}
		   
		$.each( arrTopic, function( key, value ){
			var menu =text_truncate(value.topicName,30);
			$('.gn-menu').append('<li id='+value.topicId+' data-id='+value.topicId+' class="li"  title="'+value.topicName+'"><div class=topic><div class=name><span>+</span>'+menu+'</div></div></li><div id="collapse'+value.topicId+'"class="panel-collapse collapse"><ul id="sub'+value.topicId+'" class="sub-menu list-group" pid='+value.topicId+'></ul></div>');
			if(value.istopicAssessment=='yes')
			  {
			   $nTotalAssessmentPages=value.nTopicPageLen;
			   $assessmentTopicId=value.topicId;
			  } 
			  
		     $.each( value.childArr, function( i, v){
				 var submenu =text_truncate(v.pageTitle,30);
				$('#sub'+value.topicId).append('<li onclick="clickLiOption('+key+','+i+')" id="subli'+v.id+'" data-id='+v.id+' class="list-group-item" title="'+v.pageTitle+'">'+submenu+'</li>');
		     });
          
		   });
	  
		   $(".gn-menu li").on("click",function() {
			  $(".li").removeClass('active');
              $(".sub-menu > .list-group-item").removeClass('active');			  
			   var id=$(this).attr('id');   
			  $temp = $(this).attr('data-id');
				if($(this)){ 
					 $(this).addClass('active');
					 if($("#collapse"+id).hasClass('collapse')){
						$(".panel-collapse").addClass('collapse');
						$("#collapse"+id).removeClass('collapse');	
					 }else{
						 $(".panel-collapse").addClass('collapse');
						 $("#collapse"+id).addClass('collapse');	
					 }						
				 }else{
					$(".panel-collapse").removeClass('collapse');
				  }
				  //showTopic(value.moduleName,value.topicId,value.topicUrl);
				/* $.each( arrModule, function( key, value ) {
				   if(key == $temp){
					   $nCurrModule = value.moduleFirstPageId;
					 
				   }
				});
				 */
				   
	    });	 
	      $(".sub-menu li").on("click",function() {
			  //$(".list-group-item").removeClass('active');	
             $("#gn-menu").hide();		
		 
			  /* var id=$(this).attr('id');   
			   $temp = $(this).attr('data-id'); */
			/* $(this).addClass('active');
			  var tId = $(this).parent().attr('pid');
			  if($(this)){ 
			   $("#collapse"+tId).removeClass('collapse');
			   
			  } */

	   });
	   


}
  function showTopic(cModule,cTopic, cUrl){
	 location.href='./pages/'+cModule+'/'+cTopic+'/'+cUrl; 
	  
  }
 function clickLiOption(currTopic,currentPage)
 {   
	   $nCurrTopic= currTopic;
	   $currentTopicObj = arrTopic[currTopic]; 
	   arrPage = $currentTopicObj.childArr;
	   $nCurrPage =currentPage;
	    $pageObj =arrPage[currentPage];
		finalLoadPage();
 }	 
 /* function clickLiOption(currTopic)
 {
	   $nCurrTopic= currTopic;
	   $currentTopicObj = arrTopic[currTopic]; 
	   arrPage = $currentTopicObj.childArr;
	   $nCurrPage =0;
	    $pageObj =arrPage[0];
		$('.iframe').empty();
     $('.iframe').load('./pages/'+$moduleName+'/'+$currentTopicObj.topicId+'/'+$currentTopicObj.pagename).fadeIn('500');
 }	  */

 $( "#next" ).click(function() {
 //$("#back").removeClass("disabled-btn");
 //$(".animate").removeClass('fadeInLeft').addClass('fadeInRight');
  $nCurrPage++;
  loadPage();
 
  });
 
  $( "#back" ).click(function() {
   // $("#next").removeClass("disabled-btn");
  // $(".animate").removeClass('fadeInRight').addClass('fadeInLeft');
    $nCurrPage--;
    loadPage();
  
});

 function loadPage()
 {

   $pageObj = arrPage[$nCurrPage];

   if($nCurrPage == arrPage.length)
   {   
       $nCurrTopic= $nCurrTopic+1;
	   $currentTopicObj = arrTopic[$nCurrTopic]; 
		arrPage = $currentTopicObj.childArr;
	   $nCurrPage =0;
	    $pageObj = arrPage[$nCurrPage];
	  
   }
   else if($nCurrPage == -1)
   {
	   $nCurrTopic= $nCurrTopic-1;
	   $currentTopicObj = arrTopic[$nCurrTopic]; 
	   arrPage = $currentTopicObj.childArr;
	   $nCurrPage =arrPage.length-1;
	   $pageObj = arrPage[$nCurrPage];
	   
   }
   else{
	   
   }

	finalLoadPage();
 }
 function finalLoadPage(){
  if($nCurrTopic==0 && $nCurrPage==0) {
	 $("#back").removeClass("disabled-btn");  
	 disableBack()
	  
  }else if(arrTopic.length-1==$nCurrTopic && $nCurrPage==arrPage.length-1){
	   $("#next").removeClass("disabled-btn");
	   disableNext()
  }else{
	 enableNext()
     enableBack()
  }
   $pageId = $pageObj.id;
   $pageName = $pageObj.pagename;
   $pageTitle = $pageObj.pageTitle;
   $nCurrTopicName = $pageObj.topicName;
   $topicId =$pageObj.topicId;
   
  //alert('name: '+$pageTitle+' url: ./pages/'+$moduleName+'/'+$topicId+'/'+$pageName);

   $('.iframe').empty();
   $('.iframe').load('./pages/'+$moduleName+'/'+$topicId+'/'+$pageName).fadeIn('500');
    $("#gn-menu").hide();	

    $(document).ready(function () {
	 // var title=$('.titleLine').find('> span').html();
     // alert(title); 
	   $('.titleLine').find('> span').html($pageTitle);
     });
    pageCounter();
    setCompleteStatus();
 }
 


function enableNext()
{   $("#nextImg").attr("src", '');
    $("#next").attr("disabled", false);
	$("#next").removeClass("cursorNone");
	$("#nextImg").attr("src", 'media/images/next.png');
}

function disableNext()
{
	$("#nextImg").attr("src", '');
    $("#next").attr("disabled", true);
	$("#next").addClass("cursorNone");
	$("#nextImg").attr("src", 'media/images/nextDisable.png');
}

function enableBack()
{
	 $("#backImg").attr("src", '');
	 $("#back").removeClass("cursorNone");
     $("#back").attr("disabled", false);
	 $("#backImg").attr("src", 'media/images/back.png');
}

function disableBack()
{
   $("#backImg").attr("src", '');
   $("#back").addClass("cursorNone");
   $("#back").attr("disabled", true);
   $("#backImg").attr("src", 'media/images/backdisable.png');
}

 function pageCounter()
 {
     $('#counter').html($nCurrPage +" / " + $nPageLen);
     
 }

$("#exit").click(function(){
    
   // alert("On Exit: "+$nCurrScore);
    var close = confirm("Are you sure you want to exit the course?")
if (close) {
    finish();
	//top.close();
	document.location.href="close.html?close=1";
	
}

});


function setCompleteStatus()
{
  
   if(arrVisited.toString().indexOf(0) == -1)
   {
       //alert('sss');
       set_val("cmi.core.lesson_status", "completed");
    }
    else
    {
       //alert('not completed');
    }
}
/*
function search(array, key, prop){
    // Optional, but fallback to key['name'] if not selected
    prop = (typeof prop === 'undefined') ? 'name' : prop;    

    for (var i=0; i < array.length; i++) {
        if (array[i][prop] === key) {
            return array[i];
        }
    }
}*/
