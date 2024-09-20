<?php include ('../intface/std_top.php'); ?>
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
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="keywords" content="e-learning, Intellectual Property, IP, Qualcomm, L2Pro, Patents, Standard Essential Patents, Industrial design, Confidential information, Inventions, Moral rights, Works of authorship, Service marks, Logos, Trademarks, Design rights, Commercial secrets, NDAs, Non-Disclosure Agreement, Start-ups">
      <meta name="language" content="en" />
      <title>L2Pro India</title>
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <link href="../../assetsnewdesign/css/style.css" rel="stylesheet">
   </head>
   <body>
      <!-- Navbar Start -->
      <div class="container-fluid navbg">
         <div class="container">
         <?php include('../intface/std_left.php');  ?>
         </div>
      </div>
      <!-- Navbar End -->
      <!-- Carousel Start -->
      <div class="container-fluid page-header py-5">
         <div class="container text-center py-5">
            <h1 class="display-2 text-white mb-4 animated slideInDown">Change Password</h1>
            <nav aria-label="breadcrumb animated slideInDown">
               <ol class="breadcrumb justify-content-center mb-0">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Change Password</li>
               </ol>
            </nav>
         </div>
      </div>
      <!-- Carousel End -->
      <!-- Services Start -->
      <div class="container-fluid services py-5">
         <div class="container">
         <div class=" pb-5 wow fadeIn" data-wow-delay=".3s" >
               <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  pb-2 mb-3  border-bottom ">
                  <h1 class="text-primary">Change password</h1>
                  <div>        <a href="mydtls.php" class="pull-right btn btn-primary btn-sm">Back
                     </a>
                  </div>
               </div>
              

               <form name="pwdInfo" data-validate="parsley" action="updtpwd.php" method="post">
               <p>Enter the required details in the relevant text boxes and click the Update button. Click the Back link to return to the My details page.</p>
<div class="col-sm-12">
  <label>User ID : <strong><?php echo $userid ?></strong></label>
                       
</div>

<div class="row">

 <div class="col-sm-4 col-xs-12  mt-4">
                  <label class="pb-3"> Old Password <span class="required">*</span></label>
                  <input class="form-control " name="opwd" id="opwd" type="password"  data-required="true"   size="20" maxlength="12"  placeholder="Enter old password"  autocomplete="off" data-minlength="[6]" data-maxlength="[12]" onblur="return vOldPass();" >
                  <label class="required showErr" id="oldPasswordError"><?php //echo $msgold; ?></label>
                </div>

                 <div class="col-sm-4 col-xs-12  mt-4">
                  <label class="pb-3">New Password <span class="required">*</span></label>
                  <input class="form-control " name="pwd" id="pwd" type="password" data-required="true"   size="20" maxlength="12" placeholder="Enter new password" data-regexp="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,12}$"  data-regexp-message="Password should be between 6 to 12 characters, including at least 1 letter, 1 number, and 1 special character." autocomplete="off" data-minlength="[6]" data-maxlength="[12]">
                  <p>(Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character)</p>
                  <label class="required showErr" id="newPasswordError"><!--<?php// echo $msgnew; ?>--></label>
                </div>

                 <div class="col-sm-4 col-xs-12  mt-4">
                  <label class="pb-3"> Confirm Password <span class="required">*</span></label>
                  <input class="form-control " name="cpwd" id="cpwd" type="password"  data-equalto="#pwd" data-required= "true" maxlength="12" placeholder="Enter confirm password" autocomplete="off">
                  <label class="required" id="cnfPasswordError"></label>
                </div>

                 <div class="text-end"> <input type='reset' class='btn btn-primary'  id='reset' title='Clear all fields to enter fresh information' value='&nbsp;&nbsp;Reset&nbsp;&nbsp;'
                 >  <button type="submit"  id='submituser' title='Replace old password with new' class=" btn btn-primary ">Update</button></div>
                
</div>
               
              
            </div>
</form>
         </div>
      </div>
      <!-- Services End -->
       <?php include('../intface/std_footer.php');  ?>
   </body>
</html>