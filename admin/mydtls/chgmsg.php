<?php include ('../intface/adm_top.php'); ?>

<?php 
$Msg=$_GET['done'];?>
<SCRIPT language="JavaScript" src="validate.js"></SCRIPT>
<script>
//function to clear the input fields
function clearFields()
{
document.pwdInfo.opwd.value="";
document.pwdInfo.pwd.value="";
document.pwdInfo.cpwd.value="";
}
</script>
<!-- main panel ends -->

	 <section class="scrollable">
		  <section class="panel panel-default padder contentTop">	 
		  <div class="col-lg-6 col-md-6 col-sm-6 show-mon">
            <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Change password </strong></span> </div>
          </div> <div class="col-lg-6 col-md-6 col-sm-6 text-right"> 
		  
		  <a onFocus='this.blur()' onMouseOver='return showStatus();' href="mydtls.php" target="_self" class="btn btn-lg btn-default bdrRadius20 marginLeft5" title="Go back">Back</a> 
		
			  </div>  
			  <div class="clear"> </div>
       <div class="col-lg-12 col-md-12 col-sm-12 paddTop10"> 		  <?
		  if($Msg=='true')
{
?>

<p>Your password has been changed successfully! Click the Back link to return.<p>

<?
}
else if($Msg=='false')
{
?>

<p>The old password you have entered is incorrect! Click the Back link to return.<p>

<?
}	
?></div><div class="paddTop10 divider"></div>
  </section>
  <div class="clear"> </div>
		
<?php
include ('../intface/footer.php');
?>
