<?php include('../intface/std_top.php'); ?>
<SCRIPT language="JavaScript" src="validate.js"></SCRIPT>
<script>
//function to clear the input fields
function clearFields() {
    //document.userInfo.fstnm.value="";
    //document.userInfo.lstnm.value="";
}
</script>
<script type="text/javascript" language="javascript">
var mailExists = 0;
var http_request = false;
var tempTxt;
var varid;

function makeRequest(url, txt, ids) {
    http_request = false;
    tempTxt = txt;
    varid = ids;
    if (window.XMLHttpRequest) { // Mozilla, Safari,...
        http_request = new XMLHttpRequest();
        if (http_request.overrideMimeType) {
            http_request.overrideMimeType('text/xml');
            // See note below about this line
        }
    } else if (window.ActiveXObject) { // IE
        try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
        }
    }

    if (!http_request) {
        alert('Giving up :( Cannot create an XMLHTTP instance');
        return false;
    }

    http_request.onreadystatechange = alertContents;
    http_request.open('GET', url, true);
    http_request.send(null);

}

function alertContents() {
    if (http_request.readyState == 4) {
        if (http_request.status == 200) {


            if (tempTxt == "check_list") {

                if (http_request.responseText == "1") {
                    document.getElementById("isMail").innerHTML = "Email address already exists!";
                    mailExists = 0;
                } else {
                    document.getElementById("isMail").innerHTML = "";
                    mailExists = 0;
                }


            }


        } else {
            alert('There was a problem with the request.');
        }
    }
}


function checkMail(val) {
    if (Trim(val) != "" && echeck(val) != false) {
        makeRequest('../../admin/crtuser/combo.php?action=chkMyMail&val=' + val, "check_list", val);
    } else {
        document.getElementById("isMail").innerHTML = "";
    }
}
</script>

<?php

$con=createConnection();
$stmt = $con->prepare("SELECT firstname,lastname,usertype,dtenrolled,email,mobile,sex,learn_from,education,profession,education_details,profession_experience,user_country,user_state,user_city,zip_code,allow_email_for_marketing,allow_email_for_campaign,occupation,organization,designation FROM tbl_users WHERE username=?");
$stmt->bind_param("s",$userid);
$stmt->execute();
$stmt->bind_result($fnm,$lnm,$utype,$dt,$email,$mobile,$sex,$learn_from,$education,$profession,$education_details,$profession_experience,$user_country,$user_state,$user_city,$zip_code,$allow_email_for_marketing,$allow_email_for_campaign,$occupation,$organization,$designation);
$stmt->fetch();
$stmt->close();	
closeConnection($con);

/*$result = mysql_query("SELECT * FROM tbl_users where username='$userid'");
$num = mysql_numrows($result);

$fnm = mysql_result($result, 0, "firstname");
$lnm = mysql_result($result, 0, "lastname");
$email = mysql_result($result, 0, "email");
$mobile = mysql_result($result, 0, "mobile");
$sex = mysql_result($result, 0, "sex");
$learn_from = mysql_result($result, 0, "learn_from");
$education = mysql_result($result, 0, "education");
$profession = mysql_result($result, 0, "profession");
$education_details = mysql_result($result, 0, "education_details");
$profession_experience = mysql_result($result, 0, "profession_experience");
$user_country = mysql_result($result, 0, "user_country");
$user_state = mysql_result($result, 0, "user_state");
$user_city = mysql_result($result, 0, "user_city");
$zip_code = mysql_result($result, 0, "zip_code");
$allow_email_for_marketing = mysql_result($result, 0, "allow_email_for_marketing");
$allow_email_for_campaign = mysql_result($result, 0, "allow_email_for_campaign");
$occupation = mysql_result($result, 0, "occupation");
$organization = mysql_result($result, 0, "organization");
$designation = mysql_result($result, 0, "designation");*/



function showDate($val)
{
    $showVal = explode('-', $val);
    $newShowVal = $showVal[1] . "/" . $showVal[2] . "/" . $showVal[0];
    if ($showVal[2] == '') {
        $newShowVal = '';
    }
    return $newShowVal;
}


