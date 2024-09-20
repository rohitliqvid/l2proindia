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
      <style>
        /* Override the default styles for disabled and read-only dropdowns */
        .form-control:disabled,
        .form-control:read-only {
            background-color: transparent !important; /* Change background color */
            opacity: 1 !important; /* Ensure full opacity */
            color: inherit; /* Maintain text color */
            border: 1px solid #ced4da; /* Keep border style consistent */
        }
    </style>
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
            <h1 class="display-2 text-white mb-4 animated slideInDown">Edit Profile</h1>
            <nav aria-label="breadcrumb animated slideInDown">
               <ol class="breadcrumb justify-content-center mb-0">
                  <li class="breadcrumb-item"><a href="../../student/intface/index.php">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Edit Profile</li>
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
                  <h1 class="text-primary">Edit Profile</h1>
                  <div>        <a href="mydtls.php" class="pull-right btn btn-primary  btn-sm ">Back</a></div>
               </div>
               <p>Type your new details in the relevant fields and click the Update button. Click the Back link to return to the My Profile page.</p>
               <div class="col-sm-12">
                  <label>User ID : <strong>learnerqa@yopmail.com</strong></label>
               </div>
               <form name="userInfo" data-validate="parsley" action="updtinfo.php" method="post" id="profileUpdateForm">
               <div class="row">
              
               <div class="col-sm-6 col-xs-12  mt-4">
                 <label class="pb-3"> First Name <span class="mandatory">*</span> <small>(Maximum 30 characters; No special
                           or numeric characters)</small></label>
                 <input  name="fstnm" type="text" value=<?= $fnm ?> id="fstnm" size="40" maxlength="30"
                        data-required="true" data-regexp="^[a-zA-Z ]+$"
                        data-regexp-message="First name should contain characters only."
                        class="form-control parsley-validated" autocomplete="off" require>
               </div>

                <div class="col-sm-6 col-xs-12  mt-4">
                 <label class="pb-3"> Last Name  <span class="mandatory">*</span> <small>(Maximum 30 characters; No special
                           or numeric characters)</small></label>
                 <input type="text" name="lstnm" id="lstnm" value="<?= $lnm ?>" size="40" maxlength="30"
                        data-required="true" data-regexp="^[a-zA-Z ]+$"
                        data-regexp-message="Last name should contain characters only."
                        class="form-control parsley-validated" autocomplete="off" require>
               </div>

               <div class="col-sm-6 col-xs-12  mt-4">
                 <label class="pb-3"> Email ID <span class="mandatory">*</span> <small>(No spaces; Valid email address)</small></label>
                 <input type="hidden" id="isMail" name='isMail' value="<?= $email  ?>" />
                 <input name="email" id="email" value="<?= $email ?>" data-required="true"
                        data-type="email" size="40" maxlength="200" class="form-control parsley-validated"
                        onblur='checkMail(this.value)' autocomplete="off" disabled>
               </div>
                
                <div class="col-sm-6 col-xs-12  mt-4">
                 <label class="pb-3"> Mobile  <span class="mandatory">*</span> <small>(No spaces; Number only)</small></label>
                 <input name="mobile" id="mobile" value="<?= $mobile ?>" size="10" min="10"
                        maxlength="10" data-required="true" class="form-control parsley-validated" autocomplete="off"
                        parsley-type="phone" data-type="phone" data-type-message="">
               </div>

               <div class="col-sm-6 col-xs-12  mt-4">
                 <label class="pb-3">Gender <span class="mandatory">*</span> <small></small></label>
                 <select data-required="true" class="form-select form-control input-lg width80 " name="sex" id="sex">
                        <option <? if ($sex=="" ) echo ("selected") ?> hidden disabled value="">Select</option>
                        <option <? if ($sex=="male" ) echo ("selected") ?> value="male">Male</option>
                        <option <? if ($sex=="female" ) echo ("selected") ?> value="female">Female</option>
                        <option value="i prefer not to say" <? if ($sex=="i prefer not to say" ) echo ("selected") ?>>I prefer not to say
                        </option>
                  </select>
                </div>

                <div class="col-sm-6 col-xs-12  mt-4">
                 <label class="pb-3">How did you hear about us <span class="mandatory">*</span> <small></small></label>
                 <select name="learn_from" id="learn_from" data-required="true"
                        class="form-select form-control input-lg width80 learn-from" require>
                        <option <? if ($learn_from=="" ) echo ("selected") ?> hidden disabled value="null">Select
                        </option>
                        <option <? if ($learn_from=="Social Media" ) echo ("selected") ?>>Social Media</option>
                        <option <? if ($learn_from=="Webinar/Event" ) echo ("selected") ?>> Webinar/Event</option>
                        <option <? if ($learn_from=="Internet Search" ) echo ("selected") ?>>Internet Search</option>
                        <option <? if ($learn_from=="Friends/Colleague" ) echo ("selected") ?>>Friends/Colleague</option>
                        <option <? if ($learn_from=="Other" ) echo ("selected") ?>>Others</option>
                    </select>
                </div>


                <div class="col-sm-6 col-xs-12  mt-4">
                 <label class="pb-3">Education Level <span class="mandatory">*</span> <small></small></label>
                 <select name="education" id="education" data-required="true"
                        class="form-select form-control input-lg width80 learn-from" require>
                        <option <? if ($education=="" ) echo ("selected") ?> hidden disabled value="">Select Level
                        </option>
                        <option <? if ($education=="School") echo ("selected") ?>>School</option>
                        <option <? if ($education=="Graduate" ) echo ("selected") ?>>Graduate</option>
                        <option <? if ($education=="Post-Graduate" ) echo ("selected"); ?>>Post-Graduate</option>
                    </select>
                </div>

                <div class="col-sm-6 col-xs-12  mt-4">
                 <label class="pb-3"> Education Details  <span class="mandatory">*</span> </label>
                 <input class="form-control " data-required="true" class="form-control input-lg width80" name="education_details"
                        id="education_details" data-required="false" placeholder="Enter Your Education Details"
                        type="text" value="<?= $education_details ?>">
               </div>


                <div class="col-sm-6 col-xs-12  mt-4">
                 <label class="pb-3">Profession <span class="mandatory">*</span> <small></small></label>
                 <select data-required="true" class="form-select form-control input-lg width80 signup-profession"
                        name="profession" id="LoginForm_profession" require>
                        <option <? if ($profession=="" ) echo ("selected"); ?> value="">Select Profession</option>
                        <option <? if ($profession=="Startup" ) echo ("selected"); ?> ?> Startup</option>
                        <option <? if ($profession=="Student" ) echo ("selected"); ?> ?> Student</option>
                        <option <? if ($profession=="Professor" ) echo ("selected"); ?> ?> Professor</option>
                        <option <? if ($profession=="Industry professional" ) echo ("selected"); ?> ?> Industry professional</option>
                        <option <? if ($profession=="Legal professional" ) echo ("selected"); ?> ?> Legal professional</option>
                        <option <? if ($profession=="Others" ) echo ("selected"); ?> ?> Others</option>                       
                    </select>
                </div>


                <div class="col-sm-6 col-xs-12  mt-4 profession_inputes_filds" >
                 <label class="pb-3"> Professional Experience  <span class="mandatory">*</span> </label>
                 <input class="form-control " type="text" name="profession_experience" id="profession_experience"
                        value="<?= $profession_experience ?>" class="form-control "
                        placeholder="Enter Professional Experience">
                        <span style="color : #CA0606; display:none" id="profession_experience_error">This value is
                        required.</span>
               </div>


                <div class="col-sm-6 col-xs-12  mt-4 profession_inputes_filds">
                 <label class="pb-3">Industry<span class="mandatory">*</span> <small></small></label>
                 <select data-required="true" class="form-select form-control input-lg width80 signup-profession"
                        name="organization" id="organization" require>
                        <option <? if ($organization=="" ) echo ("selected"); ?> value="">Select Industry</option>
                        <option <? if ($organization=="Agriculture" ) echo ("selected"); ?> ?> Agriculture</option>
                        <option <? if ($organization=="Academia" ) echo ("selected"); ?> ?> Academia</option>
                        <option <? if ($organization=="Biotech" ) echo ("selected"); ?> ?> Biotech</option>
                        <option <? if ($organization=="Pharma" ) echo ("selected"); ?> ?> Pharma</option>
                        <option <? if ($organization=="Semiconductors" ) echo ("selected"); ?> ?> Semiconductors</option> 
                        <option <? if ($organization=="Telecommunications" ) echo ("selected"); ?> ?> Telecommunications</option> 
                        <option <? if ($organization=="Computer Science" ) echo ("selected"); ?> ?> Computer Science</option> 
                        <option <? if ($organization=="Engineering" ) echo ("selected"); ?> ?> Engineering</option> 
                        <option <? if ($organization=="Others" ) echo ("selected"); ?> ?> Others</option> 

                    </select>                    
                </div>


                <div class="col-sm-6 col-xs-12  mt-4 profession_inputes_filds">
                 <label class="pb-3"> Designation  <span class="mandatory">*</span> </label>
                 <input type="text" name="designation" id="designation" value="<?= $designation ?>" maxlength="50"
                        class="form-control parsley-validated" autocomplete="off">
                    <span style="color : #CA0606; display:none" id="designation_error">This value is required.</span>
               </div>



               <div class="col-sm-6 col-xs-12  mt-4">
                 <label class="pb-3"> City  <span class="mandatory">*</span> </label>
                 <input type="text" name="user_city" id="user_city" value="<?= $user_city ?>" maxlength="50"
                 data-required="true" class="form-control" autocomplete="off" placeholder="Enter City" require>
               </div>

               <div class="col-sm-6 col-xs-12  mt-4">
                 <label class="pb-3"> State  <span class="mandatory">*</span> </label>
                 <input type="text" name="user_state" id="user_state" value="<?= $user_state ?>" maxlength="50"
                 data-required="true" class="form-control" autocomplete="off" placeholder="Enter State" require>
               </div>

               <div class="col-sm-6 col-xs-12  mt-4">
                 <label class="pb-3"> Country  <span class="mandatory">*</span> </label>
                 <input name="user_country" id="user_country" value="<?= $user_country ?>"
                        data-required="true" class="form-control" autocomplete="off" placeholder="Enter Country"
                        require>
               </div>

               <div class="col-sm-6 col-xs-12  mt-4">
                 <label class="pb-3"> Pin code  <span class="mandatory">*</span> </label>
                 <input type="text" name="zip_code" id="zip_code" value="<?= $zip_code ?>" maxlength="50"
                        data-required="true" class="form-control" autocomplete="off" placeholder="Enter Pin Code"
                        require>
               </div>


                <div class="col-sm-6 col-xs-12  mt-4">
               
               <label>
                   <input type="checkbox" id="checkbox-1-2" <? if ($allow_email_for_marketing == "true") {
                                                                    echo ("checked");
                                                                } ?> name="allow_email_for_marketing" value="true" class="regular-checkbox" onclick="checkShow(this.id,'checkbox-1-2');">
                    <label id="terms-conds-label" for="checkbox-1-2"></label>
                    <span class="check"></span>
                  
               </label>
               <span class="remember">
               Your privacy is important to us. By checking this box, you agree to receive communication from L2PRO India regarding L2PRO program features, prompts to complete the course, feedback regarding the course and marketing communication. You will have the option to unsubscribe at any point of time from your profile page.
               </span>
            

        
               </div>
              
                <div class="text-end">   <button  type="button" class=' btn btn-primary' title='Replace my old details with new'
                id="updatePfofilebutton">Update</button></div>
               
