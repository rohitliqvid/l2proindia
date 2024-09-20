<!-- header-->
<?php
include '../../header/dashboardHeader.php';
$curDate=date("Y-m-d");
$user_row_id=getUserIdFromUsername($login_session);
//$result4 = mysql_query("SELECT distinct(bundle_id),registration_date FROM tbl_b2client where username = '$login_session' and expiry_date > $curDate") or die("1Failed Query of " . mysql_error());
$result4 = mysql_query("SELECT distinct(bundle_id),registration_date FROM tbl_b2client where username = '$login_session'") or die("1Failed Query of " . mysql_error());
		$i=0;
		
		while($row = mysql_fetch_array($result4)){
			$bundleList[$i] = $row['bundle_id'];
			$registration_date[$i] = $row['registration_date'];
			$i++;
			}
$userCompletion=0;
$userCompletion=getUserCompletionForBadge($login_session,$bundleList);

$crsArray=array();
$user_course_names=array();

//$userDtl = getLoggedInUser();
//echo "<pre>";print_r($userDtl);exit;			
?>
<!-- mid section -->

<section id="content" class="rightside rightContenBg">
<div id="loaderDiv" class="loadBg"><img src="../../images/saving.gif" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="padder topMenuContent">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Progress Tracker</strong></span> </div>
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
		
		</div>
  </div>
  <div class="profileBg">
  <div class="col-md-12 col-sm-12 profileTop">
				<div class="col-sm-6 profileTopLeft">
                                      
                                                <a class="thumb-md  fileInputs">
                                                    <span class="fakefile">
													<?php if($userDtl['user_pic'] != ""){ ?>
													<img src="profile_pic/<?php echo $userDtl['user_pic']; ?>" />
													<?php }else{ ?>
													<img src="../../images/avatar_default.jpg" />
													<?php } ?>
													</span>
                                                 </a>
                                        
					<span class="InfoBg">
						<div class="name"><?php echo ucfirst($userDtl['firstname'])." ".ucfirst($userDtl['lastname']); ?></div>
                                                <div class="emailId"><? echo $_SESSION['login_user'];?></div>
                                                <!--
						<div class="pointCount">10</div>
						<div class="pointName">POINTS</div>-->
					</span>
			 </div>
				<div class="col-sm-6 profileTopRight">
				  <!--<div class="displayInline col-sm-4 ">
					  <div class="scoreId c100 orange small">
							<span id="scoreId">0</span>
							<div class="slice">
								<div class="bar"></div>
								<div class="fill"></div>
							</div>
					 </div>
					 <div class="clearBoth"></div>
					<div class="text-center c100Name"> Coins</div>
				  </div>-->
				  <div class="displayInline col-sm-6 text-center">
					 <div class="badgeBg">
					 <?php 
					if($userCompletion>=0 && $userCompletion<=50)
					{
					$badge_img="../../images/BronzeBadges.png";
					$badge_title="This signifies that you have completed upto 50% of the course.";
					}
					elseif($userCompletion>=51 && $userCompletion<=99)
					{
					$badge_img="../../images/SilverBadges.png";
					$badge_title="This signifies that you have completed upto 99% of the course.";
					}
					elseif($userCompletion == 100)
					{
					$badge_img="../../images/GoldBadges.png";
					$badge_title="This signifies that you have completed the course.";
					}
					 ?>
							<img src="<?php echo $badge_img?>" title="<?php echo $badge_title?>"/>
							
					
							
					 </div>
					<div class="clearBoth"></div>
					<div class="text-center c100Name"> Badge</div>
				</div>
				 <div class="displayInline col-sm-6 ">
					 <div class="completionId c100 orange small" style="margin: 0px 0.0em 0.2em .6em;">
					
							<span id="completionId"><?php echo $userCompletion;?>%</span>
							<div class="slice">
								<div class="bar"></div>
								<div class="fill"></div>
							</div>
					 </div>
					<div class="clearBoth" style="clear:both"></div>
					<div class="text-center c100Name">Your Completion</div>
				</div>
			  </div>
			 </div>
			 
			 
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12">Click on <strong>'Courses'</strong> tab in the left panel to access courses.<br><br></div>
  <div class="clear" style="clear:both"></div>
  <section class="panel panel-default  theadHeight">
 
    <div class="panel-body nobot panelBg">
	
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Courses</strong></span> </div>
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
		
		</div>
  </div>
			 
	<div class="panel row teacher-student-wrap theadHeight">
    <div class="promo" id="promo">
      <table class="table m-b-none dataTable panel-group table-fixed table-fixedDashborad " id="accordion">
    <thead  class="fixedHeader">
	
	
          <tr>
		  	<th  class="col-xs-3">Course List </th>
            <!--<th  class="col-xs-3"><a href="index.php?sort=title&dir=<?php echo $dir; ?>" class="th-sortable">Course List <span class="th-sort">
              <?php if(isset($_GET['sort']) && $_GET['sort'] == 'title' && $_GET['dir']=='ASC'){ ?>
              <i class='fa fa-sort'></i><i class='fa fa-sort-down fa-active'></i>
              <?php }elseif(isset($_GET['sort']) && $_GET['sort'] == 'title' && $_GET['dir']=='DESC'){?>
              <i class='fa fa-sort-up fa-active'></i><i class='fa fa-sort'></i></i>
              <?php }else{ ?>
              <i class='fa fa-sort'></i>
              <?php }?>
              </span> </a></th>-->
            <th  class="col-xs-1 text-center">Status </th>
            <th class="col-xs-2 text-center">Assigned Date </th>
            <th class="col-xs-2 text-center">Last Visited</th>
			 <th class="col-xs-2 text-center">Duration </th>
            <th class="col-xs-2 text-center">Time Spent </th>
          </tr>
        </thead></table></div></div></section>
