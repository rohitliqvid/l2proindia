<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../intface/adm_top.php'; ?>
<!-- mid section -->
<section class="panel panel-default  padder">
    <!-- breadcrumbs -->
    <section class="panel panel-default  padder">
        <!-- breadcrumbs -->
        <section>
            <div class="panel-body nobot panelBg" style="margin-top:20px">
                <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                    <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Learner Progress Report</strong></span>
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
                <form name='frmprofile' id='frmprofile' onSubmit='return checkDate();' action='learner-progress-report.php' method='POST'>
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
                                <a href="learner-progress-report.php">
                                    <button type="button" class="btn btn-sm btn-blue searchButton" title='Reset Fields'>Reset</button>
                                </a>

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
        <div style="clear:both;"></div>
        <form name="deletestd" id="deletestd" onSubmit="return confirmDelete();" action="#" method="post" style="margin:0px;">
            <section class="panel panel-default  theadHeight">
                <?php
                $con=createConnection();
                
                $user_rowid = getUserId($userid);
                $crsresult = mysqli_query($con,"SELECT * FROM tls_scorm where coursetype='wbt' ORDER BY id ASC");
                $crnum = mysqli_num_rows($crsresult);
                $i = 0;
                $arr_course = array();
                while ($row = $crsresult->fetch_assoc())
                {
                    
                    $id = $row['id'];
                    $crssid = $row['id'];
                    $crsname = $row['name'];
                    $arr_course[] = array('id' => $crssid, 'name' => $crsname);
                    
                }
                
                
                
                if (isset($_POST['cmbCourse']) && $_POST['cmbCourse'] != "") {

                    $crsid = $_POST['cmbCourse'];
                    $cmbStatus = $_POST['cmbStatus'];
                } else {
                    $crsid = $arr_course[0]['id'];
                    $cmbStatus = '';
                }
                $courseName = getCourseNameFromId($crsid);

                // if (!empty($from_date)) {
                //     $from_date = date('Y-m-d', strtotime($from_date));
                //     $qPart .= " AND DATE(A.dtenrolled) > '$from_date'";
                // }
                // if (!empty($to_date)) {
                //     $to_date = date('Y-m-d', strtotime($to_date));
                //     $qPart .= " AND DATE(A.dtenrolled) < '$to_date'";
                // }

                //echo "cmbStatus: ".$cmbStatus;
               $query = "SELECT * FROM tbl_users AS A WHERE A.userregistered='1' AND username<>'admin' AND usertype <> 3 " . $qPart . " order by A.usertype DESC, A.username ASC";

                $result = mysqli_query($con,$query);
                $num = mysqli_num_rows($result);
                
                ?>

            </section>
            <section class="panel panel-default panelgridBg">
                <div class="panel row teacher-student-wrap">
                    <!--Responsive grid table -->
                    <div class="table-responsive promo courseGroup table-responsiveWindow" style=" padding-top: 5px; ">
                        <table class="table m-b-none dataTable table-fixed" id="results">
                            <thead class="fixedHeader">
                                <tr>
                                    <th class="col-xs-2">Name</th>
                                    <th class="col-xs-2">Username</th>
                                    <th class="col-xs-2" style="text-align: center">Course Status</th>
                                    <th class="col-xs-2" style="text-align: center">Time Spent</th>
                                    <th class="col-xs-2" style="text-align: center">Completion Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $j = 0;
                                
                                while($row = $result->fetch_assoc())
                                {
                                    
                                    $user_data  = $row;
                                    $id = $row['id'];
                                    $userrowid = $row["id"];
                                    $usertype = $row["usertype"];
                                    $uname = $row["username"];

                                    $userCourseStatus = getUserCourseStatus($userrowid, $crsid);
                                    $userCourseTime = getUserCourseTime($userrowid, $crsid);
                                    $userCourseScore = getUserCourseScore($userrowid, $crsid);

                                    $userCourseCompletionDate = getUserCompletionDate($userrowid, $crsid);
                                    $userCourseCompletionDate = $userCourseCompletionDate == '-' ? '00-00-0000' : $userCourseCompletionDate;


                                    if ((!empty($from_date) || !empty($to_date)) && ($userCourseStatus != 'completed' || $userCourseCompletionDate == '00-00-0000')) {
                                        $i++;
                                        continue;
                                    }

                                    if (!empty($from_date) && strtotime($userCourseCompletionDate) < strtotime($from_date)) {
                                        $i++;
                                        continue;
                                    }

                                    if (!empty($to_date) && strtotime($userCourseCompletionDate) > strtotime($to_date)) {
                                        $i++;
                                        continue;
                                    }

                                    if ($usertype == '2') {
                                        $uRole = 'Administrator';
                                    } else {
                                        $uRole = 'Learner';
                                    }

                                    $userfullname = getFullNameFromIDMask($userrowid);

                                    if ($cmbStatus == 'notattempted' && $userCourseStatus == 'Not Attempted') {
                                        $visible = '';
                                        $colorClass = 'style="color:red"';
                                    } else if ($cmbStatus == 'incomplete' && ($userCourseStatus == 'incomplete' || $userCourseStatus == 'failed')) {
                                        $visible = '';
                                        $colorClass = 'style="color:red"';
                                    } else if ($cmbStatus == 'completed' && ($userCourseStatus == 'completed' || $userCourseStatus == 'passed')) {
                                        $visible = '';
                                        $colorClass = 'style="color:green"';
                                    } else {
                                        $visible = 'display:none';
                                        $colorClass = '';
                                    }

                                    if ($cmbStatus == "") {
                                        $visible = '';

                                        if ($userCourseStatus == 'Not Attempted') {
                                            $colorClass = 'style="color:red"';
                                        } else if ($userCourseStatus == 'incomplete' || $userCourseStatus == 'failed') {
                                            $colorClass = 'style="color:red"';
                                        } else if ($userCourseStatus == 'completed' || $userCourseStatus == 'passed') {

                                            $colorClass = 'style="color:green"';
                                        } else {
                                            $colorClass = '';
                                        }
                                    }
                                    if ($visible != '') {
                                        $j++;
                                    }

                                    if ($userCourseStatus == 'Passed') {

                                        $userCourseStatus = 'Completed';
                                    }

                                ?>
                                    <tr style="<?php echo $visible; ?>">
                                        <td class="col-xs-2"><? echo ucfirst(TrimString($userfullname)); ?>
                                        </td>
                                        <td class="col-xs-2" ><? echo TrimString(obfuscate_email($uname)); ?>
                                        </td>
                                        <td class="col-xs-2" style="text-align: center">
                                            <span <?php echo $colorClass; ?>>
                                                <?php echo ucfirst($userCourseStatus); ?>
                                            </span>
                                        </td>
                                        <td class="col-xs-2" style="text-align: center">
                                            <?php if ($userCourseTime != "") {
                                                echo formatToNewTime($userCourseTime);
                                            } else {
                                                echo "NA";
                                            } ?>
                                        </td>
                                        <td class="col-xs-2 text-center">
                                            <?php echo $userCourseCompletionDate; ?>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
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
<div style="clear"></div>

<script>
    $(document).ready(function () {
    $('#results').DataTable({
        paging: false,
        searching: false,
        order: [[4, 'desc']],
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
        var course = '';
        var from_date = document.getElementById('from_date').value;
        var to_date = document.getElementById('to_date').value;

        var settings = 'left=' + winLeft + ',top=' + winTop + ',width=' + winWd + ',height=' + winHt + ',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
        var fpath = "progressreport_export.php?cmbStatus=" + ustatus + "&cmbCourse=" + course + "&from_date=" + from_date + "&to_date=" + to_date;
        var logwin = window.open(fpath, 'csvwin', settings);
        logwin.focus();
    }
</script>
<script>
    function convertDate(d) {
        d = d.trim();
        var p = d.split("-");
        return +(p[2] + p[1] + p[0]);
    }

    function sortByDate() {
        var tbody = document.querySelector("#results tbody");
        // get trs as array for ease of use
        var rows = [].slice.call(tbody.querySelectorAll("tr"));

        rows.sort(function(a, b) {
            return convertDate(b.cells[4].innerHTML) - convertDate(a.cells[4].innerHTML);
        });

        rows.forEach(function(v) {
            //console.log(v);
            tbody.appendChild(v); // note that .appendChild() *moves* elements
        });
    }
    $(document).ready(function() {
        //sortByDate('desc');
    });
</script>
<?php include '../intface/footer.php';  ?>