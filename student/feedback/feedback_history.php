<?php 
include ('../intface/std_top.php'); 
//if(!$_SESSION['token'])
//{
//header("Location:../../index.php#item1");
//exit();
//}
$con=createConnection();
$stmt = $con->prepare("SELECT firstname,lastname,usertype,dtenrolled,email,mobile,sex,learn_from,education,profession,education_details,profession_experience,user_country,user_state,user_city,zip_code,allow_email_for_marketing,allow_email_for_campaign,occupation,organization,designation FROM tbl_users WHERE username=?");
$stmt->bind_param("s",$userid);
$stmt->execute();
$stmt->bind_result($fnm,$lnm,$utype,$dt,$email,$mobile,$sex,$learn_from,$education,$profession,$education_details,$profession_experience,$user_country,$user_state,$user_city,$zip_code,$allow_email_for_marketing,$allow_email_for_campaign,$occupation,$organization,$designation);
$stmt->fetch();
$stmt->close();	
closeConnection($con);


?>
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
            <h1 class="display-2 text-white mb-4 animated slideInDown">Feedback</h1>
            <nav aria-label="breadcrumb animated slideInDown">
               <ol class="breadcrumb justify-content-center mb-0">
                  <li class="breadcrumb-item"><a href="../../student/intface/index.php">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Feedback</li>
               </ol>
            </nav>
         </div>
      </div>
      <!-- Carousel End -->
      <!-- Services Start -->
      <div class="container-fluid services py-5">
         <div class="container">
		 <div class=" pb-5 wow fadeIn" data-wow-delay=".3s" ">
               <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  pb-2 mb-3  border-bottom ">
                  <h1 class="text-primary">Feedback History</h1>
                  <div>        <a href="" class="pull-right btn btn-primary  btn-sm ">Back</a></div>
               </div>
               <div class="row">
                  <div class="table-responsive">
                     <table class="table table-striped">
                        <tbody>
                           <tr>
                              <td><b>Subject:</b> Testing</td>
                           </tr>
                           <tr>
                              <td><b>From:</b> Learner QA, 29-08-2024</td>
                           </tr>
                           <tr>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="col-sm-12 col-xs-12  mt-4">
                     <label class="pb-3"> Your response <span class="mandatory">*</span> <small>(Characters Remaining:
                     500)</small></label>
                     <textarea class="form-control "></textarea>
                  </div>
                  <div class="text-end mt-4">   <button class=" btn btn-danger ">Close</button> <button class=" btn btn-primary ">Submit</button></div>
               </div>
            </div>
         </div>
      </div>
      <!-- Services End -->
       <?php include('../intface/std_footer.php');  ?>
   </body>
</html>