</section>
</section>
<!-- <div class="scrollable padder scrollPadderColor dasHeight">&nbsp;</div>-->
<section class="scrollable padder DashBoradTable">
<section class="panel panel-default panelgrid">
  <div class="panel row teacher-student-wrap">
    <div class="table-responsive">
      <table class="table m-b-none dataTable panel-group table-fixed table-fixedDashborad " id="accordion">
   <!-- <thead  class="fixedHeader">
          <tr>
            <th  class="col-xs-4"><a href="dashboard.php?sort=title&dir=ASC" class="th-sortable">Course Name <span class="th-sort">
                            <i class='fa fa-sort'></i>
                            </span> </a></th>
            <th  class="col-xs-2"><a href="dashboard.php?sort=code&dir=ASC" class="th-sortable">Course Code <span class="th-sort">
                            <i class='fa fa-sort'></i>
                            </span></a></th>
            <th class="col-xs-2 text-center">Number of Students </th>
            <th class="col-xs-2 text-center">Total Chapters</th>
            <th class="col-xs-2 text-center">Average Time Spent </th>
          </tr>
        </thead>-->
        <tbody id="ramTest">
		<?php
		$sql = $query = "SELECT * FROM tbl_b2client as A, tls_scorm as B where A.expiry_date >= '$curDate' and A.username = '$login_session' and A.course_id=B.course and B.coursetype='WBT'";
		
		$res = mysql_query($sql) or die("select course " . mysql_error());
		
		$cnt = mysql_num_rows($res);
	
	if($cnt > 0){
	for($i = 0 ; $i < sizeof($bundleList) ; $i++){
	$result4 = mysql_query("SELECT * FROM tbl_b2client_bundle where bundle = '$bundleList[$i]' and client_id = 2") or die("1Failed Query of " . mysql_error());
		
		$row = mysql_fetch_array($result4);
		$bundleDesc = $row['bundle_desc'];
		$bundleName = $row['bundle_detail'];
		$courses = explode(',' , $bundleDesc);
		for($j=0 ; $j < sizeof($courses) ; ++$j){
			$query = "SELECT * FROM tbl_b2client as A, tls_scorm as B where A.course_id = '$courses[$j]' and A.expiry_date >= '$curDate' and A.username = '$login_session' and A.course_id=B.course and B.coursetype='WBT'";
			

			$result4 = mysql_query($query) or die("1Failed Query of " . mysql_error());
			$row = mysql_fetch_array($result4);
			$courseToken = $row['token'];
			$result5 = mysql_query("SELECT name,course, coursetype FROM tls_scorm where course = '$courses[$j]'") or die("1Failed Query of " . mysql_error());
			$cResult = mysql_fetch_array($result5);
			$courseName = $cResult['name'];
			
			$scormID = $cResult['course'];
			$coursetype = $cResult['coursetype'];
			
			$resultH = mysql_query("SELECT course_duration FROM tls_sco_info WHERE course_id = $scormID") or die("course not found");
			$hResult = mysql_fetch_assoc($resultH);
			$courseDuration = $hResult['course_duration'];
			//echo $coursetype;
			if($bundleList[$i]!="demo-b2c" && $coursetype=="WBT")
			{
			
			$user_status=getUserCourseStatusFinal($user_row_id,$scormID);
			$user_last_visited=getUserCourseLastVisited($user_row_id,$scormID);
			$user_time_spent=getUserTimeSpent($user_row_id,$scormID);
			//$crsArray[]=$user_course_names[$courseName];
			//$user_course_names = array();
			$user_course_names[0] = $courseName;
			$user_course_names[1] = formatToMinutes($user_time_spent);
			//$crsArray[$j] = $user_course_names;
			//$user_course_names[$courseName]=$user_time_spent;
			array_push($crsArray,$user_course_names);
			if($user_time_spent!="NA")
			{
			$user_time_spent=formatToNewTime($user_time_spent);
			}
			
			if($user_last_visited!="NA")
			{
			$user_last_visited=date("d-m-Y",getUserCourseLastVisited($user_row_id,$scormID));
			}
			else
			{
			$user_last_visited="NA";
			}

			if($user_status=="Not Attempted")
			{
			$user_status_img="../../images/blank@3x.png";
			}
			else if($user_status=="completed")
			{
			$user_status_img="../../images/complete@3x.png";
			}
			else
			{
			$user_status_img="../../images/50@3x.png";
			}

			$arr_registration_date=explode("-",$registration_date[$i]);
			$new_registration_date=$arr_registration_date[2]."-".$arr_registration_date[1]."-".$arr_registration_date[0];

			
		?>

           <!--<tr class="toggler normal active" id="rowId<?php echo $j+1;?>" onclick="showPanel('ajax/getCourseUser.php','<?php echo $courseName;?>',this.id,'icon<?php echo $j+1;?>','panelrowId<?php echo $j+1;?>','tableId_<?php echo $j+1;?>')">-->
		   <tr class="normal active" id="rowId<?php echo $j+1;?>" onclick="">
            <!--<td class="col-xs-3" title="<?php echo $courseName;?>"><span><i class="fa fa-plus" id="icon1"></i></span> <?php echo $courseName;?></td>-->
			<td class="col-xs-3" title="<?php echo $courseName;?>"><?php echo $courseName;?></td>
            <td class="col-xs-1 text-center fname fnameImg"><img id="status_3x" src="<?php echo $user_status_img;?>" width="25px" class="img-circle" /></td>
            <td class="col-xs-2 text-center"><?php echo $new_registration_date;?></td> 
			<td class="col-xs-2 text-center"><?php echo $user_last_visited;?></td>
            <td class="col-xs-2 text-center"><?php echo formatToNewTime($courseDuration); ?></td>
            <td class="col-xs-2 text-center" id="timeSpentId_<?php echo $j+1;?>"><?php echo $user_time_spent;?></td>
          </tr>
		  <!---Uncomment for graph
		  <tr id="panelrowId<?php echo $j+1;?>" class="panelShow" style="display:block;">
						<td colspan="5" class="padd0 col-xs-12">
						<div class="subtable">
						<section class="profileChartBg">
						<div class="col-md-12 col-sm-12 profileMid profileMidCollaspe">
							 <section class="panel panel-default">
							 <p class="text-right" >Comparsion time and course duration</p>
								<div class="panel-body panelPadd">
								<h4 class="text-center rotate">Time Spent</h4>
							  <div id="flot-chart"  style="height:250px"></div>
							  <h4 class="text-center">Chapters</h4>
								
								</div>                  
							  </section>
									 
							</div>
						</section>
						</div></td>
			</tr>
			-->
			<?php
					}
				}
			
			}
			
		}else{ ?>
			<tr>
				 <td class="col-xs-12 text-center">Courses not assigned. Please contact administrator.</td> 
			</tr>
		<?php }	
			//print_r($crsArray);
			//echo json_encode($crsArray);
			//echo "<pre>";print_r($crsArray);
			?>
                   
		  	<!--	<tr id="panelrowId4" class="panelShow" style="display:none;">
						<td colspan="5" class="padd0 col-xs-12"><div class="subtable">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table-fixed" id="tableId_4">
                 
						</table>
				
						</div></td>
						 </tr>-->
                   
		  		<!--<tr id="panelrowId5" class="panelShow" style="display:none;">
						<td colspan="5" class="padd0 col-xs-12"><div class="subtable">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table-fixed" id="tableId_5">
                 
						</table>
				
						</div></td>
						 </tr>-->
                    
                  </tbody>
      </table>
    </div>
    <!--<div class="panel-footer">
      <div class="row-centered">
        <div class="col-sm-12 col-xs-12 col-centered">
          <div class="text-center"> <ul class="pagination pagination-sm"><li><a href="?page=1">‹‹ First</a></li><li><a href="?page=2">‹ Prev</a></li><li><a href="?page=1">1</a></li><li><a href="?page=2">2</a></li><li><a class="current">3</a></li><li><a href="?page=4">4</a></li><li><a href="?page=5">5</a></li><li><a href="?page=6">6</a></li><li><a href="?page=7">7</a></li><li><a href="?page=8">8</a></li><li><a href="?page=9">9</a></li><li><a href="?page=4">Next ›</a></li><li><a href="?page=9">Last ››</a></li></ul><div class="page_info text-center">Total <b>52</b> records </div> </div>
        </div>
      </div>
    </div>-->
  </div>
  <!-- row end here -->
