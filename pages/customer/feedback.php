<?php
include '../../header/dashboardHeader.php';		
?>
<!-- mid section -->

<section id="content" class="rightside rightContenBg">
<div id="loaderDiv" class="loadBg"><img src="../../images/saving.gif" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<form name="feedform" action="submit_feedback.php" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data">
<section class="padder topMenuContent">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Feedback</strong></span> </div>
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
		
		</div>
  </div>
  
  <div class="rightContent newcourse">
				
				 <div class="stepBg">
                <p> In the fields below, enter details of the bug you want to report or the feedback you want to submit, and click the Submit button. To clear the fields and enter fresh information, click the Reset button.
                
                </p>
            
			 </div>
		<div class="row-centered">
  
       <div class="col-sm-8 col-xs-8 col-centered">
	   
				 <div class="divider"></div>   <div class="divider"></div>  
				  <label class="control-label required" for="userId">  Subject / Section<span class="required">*</span></label>
               
				
					<input class='form-control input-lg' name="subject" type="text" id="subject" size="40" maxlength="250" data-required="true" autocomplete="off"> 
					  	<label class="instructionlabel">(Maximum 250 characters)</label>
                  <label class="required" id="userIdError"></label>
                
              
                </div>
				 <div class="divider"></div>    <div class="clear"></div>
				<div class="col-sm-8 col-xs-8 col-centered">
				
				 <label class="control-label required" for="userId">  Description<span class="required">*</span></label>
               
				
					
					  		<TEXTAREA  NAME="description" class='form-control input-lg textarea' id="description" COLS=42 ROWS=6 maxlength="1000" style="height:100px" data-required="true"></TEXTAREA>
							<label class="instructionlabel">(Maximum 1000 characters)</label>
                  <label class="required" id="userIdError"></label>
                <input readonly style='visibility:hidden;border:0px' type=text name='remLen' size=2 maxlength=4 value="1000">
              
                </div>
	</div>	 
			 
  </div>
   
    
</section><!--start save  -->
      <section class="hbox stretch"> 
      <section class="vbox">
        <section class="marginBottom">
          <div class="text-right"><!-- <a  class="btn btn-red confirModal" id="btnBack" href="dashboard.php"  data-confirm-title="Confirmation Message" data-confirm-message="Are you sure you want to leave this page?" > <i class="build fa fa-arrow-circle-left"></i> Back</a>
         -->
			
			 <input type='reset' class='btn btn-red'  id='reset' title='Clear all fields to enter fresh information' value='&nbsp;&nbsp;Reset&nbsp;&nbsp;'
>&nbsp;&nbsp;
				<button type="submit"  class=' btn btn-red'  id='submituser' title='Submit bug / feedback details'><i class="build fa fa fa-file-text-o"></i> Save</button>
          </div>
        </section>
      </section>
      <!--end save  -->
    </section>
</section>
</form>
<!-- footer-->
<?php
include '../../footer/dashboardFooter.php';
?>

  