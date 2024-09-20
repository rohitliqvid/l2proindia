<?php
include("lib.php");

$cid=$_REQUEST['id'];
$scoid=$_REQUEST['scoid'];
$mode=$_REQUEST['mode'];
$userid=get_userid($uid);
//echo "----->".$userid;exit;
$scorm=get_scorm_data($scoid);
$scorm_sco=get_scorm_sco_data($scoid);
$scorm_sco_track=get_scorm_sco_track_data($userid,$scoid);
file_put_contents("loadsco.txt", print_r($scorm_sco_track, true));
$scormid=$scorm['id'];


	// Forge SCO URL
    //
    $connector = '';
    $version = substr($scorm['version'],0,4);
    if (!empty($scorm_sco['parameters']) || ($version == 'AICC')) {
       /* if (stripos($scorm_sco['launch'],'?') !== false) {
            $connector = '&';
        } else {
            $connector = '?';
        }*/
		$connector='?';
		
    }
    
    if ($version == 'AICC') {
        if (!empty($scorm_sco['parameters'])) {
            $scorm_sco['parameters'] = '&'. $scorm_sco['parameters'];
        }
		$myurl="/scb/admin/catlist/aicc.php";
		$_SESSION['scoid']=$scoid;
		$randNo=rand(1,99);
		$randNoEnc=md5($randNo);
		$strJoin=$randNoEnc."^".$uid."^".$scoid;
	
		$launcher = $scorm_sco['launch'].$connector."aicc_sid=".$strJoin."&aicc_url=".$myurl.$sco->parameters;
     	//$launcher = $scorm_sco['launch'].$connector.'aicc_sid='.sesskey().'&aicc_url='.$CFG->wwwroot.'/mod/scorm/aicc.php'.$sco->parameters;
		//$launcher = $scorm_sco['launch'].$connector.$scorm_sco['parameters'];
    } else {
     
		$launcher = $scorm_sco['launch'].$connector.$scorm_sco['parameters'];

		//$launcher = $scorm_sco['launch'];
		  
    }
    if (scorm_external_link($scorm_sco['launch'])) {
        $result = $launcher;
    } else {
//        $CFG->wwwroot='http://localhost';
//		if ($CFG->slasharguments) {
            //$result = $CFG->wwwroot.'/file.php/'.$scorm->course.'/moddata/scorm/'.$scorm->id.'/'.$launcher;
		$result = '../../courses/'.$scoid.'/'.$launcher;
//        } else {
            //$result = $CFG->wwwroot.'/file.php?file=/'.$scorm->course.'/moddata/scorm/'.$scorm->id.'/'.$launcher;
//			$result = $CFG->wwwroot.'/moodledata?file=/'.$scorm->course.'/moddata/scorm/'.$scorm->id.'/'.$launcher;
//        }
    }

?>
<!DOCTYPE html>
<html>
  <head>
	<meta http-equiv="x-ua-compatible" content="IE=edge" >
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.3, maximum-scale=1.8,user-scalable=yes"/>
		<link rel="stylesheet" href="../../assets/css/loader.css"/>
	<script src="../../assets/js/jquery.min.js"></script>
	<!-- bootstrap/4.3.1-->
    <script src="../../assets/js/bootstrap.js"></script>
		 <script src="../../assets/js/common.js"></script>
        <title>LoadSCO</title>
        <script language="javascript" type="text/javascript">
        <!--
           setTimeout('document.location = "<?php echo $result ?>";',1000);
        -->
        </script>
    </head>
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
    </body>
</html>
