<?php
//session_start();
include("lib.php");
//$userid=$_SESSION['sess_uid'];

/*$result = mysql_query ("SELECT * FROM tbl_users where username='$userid'"); 
$num=mysql_numrows($result);
$uid=mysql_result($result,0,"id");*/

$stmt = $con->prepare("SELECT id FROM tbl_users where username=?");
$stmt->bind_param("s",$userid);
$stmt->execute();
$stmt->bind_result($uid);
$stmt->fetch();
$stmt->close();


$cid=$_REQUEST['cid'];
$scoid=$_REQUEST['scoid'];
$mode='normal';
//$userid=get_userid($uid);
$scorm=get_scorm_data($scoid);
$scorm_sco=get_scorm_sco_data($scoid);
$scorm_sco_track=get_scorm_sco_track_data($uid,$scoid);
$modestring = '&mode='.$mode;
$scoidstring = '&scoid='.$scoid.'&uid='.$uid;
$currentorg = $scorm_sco['organization'];

$currentorgstring = '&currentorg='.$currentorg;
?>
<!DOCTYPE html>
<html>
  <head>
  <link rel="shortcut icon" type="image/x-icon" href="../../images/Qulacomm.ico" />
	<meta http-equiv="x-ua-compatible" content="IE=edge" >
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.3, maximum-scale=1.8,user-scalable=yes"/>
	<link rel="stylesheet" href="../../assets/css/loader.css"/>
	<script src="../../assets/js/jquery.min.js"></script>
	<script src="../../assets/js/jquery-migrate.min.js"></script>

	<!-- bootstrap/4.3.1-->
    <script src="../../assets/js/bootstrap.js"></script>
	 <script src="../../assets/js/common.js"></script>
<script language="JavaScript" type="text/javascript" src="request.js"></script>
<script language="JavaScript" type="text/javascript" src="api.php?id=<?php echo $cid.$scoidstring.$modestring;?>"></script>

</head>	  
<title>Player</title>
<body style="margin:0px ;padding:0px;overflow:hidden">
<!-- ============= Start Loader Div for bg and deafult ============= -->
	 <div id="preLoaderPage" class="preloadBg" >
      <div id="overlayBlur"></div>
		<div class="loadDiv">
			<img src="../../assets/images/default.svg" class="loadImg text-center"/>
			<div class="loadText">Please wait<span>.</span><span>.</span><span>.</span>
			</div>
		</div>
    </div>
    <div id="loaderDiv" class="loadBg">
     <div id="overlayBlur"></div>
		<div class="loadDiv"> <img src="../../assets/images/default.svg" class="loadImg text-center"/>
			<div class="loadText">Please wait<span>.</span><span>.</span><span>.</span> </div>
		</div>
    </div><!-- =============end Loader Div for bg and deafult ============= -->
	<!--To be used for debugging purpose
		<iframe name="api" width="800" height="100" src="api.php?id=<?php echo $cid.$scoidstring.$modestring ?>"></iframe>
			<iframe name="main" scrolling='yes' width="<?=$scorm['width']?>" height="<?=$scorm['height']?>" src="loadSCO.php?id=<?php echo $cid.$scoidstring.$modestring ?>"></iframe>-->


	<iframe id="mainIframe" class="myIframe" style="border: none;" name="main" scrolling='no'></iframe>
	
<script type="text/javascript" language="javascript">
var url="loadSCO.php?id=<?php echo $cid.$scoidstring.$modestring ?>"; 
      function iframeRsize(){
		  var winHt=$(window).height();
			var winWd=$(window).width();
			var winLeft = (screen.width - winWd) / 2;
			var winTop = (screen.height - winHt) / 2;
			
			//if(winWd<768 || winWd >=1025){
			   var settings='width='+winWd+',height='+winHt;
			   document.getElementById('mainIframe').width = winWd;
			   document.getElementById('mainIframe').height=winHt;
			    //$("#mainIframe").attr("width",winWd);
			    //$("#mainIframe").attr("height",winHt);
				$('.myIframe').css('widtht',winWd+'px');
				$('.myIframe').css('height', winHt+'px');
			    $("#preLoaderPage").delay(0).fadeOut();
                $("#loaderDiv").delay(0).fadeOut();
             //}else{
			 //var settings='width=1024,height=768';
			// $('.myIframe').css('width', 1024+'px');
			// $('.myIframe').css('height', 700+'px');
			// document.getElementById('mainIframe').width = 1024;
			// document.getElementById('mainIframe').height=700;

			  //$("#mainIframe").attr("width","1024");
			    //$("#mainIframe").attr("height","768");
			 //}
			
	  }	
 iframeRsize() 
$(document).ready(function(){
 $("#mainIframe").attr("src",url);
  iframeRsize() 
 
});
 

$(window).resize(function(){
   iframeRsize() 
  
});	   
$(window).on('load', function() {
   iframeRsize();
})	   
window.onresize = function (event) {
  iframeRsize(); 
}	   
</script>
</body>
</html>