<?php include ('../intface/adm_top.php'); ?>

<SCRIPT language="JavaScript" src="fvalidate.js"></SCRIPT>
<script>
//function to clear all the input fields (not used)
function clearFields()
{
////Commmented to retain the values when the user returns back to modify the details
//document.userInfo.fnm.value="";
//document.userInfo.lnm.value="";
//document.userInfo.uid.value="";
//document.userInfo.pwd.value="";
//document.userInfo.cpwd.value="";
}

</script>



<!-- mid section -->
		
  <section class="padder">
<!-- breadcrumbs -->

 <section class="panel panel-default  padder">
        <!-- breadcrumbs -->
        <section>
            <div class="panel-body nobot panelBg"  style="margin-top:20px">
                <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                    <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Feedback</strong></span> </div>
                </div>  
				</div>
             
        </section>

<section class="">
  <div class=""   style="height:60px;margin-top:20px;">
	
		<div class="col-lg-12 col-sm-12 col-md-12 ">
		 <a onFocus='this.blur()' onMouseOver='return showStatus();' href='feedback_report.php' title="View report"  class="pull-right btn btn-lg btn-default bdrRadius20">View Report</a>
		</div>
  </div>
  
 <?php
$con=createConnection();

$query3 = "SELECT * FROM tbl_feedback_category";
$cresult = mysqli_query($con,$query3);
$cnum=mysqli_num_rows($cresult);


//$cresult = mysql_query ("SELECT * FROM tbl_feedback_category"); 
//$cnum=mysql_numrows($cresult);
?>
</section></section>
 <section class="">
<!--<section class="">
<img src="../../images/feedback.jpg" class="img-responsive" style="width:100%;height:260px">
</section>-->

    <!-- ####### Show table Grid -->
			
			<form name="feedform"  action="submit_feedback.php" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data"  >
			<section class="scrollable padder">
            <div class="rightContent newcourse">
              
             

  <div class="row-centered">
  
       <div class="col-sm-12 col-xs-12"> 
	   
	   
	   <div class="divider"></div> 
			<div class="col-sm-12 col-xs-12 text-left">
				<label class="control-label" for="feedbackCat">  Feedback Category<span class="required">*</span> </label>
				<select id="feedbackCat" name="feedbackCat" class="form-control  searchbtn" data-required="true">
					<option value="">Select</option> 
					<?
					$i=0;
					while ($i < $cnum) {

					$row = mysqli_fetch_assoc($cresult);
					$id = $row['id'];
					$catid=$row['id'];
					$catname=$row['name'];
					if($catid==$company_id)
					{
					$selStr1="selected";
					}
					else
					{
					$selStr1="";
					}
					?>
						<OPTION value="<?php echo $catid; ?>" <?=$selStr1?>><? echo $catname; ?></OPTION>
					<?
					$i++;
					}	
					?>   
				</select>
				<label class="required" id="lblFeedbackCat"></label>
                
            </div>
				 <div class="divider"></div>  
			
				  <div class="col-sm-12 col-xs-12 text-left">
				  <label class="control-label required" for="userId">Subject<span class="required">*</span> </label>
               
					<input class='form-control input-lg' name="subject" type="text" id="subject" size="40" maxlength="250" data-required="true" autocomplete="off"> 
					  	<label class="instructionlabel">(Maximum 250 characters)</label>
                  <label class="required" id="userIdError"></label>
                
              
                </div>
				 <div class="divider"></div>    <div class="clear"></div>
				<div class="col-sm-12 col-xs-12 text-left">
				
				 <label class="control-label required" for="userId">  Description<span class="required">*</span> (Maximum 1000 characters)</label>
               
				
					
					  		<TEXTAREA onKeyDown="textCounter(this.form.description,this.form.remLen,1000);" onKeyUp="textCounter(this.form.description,this.form.remLen,1000);" NAME="description" class='form-control input-lg textarea' id="description" COLS=42 ROWS=6 maxlength="1000" style="height:100px" data-required="true"></TEXTAREA>
							<label class="instructionlabel"></label>
                  <label class="required" id="userIdError"></label>
                <input readonly style='visibility:hidden;border:0px' type=text name='remLen' size=2 maxlength=4 value="1000">
              
                </div>
				  <div class="text-right">
			
			 <input type='reset' class='btn btn-red'  id='reset' title='Clear all fields to enter fresh information' value='&nbsp;&nbsp;Reset&nbsp;&nbsp;'
>&nbsp;&nbsp;
				<button type="submit"  class=' btn btn-red'  id='submituser' title='Submit bug / feedback details'><i class="build fa fa fa-file-text-o"></i> Save</button>
          </div> <div class="divider"></div>    <div class="clear"></div>
	</div>
  </div>


</div>		
		
           </div>
			
      <!--end right  content bar -->
   
    

  <!--End Midlle container -->

</form>					
<?php
closeConnection($con);
include ('../intface/footer.php');
?>

<!--Code to prevent the caching of page-->