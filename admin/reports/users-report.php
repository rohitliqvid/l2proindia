<?php include '../intface/adm_top.php'; ?>
<!-- mid section -->
<section class="panel panel-default  padder">
    <style>
        td {

            word-break: break-all;
        }

		  .datepicker-days {
            width: 207px !important;
        }

        .table-condensed {
            width: 205px !important;
        }
    </style>
    <!-- breadcrumbs -->
    <section class="panel panel-default  padder">
        <!-- breadcrumbs -->
        <section>
            <div class="panel-body nobot panelBg" style="margin-top:20px">
                <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                    <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Users Report</strong></span>
                    </div>
                    <div class="pull-right text-right ">
                        <div class="search inline">
                            <span><a href='javascript:exportLPRCSV();' class='btn' title='Export to CSV'><i class="fa fa-file-archive-o"></i></a></span>
                            <!-- <span><a href='javascript:void(0);' id="btnPrint" class='btn' title='Print this window'><i class="fa fa-print"></i></a></span> -->
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <section class="panel panel-default text-center">
            <div class="rightHead text-center bgWt">
                <?php
                if (isset($_POST['from_date'])) {
                    $from_date = trim($_POST['from_date']);
                }
                if (isset($_POST['to_date'])) {
                    $to_date = trim($_POST['to_date']);
                }
                ?>
                <!-- <div class="stepBg">
                <p> <b>Course Name:</b> <?= $courseName ?></p>
                </div>-->
                <form name='frmprofile' id='frmprofile' onsubmit="return checkDate();" action='users-report.php' method='POST'>
                    <div class="col-sm-1"></div>
                    <div class="searchbg">
                        <div class="search inline">
                            <span>
                                Show Users Report From:
                                <div id="divFromDate" class="input-append date inputCalenderDiv">
                                    <input type="text" name="from_date" id="from_date" class="input-sm form-control  searchbtn" size="20" maxlength="10" onClick="popUpCalendar(this,this,'dd/mm/yyyy');" readonly value="<?= $from_date; ?>"> <span class="calendarBg add-on">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                                &nbsp;
                                To:
                                <div id="divToDate" class="input-append date inputCalenderDiv">
                                    <input type="text" name="to_date" id="to_date" class="input-sm form-control  searchbtn" size="20" maxlength="10" onClick="popUpCalendar(this,this,'dd/mm/yyyy');" readonly value="<?= $to_date; ?>">
                                    <span class="calendarBg add-on">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                                <!--<i class="fa fa-search"></i>-->
                                &nbsp; &nbsp;<button type="submit" id="search" name="search" class="btn btn-sm btn-blue searchButton" title='Show login details for this time period'>Search</button>
                                &nbsp; &nbsp;
                                <a href="users-report.php"><button type="button"  class="btn btn-sm btn-blue searchButton" title='Reset Fields' >Reset</button></a>
                                
                            </span>
                        </div>
                    </div>

                </form>
            </div>
			<script>
			function checkDate()
			{
				var startDate=document.getElementById("from_date").value;
				var endDate=document.getElementById("to_date").value;

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
        </section>
        <div style="clear"></div>
        <form name="deletestd" id="deletestd" onSubmit="return confirmDelete();" action="#" method="post" style="margin:0px;">

            <?php
            $user_rowid = getUserId($userid);
            $qPart = "";

            if (isset($_POST['cmbStatus'])) {
                $cmbStatus = $_POST['cmbStatus'];
            } else {
                $cmbStatus = '';
            }
            if ($cmbStatus != "") {
                $qPart = " AND A.userregistered=$cmbStatus ";
            }

            if (isset($_POST['fname'])) {
                $fname = trim($_POST['fname']);
            } else {
                $fname = '';
            }
            if ($fname != "") {
                $qPart .= " AND A.firstname LIKE '%$fname%' or A.lastname LIKE '%$fname%' or CONCAT(A.firstname,  ' ',A.lastname ) LIKE  '%$fname%' ";
            }

            if (isset($_POST['userName'])) {
                $userName = trim($_POST['userName']);
            } else {
                $userName = '';
            }
            if ($userName != "") {
                $qPart .= " AND A.username LIKE '%$userName%' ";
            }

            if (!empty($from_date)) {
                $from_date = date('Y-m-d',strtotime($from_date));
                $qPart .= " AND DATE(A.dtenrolled) > '$from_date'";
            }
            if (!empty($to_date)) {
                $to_date = date('Y-m-d',strtotime($to_date));
                $qPart .= " AND DATE(A.dtenrolled) < '$to_date'";
            }

			$con=createConnection();
			$query1 = "SELECT * FROM tbl_users as A where username<>'admin' " . $qPart . "order by A.dtenrolled DESC";
			$result = mysqli_query($con,$query1);
			$num=mysqli_num_rows($result);


            //$query = "SELECT * FROM tbl_users as A where username<>'admin' " . $qPart . "order by A.dtenrolled DESC";
            //$result = mysql_query($query);
            //$num = mysql_numrows($result);

            //Change the date format to dd/mm/yyyy
            function dtFormat($date)
            {
                list($year, $month, $day) = split('[/.-]', $date);
                echo $day . "/" . $month . "/" . $year;
            }

            ?>
            <section class="panel panel-default panelgridBg">
                <div class="panel row teacher-student-wrap">
                    <!--Responsive grid table -->
                    <div class="table-responsive promo courseGroup table-responsiveWindow" style=" padding-top: 5px; ">
                        <table class="table m-b-none dataTable table-fixed" id="results">
                            <thead class="fixedHeader">
                                <tr>
                                    <th style="width: 9%;">Name</th>
                                    <th style="width: 9%;">Email</th>
                                    <th style="width: 9%;text-align: center;">Mobile</th>
                                    <th style="width: 5%;text-align: center;">City</th>
                                    <th style="width: 5%;text-align: center;">State</th>
                                    <th style="width: 5%;text-align: center;">Pin Code</th>
                                    <th  style="width: 5%;text-align: center;">Education</th>
                                    <th style="width: 5%;text-align: center;">Occupation</th>
                                    <th style="width: 9%;text-align: center;">Organization</th>
                                    <th style="width: 9%;text-align: center;">Designation</th>
                                    <th style="width: 9%;text-align: center;">Reg Date</th>
                                    <th  style="width: 9%;text-align: center">Status</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 0;
                                
                                 while ($row = $result->fetch_assoc())
                                 {
                                    $user_data  = $row;
                                    $id         = $row['id'];
                                    $userrowid  = $row['id'];
                                    $usertype   = $row['usertype'];
                                    $uname      = $row['username'];
                                    $uemail     = $row['email'];
                                    $ustatus    = $row['userregistered'];
                                    $dtEnrolled = $row['dtenrolled'];
                                    $newDTArr   = explode("-", $dtEnrolled);
                                    $newDT      = $newDTArr[2] . "-" . $newDTArr[1] . "-" . $newDTArr[0];

                                    $uoccupation   = $row['occupation'];
                                    $uorganization = $row['organization'];
                                    $udesignation  = $row['designation'];
                                    if ($ustatus == '1') {
                                        $ustatus = "<font color='green'>Active</font>";
                                    } else {
                                        $ustatus = "<font color='red'>Inactive</font>";
                                    }
                                    //$userCourseStatus=getUserCourseStatus($userrowid,$crsid);
                                    //$userCourseTime=getUserCourseTime($userrowid,$crsid);
                                    //$userCourseScore=getUserCourseScore($userrowid,$crsid);

                                    if ($usertype == '2') {
                                        $uRole = 'Administrator';
                                    } else {
                                        $uRole = 'Learner';
                                    }
                                    $userfullname = getFullNameFromID($userrowid);

                                    //$totalCourseAssigned = getUserCourses($uname);

                                    if ($i % 2 == 0) {
                                        $bgc = "row1";
                                    } else {
                                        $bgc = "row2";
                                    }

                                ?>
                                    <tr>
                                        <td style="width: 9%"><?php echo ucfirst(TrimString($userfullname)); ?></td>
                                        <td style="width: 9%;"><?php echo TrimString($uname); ?></td>
                                        <td style="width: 9%;text-align: center;"> <?= $user_data['mobile'] ?></td>
                                        <td style="width: 5%;text-align: center;"><?= $user_data['user_city'] ?></td>
                                        <td style="width: 5%;text-align: center;"><?= $user_data['user_state'] ?></td>
                                        <td style="width: 5%;text-align: center;"><?= $user_data['zip_code'] ?></td>
                                        <td style="width: 5%;text-align: center;"><?= $user_data['education'] ?></td>
                                        <td style="width: 5%;text-align: center;"><?php echo TrimString($uoccupation); ?></td>
                                        <td style="width: 9%;text-align: center;"><?php echo TrimString($uorganization); ?></td>
                                        <td style="width: 9%;text-align: center;"><?php echo TrimString($udesignation); ?></td>
                                        <td style="width: 9%;text-align: center;"><?php echo parseDate($newDT); ?></td>
                                        <td  style="width: 9%;text-align: center;"><?php echo $ustatus; ?></td>

                                    </tr>
                                <?php
                                    $i++;
                                }
                                ?>
                                <?php
                                if (!$num) {
                                    echo "<div  class='noRecordeTable'><h4>No records found!</h4></div>	";
                                    //exit;
                                }
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
        searching: false
    });
});
</script>
<script>
    function resetSelection() {
        document.getElementById("cmbStatus").value = "";
        document.getElementById("cmbCourse").value = "";
        document.frmprofile.submit();
    }

    function exportLPRCSV() {
        var winWd = 200;
        var winHt = 200;
        var winLeft = (screen.width - winWd) / 2;
        var winTop = (screen.height - winHt) / 2;
        var ustatus = '';
        var from_date = document.getElementById('from_date').value;
        var to_date = document.getElementById('to_date').value;

        var settings = 'left=' + winLeft + ',top=' + winTop + ',width=' + winWd + ',height=' + winHt + ',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
        var fpath = "user_export.php?cmbStatus=" + ustatus + "&from_date=" + from_date + "&to_date=" + to_date;
        var logwin = window.open(fpath, 'csvwin', settings);
        logwin.focus();
    }
</script>
<div style="clear"></div>
<?php include '../intface/footer.php'; ?>