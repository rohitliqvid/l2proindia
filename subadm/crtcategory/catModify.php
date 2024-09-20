<?php include ('../intface/adm_top.php'); ?>

<SCRIPT language="JavaScript" src="validate.js"></SCRIPT>
<script>

window.onload = function(){
	setPageTitle('Countries > <?=TrimStringMedium(ucfirst($catname))?>');
}

</script>

<?

$catid=$_REQUEST['catid'];


$result = mysql_query ("SELECT * FROM tbl_company where id='$catid'"); 
$num=mysql_numrows($result);

$catname=mysql_result($result,0,"company_name");
$catdesc=mysql_result($result,0,"company_desc");
$catlimit=mysql_result($result,0,"company_user_limit");
$explimit=mysql_result($result,0,"company_user_expiry");
$catkeys=mysql_result($result,0,"company_address");
?>


<!-- mid section -->
		
<section id="content" class="rightside rightContenBg">
<div id="loaderDiv" class="loadBg"><img src="images/saving.gif" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="padder topMenuContent">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Edit country </strong></span> </div>
		 
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
			<a onFocus='this.blur()' onMouseOver='return showStatus();' href="../catlist/catlist.php" target="_self" title="Go back" class="btn pull-right m-b-xs">Back</a>
			</div>
		
  </div>
  
  
</section>
</section>
    <!-- ####### Show table Grid -->

    <!-- ####### Show table Grid -->

<form  name="catInfo" onSubmit="return ValidateInfoEdit();" action="updcatinfo.php?catid=<?=$catid?>" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data">

	<section class="scrollable padder mTop">
            <div class="rightContent newcourse">
              
              <div class="stepBg">
                <p> Enter the information in the relevant text fields and click the Update button.
                
                </p>
              </div>

  <div class="row-centered">
  
  
      <div class="col-sm-8 col-xs-8 col-centered vTop">
	   
				 <div class="divider"></div> 
				  <label class="control-label required" for="userId"> Country name<span class="required">*</span></label>
               
				<input class='form-control input-lg'  name="catname" type="text" id="catname" size="40" maxlength="250" data-required="true" autocomplete="off"  value='<?=ucfirst($catname)?>' >
				
					  	<label class="instructionlabel">(Maximum 250 characters)</label>
                  <label class="required" id="userIdError"></label>
                
              
                </div>
				    <div class="clear"></div>
				<div class="col-sm-8 col-xs-8 col-centered vTop">
				
				 <label class="control-label required" for="userId">  Description</label>
               
				
					
					  		<TEXTAREA onKeyDown="textCounter(this.form.catdesc,this.form.remLen,1000);" onKeyUp="textCounter(this.form.catdesc,this.form.remLen,1000);"id="catdesc" NAME="catdesc"   COLS=42 ROWS=6 maxlength="1000" style="height:80px" data-required="true" class='form-control input-lg textarea'><?=ucfirst($catdesc)?></TEXTAREA>
							<label class="instructionlabel">(Maximum 1,000 characters)</label>
                  <label class="required" id="userIdError"></label>
              
                </div>
     <div class="clear"></div>
				<div class="col-sm-8 col-xs-8 col-centered vTop">
				
				 <label class="control-label required" for="userId"> Address</label>
               
				<input class='form-control input-lg' name="catkey" type="text" id="catkey" size="40" maxlength="250"  data-required="true" value='<?=ucfirst($catkeys)?>'>
					
							<label class="instructionlabel">(Maximum 250 characters)</label>
                  <label class="required" id="userIdError"></label>
              
              
                </div>
				   <div class="clear"></div>
				<div class="col-sm-4 col-xs-4 col-centered vTop">
				
				 <label class="control-label required" for="userId"> User limit<span class="required">*</span></label>
               
				<input class='form-control input-lg' name="catlimit" type="text" id="catlimit" size="40" maxlength="4"  data-type="digits" data-required="true" value="<?=$catlimit?>">
					
							<label class="instructionlabel">(Maximum 4 characters, Numeric value only)</label>
                  <label class="required" id="userIdError"></label>
              
               <input readonly style='visibility:hidden;border:0px' type=text name=remLen size=2 maxlength=4 value="1000">
                </div>
      
				<div class="col-sm-4 col-xs-4 col-centered vTop">
				
				 <label class="control-label required" for="userId">User expiry (Days)<span class="required">*</span></label>
               
				<input class='form-control input-lg' name="explimit" type="text" id="explimit" size="40" maxlength="4" value='365' data-type="digits" data-required="true" value="<?=$explimit?>">
					
							<label class="instructionlabel">(Maximum 4 characters, Numeric value only)</label>
                  <label class="required" id="userIdError"></label>
              
           <input readonly style='visibility:hidden;border:0px' type=text name=remLen size=2 maxlength=4 value="1000"><input type="hidden" id='curLimit' name='curLimit' value="<?=$catlimit?>">
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
			
			 <input type='button' class='btn btn-red'  id='reset' title='Cancel changes to country details and return to Countries page' value='&nbsp;Cancel&nbsp;'
 onClick="javascript:document.location='../catlist/catlist.php'">&nbsp;&nbsp;
				<button type="submit"  class=' btn btn-red'  id='submituser' title='Replace old details of this country with new' ><i class="build fa fa fa-file-text-o"></i> Update</button>
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



