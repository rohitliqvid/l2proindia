<script>
    function showReport()
    {
    /* var winWd=1024;
    var winHt=768;
    var winWd=screen.width;
    var winHt=screen.height;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no,fullscreen=yes';
    var fpath="progressreport.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();*/
    
    var winWd=1024;
    var winHt=678;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
    var fpath="progressreport.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();
    }
    
    function showUserReport()
    {
    /* var winWd=1024;
    var winHt=768;
    var winWd=screen.width;
    var winHt=screen.height;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no,fullscreen=yes';
    var fpath="user.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();*/
    
    var winWd=1024;
    var winHt=678;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
    var fpath="user.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();
    }
    
    function showBusinessReport()
    {
     var winWd=1024;
    var winHt=768;
    var winWd=screen.width;
    var winHt=screen.height;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no,fullscreen=yes';
    var fpath="business_report.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();
    }
    
    function showBusinessReportSnapShot()
    {
     var winWd=1024;
    var winHt=768;
    var winWd=screen.width;
    var winHt=screen.height;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no,fullscreen=yes';
    var fpath="business_report_snapshot.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();
    }
    function showLog()
    {
    /*	alert(1);
     var winWd=1024;
    var winHt=768;
    var winWd=0;
    var winHt=0;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=no,statusbar=no,scrollbars=yes,location=no,directories=no,fullscreen=yes';
    var fpath="../userlist/userlog.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();*/
    
    var winWd=1024;
    var winHt=678;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=no,statusbar=no,scrollbars=yes,location=no,directories=no';
    var fpath="../userlist/userlog.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();
    }
    
</script>
<?php include '../intface/adm_top.php'; ?>
<!-- mid section -->
<section class="panel panel-default  padder">
<!-- breadcrumbs -->
<section>
    <div class="panel-body nobot panelBg"  style="margin-top:20px">
        <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
            <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Reports</strong></span> </div>
        </div>
    </div>
</section>
<form   name="docInfo" action="submit_upload_form.php?upload=yes" onSubmit="return ValidateInfo();" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" name="MAX_file_size" value="315000000" />
    <section class="scrollable padder">
        <div class="rightContent newcourse">
            <div class="stepBg">
                <p> Click to open report window
                </p>
            </div>
            <div class="row-centered">
                <div class="col-md-3">
                    <a href="learner-progress-report.php">
                        <div class="panel panel-default" style="border: 1px solid black"; >
                            <div class="panel-body">
                                Learner Progress Report
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="users-report.php">
                        <div class="panel panel-default" style="border: 1px solid black"; >
                            <div class="panel-body">
                                Users Report
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-md-3">
                    <a href="activity-log.php">
                        <div class="panel panel-default" style="border: 1px solid black"; >
                            <div class="panel-body">
                                User Activity Log Report
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-md-3">
                    <a href="module-wise-usage-report.php">
                        <div class="panel panel-default" style="border: 1px solid black"; >
                            <div class="panel-body">
                            Module Wise Usage Report
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 mt-2" style="margin-top:20px;">
                    <a href="module-completion-status.php">
                        <div class="panel panel-default" style="border: 1px solid black" >
                            <div class="panel-body">
                            Module Completion Status Report
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 mt-2" style="margin-top:20px;">
                    <a href="survey_report.php">
                        <div class="panel panel-default" style="border: 1px solid black" >
                            <div class="panel-body">
                            Survey Report
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- <div class="row-centered">
                <div class="divider"></div>
                <div class="divider"></div>
                <div class="col-sm-12 col-xs-12 col-centered vTop text-left">
                    <a href='javascript:showReport();' class="text-center"><img src='../graphics/arrow01.png' border='0' align='absmiddle' />Learner Progress Tracking</a>
                </div>
                <div class="divider"></div>
                <div class="col-sm-12 col-xs-12 col-centered vTop  text-center">
                    <a href='javascript:showUserReport();'  class="text-center"><img src='../graphics/arrow01.png' border='0' align='absmiddle' />Users Report</a>
                </div>
                <div class="divider"></div>
                <div class="col-sm-12 col-xs-12 col-centered vTop ">
                    <a href='javascript:showLog();' class="text-center"><img src='../graphics/arrow01.png' border='0' align='absmiddle' />User Activity Log</a>
                </div>
            </div> -->
        </div>
        </div>
        <!--end right  content bar -->
        <!--End Midlle container -->
    </section>
