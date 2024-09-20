//global variables
$nTopicLen = 0;
$nPageLen = 1;
$nCurrPage = 1;
$nCurrTopic = 0;
$nCurrTopicName = "";
$nCurrScore = 0;
$currentXML='';
$leftPanel = 0;
$nTotalAssessmentPages = 0;
$isCurrentTopicAssessment = 'no';
$assessmentTopicId=0;


arrTopic = [];
arrPage=[];
arrVisited = [];

//var vid = document.getElementById("audioId");
disableBack();
$(document).ready(function(){
   initSco()
    Bookmark_location = get_val("cmi.core.lesson_location");
    last_score = get_val("cmi.core.score.raw");
	//alert("last_score on start:"+last_score)
    
    if (Bookmark_location != "" && Bookmark_location != undefined && Bookmark_location != null ) {
    var bookmark = confirm("Would you like to start from where you left?")
if (bookmark) {
    $nCurrPage = Bookmark_location;
}
else {
    $nCurrPage = 1;
}
        
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
  $('#cn').html(xml_node.attr('courseName'));
  $leftPanel = xml_node.attr('leftPanel')
  topic(xml_node);
  page(xml_node);
  createMenu();
  loadPage();
  pageCounter();
  getCurrentTopic()
}

function topic(xml_node)
{
   $nTopicLen = $(xml_node).find("topic").length;
   $(xml_node).find("topic").each(function(){
       if($(this).find("page").length){
       if($(this).find("page").length){
        var obj = {
        "topicId": $(this).attr('id'),
        "topicName":$(this).attr('name'),
		"istopicAssessment" :$(this).attr('isAssessment'),
        "nTopicPageLen":$(this).find("page").length,
        "topicFirstPageId":$(this).find("page")[0].id
       };
       arrTopic.push(obj);
   }
       }
});
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
       "topicId": $(this).parent().attr('id'),
       "topicName": $(this).parent().attr('name'),
       "pageNum": index+1
       };
	   
       arrPage.push(obj);
	  // alert(arrPage[0].pagename);
    });
    
	/*for(i=0;i<$nPageLen;i++)
    {
        arrVisited[i] = 0;
    }
    
	visited_pages = get_val("cmi.suspend_data");
    arrTemp =  visited_pages.split(",");
     for(i=0;i<arrTemp.length;i++)
    {
        arrVisited[i] = arrTemp[i]
    }*/
    }
    
}

function createMenu(){
	   if($leftPanel == 0)
		{
		  $('.gn-menu-wrapper.gn-open-all').css('display','none');
		  $('.iframe').css('margin-left','0px');
		}
		 
		$.each( arrTopic, function( key, value ){
			  
			$('.gn-menu').append('<li id='+key+' data-id='+key+' class="li "><div class=topic><div class=name>'+value.topicName+'</div></div></li>');
			  if(value.istopicAssessment=='yes')
			  {
			   $nTotalAssessmentPages=value.nTopicPageLen;
			   $assessmentTopicId=value.topicId;
			  }
		 });
	   $(function() {
		   $(".gn-menu li").on("click",function() {
			  $(".li").removeClass('active');
			 var id=$(this).attr('id');   
			 $temp = $(this).attr('data-id');
			  if(id==$temp){
				$(this).addClass('active');  
			  }
		      $.each( arrTopic, function( key, value ) {
			 
			 // $(".gn-menu li:nth-child("+$nCurrPage+")").addClass("active");

   // alert($temp);
			  if(key == $temp)
			  {
				   $nCurrPage = value.topicFirstPageId;
				   //alert("currPage :"+$nCurrPage);
				  
				   loadPage();
			  }
		  });
	   });
	});

}
function loadAudio($audioPath)
{
   
 $("#audioToggle").prop('checked',true);
 vid.pause();

  vid.src = $audioPath;
  vid.play();
   
}

$("#audioToggle").change(function() {
   
        if($(this).prop('checked') == false)
        {
            //$('#audioId')[0].pause();
         audioPause();
        }
        else
        {
           // $('#audioId')[0].play();
           audioPlay();
            
        }
    }); 
        
function  audioPause()
{
       vid.pause();
}

 function  audioPlay()
{
       vid.pause();
}

 $( "#next" ).click(function() {
 $("#back").removeClass("disabled-btn");
 $nCurrPage++;
  loadPage();
 
  });
 
  $( "#back" ).click(function() {
    $("#next").removeClass("disabled-btn");
    $nCurrPage--;
    loadPage();
  
});

 function loadPage()
 {
   //arrVisited[$nCurrPage-1] = 1;
   //set_val("cmi.core.lesson_location", $nCurrPage);
   //set_val("cmi.suspend_data", arrVisited.toString());

   $pageId = arrPage[$nCurrPage-1].id;
   $pageName = arrPage[$nCurrPage-1].pagename;
   $nCurrTopicName = arrPage[$nCurrPage-1].topicName;
   $('.iframe').empty();
   var topic=$(".gn-menu li > .topic > .name").text();
  
    if(topic==$nCurrTopicName){
		var id=$(".name").closest("li").attr('id');
		 // alert(id);
	}
    //alert($nCurrTopicName);
   $('.iframe').load('./pages/'+$pageName).fadeIn('500');
   
    if($nCurrPage  == 1 )
    {
        disableBack();
        enableNext();
    }
    else if($nCurrPage == $nPageLen)
    {
        disableNext();
        enableBack();   
    }
    else
    {
        enableBack();
        enableNext();
    }
    pageCounter();
    getCurrentTopic();
    setCompleteStatus();
 }
 
function getCurrentTopic()
{
    $.each( arrPage, function( key, value ) {
		if(key == $nCurrPage-1)
		{
		  $nCurrTopic = value.topicId;
		  
		}
		$(".gn-menu li:nth-child("+key+")").removeClass("li-disabled");
    });
	
    $(".gn-menu li:nth-child("+$nCurrTopic+")").addClass("li-disabled");
	
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
	top.close();
	
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