<?php
session_start();
if(!$_SESSION['token'])
{
header("Location:../../index.php#item1");
exit();
}

$msgnew ='';
$msgold ='';
?> <div class="divider"  style="border-top:solid thin #ccc"></div>
 <div class="col-sm-4 col-xs-6 col-centered">
 <div class="col-sm-12 col-xs-12 col-centered">
                  <label class="control-label required" for="txtOldPassword"> Old Password <span class="required">*</span></label>
                  <input class="form-control input-lg" name="oldPassword" id="oldPassword" type="password"  onKeyPress="return emptyErr();"  data-required="true" maxlength="20" onblur="trimSpaces(this.id);" placeholder="Enter old password"  autocomplete="off" data-minlength="[6]" data-maxlength="[20]"/>
                  <label class="required showErr" id="oldPasswordError"><?php echo $msgold; ?></label>
                </div>
                </div>
                
				 <div class="col-sm-4 col-xs-6 col-centered">
				  <div class="col-sm-12 col-xs-12 col-centered">
                  <label class="control-label required" for="txtNewPassword"> New Password <span class="required">*</span></label>
                  <input class="form-control input-lg" name="newPassword" id="newPassword" type="password" onKeyPress="return emptyErr();" onblur="trimSpaces(this.id); validateNewPass(this.value,this.id);"  data-required="true" data-type="alphanum" maxlength="20" placeholder="Enter new password" autocomplete="off" data-minlength="[6]" data-maxlength="[20]"/>
                  <label class="required showErr" id="newPasswordError"><?php echo $msgnew; ?></label>
                </div>
				
               </div>
                
                <div class="col-sm-4 col-xs-6 col-centered">
				 <div class="col-sm-12 col-xs-12 col-centered">
                 <label class="control-label required" for="txtCnfPassword">  Confirm Password <span class="required">*</span></label>
                  <input class="form-control input-lg" name="cnfPassword" id="cnfPassword" type="password" data-required= "true" data-type="alphanum" data-minlength="[6]" data-maxlength="[20]"  onblur="trimSpaces(this.id);"  data-equalto="#newPassword" maxlength="20" placeholder="Enter confirm password" autocomplete="off"/>
                  <label class="required" id="cnfPasswordError"></label>
                </div>
              </div>
                <div class="clear"></div>