?>
<section class="scrollable">
    <section class="panel panel-default padder contentTop">
        <div class="col-lg-6 col-md-6 col-sm-6 show-mon">
            <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Edit
                        Profile</strong></span> </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 text-right">
            <a onFocus='this.blur()' onMouseOver='return showStatus();' href="mydtls.php" target="_self"
                class="btn btn-lg btn-default bdrRadius20 marginLeft5" title="Go back">Back</a>
        </div>
        <div class="clear"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 paddTop10">
            <p>Type your new details in the relevant fields and click the Update button. Click the Back link to return
                to the My Profile page.
            </p>
        </div>
        <div class="paddTop10 divider"></div>
    </section>
    <div class="clear"></div>

    <section class="panel panel-default padder paddTop10" style="overflow:hidden">

        <form name="userInfo" data-validate="parsley" action="updtinfo.php" method="post" id="profileUpdateForm">
            <div style="display: flex;flex-wrap: wrap;">
                <div class="form-group col-sm-6 vTop">
                    <label>First Name <span class="mandatory">*</span> <small>(Maximum 30 characters; No special
                            or numeric characters)</small></label>
                    <input name="fstnm" type="text" value=<?= $fnm ?> id="fstnm" size="40" maxlength="30"
                        data-required="true" data-regexp="^[a-zA-Z ]+$"
                        data-regexp-message="First name should contain characters only."
                        class="form-control parsley-validated" autocomplete="off" require />
                </div>

                <div class="form-group col-sm-6 vTop">
                    <label>Last Name <span class="mandatory">*</span> <small>(Maximum 30 characters; No special
                            or numeric characters)</small></label>

                    <input type="text" name="lstnm" id="lstnm" value="<?= $lnm ?>" size="40" maxlength="30"
                        data-required="true" data-regexp="^[a-zA-Z ]+$"
                        data-regexp-message="Last name should contain characters only."
                        class="form-control parsley-validated" autocomplete="off" require>
                </div>

                <div class="form-group  col-sm-6 vTop">
                    <label>Email ID <span class="mandatory">*</span> <small>(No spaces; Valid email
                            address)</small></label>
                    <input type="hidden" id="isMail" name='isMail' value="<?= $email  ?>" />

                    <input type="text" name="email" id="email" value="<?= $email ?>" data-required="true"
                        data-type="email" size="40" maxlength="200" class="form-control parsley-validated"
                        onblur='checkMail(this.value)' autocomplete="off" disabled>
                </div>

                <div class="form-group  col-sm-6 vTop">
                    <label>Mobile <span class="mandatory">*</span> <small>(No spaces; Number only)</small></label>

                    <input type="text" name="mobile" id="mobile" value="<?= $mobile ?>" size="10" min="10"
                        maxlength="10" data-required="true" class="form-control parsley-validated" autocomplete="off"
                        parsley-type="phone" data-type="phone" data-type-message="">
                </div>

                <div class="form-group  col-sm-6 vTop">
                    <label>Gender <span class="mandatory">*</span></label>

                    <select data-required="true" class="form-control input-lg width80" name="sex" id="sex">
                        <option <? if ($sex=="" ) echo ("selected") ?> hidden disabled value="">Select</option>
                        <option <? if ($sex=="male" ) echo ("selected") ?> value="male">Male</option>
                        <option <? if ($sex=="female" ) echo ("selected") ?> value="female">Female</option>
                        <option value="i prefer not to say" <? if ($sex=="i prefer not to say" ) echo ("selected") ?>>I prefer not to say
                        </option>
                    </select>
                </div>

                <div class="form-group  col-sm-6 vTop">
                    <label>How did you hear about us
                        <span class="mandatory">*</span>
                    </label>

                    <select name="learn_from" id="learn_from" data-required="true"
                        class="form-control input-lg width80 learn-from" require>
                        <option <? if ($learn_from=="" ) echo ("selected") ?> hidden disabled value="null">Select
                        </option>
                        <option <? if ($learn_from=="Social Media" ) echo ("selected") ?>>Social Media</option>
                        <option <? if ($learn_from=="Webinar/Event" ) echo ("selected") ?>> Webinar/Event</option>
                        <option <? if ($learn_from=="Internet Search" ) echo ("selected") ?>>Internet Search</option>
                        <option <? if ($learn_from=="Friends/Colleague" ) echo ("selected") ?>>Friends/Colleague</option>
                        <option <? if ($learn_from=="Other" ) echo ("selected") ?>>Others</option>
                    </select>
                </div>
                <div class="form-group  col-sm-6 vTop">
                    <label>Education Level<span class="mandatory">*</span></label>
                    <select name="education" id="education" data-required="true"
                        class="form-control input-lg width80 learn-from" require>
                        <option <? if ($education=="" ) echo ("selected") ?> hidden disabled value="">Select Level
                        </option>
                        <option <? if ($education=="School") echo ("selected") ?>>School</option>
                        <option <? if ($education=="Graduate" ) echo ("selected") ?>>Graduate</option>
                        <option <? if ($education=="Post-Graduate" ) echo ("selected"); ?>>Post-Graduate</option>
                    </select>
                </div>

                <div class="form-group  col-sm-6 vTop">
                    <label>Education Details<span class="mandatory">*</span></label>
                    <input data-required="true" class="form-control input-lg width80" name="education_details"
                        id="education_details" data-required="false" placeholder="Enter Your Education Details"
                        type="text" value="<?= $education_details ?>" />
                </div>
               
                <div class="form-group col-sm-6 vTop">
                    <label>Profession<span class="mandatory">*</span></label>
                    <select data-required="true" class="form-control input-lg width80 signup-profession"
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

                <div class="form-group col-sm-6 vTop profession_inputes_filds">
                    <label>Professional Experience <span class="mandatory">*</span></label>

                    <input type="text" name="profession_experience" id="profession_experience"
                        value="<?= $profession_experience ?>" class="form-control "
                        placeholder="Enter Professional Experience">
                    <span style="color : #CA0606; display:none" id="profession_experience_error">This value is
                        required.</span>
                </div>

                <div class="form-group  col-sm-6 vTop  profession_inputes_filds">
                    <label>Industry <span class="mandatory">*</span></label>                   
                    <select data-required="true" class="form-control input-lg width80 signup-profession"
                        name="organization" id="LoginForm_profession" require>
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

                <div class="form-group  col-sm-6 vTop profession_inputes_filds">
                    <label>Designation <span class="mandatory">*</span></label>

                    <input type="text" name="designation" id="designation" value="<?= $designation ?>" maxlength="50"
                        class="form-control parsley-validated" autocomplete="off">
                    <span style="color : #CA0606; display:none" id="designation_error">This value is required.</span>
                </div>


                <div class="form-group  col-sm-6 vTop">
                    <label>City <span class="mandatory">*</span></label>

                    <input type="text" name="user_city" id="user_city" value="<?= $user_city ?>" maxlength="50"
                        data-required="true" class="form-control" autocomplete="off" placeholder="Enter City" require>
                </div>


                <div class="form-group  col-sm-6 vTop">
                    <label>State <span class="mandatory">*</span></label>

                    <input type="text" name="user_state" id="user_state" value="<?= $user_state ?>" maxlength="50"
                        data-required="true" class="form-control" autocomplete="off" placeholder="Enter State" require>
                </div>

                <div class="form-group  col-sm-6 vTop">
                    <label>Country <span class="mandatory">*</span></label>

                    <input type="text" name="user_country" id="user_country" value="<?= $user_country ?>"
                        data-required="true" class="form-control" autocomplete="off" placeholder="Enter Country"
                        require>
                </div>

                <div class="form-group  col-sm-6 vTop">
                    <label>Pin Code <span class="mandatory">*</span></label>


                    <input type="text" name="zip_code" id="zip_code" value="<?= $zip_code ?>" maxlength="50"
                        data-required="true" class="form-control" autocomplete="off" placeholder="Enter Pin Code"
                        require>
                </div>

                <div class="form-group  col-sm-6 vTop">
                <label style="margin-bottom:0px;">
                    <input type="checkbox" id="checkbox-1-2" <? if ($allow_email_for_marketing == "true") {
                                                                    echo ("checked");
                                                                } ?> name="allow_email_for_marketing" value="true" class="regular-checkbox" onclick="checkShow(this.id,'checkbox-1-2');">
                    <label id="terms-conds-label" for="checkbox-1-2"></label>
                    <span class="check"></span>
                </label>
                <span class="remember">
                Your privacy is important to us. By checking this box, you agree to receive communication from L2PRO India regarding L2PRO program features, prompts to complete the course, feedback regarding the course and marketing communication. You will have the option to unsubscribe at any point of time from your profile page.
                </span>
                
                <!-- <br><br>
                <label style="margin-bottom:0px;">
                    <input type="checkbox" id="checkbox-1-3" name="allow_email_for_campaign" <? if ($allow_email_for_campaign == "true") {
                                                                                                    echo ("checked");
                                                                                                } ?> value="true" class="regular-checkbox">
                    <label id="terms-conds-label" for="checkbox-1-3"></label>
                    <span class="check"></span>
                </label>
                <span class="remember">
                    I allow my email for Campaign
                </span> -->

            </div>
            <div class="form-group  col-sm-6 vTop">

                    <div class="divider">

                    </div>
                    <div class="clear">

                    </div>
                    <div class="text-right">
                        <button type="button" class=' btn btn-red' title='Replace my old details with new'
                            id="updatePfofilebutton">
                            <i class="build fa fa fa-file-text-o"></i> Update </button>
                    </div>
                    <div class="divider"></div>
                    <div class="clear"></div>
                </div>
            </div>
        </form>
    </section>
</section>

<?php
include('../intface/footer.php');
?>

<script>
    $(document).on('click', '#updatePfofilebutton', function(e) {
        var designation = $('#designation').val();
        var organization = $('#organization').val();
        var profession_experience = $('#profession_experience').val();

        var profession = $('#LoginForm_profession').val();
        console.log(profession);
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