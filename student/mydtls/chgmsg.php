<?php include ('../intface/std_top.php'); ?>

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
           <?php 
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
		   ?>
		   </div>
         </div>
      </div>
      <!-- Services End -->
       <?php include('../intface/std_footer.php');  ?>
   </body>
</html>