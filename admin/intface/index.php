<?php include ('adm_top.php'); ?>
<!-- mid section -->

<?php

function changeToMinutes($str_time) {
	$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
	sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
	$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
	return $time_seconds/60;
}

function getDateRangeCourse($dt_r){
		switch ($dt_r)
		{
			case "month":
				return ' FROM_UNIXTIME(tsst.timemodified)  > DATE_ADD(NOW() , INTERVAL -1 MONTH)';
				break;
			case "quarter":
				return ' FROM_UNIXTIME(tsst.timemodified)  > DATE_ADD(NOW() , INTERVAL -1 QUARTER)';
				break;
			case "year":
				return ' FROM_UNIXTIME(tsst.timemodified)  > DATE_ADD(NOW() , INTERVAL -1 YEAR)';
				break;
			default:
				return ' FROM_UNIXTIME(tsst.timemodified)  > DATE_ADD(NOW() , INTERVAL -1 WEEK)';
		}
}

function getDateRangeLogin($dt_r){
		switch ($dt_r)
		{
			case "month":
				return ' user_entry  > DATE_ADD(NOW() , INTERVAL -1 MONTH) group by WEEK(user_entry)';
				break;
			case "quarter":
				return ' user_entry  > DATE_ADD(NOW() , INTERVAL -1 QUARTER) group by MONTH(user_entry)';
				break;
			case "year":
				return ' user_entry  > DATE_ADD(NOW() , INTERVAL -1 YEAR) group by MONTH(user_entry)';
				break;
			default:
				return ' user_entry  > DATE_ADD(NOW() , INTERVAL -1 WEEK) group by user_entry';
		}
}

function getDateRangeRegistration($dt_r){
		switch ($dt_r)
		{
			case "month":
				return ' tu.dtenrolled > DATE_ADD(NOW() , INTERVAL -1 MONTH)';
				break;
			case "quarter":
				return ' tu.dtenrolled > DATE_ADD(NOW() , INTERVAL -1 QUARTER)';
				break;
			case "year":
				return ' tu.dtenrolled > DATE_ADD(NOW() , INTERVAL -1 YEAR)';
				break;
			default:
				return ' tu.dtenrolled > DATE_ADD(NOW() , INTERVAL -1 WEEK)';
		}
}

$date_range_1 = getDateRangeCourse(empty($_GET['t'])?"week":$_GET['t']);
$date_range_2 = getDateRangeLogin(empty($_GET['t'])?"week":$_GET['t']);	
$date_range_3 = getDateRangeRegistration(empty($_GET['t'])?"week":$_GET['t']);	

$query1 = "SELECT ts.name, tsst.value,DATE_FORMAT(FROM_UNIXTIME(tsst.timemodified),'%m-%d-%Y') as rrr
			FROM tls_scorm ts
			JOIN tls_scorm_sco_tracking tsst ON ts.id = tsst.scoid
			WHERE tsst.element = 'cmi.core.total_time' AND ts.coursetype = 'WBT'
			AND ".$date_range_1."
			ORDER BY ts.id, rrr";
$result1 = mysqli_query($con,$query1);
//$row = mysqli_fetch_assoc($query);
$userCourseArr = array();
//echo mysqli_num_rows($result1);exit;
if(mysqli_num_rows($result1) > 0){
	while($row1 = mysqli_fetch_assoc($result1)){
		$userCourseArr[] = $row1;
	}
}

//echo "<pre>";print_r($userCourseArr);exit;
$tempArr = array();
$userCourseStr = "";
$userGraphCourseArr =array();
$timeSpentArr = array();

if(count($userCourseArr) > 0){
	foreach($userCourseArr as $key1 => $value1){
		$tempArr[$value1['name']][] = $value1['value'];
	}
	foreach($tempArr as $key => $value){
		$userGraphCourseArr[]=$key;
		
		$userCourseStr .= "['".$key."',";
		$time = 0;
		foreach($value as $k => $v){
			$time = $time + round(changeToMinutes($v));
		}
		$userCourseStr .= ($time/60)."],";
		$timeSpentArr[]=($time/60);
	}
}
//echo "<pre>";print_r($tempArr);exit;
//echo $userCourseStr;exit;
$query2 = "select count(*) no_of_login, DATE_FORMAT(user_entry,'%d-%m-%Y') user_entry from tbl_entry_log WHERE ".$date_range_2;

$result2 = mysqli_query($con,$query2);
$loginArr = array();
if(mysqli_num_rows($result2) > 0){
	while($row2 = mysqli_fetch_assoc($result2)){
		$loginArr[] = $row2;
	}
}
$loginStr = "";
if(count($loginArr) > 0){
	foreach($loginArr as $key2 => $value2){
		$loginStr .= "['".$value2['user_entry']."',".$value2['no_of_login']."],";
	}
}
$loginStr = rtrim($loginStr, ",");



$query3 = "SELECT count(tu.id) user_reg, tc.client_name FROM tbl_client tc
				JOIN tbl_users tu ON tu.client = tc.id WHERE ".$date_range_3." GROUP BY tc.id";	
//echo $query3;exit;							
$result3 = mysqli_query($con,$query3);				
$userRegArr = array();
if(mysqli_num_rows($result3) > 0){
	while($row3 = mysqli_fetch_assoc($result3)){
		$userRegArr[] = $row3;
	}
}

$uRegStr = "";
if(count($userRegArr) > 0){
	foreach($userRegArr as $key3 => $value3){
		$uRegStr .= "['".$value3['client_name']."',".$value3['user_reg']."],";
	}
}
$uRegStr = rtrim($uRegStr, ",");