</section>
	     </section>
 <section class="padder DashBoradTableBottom">
<section class="profileChartBg profileChartBgBottom">
<div class="col-md-12 col-sm-12 profileMid padding0">
			 <section class="panel panel-default">
               <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Time Spent</strong></span> </div>
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
		
		</div>
  </div><p class="text-right" ><!--Comparsion time and course duration--></p>
                 <div class="panel-body panelPadd">
				 <h4 class="text-center rotate">Time Spent</h4>
                  <div id="flot-1ine" style="height:250px"></div>
				  <h4 class="text-center">Courses</h4>
                </div>

				</section>
				
	  </div>
	 
</section>
<!-- footer-->
 <!-- chart -->
  <script src="../../js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="../../js/charts/sparkline/jquery.sparkline.min.js"></script>
  <script src="../../js/charts/flot/jquery.flot.min.js"></script>
  <script src="../../js/charts/flot/jquery.flot.tooltip.min.js"></script>
  <script src="../../js/charts/flot/jquery.flot.resize.js"></script>
  <script src="../../js/charts/flot/jquery.flot.grow.js"></script>
  <script src="../../js/charts/flot/jquery.flot.categories.js"></script>
  
  <script type="text/javascript">
 <!--progress increment -->
 $(document).ready(function(){
  <!--score increment -->
	 var score = $('#scoreId').text();
	 scoreStr=score.replace(".","");
	var classScore = 'p'+scoreStr;
    $(".scoreId").addClass(classScore);
	
	  <!--Completion increment -->
	var completion = $('#completionId').text();
	 completionStr=completion.replace("%","");
	var classCompletion = 'p'+completionStr;
    $(".completionId").addClass(classCompletion);
});


