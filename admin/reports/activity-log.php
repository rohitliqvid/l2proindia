<?php include '../intface/adm_top.php'; ?>
<!-- mid section -->
<section class="panel panel-default  padder">
    <!-- breadcrumbs -->
    <section class="panel panel-default  padder">
        <!-- breadcrumbs -->
        <section>
            <div class="panel-body nobot panelBg" style="margin-top:20px">
                <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                    <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Users Activity Log Report</strong></span>
                    </div>
                    <div class="pull-right text-right ">
                        <div class="search inline">
                            <span><a href='javascript:exportCUCSV();' class='btn' title='Export to CSV'><i class="fa fa-file-archive-o"></i></a></span>
                            <!-- <span><a href='javascript:void(0);' id="btnPrint" class='btn' title='Print this window'><i class="fa fa-print"></i></a></span> -->
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <section class="panel panel-default text-center">
            <div class="rightHead text-center bgWt">
                <!-- <div class="stepBg">
                <p> <b>Course Name:</b> <?= $courseName ?></p>
                </div>-->
                <form name='frmprofile' id='frmprofile' onSubmit='return checkDate();' action='activity-log.php'>
                    <div class="col-sm-1"></div>
                    <div class="searchbg">
                        <div class="search inline">
                            <?php  
                                $from = $_REQUEST['from'];
                                $to = $_REQUEST['to'];
                            ?>
                            <span>
                                Show activity log From:
                                <div id="divFromDate" class="input-append date inputCalenderDiv">
                                    <input type="text" name="from" id="from" class="input-sm form-control  searchbtn" size="20" maxlength="10" onClick="popUpCalendar(this,this,'dd/mm/yyyy');" readonly value="<?= $from; ?>"> <span class="calendarBg add-on">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                                &nbsp;
                                To:
                                <div id="divToDate" class="input-append date inputCalenderDiv">
                                    <input type="text" name="to" id="to" class="input-sm form-control  searchbtn" size="20" maxlength="10" onClick="popUpCalendar(this,this,'dd/mm/yyyy');" readonly value="<?= $to; ?>">
                                    <span class="calendarBg add-on">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                                <!--<i class="fa fa-search"></i>-->
                                &nbsp; &nbsp;<button type="submit" id="search" name="search" class="btn btn-sm btn-blue searchButton" title='Show login details for this time period'>Search</button>
                                &nbsp; &nbsp;
                                <a href="activity-log.php"><button type="button" class="btn btn-sm btn-blue searchButton" title='Reset Fields'>Reset</button>
                                </a>
                            </span>
                        </div>
                    </div>
                </form>

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
            </div>
            </div>
        </section>
        <div style="clear"></div>
        <form name="deletestd" id="deletestd" onSubmit="return confirmDelete();" action="#" method="post" style="margin:0px;">
            <section class="panel panel-default panelgridBg">
                <div class="panel row teacher-student-wrap">
                    <!--Responsive grid table -->
                    <div class="table-responsive promo courseGroup table-responsiveWindow" style=" padding-top: 5px; ">
                        <table class="table m-b-none  table-fixed" id="results">
                            <thead class="fixedHeader">
                                <tr>
                                    <th class="col-xs-3 ">Name</th>
                                    <th class="col-xs-3" style="text-align: center">Total Logins</th>
                                    <th class="col-xs-2" style="text-align: center">User IP</th>
                                    <th class="col-xs-3 " style="text-align: center">Last Login Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                               $con=createConnection();
                                $from = $_REQUEST['from'];
                                $to = $_REQUEST['to'];

                                if ($from != "" && $to != "") {

                                    $fromArr = explode("-", $from);
                                    $fromDate = $fromArr[2] . "-" . $fromArr[1] . "-" . $fromArr[0];

                                    $toArr = explode("-", $to);
                                    $toDate = $toArr[2] . "-" . $toArr[1] . "-" . $toArr[0];

                                    $dateclause = " AND user_entry BETWEEN '$fromDate' AND '$toDate' ";
                                    $dateclause1 = " AND user_entry BETWEEN '$fromDate' AND '$toDate' ";
                                } else {
                                    $dateclause = " ";
                                    $dateclause1 = " ";
                                }
                                
                                //echo "SELECT user_id FROM tbl_entry_log " . $dateclause . " where user_id!='' GROUP BY user_id";
                                //die();

                                $result2 = mysqli_query($con,"SELECT user_id FROM tbl_entry_log where user_id!='' " . $dateclause . " GROUP BY user_id  ORDER BY user_entry DESC");
                                $num = mysqli_num_rows($result2);

                                $blank_names_ids = '';
                                $i = 0;
                               while ($row = $result2->fetch_assoc())
                               {
                                    $id = $row['id'];
                                   $username = $row["user_id"];

                                   $userfullname = getFullNameFromID($username);
                                    $resultc = mysqli_query($con,"SELECT client_name from tbl_client as a, tbl_users as b where a.id=b.client and b.id='".$username."'");
                                     //print_r($resultc);
                                    $row1=mysqli_fetch_array($resultc, MYSQLI_ASSOC);
                                    $user_client = $row1["client_name"];

                                    
                                    $result3 = mysqli_query($con,"SELECT * FROM tbl_entry_log WHERE user_id=$username" . $dateclause1);
                                    $num3 = mysqli_num_rows($result3);

                                    /*$result4 = mysqli_query($con,"SELECT MAX(id) as id FROM tbl_entry_log where user_id=$username");
                                    $num4 = mysqli_num_rows($result4);
                                    
                                    $row2=mysqli_fetch_array($result4, MYSQLI_ASSOC);
                                    $lastid = $row2["id"];

                                    $result5 = mysqli_query($con,"SELECT user_ip, user_entry FROM tbl_entry_log where id=$lastid" .$dateclause1);
                                    $row3=mysqli_fetch_array($result5, MYSQLI_ASSOC);
                                    
                                    $userip = $row3["user_ip"];
                                    $logindate = $row3["user_entry"];*/

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
$logindate=parseDate($user_entry);

                                    

                                    if ($i % 2 == 0)
                                        $bgc = "row1";
                                    else
                                        $bgc = "row2";

                                $userfullname = ucfirst(TrimString($userfullname));
                                if (!$userfullname) {
                                    $blank_names_ids .= $username.',';
                                    //array_push($blank_names_ids,$username);
                                }
                                
                                ?>

                                <tr>
                                    <!-- <td class="col-xs-3 text-left"><a href='inuserlog.php?uid=<?= $username ?>'><? echo ucfirst(TrimString($userfullname)); ?></a></td> -->
                                    <td class="col-xs-3"><?php echo ucfirst(TrimString($userfullname)); ?></td> 
                                    <td class="col-xs-3" style="text-align: center"><?php echo $num3; ?></td>
                                    <td class="col-xs-2" style="text-align: center"><?php echo $user_ip; ?></td>
                                    <td class="col-xs-3 " style="text-align: center"><?php echo parseDate($logindate); ?></td>
                                </tr>

                                <?
                                    $i++;
                                }
                                ////print_r($blank_names_ids);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- row end here -->
            </section>
        </form>
    </section>
</section>

<script>
    $(document).ready(function () {
    $('#results').DataTable({
        paging: false,
        searching: false,
        order: [[3, 'desc']],
    });
});
</script>
<script>
    function resetSelection() {
        document.getElementById("cmbStatus").value = "";
        document.getElementById("cmbCourse").value = "";
        document.frmprofile.submit();
    }

    function exportCUCSV() {
        var winWd = 200;
        var winHt = 200;
        var winLeft = (screen.width - winWd) / 2;
        var winTop = (screen.height - winHt) / 2;
        var txtFrom = document.getElementById('from').value;
        var txtTo = document.getElementById('to').value;

        var settings = 'left=' + winLeft + ',top=' + winTop + ',width=' + winWd + ',height=' + winHt + ',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
        var fpath = "userlog_export.php?txtFrom=" + txtFrom + "&txtTo=" + txtTo;
        var logwin = window.open(fpath, 'csvwin2', settings);
        logwin.focus();
    }
</script>
<div style="clear"></div>
<?php include '../intface/footer.php'; ?>