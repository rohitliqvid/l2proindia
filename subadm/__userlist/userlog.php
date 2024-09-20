<title>Activity Log</title>
<?php include ('../intface/windowHeader.php');?>
<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$from=$_REQUEST['from'];
$to=$_REQUEST['to'];

if($from!="" && $to!="")
{

$fromArr=explode("-",$from);
$fromDate=$fromArr[2]."-".$fromArr[1]."-".$fromArr[0];

$toArr=explode("-",$to);
$toDate=$toArr[2]."-".$toArr[1]."-".$toArr[0];

$dateclause=" AND user_entry BETWEEN '$fromDate' AND '$toDate' ";
$dateclause1=" AND user_entry BETWEEN '$fromDate' AND '$toDate' ";
}
else
{
$dateclause=" ";
$dateclause1=" ";
}
//echo "SELECT DISTINCT user_id FROM tbl_entry_log ".$dateclause." ORDER BY username ASC";exit;
//$result2 = mysql_query ("SELECT DISTINCT user_id FROM tbl_entry_log ".$dateclause." ORDER BY username ASC"); 
//$num=mysql_numrows($result2);
//mysql_close();
//$con=createConnection();

////$query5 = "SELECT DISTINCT user_id FROM tbl_entry_log ".$dateclause." ORDER BY username ASC";
$query5 = "SELECT user_id FROM tbl_entry_log where user_id!='' " . $dateclause . " GROUP BY user_id  ORDER BY user_entry DESC";
//echo $query5;exit;
$result2 = mysqli_query($con,$query5);
$num=mysqli_num_rows($result2);
//echo $num;exit;


?>
<html>
<head>

<script>
function validate()
{
	

	if(document.getElementById("from").value=="")
	{
	alertify.alert("Please select From date!");
	return false;
	}
	else if (document.getElementById("to").value=="")
	{
	alertify.alert("Please select To date!");
	return false;
	}
	else if(Date.parse(document.getElementById("from").value) > Date.parse(document.getElementById("to").value))
	{
	alertify.alert("To date should be greater or equal to From date!");
	return false;
	}

}

function resetDates()
{
document.getElementById("from").value="";
document.getElementById("to").value="";
document.frmprofile.submit();
}

function exportCUCSV()
{
    var winWd=200;
    var winHt=200;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var txtFrom = document.getElementById('from').value;
    var txtTo = document.getElementById('to').value;
    
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
    var fpath="userlog_export.php?txtFrom="+txtFrom+"&txtTo="+txtTo;
    var logwin=window.open(fpath,'csvwin2',settings);
    logwin.focus();
}
</script>
<section id="content" class="rightside windowrightContenBg" >

<section class="windowtopMenuContent">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg paddingTOPBottom0">
		<div class="col-sm-4 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Activity log </strong></span> </div>
		 
		</div>
		
		<div class="col-sm-7 pull-right">
    
          <div class="pull-right text-right ">
            <div class="search inline">
			 <span><a href='javascript:exportCUCSV();' class='btn' title='Export to CSV'><i class="fa fa-file-archive-o"></i></a></span> 
			<!-- <span><a href='javascript:window.print();' class='btn' title='Print this window'><i class="fa fa-print"></i></a></span> -->
			  <span><a href='javascript:void(0);' id="btnPrint" class='btn' title='Print this window'><i class="fa fa-print"></i></a></span> 
			 <span class="text-right"><a href='javascript:self.close();' class='btn ' title='Close this window'><i class="fa fa-times-circle"></i></a> </span> 
			</div>
          
      
      </div>
    </div>
		
  </div>
