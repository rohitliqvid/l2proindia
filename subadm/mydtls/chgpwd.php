<?php include ('../intface/adm_top.php'); ?>
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
       <div class="col-lg-12 col-md-12 col-sm-12 paddTop10"> <p>Enter the required details in the relevant text boxes and click the Update button. Click the Back link to return to the My details page.
	  </p></div><div class="paddTop10 divider"></div>
  </section>
  <div class="clear"> </div>
 <section class="panel panel-default padder paddTop10" >

<form name="pwdInfo" data-validate="parsley" action="updtpwd.php" method="post">


<div class="divider"></div><div class="divider"></div>
 <div class="col-sm-12 padd0">
<div class="col-sm-6">
  <label>User ID : <strong><? echo $userid ?></strong></label>
                       
</div>
<div class="col-sm-6">
                       
</div></div>
<div class="clear"></div>
 <div class="col-sm-4 padd0">
 <div class="col-sm-12 col-xs-12  paddLeft0">
                  <label> Old Password <span class="required">*</span></label>
                  <input class="form-control input-lg" name="opwd" id="opwd" type="password"  data-required="true"   size="20" maxlength="12"  placeholder="Enter old password"  autocomplete="off" data-minlength="[6]" data-maxlength="[12]" onblur="return vOldPass();" />
                  <label class="required showErr" id="oldPasswordError"><?php //echo $msgold; ?></label>
                </div>
                </div>
                
				 <div class="col-sm-4 padd0">
				  <div class="col-sm-12 col-xs-12  paddLeft0">
                  <label > New Password <span class="required">*</span></label>
                  <input class="form-control input-lg" name="pwd" id="pwd" type="password" data-required="true"   size="20" maxlength="12" placeholder="Enter new password" data-regexp="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,12}$"  data-regexp-message="Password should be between 6 to 12 characters, including at least 1 letter, 1 number, and 1 special character." autocomplete="off" data-minlength="[6]" data-maxlength="[12]"/>
				  <label class="instructionlabel">(Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character)</label>
				 
				  
				  
                  <label class="required showErr" id="newPasswordError"><!--<?php echo $msgnew; ?>--></label>
                </div>
				
               </div>
                
                <div class="col-sm-4 padd0">
				 <div class="col-sm-12 col-xs-12   paddLeft0  paddRight0">
                 <label >  Confirm Password <span class="required">*</span></label>
                  <input class="form-control input-lg" name="cpwd" id="cpwd" type="password"  data-equalto="#pwd" data-required= "true" maxlength="12" placeholder="Enter confirm password" autocomplete="off"/>
                  <label class="required" id="cnfPasswordError"></label>
                </div>
              </div>
                <div class="clear"></div>

<div class="clear"></div><div class="divider"></div>
<div class="text-right">
			
			 <input type='reset' class='btn btn-red'  id='reset' title='Clear all fields to enter fresh information' value='&nbsp;&nbsp;Reset&nbsp;&nbsp;'
>&nbsp;&nbsp;
		<button type="submit"  class=' btn btn-red'  id='submituser' title='Replace old password with new'><i class="build fa fa fa-file-text-o"></i> Update</button>
          </div> <div class="divider"></div>    
		  <div class="clear"></div>
			
              

</form>
 </section>  </section> 
		
<?php
include ('../intface/footer.php');
?>
