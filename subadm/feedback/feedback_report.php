<?php include ('../intface/adm_top.php'); ?>

<!-- mid section -->
	
<section id="content" class="">
<div id="loaderDiv" class="loadBg"><img src="../../assets/images/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>

<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Feedback Report</strong></span> </div>
		 
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
		<a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:history.go(-1);" target="_self" title="Go back" class="btn pull-right m-b-xs">Back</a></div>
  </div>
  
  
</section>
<?php
$con=createConnection();

$query3 = "SELECT * FROM tbl_feedback_category";
$cresult = mysqli_query($con,$query3);
$cnum=mysqli_num_rows($cresult);
?>
<!--<section class="panel panel-default">
		   <div class="rightHead text-center bgWt">  <div class="col-md-12 col-sm-12 buildcourse text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a  class="btn btn-lg btn-default" id="btnBuildCourse" name="btnBuildCourse"> <i class="build fa fa fa-edit"></i> Add New App</a> 
			  </div>
			 </div>
	</section>-->
			
			 <section class="panel panel-default  theadHeight">
			
			  <div class="panel row teacher-student-wrap theadHeight newcourse">
				<div class="divider"></div>
				<div class="col-lg-9 col-md-9 col-sm-9">
				
				</div> 
			  <div class="col-lg-3 col-sm-3 col-md-3"> 
				  
				  <select id="feedbackCat" name="feedbackCat"  onchange="feedbackList(this.options[this.selectedIndex].value);" class="form-control ">
					<option value="">Select Category</option> 
					<?
					$i=0;
					while ($i < $cnum) {

					$row = mysqli_fetch_assoc($cresult);
					$id = $row['id'];
					$catid=$row['id'];
					$catname=$row['name'];
					if($catid==$company_id)
					{
					$selStr1="selected";
					}
					else
					{
					$selStr1="";
					}
					?>
						<OPTION value="<?php echo $catid; ?>" <?=$selStr1?>><? echo $catname; ?></OPTION>
					<?
					$i++;
					}	
					?>   
				</select>
			  </div>
			   </div>	 
			<!--Responsive grid table -->
	</section>	
	

  <section class="scrollable padder">
<section class="panel-default panelgridBg">
			 
			 <div class="panel row teacher-student-wrap">
			
			<!--Responsive grid table -->
             <div class="table-responsive promo courseGroup">
				<!-- ####### Show table Grid -->
				<div id='feedback_list' class='content' name='feedback_list' style="height:auto;overflow:auto"></div>
			</div>


</div>		
		
           </div></section>
  
  </section>	    <!--end right  content bar -->
   
    <!--start save  -->
      
<?php
include ('../intface/footer.php');
?>
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
makeRequest('ajaxreport.php?action=get_feedback_list&fcat='+fcat,"feedback_list",num);
}


function DeleteFeedback(num)
{
makeRequest('ajaxreport.php?action=get_feedback_list&id='+num,"feedback_list",num);
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
