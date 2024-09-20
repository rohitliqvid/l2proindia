<?php include ('../intface/adm_top.php'); ?>

<SCRIPT language="JavaScript" src="validate.js"></SCRIPT>
<script>

window.onload = function(){
	setPageTitle('Countries > Create new client');
}

</script>


<!-- mid section -->
		
<section id="content" class="rightside rightContenBg">
<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="padder topMenuContent">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Client </strong></span> </div>
		 
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
		<!--<a onFocus='this.blur()' onMouseOver='return showStatus();' href="../catlist/catlist.php" target="_self" title="Country List" class="btn pull-right m-b-xs">Country  List</a>-->
		<a onFocus='this.blur()' onMouseOver='return showStatus();' href="../client/client.php" target="_self" title="Go back" class="btn pull-right m-b-xs">Back</a>
		</div>
  </div>
  
  
</section>
</section>
    <!-- ####### Show table Grid -->

<form name="catInfo" onSubmit="return ValidateClientInfo();" action="sbmtinfo.php" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data">

	<section class="scrollable padder mTop">
            <div class="rightContent newcourse">
              
              <div class="stepBg">
                <p> Enter the information in the relevant text fields and click the Create button.
                
                </p>
              </div>

  <div class="row-centered">
  
  
      <div class="col-sm-8 col-xs-8 col-centered vTop">
	   
				 <div class="divider"></div> 
				  <label class="control-label required" for="userId">  Client name<span class="required">*</span></label>
               
				<input class='form-control input-lg'  name="cName" type="text" id="cName" size="40" maxlength="250"  data-required="true" autocomplete="off">
				
					  	<label class="instructionlabel">(Maximum 250 characters)</label>
                  <label class="required" id="userIdError"></label>
                
              
                </div>
				    <div class="clear"></div>
				<div class="col-sm-8 col-xs-8 col-centered vTop">
				
				 <label class="control-label required" for="userId">  Description<span class="required">*</span></label>
               
				
					
					  		<TEXTAREA onKeyDown="textCounter(this.form.cDesc,this.form.remLen,1000);" onKeyUp="textCounter(this.form.cDesc,this.form.remLen,1000);" class='form-control input-lg textarea' id="cDesc" NAME="cDesc"  COLS=42 ROWS=6 maxlength="1000" style="height:80px" data-required="true"></TEXTAREA>
							<label class="instructionlabel">(Maximum 1,000 characters)</label>
                  <label class="required" id="userIdError"></label>
              
                </div>
     <div class="clear"></div>
				<div class="col-sm-8 col-xs-8 col-centered vTop">
				
				 <label class="control-label required" for="userId">  Email<span class="required">*</span></label>
               
				<input class='form-control input-lg' type="text" id="cEmail" name="cEmail"   size="40" maxlength="200" data-type="email" data-required="true">
					
							<label class="instructionlabel">(Maximum 200 characters)</label>
                  <label class="required" id="userIdError"></label>
              
              
                </div>
				   <div class="clear"></div>
				<div class="col-sm-8 col-xs-8 col-centered vTop">
				
				 <label class="control-label required" for="userId">  Phone<span class="required">*</span></label>
               
				<input class='form-control input-lg' type="text" name="cPhone"  id="cPhone" size="40" maxlength="15" data-type="phone" data-required="true">
					
							<label class="instructionlabel">(Maximum 15 characters, Numeric value only)</label>
                  <label class="required" id="userIdError"></label>
              
               <input readonly style='visibility:hidden;border:0px' type=text name=remLen size=2 maxlength=4 value="1000">
			 <br /> <br />
                </div>
        
</div>


</div>		
		
           </div>
			
      <!--end right  content bar -->
   
    <!--start save  -->
      <section class="hbox stretch"> 
      <section class="vbox">
        <section class="marginBottom">
          <div class="text-right"><!-- <a  class="btn btn-red confirModal" id="btnBack" href="dashboard.php"  data-confirm-title="Confirmation Message" data-confirm-message="Are you sure you want to leave this page?" > <i class="build fa fa-arrow-circle-left"></i> Back</a>
         -->
			
			 <input type='reset' class='btn btn-red'  id='reset' title='Clear all fields to enter fresh information' value='&nbsp;&nbsp;Reset&nbsp;&nbsp;'
>&nbsp;&nbsp;
				<button type="submit"  class=' btn btn-red'  id='submituser' title='Save details'><i class="build fa fa fa-file-text-o"></i> Save</button>
          </div>
        </section>
      </section>
      <!--end save  -->
    </section>


  <!--End Midlle container -->

 </form>
<?php
include ('../intface/footer.php');
?>

<!--Code to prevent the caching of page-->