var prviousId;
function showPanel(filePath, course_code, curId, iconId, panelId, targetId){
	
	if( typeof($(".fa-minus")[0]) == "undefined"){
		
		
		showLoader();	 
		
		$.post(filePath, {course_code: course_code}, function(data){ $("#"+panelId).fadeIn(); $("#"+targetId).html(data);hideLoader();
			// Handler for .ready() called.
					 $('html, body').animate({
					scrollTop: $("#"+targetId).offset().top-200
				    }, 'slow');	
				
			});
		
		   
		 if(prviousId != curId){
			prviousId =  curId ;
			
		 }else{
			   $(".panelShow").fadeOut();
			   $('span > i').addClass( "fa-plus" ).removeClass( "fa-minus" );
			   $('.toggler').addClass("normal").removeClass( "bold" );
			   
		 }
		  //$("#"+rowId).show();
		  $('#'+curId).find('i.fa').toggleClass("fa-plus fa-minus");
		  $('#'+curId).toggleClass("normal bold ");
		
		  
	}else{
		   $(".panelShow").fadeOut();
		   $('span > i').addClass( "fa-plus" ).removeClass( "fa-minus" );
		   $('.toggler').addClass("normal").removeClass("bold");
		 
		   
	}
	if(prviousId != curId){
		showLoader();
		$.post(filePath, {course_code: course_code}, function(data){ $("#"+panelId).fadeIn(); $("#"+targetId).html(data);hideLoader();
			// Handler for .ready() called.
				 $('html, body').animate({
				scrollTop: $("#"+targetId).offset().top-200
				}, 'slow');				 
			
		 });
		$('#'+curId).find('i.fa').toggleClass("fa-plus fa-minus");
		$('#'+curId).toggleClass("normal bold "); 
	   
	}
		 prviousId =  curId;
}

  </script>
