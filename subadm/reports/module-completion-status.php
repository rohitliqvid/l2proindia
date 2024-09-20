<?php include '../intface/adm_top.php'; ?>
<!-- mid section -->
<section class="panel panel-default  padder">
    <!-- breadcrumbs -->

    <section>
            <div class="panel-body nobot panelBg" style="margin-top:20px">
                <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                    <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong> Module Completion Status Report</strong></span>
                    </div>
                    <div class="pull-right text-right ">
                        
                    </div>
                </div>
            </div>
            </div>
        </section>
    <section class="panel panel-default  padder">
        <!-- breadcrumbs -->
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
                <form name="frmprofile" id="frmprofile" onSubmit="return validateDateFilter();" action="module-completion-status.php" method="POST">
                    <div class="col-sm-1"></div>
                    <div class="searchbg">
                        <div class="search inline">
                            <span>
                                Show Status From Date:
                                <div id="divFromDate" class="input-append date inputCalenderDiv">
                                    <input type="text" name="from_date" id="from_date" class="input-sm form-control  searchbtn" size="20" maxlength="10" onClick="popUpCalendar(this,this,'dd/mm/yyyy');" readonly value="<?= $from_date; ?>"> <span class="calendarBg add-on">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                                &nbsp;
                                To Date:
                                <div id="divToDate" class="input-append date inputCalenderDiv">
                                    <input type="text" name="to_date" id="to_date" class="input-sm form-control  searchbtn" size="20" maxlength="10" onClick="popUpCalendar(this,this,'dd/mm/yyyy');" readonly value="<?= $to_date; ?>">
                                    <span class="calendarBg add-on">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                                <!--<i class="fa fa-search"></i>-->
                                &nbsp; &nbsp;<button type="submit" id="search" name="search" class="btn btn-sm btn-blue searchButton" title='Show login details for this time period'>Search</button>
                                &nbsp; &nbsp;
                                <a href="module-completion-status.php"><button type="button" class="btn btn-sm btn-blue searchButton" title='Reset Fields'>Reset</button></a>

                            </span>
                        </div>
                    </div>

                </form>
            </div>
            </div>
        </section>

        <section>
            <div class="panel-body nobot panelBg" style="margin-top:20px">
                <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                    <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong> Module Completion Status : Basic</strong>
                        </span>
                    </div>
                </div>
            </div>
            </div>
        </section>

        <div style="clear"></div>
        <form name="deletestd" id="deletestd" onSubmit="return confirmDelete();" action="#" method="post" style="margin:0px;">
            <section class="panel panel-default panelgridBg">
                <div class="panel row teacher-student-wrap">
                    <!--Responsive grid table -->
                    <div class="table-responsive promo courseGroup table-responsiveWindow" style=" padding-top: 5px; ">
                        <table class="table m-b-none dataTable table-fixed">
                            <thead class="fixedHeader">
                                <tr>
                                    <th class="col-xs-1 text-left">S.No</th>
                                    <th class="col-xs-4 text-left">Module </th>
                                    <th class="col-xs-2" style="text-align: center">Number Of Started</th>
                                    <th class="col-xs-1 " style="text-align: center">Completed</th>
                                    <th class="col-xs-2" style="text-align: center">In-Completed</th>
                                    <th class="col-xs-1" style="text-align: center">Not Started</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $u_q_part = "";
                                $strom_tbl_filter = "";

                                $userid       = $_REQUEST['uid'];
                                $userfullname = getFullNameFromID($userid);

                                if (!empty($from_date)) {
                                    $from_date = date('Y-m-d', strtotime($from_date));
                                    $u_q_part .= " AND DATE(dtenrolled) > '$from_date'";
                                    $from_date_milli = strtotime($from_date);
                                    $strom_tbl_filter .= " AND timemodified > $from_date_milli";
                                }
                                if (!empty($to_date)) {
                                    $to_date = date('Y-m-d', strtotime($to_date));
                                    $u_q_part .= " AND DATE(dtenrolled) < '$to_date'";

                                    $to_date_milli = strtotime($to_date);
                                    $strom_tbl_filter .= " AND timemodified <= $to_date_milli";
                                }

                                $con=createConnection();
								$result2      = mysqli_query($con,"SELECT * FROM tls_scorm WHERE course_level='Basic'");
                                $num          = mysqli_num_rows($result2);
                                $i = 0;
                                 while ($row = $result2->fetch_assoc()){
                                    //$row = mysql_fetch_assoc($result2);
                                ?>
                                    <?php
                                    $course_id     = $row['id'];

                                    $total_count_sql    = mysqli_query($con,"SELECT COUNT(id) as total_users FROM tbl_users WHERE id > 1 " . $u_q_part);
                                    $total_count_row = mysqli_fetch_array($total_count_sql, MYSQLI_ASSOC);
                                     $total_count_number = $total_count_row['total_users'];

                                    $completed_sql    = mysqli_query($con,"SELECT * FROM `tls_scorm_sco_tracking` WHERE `element` LIKE 'cmi.core.lesson_status' AND value = 'completed' AND scormid = $course_id" . $strom_tbl_filter);
                                    $completed_number = mysqli_num_rows($completed_sql);

                                    $incomplete_sql    = mysqli_query($con,"SELECT * FROM `tls_scorm_sco_tracking` WHERE `element` LIKE 'cmi.core.lesson_status' AND value = 'incomplete' AND scormid = $course_id" . $strom_tbl_filter);
                                    $incomplete_number = mysqli_num_rows($incomplete_sql);

                                    $total_started_number = $completed_number + $incomplete_number;
                                    $not_statted_number = $total_count_number - $total_started_number;

                                    ?>
                                    <tr>
                                        <td class="col-xs-1 text-left"><?php echo $i + 1; ?></td>
                                        <td class="col-xs-4 text-left"> <?php echo $row['name']; ?> </td>
                                        <td class="col-xs-2 " style="text-align: center"><?= $total_started_number ?> </td>
                                        <td class="col-xs-1 " style="text-align: center"><?= $completed_number ?></td>
                                        <td class="col-xs-2 " style="text-align: center"><?= $incomplete_number ?></td>
                                        <td class="col-xs-1 " style="text-align: center"><?= $not_statted_number ?></td>

                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- row end here -->
            </section>
        </form>
    </section>

    <section class="panel panel-default  padder">
        <!-- breadcrumbs -->
        <section>
            <div class="panel-body nobot panelBg" style="margin-top:20px">
                <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                    <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong> Module Completion Status : Intermediate</strong>
                        </span>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <div style="clear"></div>
        <form name="deletestd" id="deletestd" onSubmit="return confirmDelete();" action="#" method="post" style="margin:0px;">
            <section class="panel panel-default panelgridBg">
                <div class="panel row teacher-student-wrap">
                    <!--Responsive grid table -->
                    <div class="table-responsive promo courseGroup table-responsiveWindow" style=" padding-top: 5px; ">
                        <table class="table m-b-none dataTable table-fixed">
                            <thead class="fixedHeader">
                                <tr>
                                    <th class="col-xs-1 text-left">S.No</th>
                                    <th class="col-xs-4 text-left">Module </th>
                                    <th class="col-xs-2" style="text-align: center">Number Of Started</th>
                                    <th class="col-xs-1" style="text-align: center">Completed</th>
                                    <th class="col-xs-2" style="text-align: center">In-Completed</th>
                                    <th class="col-xs-1" style="text-align: center">Not Started</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userid       = $_REQUEST['uid'];
                                $userfullname = getFullNameFromID($userid);
                                $result2      = mysqli_query($con,"SELECT * FROM tls_scorm WHERE course_level='Intermediate'");
                                $num          = mysqli_num_rows($result2);
                                $i = 0;
                                while ($row = $result2->fetch_assoc()){
                                    //$row = mysql_fetch_assoc($result2);
                                ?>
                                    <?php
                                    $course_id     = $row['id'];

                                    $total_count_sql    = mysqli_query($con,"SELECT COUNT(id) as total_users FROM tbl_users WHERE id > 1" . $u_q_part);
                                    $total_count_row=mysqli_fetch_array($total_count_sql, MYSQLI_ASSOC);
                                     $total_count_number = $total_count_row['total_users'];

                                    $completed_sql    = mysqli_query($con,"SELECT * FROM `tls_scorm_sco_tracking` WHERE `element` LIKE 'cmi.core.lesson_status' AND value = 'completed' AND scormid = $course_id" . $strom_tbl_filter);
                                    $completed_number = mysqli_num_rows($completed_sql);

                                    $incomplete_sql    = mysqli_query($con,"SELECT * FROM `tls_scorm_sco_tracking` WHERE `element` LIKE 'cmi.core.lesson_status' AND value = 'incomplete' AND scormid = $course_id" . $strom_tbl_filter);
                                    $incomplete_number = mysqli_num_rows($incomplete_sql);

                                    $total_started_number = $completed_number + $incomplete_number;
                                    $not_statted_number = $total_count_number - $total_started_number;

                                    ?>
                                    <tr>
                                        <td class="col-xs-1 text-left"><?php echo $i + 1; ?></td>
                                        <td class="col-xs-4 text-left"> <?php echo $row['name']; ?> </td>
                                        <td class="col-xs-2" style="text-align: center"><?= $total_started_number ?> </td>
                                        <td class="col-xs-1" style="text-align: center"><?= $completed_number ?></td>
                                        <td class="col-xs-2" style="text-align: center"><?= $incomplete_number ?></td>
                                        <td class="col-xs-1" style="text-align: center"><?= $not_statted_number ?></td>

                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- row end here -->
            </section>
        </form>
    </section>

    <section class="panel panel-default  padder">
        <!-- breadcrumbs -->
        <section>
            <div class="panel-body nobot panelBg" style="margin-top:20px">
                <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                    <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong> Module Completion Status : Advance</strong>
                        </span>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <div style="clear"></div>
        <form name="deletestd" id="deletestd" onSubmit="return confirmDelete();" action="#" method="post" style="margin:0px;">
            <section class="panel panel-default panelgridBg">
                <div class="panel row teacher-student-wrap">
                    <!--Responsive grid table -->
                    <div class="table-responsive promo courseGroup table-responsiveWindow" style=" padding-top: 5px; ">
                        <table class="table m-b-none dataTable table-fixed">
                            <thead class="fixedHeader">
                                <tr>
                                    <th class="col-xs-1 text-left">S.No</th>
                                    <th class="col-xs-4 text-left" style="text-align: center">Module </th>
                                    <th class="col-xs-2" style="text-align: center">Number Of Started</th>
                                    <th class="col-xs-1" style="text-align: center">Completed</th>
                                    <th class="col-xs-2 " style="text-align: center">In-Completed</th>
                                    <th class="col-xs-1" style="text-align: center">Not Started</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userid       = $_REQUEST['uid'];
                                $userfullname = getFullNameFromID($userid);
                                $result2      = mysqli_query($con,"SELECT * FROM tls_scorm WHERE course_level='Advance'");
                                $num          = mysqli_num_rows($result2);
                                $i = 0;
                                 while ($row = $result2->fetch_assoc()){
                                  //  $row = mysql_fetch_assoc($result2);
                                ?>
                                    <?php
                                    $course_id     = $row['id'];

                                    $total_count_sql    = mysqli_query("SELECT COUNT(id) as total_users FROM tbl_users WHERE id > 1" . $u_q_part);
                                    $total_count_row=mysqli_fetch_array($total_count_sql, MYSQLI_ASSOC);
                                    $total_count_number = $total_count_row['total_users'];

                                    $completed_sql    = mysqli_query($con,"SELECT * FROM `tls_scorm_sco_tracking` WHERE `element` LIKE 'cmi.core.lesson_status' AND value = 'completed' AND scormid = $course_id" . $strom_tbl_filter);
                                    $completed_number = mysqli_num_rows($completed_sql);

                                    $incomplete_sql    = mysqli_query($con,"SELECT * FROM `tls_scorm_sco_tracking` WHERE `element` LIKE 'cmi.core.lesson_status' AND value = 'incomplete' AND scormid = $course_id" . $strom_tbl_filter);
                                    $incomplete_number = mysqli_num_rows($incomplete_sql);

                                    $total_started_number = $completed_number + $incomplete_number;
                                    $not_statted_number = $total_count_number - $total_started_number;

                                    ?>
                                    <tr>
                                        <td class="col-xs-1 text-left"><?php echo $i + 1; ?></td>
                                        <td class="col-xs-4 text-left"> <?php echo $row['name']; ?> </td>
                                        <td class="col-xs-2" style="text-align: center"><?= $total_started_number ?> </td>
                                        <td class="col-xs-1" style="text-align: center"><?= $completed_number ?></td>
                                        <td class="col-xs-2" style="text-align: center"><?= $incomplete_number ?></td>
                                        <td class="col-xs-1" style="text-align: center"><?= $not_statted_number ?></td>

                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- row end here -->
            </section>
        </form>
    </section>
</section>
<?php
function sum_the_time($time1, $time2)
{
    $times   = array($time1, $time2);
    $seconds = 0;
    foreach ($times as $time) {
        list($hour, $minute, $second) = explode(':', $time);
        $seconds += $hour * 3600;
        $seconds += $minute * 60;
        $seconds += $second;
    }
    $hours = floor($seconds / 3600);
    $seconds -= $hours * 3600;
    $minutes = floor($seconds / 60);
    $seconds -= $minutes * 60;
    if ($seconds < 9) {
        $seconds = "0" . $seconds;
    }
    if ($minutes < 9) {
        $minutes = "0" . $minutes;
    }
    if ($hours < 9) {
        $hours = "0" . $hours;
    }
    return "{$hours}:{$minutes}:{$seconds}";
}

?>
<script>
    function validateDateFilter() {
        if (document.getElementById("from_date").value == "") {
            alertify.alert("Please select From date!");
            return false;
        } else if (document.getElementById("to_date").value == "") {
            alertify.alert("Please select To date!");
            return false;
        } else {
            var from_date = ($('#from_date').val()).split("-");
            var to_date = ($('#to_date').val()).split("-");
            
            let from = new Date([from_date[1], from_date[0], from_date[2]].join("-")).getTime();
            let to = new Date([to_date[1], to_date[0], to_date[2]].join("-")).getTime();
            
            if (from > to) {
                alertify.alert("To date should be greater or equal to From date!");
                return false;
            }
        }
    }

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

        var settings = 'left=' + winLeft + ',top=' + winTop + ',width=' + winWd + ',height=' + winHt + ',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
        var fpath = "progressreport_export.php?cmbStatus=" + ustatus + "&cmbCourse=" + course;
        var logwin = window.open(fpath, 'csvwin', settings);
        logwin.focus();
    }
</script>
<div style="clear"></div>
<?php include '../intface/footer.php'; ?>