?>


	 <section class="scrollable">
		  <section class="panel panel-default padder" style="height:100px;padding-top:30px">	 
		  <div class="col-lg-9 col-md-9 col-sm-9 show-mon">
            <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong> Welcome <? echo $fnm ?>!</strong></span> </div>
          </div> <div class="col-lg-3 col-sm-3 col-md-3 tablegrid"> <select  onChange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class="form-control">
		  <!--<option value="">-Select-</option>-->
		 <option value="index.php?t=week" <?php if(isset($_GET['t']) && $_GET['t'] == 'week'){ ?> selected="selected"<?php } ?>>Week</option>
		  <option value="index.php?t=month" <?php if(isset($_GET['t']) && $_GET['t'] == 'month'){ ?> selected="selected"<?php } ?>>Month</option>
		  <option value="index.php?t=quarter" <?php if(isset($_GET['t']) && $_GET['t'] == 'quarter'){ ?> selected="selected"<?php } ?>>Quarter</option>
		  <option value="index.php?t=year" <?php if(isset($_GET['t']) && $_GET['t'] == 'year'){ ?> selected="selected"<?php } ?>>Year</option>
		  </select></div>
        </div>
  </section>
  
			  <section class="panel panel-default panelgridBg padder">
<section class="panel panel-default panelgridBg">
<div class="panel row teacher-student-wrap">

<section class="profileChartBg profileChartBgBottom">
<div class="col-md-12 col-sm-12 profileMid">
			 <section class="panel panel-default chatBorder">
               <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>User Course Usage Report</strong></span> </div>
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
		
		</div>
  </div><p class="text-right" ><!--Comparsion time and course duration--></p>
                 <div class="panel-body panelPadd">
				 <h4 class="text-center rotate">Time Spent</h4>
                  <div id="chartColumn" style="height:200px"></div>
				  <h4 class="text-center">Courses</h4>
                </div>

				</section>
				
	  </div>
	 
</section>

<section class="profileChartBg profileChartBgBottom">
<div class="col-md-12 col-sm-12 profileMid">
			 <section class="panel panel-default chatBorder">
               <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>User Login Report</strong></span> </div>
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
		
		</div>
  </div><p class="text-right" ><!--Comparsion time and course duration--></p>
                 <div class="panel-body panelPadd">
				 <h4 class="text-center rotate">Login Count</h4>
                  <div id="flot-1ine2" style="height:250px"></div>
				  <h4 class="text-center">Date</h4>
                </div>

				</section>
				
	  </div>
	 
</section>

</div>  </section> </section>
<!-- footer-->
 <!-- chart -->
  <script src="../../assets/js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="../../assets/js/charts/sparkline/jquery.sparkline.min.js"></script>
  <script src="../../assets/js/charts/flot/jquery.flot.min.js"></script>
  <script src="../../assets/js/charts/flot/jquery.flot.tooltip.min.js"></script>
  <script src="../../assets/js/charts/flot/jquery.flot.resize.js"></script>
  <script src="../../assets/js/charts/flot/jquery.flot.grow.js"></script>
  <script src="../../assets/js/charts/flot/jquery.flot.categories.js"></script>
  <script src="../../assets/js/charts/highcharts.js"></script>
<?php
$userGraphCourseArr= json_encode($userGraphCourseArr);
$timeSpentArr=json_encode($timeSpentArr);?> 
  <script>$(function(){

/*global chart*/
 //var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
//var d1 = <?php echo json_encode($crsArray);?>;
//alert(d1);



 var graphPer=<?php echo $timeSpentArr;?>;

  console.log(graphPer);
  var graphXAxixData=<?php echo $userGraphCourseArr; ?> ;

	console.log(graphXAxixData);
	Highcharts.chart('chartColumn', {
		credits: {
			text: 'App NAME',
			href: '#'
		},
		credits: {
			enabled: false
		},
		chart: {
			height: 180,
			type: 'column'
		},
		title: {
			text: '',
			style: {
				display: 'none'
			}
		},
		subtitle: {
			text: '',
			style: {
				display: 'none'
			}
		},
		xAxis: {
			categories: graphXAxixData,
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: ''
			},
			labels: {
				format: '{}'
			},
			gridLineColor: '#ccc',
			gridLineWidth: 1
		},
		tooltip: {
			headerFormat: '<table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0"> {point.y:.0f} hours </td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			},
			series: {
				pointWidth: 50,
				pointPadding: 0,
				groupPadding: 0,
				colorByPoint: true,
				dataLabels:{
					enabled:true,
					formatter:function() {
						var txt='hour';
						if(Math.round(this.y)>1){
							txt='hours';
						}
						return Math.round(this.y)+' '+txt;
					}
				},
				events: {
					legendItemClick: function (e) {
						e.preventDefault();
					}
				}				
			}
		},
		colors: [
		'#7CB5EC',
		'#93A47B',
		'#7CB5EC'
		],
		series: [{
			showInLegend: false,
			name: 'App name',
			data: graphPer
		}]
	});




var d2 = [ <?php echo $loginStr; ?> ];
  $("#flot-1ine2").length && $.plot($("#flot-1ine2"), [{
          data: d2,
		   label: "Login Count / Date",
		   
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
        colors: ["#526cdd"],
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
              yval = yval.toFixed(0);
              var tt = "Login/Date : " +yval + '/' + xval;
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
  
    var d3 = [<?php echo $uRegStr; ?>];
     $("#flot-1ine3").length && $.plot($("#flot-1ine3"), [{
          data: d3,
		   label: "Registration Count / Clients",
		   
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
        colors: ["#526cdd"],
        xaxis:{
           mode: "categories",
		        
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
              yval = yval.toFixed();
              var tt = "Clients/User Registration : " +yval + '/' + xval;
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
  
});  
</script>


<!-- main panel ends -->
<?php
include ('footer.php');
?>
<!--Code to prevent the caching of page-->