<div class="col-md-12 col-sm-12 buildcourse text-center" style="padding-top:20px">

 
</div> 
</section>
<section class="panel panel-default text-center">
		   <div class="rightHead text-center bgWt">
		  <!-- <div class="stepBg">
                <p> <b>Course Name:</b> <?=$courseName?></p>
              </div>-->
		    <form name='frmprofile' id='frmprofile' onSubmit='return checkDate();' action='userlog.php'>

          <div class="col-sm-1"></div>
          <div class="searchbg">
            <div class="search inline"> <span>
         Show activity log From: 
		  <div id="divFromDate" class="input-append date inputCalenderDiv">
					  <input type="text" name="from"  id="from" class="input-sm form-control  searchbtn" size="20" maxlength="10"  onClick="popUpCalendar(this,this,'dd/mm/yyyy');" readonly value="<?=$from; ?>"> 	<span class="calendarBg add-on">
					   <i class="fa fa-calendar"></i>
					  </span></div> 
     <!--  &nbsp;<a href="javascript:void(0)" onClick="popUpCalendar(frmprofile.from,frmprofile.from,'dd/mm/yyyy');"><img src="../graphics/calendar.gif" align='absmiddle' title="From" width="17" height="15" border="0">-->
			 &nbsp;
To:   <div id="divToDate" class="input-append date inputCalenderDiv">
<input type="text" name="to" id="to" class="input-sm form-control  searchbtn" size="20" maxlength="10"  onClick="popUpCalendar(this,this,'dd/mm/yyyy');" readonly value="<?=$to; ?>"><!--&nbsp;<a href="javascript:void(0)" onClick="popUpCalendar(frmprofile.to,frmprofile.to,'dd/mm/yyyy');"><img src="../graphics/calendar.gif" align='absmiddle' title="To" width="17" height="15" border="0"></a>-->
<span class="calendarBg add-on">
					   <i class="fa fa-calendar"></i>
					  </span></div> 
              <!--<i class="fa fa-search"></i>-->
               &nbsp; &nbsp;<button type="submit" id="search" name="search" class="btn btn-sm btn-blue searchButton"  title='Show login details for this time period'>Search</button>
              </span> <span class="text-right"> <a href="javascript:(0)" class="btn  btn-blue btn-reset" onclick='resetDates();' >Refresh</a><!--<a href="javascript:(0)" class="btn  btn-blue btn-reset" onclick='resetDates();' >Refresh</a>--> </span> </div>
          </div>
        </form>
			 </div>
			 </div>
			 
		 </section>


</section>
<script>
			function checkDate()
			{
				var startDate=document.getElementById("from").value;
				var endDate=document.getElementById("to").value;

				date1 = new Date(startDate.split('-')[2],startDate.split('-')[1]-1,startDate.split('-')[0]);
				date2 = new Date(endDate.split('-')[2],endDate.split('-')[1]-1,endDate.split('-')[0]);
				

				if( date1 > date2)
				{
					alert("To Date can not be smaller than From Date!");
					return false;

				}
				else
				{
					return true;
				}

				
				
			}
			</script>

<div id="printTable">	
	<?
if($searchmsg=='1')	{
}
else
{
?>
				
				<!--Responsive grid table -->
				<!--<section class="windowtopMenuContent" style="top: 149px;">
			 <section class="panel panel-default  theadHeight">
			
			  <div class="panel row teacher-student-wrap theadHeight">
 
               <div class="promo" id="promo">
				<table class="table m-b-none dataTable table-fixed" style="margin-bottom: 0px;">
                   <thead  class="fixedHeader">   
				   <tr>
						<th class="col-xs-3 text-left">Name</th>
						<th class="col-xs-3 text-left">Total Logins</th>
						<th class="col-xs-3 text-left">User IP</th>
						<th class="col-xs-2 text-left">Last Login Date</th>
					</tr>
                    </thead>
					
					</table>
					
					</div>
					</div>	
				</section>
	</section>	-->
<? 
}
?>	
		
	
<form name="deletecourse" onSubmit="return confirmDelete();" action="approval.php?cp=<? echo $currpage?>&tp=<? echo $totalPages?>&catid=<?=$catid?>&trec=<?=$totalnum?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>&from_page=w" method="post">