<script>$(function(){

/*global chart*/
 //var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
var d1 = <?php echo json_encode($crsArray);?>;
//alert(d1);
//var d1 = [ ["Interview Edge", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9] ];
  $("#flot-1ine").length && $.plot($("#flot-1ine"), [{
          data: d1,
		   label: "Time Spent (min.)/ Courses",
		   
      }], 
      {
        series: {
            lines: {
                show: true,
                lineWidth: 2,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.1
                    }, {
                        opacity: 0.2
                    }]
                }
            },
            points: {
                radius: 5,
                show: true
            },
            grow: {
              active: true,
              steps: 50
            },
            shadowSize: 2
        },
        grid: {
            hoverable: true,
            clickable: true,
            tickColor: "#f0f0f0",
            borderWidth: 1,
            color: '#f0f0f0'
        },
        colors: ["#36BBE1"],
        xaxis:{
           mode: "categories",
		  
            // categories: ['Apples', 'Pears', 'Oranges', 'Bananas', 'Grapes', 'Plums', 'Strawberries', 'Raspberries'],
      
            tickLength: 0,
			tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
		legend: {
		  show: true,
		   labelBoxBorderColor: "none",
          position: "left"
		},
        yaxis: {
          ticks: 5,
		 title: {
                text: 'Percent'
            }
        },
        tooltip: true,
        tooltipOpts: {
          content: function(label, xval, yval, flotItem){
              var yval = Math.round(yval * 100) / 100;
              yval = yval.toFixed(2);
              var tt = "Time/Chapter : " +yval + '/' + xval;
              return tt;
          },
          defaultTheme: false,
          shifts: {
            x: 0,
            y: 20
          }
        }
      }
  );
  
/*expanable chart*/
 var d2 = [];
  for (var i = 0; i <= 6; i += 1) {
    d2.push([i, parseInt((Math.floor(Math.random() * (1 + 30 - 10))) + 10)]);
  }
  var d3 = [];
  for (var i = 0; i <= 6; i += 1) {
    d3.push([i, parseInt((Math.floor(Math.random() * (1 + 30 - 10))) + 10)]);
  }
  $("#flot-chart").length && $.plot($("#flot-chart"), [{
          data: d2,
         // label: "Unique Visits"
      }, {
          data: d3,
          label: "Time Spent(min.)/Chapters"
      }], 
      {
        series: {
            lines: {
                show: true,
                lineWidth: 1,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.1
                    }, {
                        opacity: 0.8
                    }]
                }
            },
            points: {
                show: true
            },
            shadowSize: 2
        },
        grid: {
            hoverable: true,
            clickable: true,
            tickColor: "#f0f0f0",
            borderWidth: 0
        },
        colors: ["#D6EAF3","#0189c5"],
        xaxis: {
            ticks: 15,
            tickDecimals: 0
        },
        yaxis: {
            ticks: 10,
            tickDecimals: 0
        },
        tooltip: true,
        tooltipOpts: {
          content: "'%s' of %x.1 is %y.4",
          defaultTheme: false,
          shifts: {
            x: 0,
            y: 20
          }
        }
      }
  );



});</script>

<script>
     // var c_edge_id = <?php echo json_encode($course_id);?>;
//     <?php if( strlen($pop_msg)):?>
//         var pop_msg = <?php echo json_encode($pop_msg)?>;
//     <?php endif;?>    
//         
//         $(document).ready(function(){
//             if( typeof pop_msg != 'undefined' ){
//                 if(pop_msg != '' && pop_msg != null ){
//                    alertPopup(pop_msg);
//                }
//             }
//             
//             
//             $("#profile-image-edit").click(function(){
//                 var ref = $.trim($(this).attr('ref'));
//                 if( ref.toLowerCase() == 'edit'){
//                     // show upload form
//                     $(this).attr('ref', 'cancel');
//                     $(this).text('Cancel');
//                     $("#profile-upload-form").show();
//                 }else{
//                     // hide form
//                     $(this).attr('ref', 'edit');
//                     $(this).text('Edit');
//                     $("#profile-upload-form").hide();
//                 }
//                 
//             });
//             
//             $(".profile-pic-input").change(function(){
//                 $("#profile-pic-form").submit();
//             });
//             
//             $("#profile-pic-remove").click(function(){
//                    $("#profile-pic-removal .msg").text('Are you sure to remove profile pic?');
//                    $("#profile-pic-removal").modal({backdrop: "static"});
//             });
//             
//             $("#remove-profile-pic-confirm").click(function(){
//                    $("#loaderDiv").show();
//                    $.ajax(
//                            {url: 'ajax.php', type: 'POST', dataType : 'json',
//                            data : {action: "remove-profile-pic"},
//                            success : function(data){
//                                $("#loaderDiv").hide();
//                                if( data.status == 1){
//                                    top.location.href = 'profile.php?cid='+c_edge_id;
//                                }else{
//                                    alertPopup('There was some error in deleting profile pic. Please try again.');
//                                }
//                            }, error : function(){
//                                $("#loaderDiv").hide();
//                                alertPopup('There was some error in deleting profile pic. Please try again.');
//                            } 
//
//                    });
//                    
//             });
//             
//             
//         });
         
 </script>
<?php
include '../../footer/dashboardFooter.php';
?>

  