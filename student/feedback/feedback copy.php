<?php include ('../intface/std_top.php'); 
//if(!$_SESSION['token'])
//{
//header("Location:../../index.php#item1");
//exit();
//}
$con=createConnection();
?>

<SCRIPT language="JavaScript" src="fvalidate.js"></SCRIPT>
<script>
//function to clear all the input fields (not used)
function clearFields()
{

}

</script>

<!-- mid section -->
		
<section class="panel panel-default  padder">

<section>
   <div class="panel-body nobot panelBg" style="margin-top:20px">
                <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                    <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Feedback </strong></span> </div>
                </div>  
				</div>
<div class=""   style="height:60px;margin-top:20px;">
	
		<div class="col-lg-12 col-sm-12 col-md-12 ">
		 <a onFocus='this.blur()' onMouseOver='return showStatus();' href='feedback_report.php' title="My Feedbacks"  class="pull-right btn btn-lg btn-default bdrRadius20">My Feedbacks</a>
		</div>
  </div>
</section>
 <section class="">
<!--<section class="">
<img src="../../images/feedback.jpg" class="img-responsive" style="width:100%;height:260px">
</section>-->

    <!-- ####### Show table Grid -->
<?php


$stmt = $con->prepare("SELECT id,name FROM tbl_feedback_category");
//$stmt->bind_param("ss",$userid,$opwd);
$stmt->execute();
$stmt->bind_result($id,$name);
$stmt->fetch();

?>
			<form name="feedform"   action="submit_feedback.php" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data">
			<section class="scrollable padder mTop">
            

  <div class="row-centered">
  
       <div class="col-sm-12 col-xs-12"> 
	   
			<div class="divider"></div> 
			<div class="col-sm-12 col-xs-12 text-left">
				<label class="control-label" for="feedbackCat">  Feedback Category<span class="required">*</span> </label>
				<select id="feedbackCat" name="feedbackCat" class="input-lg form-control" data-required="true">
					<option value="">Select</option> 
					<?
					$i=0;
					while($stmt->fetch()){

					$catid=$id;
					$catname=$name;
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
					}	
					$stmt->close();	
					?>   
				</select>
				<label class="required" id="lblFeedbackCat"></label>
                
            </div>
			
			<div class="divider"></div> 
			<div class="col-sm-12 col-xs-12 text-left">
				<label class="control-label" for="userId">  Subject<span class="required">*</span> </label>

				<input class='form-control input-lg' name="subject" type="text" id="subject" size="40" maxlength="250" data-required="true" data-maxlength="[250]" autocomplete="off"> 
					<label class="instructionlabel">(Maximum 250 characters)</label>
				<label class="required" id="userIdError"></label>
                
            </div>
			<div class="divider"></div>    <div class="clear"></div>
			<div class="col-sm-12 col-xs-12 text-left">

			 <label class="control-label " for="userId">  Description<span class="required">*</span> (Maximum 1000 characters)</label>
				
						<TEXTAREA onKeyDown="textCounter(this.form.description,this.form.remLen,1000);" onKeyUp="textCounter(this.form.description,this.form.remLen,1000);" NAME="description" class='form-control input-lg textarea' id="description" COLS=42 ROWS=6 maxlength="1000" style="height:100px" data-required="true"  data-maxlength="[1000]"></TEXTAREA>
						<label class="instructionlabel"></label>
			  <label class="required" id="userIdError"></label>
			<input readonly style='visibility:hidden;border:0px' type=text name='remLen' size=2 maxlength=4 value="1000">

			</div>
			<div class="col-sm-12 col-xs-12 text-right">
			
			 <input type='reset' class='btn btn-red'  id='reset' title='Clear all fields to enter fresh information' value='&nbsp;&nbsp;Reset&nbsp;&nbsp;'
>&nbsp;&nbsp;
			<button type="submit"  class=' btn btn-red'  id='submituser' title='Submit bug / feedback details'><i class="build fa fa fa-file-text-o"></i> Save</button>
          </div> <div class="divider"></div>    <div class="clear"></div>
	</div>
  </div>


</div>		
		
          
		</section>	
      <!--end right  content bar -->
   
    

  <!--End Midlle container -->

</form>	
			
<?php
include ('../intface/footer.php');
?>

