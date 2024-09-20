<?php include '../intface/adm_top.php'; ?>
<!-- mid section -->
<section class="panel panel-default  padder">
    <!-- breadcrumbs -->
    <section class="panel panel-default  padder">
        <!-- breadcrumbs -->
        <section>
            <div class="panel-body nobot panelBg" style="margin-top:20px">
                <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                    <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong> Module Wise Usage</strong></span>
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
        <div style="clear"></div>
        <form name="deletestd" id="deletestd" onSubmit="return confirmDelete();" action="#" method="post"
            style="margin:0px;">
            <section class="panel panel-default panelgridBg">
                <div class="panel row teacher-student-wrap">
                    <!--Responsive grid table -->
                    <div class="table-responsive promo courseGroup table-responsiveWindow" style=" padding-top: 5px; ">
                        <table class="table m-b-none dataTable table-fixed" id="results">
                            <thead class="fixedHeader">
                                <tr>
                                    <th class="col-xs-1 ">S.No</th>
                                    <th class="col-xs-4 ">Module  </th>
                                    <th class="col-xs-3" style="text-align: center">Number of Logins</th>
                                    <th class="col-xs-3" style="text-align: center">Time  Spent</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                 $con=createConnection();
                                $userid=$_REQUEST['uid'];
                                $userfullname=getFullNameFromID($userid);
                                $result2 = mysqli_query($con,"SELECT * FROM tls_scorm"); 
                                $num=mysqli_num_rows($result2);

                                $i=0;
                                while ($row = $result2->fetch_assoc()){
                                     ?>

                                <tr>
                                    <td class="col-xs-1"><?php echo $i +1?></td>
                                    <td class="col-xs-4"> <?php echo $row['name']?> </td>
                                    <td class="col-xs-3" style="text-align: center">
                                        <?php
                                        $course_id = $row['id'];
                                        $logins_sql =  mysqli_query ($con,"SELECT * FROM `tls_scorm_sco_tracking` WHERE `element` LIKE 'cmi.core.lesson_status' AND value = 'completed' AND scormid = $course_id"); 
                                        $logins_number=mysqli_num_rows($logins_sql);
                                        echo $logins_number;
                                        ?>
                                    </td>
                                    <td class="col-xs-3" style="text-align: center">
                                        <?php
                                            $spend_time_sql =  mysqli_query ($con,"SELECT id,value FROM tls_scorm_sco_tracking WHERE element='cmi.core.total_time' AND scormid=$course_id"); 
                                            
                                            $total_time  = '00:00:00.00';
                                            if (mysqli_num_rows($spend_time_sql) > 0) {
                                                while($spend_time_row = $spend_time_sql->fetch_assoc()) {
                                                    //print_r();
                                                    $total_time = sum_the_time($total_time, $spend_time_row['value']);
                                                }
                                            }
                                            echo $total_time;

                                        ?>

                                    </td>
                                </tr>


                            <? $i++; } ?>
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

<?php  
function sum_the_time($time1, $time2) {
    $times = array($time1, $time2);
    $seconds = 0;
    foreach ($times as $time)
    {
      list($hour,$minute,$second) = explode(':', $time);
      $seconds += $hour*3600;
      $seconds += $minute*60;
      $seconds += $second;
    }
    $hours = floor($seconds/3600);
    $seconds -= $hours*3600;
    $minutes  = floor($seconds/60);
    $seconds -= $minutes*60;
    if($seconds < 9)
    {
    $seconds = "0".$seconds;
    }
    if($minutes < 9)
    {
    $minutes = "0".$minutes;
    }
      if($hours < 9)
    {
    $hours = "0".$hours;
    }
    return "{$hours}:{$minutes}:{$seconds}";
}


?>
<script>
    function resetSelection()
    {
    document.getElementById("cmbStatus").value="";
    document.getElementById("cmbCourse").value="";
    document.frmprofile.submit();
    }
    function exportLPRCSV()
    {
        var winWd=200;
        var winHt=200;
        var winLeft = (screen.width - winWd) / 2;
        var winTop = (screen.height - winHt) / 2;

        var ustatus = '';
        var course = '';

        var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
        var fpath="module_wise_usage_report_export.php?cmbStatus="+ustatus+"&cmbCourse="+course;
        var logwin=window.open(fpath,'csvwin',settings);
        logwin.focus();
    }
</script>
<div style="clear"></div>
<?php include '../intface/footer.php'; ?>