</div>
                                                              </form>
            </div>
         </div>
      </div>
      <!-- Services End -->
       <?php include('../intface/std_footer.php');  ?>

       <script>
    $(document).on('click', '#updatePfofilebutton', function(e) {
    
        var designation = $('#designation').val();
        var organization = $('#organization').val();
        var profession_experience = $('#profession_experience').val();

        var profession = $('#LoginForm_profession').val();

        if (profession == 'Working Professional') {

            if (!designation) {
                $('#designation_error').show();
                return 0;
            }else if (!organization) {
                $('#organization_error').show();
                return 0;
            }else if (!profession_experience) {
                $('#profession_experience_error').show();
                return 0;
            }else{
                $('#profileUpdateForm').submit();
            }
        }else{
            $('#profileUpdateForm').submit();
        }
    });
  	
  	

	$(document).on('change', '#LoginForm_profession', function(e) {
    	
   	  showHideProfessionFields($(this).val());
	})
    
    
    function showHideProfessionFields(value){
    	if (value == 'Student') {
        	$('.profession_inputes_filds').hide();
    	}else{
         	$('.profession_inputes_filds').show();
        }
    }
    
    var profession = '<?php echo $profession  ?>';
  	showHideProfessionFields(profession);


/* Zapatec.Calendar.setup({
    inputField: "dob", // ID of the input field
    ifFormat: "%m/%d/%Y", // the date format
    button: "trigger1" // ID of the button
});

Zapatec.Calendar.setup({
    inputField: "doj", // ID of the input field
    ifFormat: "%m/%d/%Y", // the date format
    button: "trigger2" // ID of the button
}); */
</script>
   </body>
</html>