</form>
<div style="clear"></div>
<?php
    include '../intface/footer.php';
    ?>
<?php
    if (strpos($_SERVER['REQUEST_URI'], 'index.php') !== false) {
     ?>
<script>
    $("#reportsActive").addClass('active');
    $("#home").removeClass('active');
</script>
<?php
    }
    ?><script>
    function showReport()
    {
    /* var winWd=1024;
    var winHt=768;
    var winWd=screen.width;
    var winHt=screen.height;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no,fullscreen=yes';
    var fpath="progressreport.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();*/
    
    var winWd=1024;
    var winHt=678;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
    var fpath="progressreport.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();
    }
    
    function showUserReport()
    {
    /* var winWd=1024;
    var winHt=768;
    var winWd=screen.width;
    var winHt=screen.height;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no,fullscreen=yes';
    var fpath="user.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();*/
    
    var winWd=1024;
    var winHt=678;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
    var fpath="user.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();
    }
    
    function showBusinessReport()
    {
     var winWd=1024;
    var winHt=768;
    var winWd=screen.width;
    var winHt=screen.height;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no,fullscreen=yes';
    var fpath="business_report.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();
    }
    
    function showBusinessReportSnapShot()
    {
     var winWd=1024;
    var winHt=768;
    var winWd=screen.width;
    var winHt=screen.height;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no,fullscreen=yes';
    var fpath="business_report_snapshot.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();
    }
    function showLog()
    {
    /*	alert(1);
     var winWd=1024;
    var winHt=768;
    var winWd=0;
    var winHt=0;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=no,statusbar=no,scrollbars=yes,location=no,directories=no,fullscreen=yes';
    var fpath="../userlist/userlog.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();*/
    
    var winWd=1024;
    var winHt=678;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=no,statusbar=no,scrollbars=yes,location=no,directories=no';
    var fpath="../userlist/userlog.php";
    var logwin=window.open(fpath,'logwin',settings);
    logwin.focus();
    }
    
</script>
<?php include '../intface/adm_top.php'; ?>
<!-- mid section -->
<section class="panel panel-default  padder">
<!-- breadcrumbs -->
<section>
    <div class="panel-body nobot panelBg"  style="margin-top:20px">
        <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
            <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Reports</strong></span> </div>
        </div>
    </div>
</section>
<form   name="docInfo" action="submit_upload_form.php?upload=yes" onSubmit="return ValidateInfo();" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" name="MAX_file_size" value="315000000" />
    <section class="scrollable padder">
        <div class="rightContent newcourse">
            <div class="stepBg">
                <p> Click to open report window
                </p>
            </div>
            <div class="row-centered">
                <div class="col-md-3">
                    <div class="panel panel-default" style="border: 1px solid black"; >
                        <div class="panel-body">
                            Basic panel example
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-centered">
                <div class="divider"></div>
                <div class="divider"></div>
                <div class="col-sm-12 col-xs-12 col-centered vTop text-left">
                    <a href='javascript:showReport();' class="text-center"><img src='../graphics/arrow01.png' border='0' align='absmiddle' />Learner Progress Tracking</a>
                </div>
                <div class="divider"></div>
                <div class="col-sm-12 col-xs-12 col-centered vTop  text-center">
                    <a href='javascript:showUserReport();'  class="text-center"><img src='../graphics/arrow01.png' border='0' align='absmiddle' />Users Report</a>
                </div>
                <div class="divider"></div>
                <div class="col-sm-12 col-xs-12 col-centered vTop ">
                    <a href='javascript:showLog();' class="text-center"><img src='../graphics/arrow01.png' border='0' align='absmiddle' />User Activity Log</a>
                </div>
            </div>
        </div>
        </div>
        <!--end right  content bar -->
        <!--End Midlle container -->
    </section>