<div class="scrollable padder courseGroupheight76">&nbsp;</div>
       <section class="scrollable">
			<section class="panel panel-default panelgridBg">
			  <div class="panel row teacher-student-wrap">
			
		
				<!--Responsive grid table -->
                <div class="table-responsive promo courseGroup table-responsiveWindow" >





<table class="table m-b-none dataTable table-fixed" style="margin-bottom: 0px;">
                   <thead  class="fixedHeader">   
				   <tr>
<th class="col-xs-3 text-left">Name</th>
<th class="col-xs-3 text-left">Total Logins</th>
<th class="col-xs-2 text-left" colspan="2">User IP</th>
<th class="col-xs-3 text-right" colspan="2" align="right">Last Login Date</th>

   
                      </tr>
 </thead>
<?
$i=0;
while ($i < $num) {

$row = mysqli_fetch_assoc($result2);
//$id = $row['id'];

 $username = $row["user_id"];
 $userfullname = getFullNameFromID($username);





//$resultc = mysql_query ("SELECT client_name from tbl_client as a, tbl_users as b where a.id=b.client and b.id=$username");
//$user_client=mysql_result($resultc,0,"client_name");

	$stmt = $con->prepare("SELECT client_name from tbl_client as a, tbl_users as b where a.id=b.client and b.id=?");
	$stmt->bind_param("i",$username);
	$stmt->execute();
	$stmt->bind_result($user_client);
	$stmt->fetch();
	$stmt->close();




//$result3 = mysql_query ("SELECT * FROM tbl_entry_log WHERE user_id=$username".$dateclause1); 
//$num3=mysql_numrows($result3);

//$query4 = "SELECT * FROM tbl_entry_log WHERE user_id=$username".$dateclause1;
//$result3 = mysqli_query($con,$query4);
//$num3=mysqli_num_rows($result3);

$query4 = "SELECT id FROM tbl_entry_log WHERE user_id=$username".$dateclause1;
//echo $query4;exit;
$result3 = mysqli_query($con,$query4);
$num3=mysqli_num_rows($result3);


//$result4 = mysql_query ("SELECT MAX(id) as id FROM tbl_entry_log where user_id=$username"); 
//$num4=mysql_numrows($result4);
//$lastid=mysql_result($result4,0,"id");

$stmt = $con->prepare("SELECT MAX(id) as id FROM tbl_entry_log where user_id=?");
$stmt->bind_param("s",$username);
$stmt->execute();
$stmt->bind_result($id);
$stmt->fetch();
$stmt->close();
$lastid=$id;
//echo "-->".$lastid;
//$result5 = mysql_query ("SELECT user_ip, user_entry FROM tbl_entry_log where id=$lastid"); 
//$userip=mysql_result($result5,0,"user_ip");
//$logindate=mysql_result($result5,0,"user_entry");

$stmt = $con->prepare("SELECT user_ip, user_entry FROM tbl_entry_log where id=?");
$stmt->bind_param("i",$lastid);
$stmt->execute();
$stmt->bind_result($user_ip,$user_entry);
$stmt->fetch();
$stmt->close();

if($i%2==0)
 $bgc="row1";
		else
$bgc="row2";
?>
<?

?>


<tr>

<td class="col-xs-3 text-left"><a href='inuserlog.php?uid=<?=$username?>'><? echo ucfirst(TrimString($userfullname)); ?></a></td>
<td class="col-xs-3 text-left"><? echo $num3; ?></td>
<td class="col-xs-2 text-left" colspan="2" ><? echo $user_ip; ?></td>
<td class="col-xs-3 text-right" colspan="2" align="right"><? echo parseDate($user_entry); ?></td>
</tr>
<?
$i++;
}
?>
</table>  
<?
if(!$num)
{
echo "<div  class='noRecordeTable'><h4>No records found in this date range!</h4></div>	";

}
?>    
</div></div></section>
</form>
<?php
include ('../intface/footer.php');
?>
<script>
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('#btnPrint').on('click',function(){
 printData();
})
</script>