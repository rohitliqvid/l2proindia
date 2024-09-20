
<?php include ('../intface/adm_top.php'); ?>

<script>
/*
window.onload = function(){
	setPageTitle('Countries > Create new country');
}*/

</script><script>
function showReport()
{
var winWd=750;
var winHt=550;
var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=no,statusbar=no,scrollbars=yes,location=no,directories=no';
var fpath="bulkuserreport.php";
var logwin=window.open(fpath,'bulkrpt',settings);
logwin.focus();
}
</script>
<section id="content" class="rightside rightContenBg">
<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="padder topMenuContent">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Users > Bulk Upload </strong></span> </div>
		 
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
		
		<a onFocus='this.blur()' onMouseOver='return showStatus();' href="userlist.php" target="_self" title="Go back" class="btn pull-right m-b-xs">Back</a>
		</div>
  </div>
  
  
</section>
</section>
<section class="scrollable padder mTop">
            <div class="rightContent newcourse">
              
              <div class="stepBg">
                <p> Users created successfully! Click on View Report link to view the list of users created.
                
                </p>
              </div>

  <div class="row-centered">
  
       <p style="padding-top:100px;"> <a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:showReport();" title="View Report"><img src="../graphics/arrow01.png" border="0" align="absmiddle"> View Report</a></p>
</div>


</div>		
		
           </div>
			
      <!--end right  content bar -->
	  
  <!--End Midlle container -->

</section>
<?php
include ('../intface/footer.php');
?>