</form>
<div style="clear"></div>
<?php
    include '../intface/footer.php';
    ?>
<?php
    if (strpos($_SERVER['REQUEST_URI'], 'index.php') !== false) {
     ?>
<script>
    $("#reportsActive").addClass('active');
    $("#home").removeClass('active');
</script>
<?php
    }
    ?>
function showUserReport()
{
/* var winWd=1024;
var winHt=768;
var winWd=screen.width;
var winHt=screen.height;
var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no,fullscreen=yes';
var fpath="user.php";
var logwin=window.open(fpath,'logwin',settings);
logwin.focus();*/
var winWd=1024;
var winHt=678;
var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
var fpath="user.php";
var logwin=window.open(fpath,'logwin',settings);
logwin.focus();
}
function showBusinessReport()
{
var winWd=1024;
var winHt=768;
var winWd=screen.width;
var winHt=screen.height;
var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no,fullscreen=yes';
var fpath="business_report.php";
var logwin=window.open(fpath,'logwin',settings);
logwin.focus();
}
function showBusinessReportSnapShot()
{
var winWd=1024;
var winHt=768;
var winWd=screen.width;
var winHt=screen.height;
var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no,fullscreen=yes';
var fpath="business_report_snapshot.php";
var logwin=window.open(fpath,'logwin',settings);
logwin.focus();
}
function showLog()
{
/*	alert(1);
var winWd=1024;
var winHt=768;
var winWd=0;
var winHt=0;
var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=no,statusbar=no,scrollbars=yes,location=no,directories=no,fullscreen=yes';
var fpath="../userlist/userlog.php";
var logwin=window.open(fpath,'logwin',settings);
logwin.focus();*/
var winWd=1024;
var winHt=678;
var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=no,statusbar=no,scrollbars=yes,location=no,directories=no';
var fpath="../userlist/userlog.php";
var logwin=window.open(fpath,'logwin',settings);
logwin.focus();
}
</script>
<?php include ('../intface/adm_top.php'); ?>
<!-- mid section -->
<section class="panel panel-default  padder">
<!-- breadcrumbs -->
<section>
    <div class="panel-body nobot panelBg"  style="margin-top:20px">
        <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
            <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Reports</strong></span> </div>
        </div>
    </div>
</section>
<form   name="docInfo" action="submit_upload_form.php?upload=yes" onSubmit="return ValidateInfo();" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" name="MAX_file_size" value="315000000" />
    <section class="scrollable padder">
        <div class="rightContent newcourse">
            <div class="stepBg">
                <p> Click to open report window
                </p>
            </div>
            <div class="row-centered">
                <div class="divider"></div>
                <div class="divider"></div>
                <div class="col-sm-12 col-xs-12 col-centered vTop text-left">
                    <a href='javascript:showReport();' class="text-center"><img src='../graphics/arrow01.png' border='0' align='absmiddle' />Learner Progress Tracking</a>
                </div>
                <div class="divider"></div>
                <div class="col-sm-12 col-xs-12 col-centered vTop  text-center">
                    <a href='javascript:showUserReport();'  class="text-center"><img src='../graphics/arrow01.png' border='0' align='absmiddle' />Users Report</a>
                </div>
                <div class="divider"></div>
                <div class="col-sm-12 col-xs-12 col-centered vTop ">
                    <a href='javascript:showLog();' class="text-center"><img src='../graphics/arrow01.png' border='0' align='absmiddle' />User Activity Log</a>
                </div>
            </div>
        </div>
        </div>
        <!--end right  content bar -->
        <!--End Midlle container -->
    </section>
</form>
<div style="clear"></div>
<?php
    include ('../intface/footer.php');
    ?>
<?php
    if(strpos($_SERVER['REQUEST_URI'], 'index.php')!== false)  {
    ?>
<script>
    $("#reportsActive").addClass('active');
    $("#home").removeClass('active');
</script>
<?php
    }
    ?>