<?php
//include ("../connect.php");
$result4 = mysql_query("SELECT * FROM tbl_b2client_bundle where bundle = 'demo-b2c' and client_id = 2") or die("1Failed Query of " . mysql_error());
$row = mysql_fetch_array($result4);
$bundleDesc = $row['bundle_desc'];
$bundleName = $row['bundle_detail'];
$courses = explode(',' , $bundleDesc);
$arrCourse=array();
for($j=0 ; $j < sizeof($courses) ; ++$j){
			
			$query = "SELECT * FROM tbl_b2client where course_id = '$courses[$j]'";
			//echo $query."<br>";
			$result4 = mysql_query($query) or die("1Failed Query of " . mysql_error());
				
				$row = mysql_fetch_array($result4);
				$courseToken = $row['token'];
				
				$result5 = mysql_query("SELECT name,course FROM tls_scorm where course = '$courses[$j]'") or die("1Failed Query of " . mysql_error());
				$cResult = mysql_fetch_array($result5);
				$courseName = $cResult['name'];
				$scormID = $cResult['course'];
				//$courseToken = $cResult['token'];
				$courseToken = $courseToken;
				array_push($arrCourse,$scormID);
				//echo $scormID."<br>";
				//echo $courseName."<br>";
}

?>
<div class="clear"></div>
<div class="col-md-12 text-center">
<div class="demoArrowBg"> <a href="#divderMBottom20" class="scrollDivSlide m-t-xs back"> <div class="demoArrowCircle"> <i class="fa fa-arrow-down"></i></div></a>
   </div>.                        
                        </div>
<div class="page-block" >
	<div class="border-holder" style="margin:0px auto; padding:0px 20px; width:90%">
	<div class="main-votex col-md-12"><!--<div class="divderMTop40"></div>-->
	<div class="col-md-12 widget-container page-element-type-headline widget-headline text-center">
	
<div class="home-sec">
<div class="sec-hd">
				<h2 class="sec-title">Product Demo</h2>
				<div class="triangled_colored_separator">
			<div class="triangle"></div>
		</div>
			</div>

</div><div class="divderMBottom20" id="divderMBottom20"></div><div class="divider"></div><div class="divider"></div><div class="divider"></div>
</div>

<div class="col-md-3  widget-container page-element-type-image widget-image" >
<ul class="caption-style-4">
			<li><a href="javascript:launch_content('<?php echo $arrCourse[1];?>');" class="whiteDemo" >
			<div class="contents text-center ">

				<img src="images/interview.png" alt=""  class="demoImg">
				<div class="caption">
					<div class="blur"></div>
					<div class="caption-text">
						<h1>Demo</h1>
					
					</div>
				</div></a>
		
	<div class="clear"></div>			
<h4>Interview Edge</h4>
 <div class="paraDiv"><p class="text-left"><strong>Get a job where you're truly appreciated: </strong>Interview Edge is designed to turbo charge your career as it prepares you for everything - from getting your resume right to negotiating your pay package. Transforming you into a confident converser when you are in the hot seat.</p></div>
 <div class="text-center"><a href="javascript:launch_content('<?php echo $arrCourse[1];?>');" class="btn btnOrange">Demo</a></div>
 </div>	</li></ul>
</div>	
<div class="col-md-3 widget-container page-element-type-image widget-image">
<ul class="caption-style-4">
			<li><div class="contents text-center">

				<img src="images/professionalthumb.png" alt=""  class="demoImg">
				<div class="caption">
					<div class="blur"></div>
					<div class="caption-text">
						<h1><a href="javascript:launch_content('<?php echo $arrCourse[0];?>');" class="whiteDemo" >Demo</a></h1>
						
					</div>
				</div>
			
	<div class="clear"></div>			
<h4>Professional Edge</h4>
	<div class="paraDiv"><p class="text-left"><strong>Make Your Point With Power: </strong>To move up the corporate ladder faster than others you need to first get noticed. This is where Professional Edge can arm you with the soft skills to make the right impact.</p>	</div>
	<div class="text-center"><a href="javascript:launch_content('<?php echo $arrCourse[0];?>');" class="btn btnOrange">Demo</a></div>
	</div></li></ul>
</div>

<div class="col-md-3 widget-container page-element-type-image widget-image ">
<ul class="caption-style-4">
			<li>
			<div class="contents  text-center">

				<img src="images/conversation.png" alt=""  class="demoImg">
				<div class="caption">
					<div class="blur"></div>
					<div class="caption-text">
					<h1><a href="javascript:launch_content('<?php echo $arrCourse[3];?>');" class="whiteDemo" >Demo</a></h1>
					
					</div>
				</div>
		
	<div class="clear"></div>		
<h4>Conversation Edge</h4>
<div class="paraDiv"><p class="text-left"><strong>Speaking fluently without stumbling or hesitation: </strong>Networking and building relationships with This is where Conversation Edge can help make a difference. Be it speaking to a prospective employer or conversing with clients on an overseas business trip.
 </p>	</div>
<div class="text-center"><a href="javascript:launch_content('<?php echo $arrCourse[3];?>');" class="btn btnOrange">Demo</a></div>
</div>	</li></ul>
</div>

<div class="col-md-3  widget-container page-element-type-image widget-image">
<ul class="caption-style-4">
			<li>	
<div class="contents  text-center">

				<img src="images/grammer.png" alt=""  class="demoImg">
				<div class="caption">
					<div class="blur"></div>
					<div class="caption-text">
					<h1><a href="javascript:launch_content('<?php echo $arrCourse[2];?>');" class="whiteDemo" >Demo</a></h1>
						
					</div>
				</div>
			
	<div class="clear"></div>			
<h4>Grammar Edge</h4>
<div class="paraDiv"><p class="text-left"><strong>Clear Entrance Exams with ease: </strong>The key difference between spoken and written English is grammar. While you may get away with a few mistakes while speaking, it becomes impossible to escape detection when appearing in written entrance exams like Bank PO, SSC, and Railways etc.<!-- <span id="hiddenPara4" class="hiddenPara">This is where Conversation Edge can help make a difference. Be it speaking to a prospective employer or conversing with clients on an overseas business trip. </span>
<a class="paraHover" id="pmore4"  onclick="show('hiddenPara4')" > ...<i class="fa fa-plus-circle"></i>more  </a>-->

	</p>

</div>	
	<div class="text-center"><a href="javascript:launch_content('<?php echo $arrCourse[2];?>');" class="btn btnOrange">Demo</a></div>	
	</div></li></ul>
</div>

<div class="clear"></div>


</div>


</div>
</div>

<div class="clear"></div>

<div class="main-votex width100" style="margin-top:40px; background:#D8DCE3;padding:5px;font-size:11px;">
	<div class="col-md-12 widget-container page-element-type-headline widget-headline text-right">
	Powered by LIQVID.
	</div></div>
	
	
	<div id="loaderDiv" class="loadBg">
    <div id="overlayBlur"></div>
    <div class="loadDiv">
        <img src="images/default.svg" class="loadImg text-center"/>
        <div class="loadText">Please wait<span>.</span><span>.</span><span>.</span>
        </div>
    </div>
</div>
	<?php include_once 'term.php';?>
 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50000623-2', 'auto');
  ga('send', 'pageview');

</script>
</body></html>
