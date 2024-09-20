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
            <h1 class="display-2 text-white mb-4 animated slideInDown">My Profile</h1>
            <nav aria-label="breadcrumb animated slideInDown">
               <ol class="breadcrumb justify-content-center mb-0">
                  <li class="breadcrumb-item"><a href="../../student/intface/index.php">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">My Profile</li>
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
                  <h1 class="text-primary">My Profile</h1>
                  <div>        <a href="modify.php" class="pull-right btn btn-primary  btn-sm ">Modify
                     Profile</a><a href="chgpwd.php" class="pull-right btn btn-primary btn-sm">Change
                     Password</a>
                  </div>
               </div>
         <p>The following information pertaining to you is currently stored in the Learning Management System:
</p>
<div class="table-responsive">


            <table class="table table-striped">

                <tbody><tr>
                    <td class="col-sm-2 ContentBold">First name:</td>
                    <td class="col-sm-9">
                    <?php echo $fnm ? $fnm : '-' ?>                    </td>

                </tr>
                <tr>
                    <td class="col-sm-2 ContentBold">Last name:</td>
                    <td class="col-sm-9">
                    <?php echo $lnm ? $lnm :'-' ?>                 </td>

                </tr>
                <tr>
                    <td class="col-sm-2 ContentBold">Email:</td>
                    <td class="col-sm-9">
                    <?php echo TrimStringLarge($email) ? TrimStringLarge($email) :'-'?>                   </td>

                </tr>
                <tr>
                    <td class="col-sm-2 ContentBold">Mobile:</td>
                    <td class="col-sm-9">
                    <?php echo TrimStringLarge($mobile) ? TrimStringLarge($mobile):'-' ?>                    </td>
                </tr>

                <tr>
                    <td class="col-sm-2 ContentBold">Gender:</td>
                    <td class="col-sm-9">
                    <?php echo TrimStringLarge($sex)  ?TrimStringLarge($sex) :'-' ?>                    </td>

                </tr>


                <tr>
                    <td class="col-sm-2 ContentBold">Education Level:</td>
                    <td class="col-sm-9">
                    <?php echo TrimStringLarge($education) ? TrimStringLarge($education) :'-' ?>                    </td>

                </tr>

                <tr>
                    <td class="col-sm-2 ContentBold">Education Details:</td>
                    <td class="col-sm-9">
                    <?php echo TrimStringLarge($education_details) ? TrimStringLarge($education_details) :'-' ?>                    </td>

                </tr>
                <tr>
                    <td class="col-sm-2 ContentBold">How did you hear about us:</td>
                    <td class="col-sm-9">
                    <?php echo TrimStringLarge($learn_from) ? TrimStringLarge($learn_from) :'-' ?>                   </td>

                </tr>
                <tr>
                    <td class="col-sm-2 ContentBold">Profession:</td>
                    <td class="col-sm-9">
                    <?php echo TrimStringLarge($profession) ? TrimStringLarge($profession) :'-' ?>                   </td>

                </tr>
                <tr>
                    <td class="col-sm-2 ContentBold">Professional Experience:</td>
                    <td class="col-sm-9">
                    <?php echo TrimStringLarge($profession_experience) ? TrimStringLarge($profession_experience)  : '-' ?>       </td>

                </tr>

                <tr>
                    <td class="col-sm-2 ContentBold">Industry:</td>
                    <td class="col-sm-9">
                    <?php echo TrimStringLarge($organization) ? TrimStringLarge($organization)  : '-' ?>              </td>

                </tr>

                <tr>
                    <td class="col-sm-2 ContentBold">Designation:</td>
                    <td class="col-sm-9">
                    <?php echo TrimStringLarge($designation) ? TrimStringLarge($designation)  : '-' ?> </td> </td>

                </tr>

                

                

                <tr>
                    <td class="col-sm-2 ContentBold">City:</td>
                    <td class="col-sm-9">
                    <?php echo TrimStringLarge($user_city) ? TrimStringLarge($user_city) :'-' ?>                 </td>

                </tr>

                <tr>
                    <td class="col-sm-2 ContentBold">State:</td>
                    <td class="col-sm-9">
                    <?php echo TrimStringLarge($user_state) ? TrimStringLarge($user_state) : '-' ?>                    </td>

                </tr>

                <tr>
                    <td class="col-sm-2 ContentBold">Country:</td>
                    <td class="col-sm-9">
                    <?php echo TrimStringLarge($user_country) ? TrimStringLarge($user_country) :'-' ?>                    </td>

                </tr>

                <tr>
                    <td class="col-sm-2 ContentBold">Pin Code:</td>
                    <td class="col-sm-9">
                    <?php echo TrimStringLarge($zip_code) ? TrimStringLarge($zip_code) :'-' ?>                    </td>

                </tr>

                <tr>
                    <td class="col-sm-2 ContentBold">Interested in receiving communication from L2Pro:</td>
                    <td class="col-sm-9">
                    <?php echo  $allow_email_for_marketing =='false' ? 'No' :'Yes' ?>                    </td>

                </tr>

           


                

            </tbody>
          </table>
          </div>
         </div>
      </div>
         </div>
      <!-- Services End -->
      <?php include('../intface/std_footer.php');  ?>
   </body>
</html>