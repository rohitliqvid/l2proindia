
$correctAns = 0;
$selectedAns = 0;
 
$(document).ready(function() {
      $.ajax({
    //url: parent.$currentXML,
	url: $currentXML,
   
    dataType: 'xml',
    success: function(data){
       $xml_node = $('page',data);
       readXml($xml_node);
     },
    error: function(data){
        console.log('Error loading XML data');
    }
		
});


});

$('.alert-close').on('click', function(c){
		$(this).parent().fadeOut('slow', function(c){
		});
            });
function readXml(xml_node)
{
 
$('#submit').prop('disabled', true);
   $('.header').html(xml_node.attr('name'));
   $('#quesText').html(xml_node.find('ques-text').text());
   $correctAns = xml_node.find('options').attr('ans');
  
   $audioPath = xml_node.attr('audio');
   $(xml_node).find("option").each(function(index, Element){
     $optText =  $(this).text();
      $('.options ul').append('<li> <span class=rightWrong ><img id=rightwrong'+index+' src=media/images/right.png></span><span class=spnRadioContainer> <input data-id='+index+' value='+index+' type=radio class=radio id =radio'+index+' name =radio>  </span><label>'+$optText+'</label></li>');
   });
   $('input[type="radio"]').on('click', function(e) {
 $('#submit').prop('disabled', false);
 $selectedAns = $(this).attr('data-id');
});


 $mediaType = $xml_node.find('media').attr('type');
        $mediaPath = $xml_node.find('media').text();
        $pagePos = $xml_node.attr('position');
         $audioPath = $xml_node.attr('audio');
         if($audioPath!="")
            {
               //parent.loadAudio($audioPath);
			   loadAudio($audioPath);
            }
        if( $mediaPath =="")
        {
             $('.media').css('display','none');
        }
        if($mediaType == 'image')
        {
           $('#video').css('display','none');
           $("#img").attr("src", $mediaPath);
        }
        else
        {
           var vid= document.getElementById('video');
            vid.src = $mediaPath;
            //vid.play();
            $('#img').css('display','none');
        }
      
        
        $('.options').css('float',$pagePos.split('-')[0]);
        $('.media').css('float',$pagePos.split('-')[1]);
      
  }


$('#submit').on('click', function() {
   
     $('#submit').prop('disabled', true);
	
   if($correctAns == $selectedAns) 
   {
       //if(parent.$nCurrTopicName != "Assessment"){

		   //$nCurrTopicName = arrPage[$nCurrPage-1].topicName;
		   //alert($isCurrentTopicAssessment);
		  // alert("$assessmentTopicId: "+$assessmentTopicId+"\ncurTopic: "+$nCurrTopic);
		if($nCurrTopic != $assessmentTopicId){
		//if($nCurrTopicName != "Assessment"){
        $('.feedback-container').css('display','block');
        $('.feedback-content').html('correct');
		}
		else
        {
           //parent.$nCurrScore++;
		$nCurrScore++;
		//alert($nCurrScore);
             $('.feedback-container').css('display','none');
        //$('.feedback-content').html('correct');

        }
               
   }
   else
   {
      
       //if(parent.$nCurrTopicName != "Assessment"){
		   if($nCurrTopic != $assessmentTopicId){
		//if($nCurrTopicName != "Assessment"){
            
      $('.feedback-container').css('display','block');
        $('.feedback-content').html('incorrect');
}
else
{
      $('.feedback-container').css('display','block');
        $('.feedback-content').html('incorrect');
}
       
   }
  
     $("input[type=radio]").attr('disabled', true);
});



