<?php include ('../intface/std_top.php'); ?>

<!-- mid section -->
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="keywords" content="e-learning, Intellectual Property, IP, Qualcomm, L2Pro, Patents, Standard Essential Patents, Industrial design, Confidential information, Inventions, Moral rights, Works of authorship, Service marks, Logos, Trademarks, Design rights, Commercial secrets, NDAs, Non-Disclosure Agreement, Start-ups">
      <meta name="language" content="en" />
      <title>L2Pro India</title>
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <link href="../../assetsnewdesign/css/style.css" rel="stylesheet">
   </head>
   <body>
      <!-- Navbar Start -->
      <div class="container-fluid navbg">
         <div class="container">
         <?php include('../intface/std_left.php');  ?>
         </div>
      </div>
	  <div id="loaderDiv" class="loadBg"><img src="../../assets/images/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
      <!-- Navbar End -->
      <!-- Carousel Start -->
      <div class="container-fluid page-header py-5">
         <div class="container text-center py-5">
            <h1 class="display-2 text-white mb-4 animated slideInDown">Feedback</h1>
            <nav aria-label="breadcrumb animated slideInDown">
               <ol class="breadcrumb justify-content-center mb-0">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Feedback</li>
               </ol>
            </nav>
         </div>
      </div>
      <!-- Carousel End -->
      <!-- Services Start -->
      <div class="container-fluid services py-5">
         <div class="container">
           <div class=" pb-5 wow fadeIn" data-wow-delay=".3s" ">
               <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  pb-2 mb-3  border-bottom ">
                  <h1 class="text-primary">Feedback</h1>
                  <div>        <a href="feedback.php" class="pull-right btn btn-primary  btn-sm ">Back</a></div>
               </div>

			   <!--Responsive grid table -->
			   <div class="table-responsive promo courseGroup">
				<!-- ####### Show table Grid -->
				<div id='feedback_list' class='content' name='feedback_list' style="height:auto;overflow:auto"></div>
			</div>
         </div>
         </div>
      </div>


</div>		
		
       
<?php
include ('../intface/std_footer.php');
?>
   </body>
   </html>
<script>
$(window).load(function() {
 // executes when complete page is fully loaded, including all frames, objects and images
var fcat='';
feedbackList(fcat);
});
</script>
<SCRIPT language="JavaScript" src="fvalidate.js"></SCRIPT>
<script type="text/javascript" language="javascript">
var http_request = false;
var tempTxt;
var varid;
function makeRequest(url,txt,ids) {
	showLoader();
http_request = false;
tempTxt=txt;
varid=ids;
if (window.XMLHttpRequest) { // Mozilla, Safari,...
http_request = new XMLHttpRequest();
if (http_request.overrideMimeType) {
http_request.overrideMimeType('text/xml');
// See note below about this line
}
} else if (window.ActiveXObject) { // IE
try {
http_request = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
try {
http_request = new ActiveXObject("Microsoft.XMLHTTP");
} catch (e) {}
}
}

if (!http_request) {
alertify.alert('Giving up :( Cannot create an XMLHTTP instance');
return false;
}

http_request.onreadystatechange = alertContents;
http_request.open('GET', url, true);
http_request.send(null);
hideLoader();
}

function alertContents() {
if (http_request.readyState == 4) {
if (http_request.status == 200) {


if(tempTxt == "feedback_list")
{

	
	//alert(http_request.responseText);
	document.getElementById("feedback_list").innerHTML=http_request.responseText;
	

}
} 
else {
alertify.alert('There was a problem with the request.');
}
}
}

function feedbackList(fcat)
{
var num=1;
makeRequest('./ajaxreport.php?action=get_feedback_list&fcat='+fcat,"feedback_list",num);
}


function DeleteFeedback(num)
{
makeRequest('./ajaxreport.php?action=get_feedback_list&id='+num,"feedback_list",num);
}

function sendReply(f_id)
{
 var winleft = (screen.width - 550) / 2;
 var wintop = (screen.height - 400) / 2;
var srcfile="reply.php?fid="+f_id;
 var mtiwin=window.open(srcfile,'replywin',"top="+wintop+",left="+winleft+",status=no,toolbar=no,width=550,height=400,resizable=no");
}

function viewHistory(feed_id)
{
 var winleft = (screen.width - 1024) / 2;
 var wintop = (screen.height - 768) / 2;
var srcfile="feedback_history.php?fid="+feed_id;
 var mtiwin=window.open(srcfile,'hiswin',"top="+wintop+",left="+winleft+",status=no,toolbar=no,width=1024,height=768,resizable=no");
}

</script>



<script>

//function to clear all the input fields (not used)
function clearFields()
{
////Commmented to retain the values when the user returns back to modify the details

}

</script>
