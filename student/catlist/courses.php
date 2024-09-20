<?php 
ini_set('display_errors',0);
ini_set('display_startup_errors',0);
error_reporting(0);
include '../intface/std_top.php';
//if(!$_SESSION['token'])
//{
//header("Location:../../index.php#item1");
//exit();
//}
$pageSplit = 10;

function mysql_escape_mimic($inp) {

    if(is_array($inp))
    return array_map(__METHOD__, $inp);
    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);

    }
    return $inp;
}


$perms = $_SESSION['perms'];


if (isset($_REQUEST['id'])) {
    $catid = $_REQUEST['id'];
}
$database = $database;

if (isset($_REQUEST['cContent'])) {
    $cContent = trim($_REQUEST['cContent']);
}

if (isset($_REQUEST['cCode'])) {
    $cCode = trim($_REQUEST['cCode']);
}

if (isset($_REQUEST['cTitle'])) {

	$cTitle=trim(mysql_escape_mimic(htmlspecialchars($_REQUEST['cTitle'])));
}

if (isset($_REQUEST['cDesc'])) {
    $cDesc = trim(mysql_escape_mimic(htmlspecialchars($_REQUEST['cDesc'])));
}

if (isset($_REQUEST['cGroup'])) {
    $cGroup = trim(mysql_escape_mimic(htmlspecialchars($_REQUEST['cGroup'])));
}

if (isset($_REQUEST['cKey'])) {
    $cKey = trim($_REQUEST['cKey']);
}

if ($cGroup == "") {
    $cGroup = 'Basic';
}
else if ($cGroup == 'Advance') {
    $cGroupName = "Advanced";
} else if ($cGroup == 'Intermediate') {
    $cGroupName = 'Intermediate';
}
else
{
$cGroupName = '';
}
$user_rowid = getUserId($userid);

//echo $userid."-".$user_rowid;exit;
$user_comp_id = getUserCompanyId($user_rowid);

//exit;

?>
<style>
    .nav-tabs>li,
    nav-tabs>li>a {
        float: left;
        width: 33.0%;
        color: #fff;
        margin-bottom: -1px;
        border-radius: 10px 10px 0 0;
        background-color: #00558e;
    }

    .nav-tabs>li>a,
    nav-tabs>li>a:hover,
    nav-tabs>li:hover {
        text-align: center;
        font-size: 16px;
        margin-right: 0px;
        border-radius: 10px 10px 0 0;
        color: #fff;
        cursor: pointer;
        background-color: #00558e;
        border: 1px solid #054b79;
        border-bottom-color: transparent;
    }

    .nav-tabs>li {
        margin-right: 5px;
    }

    .nav-tabs>li.active {
        color: #fff;
        margin-right: 5px;
        background-color: #ffb901 !important;
    }

    .nav-tabs>li:last-child,
    .nav-tabs>li.active:last-child {
        margin-right: 0px;
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:hover,
    .nav-tabs>li.active>a:focus {
        color: #fff !important;
        margin-right: 0px;
        cursor: pointer;
        background-color: #ffb901 !important;
        border: 1px solid #ffb901;
        border-bottom-color: transparent;
    }

    nav-tabs>li>a:hover {
        border-color: #ffb901 #ffb901 #ffb901;
    }

    .nav>li>a:hover,
    .nav>li>a:focus {
        text-decoration: none;
        color: #fff !important;
        background-color: #00558e !important;
        border: 1px solid #054b79;
    }

    .table-responsive45 {
        padding-top: 10px;
        border-top: 1px solid #ddd;
    }

    .promo .table thead {
        padding-top: 10px;
    }

    .table-responsive {
        border-top: 1px solid #ddd;
        padding-top: 10px;
    }

    .panel-footer {

        padding: 20px 0px;

    }


    #share {
        width: 100%;
        margin: 0px auto;
        text-align: center;
    }

    /* buttons */

    #share a {
        width: 50px;
        height: 50px;
        display: inline-block;
        margin: 8px;
        border-radius: 50%;
        font-size: 24px;
        color: #fff;
        opacity: 0.75;
        transition: opacity 0.15s linear;
    }

    #share a:hover {
        opacity: 1;
    }

    /* icons */

    #share i {
        position: relative;
        top: 50%;
        transform: translateY(-50%);
    }

    /* colors */

    .facebook {
        background: #3b5998;
    }

    .twitter {
        background: #55acee;
    }

    .googleplus {
        background: #dd4b39;
    }

    .linkedin {
        background: #0077b5;
    }
</style>

<script>
    function openFile(docid, winWd, winHt, winRsz, winScl, winDir, winLoc, winMenu, winTool, winSts) {

        var winLeft = (screen.width - winWd) / 2;
        var winTop = (screen.height - winHt) / 2;
        var settings = 'left=' + winLeft + ',top=' + winTop + ',width=' + winWd + ',height=' + winHt + ',toolbar=' +
            winTool + ',menubar=' + winMenu + ',resizable=' + winRsz + ',statusbar=' + winSts + ',scrollbars=' + winScl +
            ',location=' + winLoc + ',directories=' + winDir;
        var fpath = "view.php?docid=" + docid;
        //alert(fpath);
        var fileWin = window.open(fpath, 'fwind', settings);
        fileWin.focus();
    }
    //function to ask user whether he wants to delete the course or not
    //Function to confirm if the user wants to delete the selected requests or not

    function openFileZip(docid, launchid, winWd, winHt, winRsz, winScl, winDir, winLoc, winMenu, winTool, winSts) {

        var winLeft = (screen.width - winWd) / 2;
        var winTop = (screen.height - winHt) / 2;
        var settings = 'left=' + winLeft + ',top=' + winTop + ',width=' + winWd + ',height=' + winHt + ',toolbar=' +
            winTool + ',menubar=' + winMenu + ',resizable=' + winRsz + ',statusbar=' + winSts + ',scrollbars=' + winScl +
            ',location=' + winLoc + ',directories=' + winDir;
        //alert(settings);
        var fpath = "view.php?docid=" + docid + "&launchid=" + launchid;

        var fileWin = window.open(fpath, 'fwind', settings);
        fileWin.focus();
    }

    function submitSearch() {
        document.searchcourse.submit();
    }


    function getCourse(rowId, file) {
        document.location.href = "../../courses/" + rowId + "/" + file;
    }
    $(document).ready(function() {
        localStorage.removeItem("download_status");
    });

    function launch_content(cid, scoid, width, height) {
        //	alert(scoid);
        /////generic code//////
        var w = width;
        var h = height;
        var winl = (screen.width - w) / 2;
        var wint = (screen.height - h) / 2;
        if (winl < 0) winl = 0;
        if (wint < 0) wint = 0;
        windowprops = "height=" + h + ",width=" + w + ",top=" + wint + ",left=" + winl + ",location=no," +
            "scrollbars=no,menubars=no,toolbars=no,resizable=no,status=no,directories=no";
        path = "playscorm.php?cid=" + cid + "&scoid=" + scoid;
        var con_window = window.open(path, "win", windowprops);
        con_window.focus();
    }

    function launch_survey(user_id) {
        //	alert(scoid);
        /////generic code//////
        var w = 1024;
        var h = 768;
        var winl = (screen.width - w) / 2;
        var wint = (screen.height - h) / 2;
        if (winl < 0) winl = 0;
        if (wint < 0) wint = 0;
        windowprops = "height=" + h + ",width=" + w + ",top=" + wint + ",left=" + winl + ",location=no," +
            "scrollbars=no,menubars=no,toolbars=no,resizable=no,status=no,directories=no";
        path = "../survey/survey.php?user_id=" + user_id;
        var con_window = window.open(path, "win", windowprops);
        con_window.focus();
    }



    function getPackage(file) {
        alert("This option is not available to Guests!");
        //document.location.href="../../courses/download/"+file;
    }

    function courseGroupSubmit(group) {
        document.getElementById('cGroup').value = group;
        document.search.submit();
    }


    //to create and open certificate

    function open_cert(docId, userRowId, levelname, download_status, user_name) {

        download_status = download_status;
        if (localStorage.getItem("download_status")) {
            download_status = localStorage.getItem("download_status");
        }
        var w = 1024;
        var h = 600;
        var winl = (screen.width - w) / 2;
        var wint = (screen.height - h) / 2;
        if (winl < 0) winl = 0;
        if (wint < 0) wint = 0;
        windowprops = "height=" + h + ",width=" + w + ",top=" + wint + ",left=" + winl + ",location=no," +
            "scrollbars=no,menubars=no,toolbars=no,resizable=no,status=no,directories=no";
        path = '../../webapi/certs/library/certificate-create.php?docId=' + docId + '&userRowId=' + userRowId +
            '&levelname=' + levelname;
        //alert(download_status)
        if (download_status == 0) {
            localStorage.setItem("download_status", download_status);
            localStorage.setItem("download_certificate_path", path);
            $('#checkDownloadCertificateModal').modal('show');
            return 0;
        } else {
            var con_window = window.open(path, "win", windowprops);
            con_window.focus();
        }

    }
</script>


<div class="modal fade" id="checkDownloadCertificateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow:auto">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="position: relative;">
                <h5 class="modal-title" id="exampleModalLongTitle"> Hi <?php echo $user_name ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;top: 0;right: 15px;bottom: 0;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" id="updateUserinfoform" action="#" novalidate="novalidate">
                    <div style="display: flex;flex-wrap: wrap;">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <b>Please take a moment to complete these profile fields, before you download the
                                certificate</b>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <input type="hidden" id="user_id_update_field" name="user_id" value="<?php echo $user_rowid ?>">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label"> Education Level</label>
                                <select class="form-control " id="input_education" name="education">
                                    <option value="">Select Education</option>
                                    <option value="School" <?php echo $education == 'School' ? 'selected' : '' ?>>
                                        School</option>
                                    <option value="Graduate" <?php echo $education == 'Graduate' ? 'selected' : '' ?>>
                                        Graduate</option>
                                    <option value="Post-Graduate" <?php echo $education == 'Post-Graduate' ? 'selected' : '' ?>>
                                        Post-Graduate</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label"> Education Details</label>
                                <input type="text" class="form-control " id="input_education_details" name="education_details" value="<?php echo $education_details ?>">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label"> Gender </label>
                                <select class="form-control " id="input_gender" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male" <?php echo $sex == 'male' ? 'selected' : '' ?>>
                                        Male</option>
                                    <option value="female" <?php echo $sex == 'female' ? 'selected' : '' ?>>
                                        Female</option>
                                    <option value="i prefer not to say" <?php echo $sex == 'i prefer not to say' ? 'selected' : '' ?>>
                                        I prefer not to say</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label"> Profession</label>
                                <select class="form-control " id="input_profession" name="profession">
                                <option <? if ($profession=="" ) echo ("selected"); ?> value="">Select Profession</option>
                        <option <? if ($profession=="Startup" ) echo ("selected"); ?> ?> Startup</option>
                        <option <? if ($profession=="Student" ) echo ("selected"); ?> ?> Student</option>
                        <option <? if ($profession=="Professor" ) echo ("selected"); ?> ?> Professor</option>
                        <option <? if ($profession=="Industry professional" ) echo ("selected"); ?> ?> Industry professional</option>
                        <option <? if ($profession=="Legal professional" ) echo ("selected"); ?> ?> Legal professional</option>
                        <option <? if ($profession=="Others" ) echo ("selected"); ?> ?> Others</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 profession_inputes_filds">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label"> Industry</label>
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
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 profession_inputes_filds">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label"> Professional Experience</label>
                                <input type="text" class="form-control " id="input_profession_experience" name="profession_experience" value="<?php echo $profession_experience ?>">
                                <span style="color:red;display: none" id="profession_experience-error">This value is required.</span>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="learn_from" class="col-form-label"> How did you hear about us</label>
                                <select class="form-control " id="learn_from" name="learn_from">
                                    <option value="">Select</option>
                                    <option value=" Social Media" <?php echo $learn_from == ' Social Media' ? 'selected' : '' ?>>
                                        Social Media</option>
                                    <option value="Webinar/Event" <?php echo $learn_from == 'Webinar/Event' ? 'selected' : '' ?>>
                                        Webinar/Event</option>
                                    <option value="Internet Search" <?php echo $learn_from == 'Internet Search' ? 'selected' : '' ?>>
                                        Internet Search</option>

                                    <option value="Friends/Colleague" <?php echo $learn_from == 'Friends/Colleague' ? 'selected' : '' ?>>
                                        Friends/Colleague</option>
                                    <option value="Others" <?php echo $learn_from == 'Others' ? 'selected' : '' ?>>
                                        Others</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label"> City</label>
                                <input type="text" class="form-control " id="input_user_city" name="user_city" value="<?php echo $user_city ?>">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label"> State</label>
                                <input type="text" class="form-control " id="input_user_state" name="user_state" value="<?php echo $user_state ?>">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label"> Country</label>
                                <input type="text" class="form-control " id="input_user_country" name="user_country" value="<?php echo $user_country ?>">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Pin Code</label>
                                <input type="text" class="form-control " id="input_zip_code" name="zip_code" value="<?php echo $zip_code ?>">
                            </div>
                        </div>

                        <!-- <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                <div class="checkbox-1">
                                        <label style="margin-bottom:0px;">
                                            <input type="checkbox" id="privacy_policy_checkbox" name="privacy_policy_checkbox"
                                                class="regular-checkbox">
                                            <label id="terms-conds-label" for="privacy_policy_checkbox"></label>
                                            <span class="check"> </span>
                                        </label>
                                        <span class="remember">
                                        I agree to L2pro <a href="javascript:void(0)" onClick="showPrivacyPolicyModal()"    class="text-info"><u> Privacy Policy </u>
                                        </a>
                                        </span> <br>
                                        <span class="mt-2" id="privacy_policy_checkbox_error" style=" color: red;"></span>
                                    </div>
                                </div>
                            </div> -->
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"> Update </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<div class="modal fade" id="ShareCertificateModal" tabindex="-1" role="dialog" aria-labelledby="ShareCertificateModelTitle" aria-hidden="true" style="overflow:auto">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="position: relative;">
                <h5 class="modal-title" id="ShareCertificateModelTitle"> Hi <?php echo $user_name ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;top: 0;right: 15px;bottom: 0;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="share">
                            Please choose any of the following social media platforms to share your certificate with your social media connections.

                            Happy Learning...
                            <br>
                            <!-- google plus -->
                            <!-- <a class="googleplus" href="https://plus.google.com/share?url=<?php echo  $url ?>" target="blank">
                                <i class="fa fa-google"></i>
                            </a> -->
                            <!-- facebook -->
                            <a class="facebook" href="" target="blank" id="facebook_link_button"><i class="fa fa-facebook"></i></a>
                            <!-- twitter -->
                            <a class="twitter" href="" target="blank" id="twitter_link_button"><i class="fa fa-twitter"></i></a>
                            <!-- linkedin -->
                            <a class="linkedin" href="" target="blank" id="linkedin_link_button"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="term modal fade" id="PrivacyPolicyModel" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal-course-title"> Privacy Policy</h4>
            </div>
            <div class="modal-body">
                <section class="scrollable ">
                    <!--start Midlle container -->
                    <div class="col-md-12 col-sm-12 chComponentBg">
                        <div class="customContainer">
                            <div class="col-md-12 col-sm-12">
                                <div class="overviewBg">
                                    <p> </p>
                                    <div class="clear"></div>
                                    <h2>Waiting for content </h2>
                                    <p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ####### end  Midlle container-->
                </section>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=62d14a75987470001990b538&product=inline-share-buttons" async="async"></script>
<script>
    var $form = $('#updateUserinfoform');

    validator = $form.validate({
        rules: {
            education: {
                required: true
            },
            user_country: {
                required: true
            },
            user_state: {
                required: true,
            },
            user_city: {
                required: true,
            },
            zip_code: {
                required: true
            },
            profession: {
                required: true
            },
            gender: {
                required: true
            },
            learn_from: {
                required: true
            },
            education_details: {
                required: true
            },
            /* privacy_policy_checkbox: {
                required: true
            } */

        },
        errorPlacement: function(error, element) {
            $('#privacy_policy_checkbox_error').text('');
            var error_html_id = element.attr('id');
            if (error_html_id == 'privacy_policy_checkbox') {
                $('#privacy_policy_checkbox_error').text('This value is required.');
            } else {
                $('#' + error_html_id + '-error').remove();
                $('<label id="' + error_html_id + '-error" class="error" for="input_education" style=" color: red;">This value is required.</label>').insertAfter(element);
            }
        }
    });


    $(document).on('change', '#input_profession', function(e) {
        showHideProfessionFields($(this).val());
    })

    function openShareCertificateModel(download_status, facebook_link, linkedin_link, twitter_link) {
        $("#facebook_link_button").attr("href", facebook_link);
        $("#linkedin_link_button").attr("href", linkedin_link);
        $("#twitter_link_button").attr("href", twitter_link);
        download_status = download_status;
        if (localStorage.getItem("download_status")) {
            download_status = localStorage.getItem("download_status");
        }
        if (download_status == 0) {
            localStorage.setItem("ShareCertificateMode", 1);
            $('#checkDownloadCertificateModal').modal('show');
        } else {
            $('#ShareCertificateModal').modal('show');
        }
    }


   

    function showHideProfessionFields(value) {
        if (value == 'Professor' || value == 'Industry professional' || value == 'Legal professional' || value == 'Others') {
            $('.profession_inputes_filds').show();
        } else {
            $('.profession_inputes_filds').hide();
        }
    }

    var profession = '<?php echo $user_query_response['profession'] ?>';
    showHideProfessionFields(profession);

    $('#updateUserinfoform').on('submit', function(e) {
        e.preventDefault();
        if (validator.valid()) {
            var is_invalid = 1;
            var profession = $('#input_profession').val();
            if (profession == 'Working Professional') {
                var organization = $('#input_organization').val();
                var experience = $('#input_profession_experience').val();
                if (!organization) {
                    is_invalid = 0;
                    $('#organization-error').show();
                }
                if (!experience) {
                    is_invalid = 0;
                    $('#profession_experience-error').show();
                }
            }
            if (is_invalid == 1) {
                updateUserinfo();
            }
        }
    });

    function updateUserinfo() {
        $.ajax({
            type: "POST",
            url: 'update_user_info.php',
            data: $('#updateUserinfoform').serialize(),
            success: function(response) {
                var jsonData = JSON.parse(response);
                console.log(jsonData)
                if (jsonData.success == "1") {
                  $('#checkDownloadCertificateModal').modal('hide');
                    //window.location.reload();
                    localStorage.removeItem("download_status")
                    localStorage.setItem("download_status", 1);
                    if (localStorage.getItem("ShareCertificateMode") == 1) {
                        localStorage.removeItem("ShareCertificateMode")
                        $('#ShareCertificateModal').modal('show');
                    } else {
                        var con_window = window.open(localStorage.getItem("download_certificate_path"), "win",
                            windowprops);
                        con_window.focus();
                    }

                } else {
                    //alert('Invalid Credentials!');
                }
            }
        });
    }

    function showPrivacyPolicyModal() {
        $('#PrivacyPolicyModel').modal('show');
    }
</script>
<!-- -->

<?

//$result = mysql_query ("SELECT category_name FROM tbl_category where id='$catid'");
//$category_name=mysql_result($result,0,"category_name");
//get the status message if a new course has been uploaded
$successMsg = $_GET['msg'];

if (!isset($_GET['currpage'])) {
    $currpage = 0;
} else {
    $currpage = $_GET['currpage'];
}
$startRecord = ($currpage * $pageSplit);
$joinQuery = '';
//$joinQuery="WHERE 1=1";
$joinTable = "";

if ($cTitle != "") {
    $joinQuery .= " AND A.name LIKE '%$cTitle%'";
}

if ($cDesc != "") {
    $joinQuery .= " AND  A.summary LIKE '%$cDesc%'";
}
if ($cGroup != "") {
    $joinQuery .= " AND  A.course_level = '$cGroup'";
}

if ($cCode != "" || $cTitle != "" || $cDesc != "" || $cKey != "" || $cContent != "") {
    $searchmsg = '1';
} else {
    $searchmsg = '0';
}


////$totalnum = mysql_numrows($result);



$con = createConnection();
$query1 = "SELECT DISTINCT A.id,A.name,A.summary,A.width,A.height,A.version FROM tls_scorm AS A, tbl_category_course AS B, tbl_company_category AS C WHERE B.category_id=C.category_id AND A.course_type='course' AND C.company_id='$user_comp_id'" . $joinQuery . " ORDER BY A.name + 0 DESC";
$result = mysqli_query($con, $query1);
$totalnum = mysqli_num_rows($result);





$query2 = "SELECT DISTINCT A.id,A.name,A.summary,A.width,A.height,A.version,A.course_type FROM tls_scorm AS A, tbl_category_course AS B, tbl_company_category AS C WHERE B.category_id=C.category_id AND C.company_id=$user_comp_id" . $joinQuery . " ORDER BY A.id + 0 ASC LIMIT $startRecord,$pageSplit";
$resultList = mysqli_query($con, $query2);
$num = mysqli_num_rows($resultList);


$totalPages = ceil($totalnum / $pageSplit);



$query3 = "SELECT * FROM tbl_category AS A, tbl_company_category AS B WHERE A.id=B.category_id AND B.company_id=$user_comp_id ORDER BY category_name ASC";
$catResult = mysqli_query($con, $query3);
$cattotalnum = mysqli_num_rows($catResult);

//if courses not found

?>

<section class="panel panel-default  padder">
    <!-- breadcrumbs -->
    <!-- breadcrumbs -->
    <section>
        <div class="panel-body nobot panelBg" style="margin-top:2px">
            <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Courses</strong></span>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 " style="margin-top:12px;">
            <div class="row">
                <form name="search" action="courses.php" method="post">
                    <div class="pull-right text-right searchbg" style="padding-left:10px">
                        <div class="search inline"> <span>
                                Title:&nbsp;<input name="cTitle" class='input-sm form-control searchbtn' type="text" id="cTitle" size="15" maxlength="30" value='<?= htmlspecialchars($cTitle);
                                                                                                                                                                    ?>' placeholder="Title">

                                Description:&nbsp;
                                <input name="cDesc" value='<?= htmlspecialchars($cDesc);
                                                            ?>' class="input-sm form-control  searchbtn" type="text" id="cDesc" size="15" maxlength="30" placeholder="Description"><input name="cGroup" value='<?= htmlspecialchars($cGroup);
                                                                                                                                                    ?>' type="hidden" id="cGroup" size="15" maxlength="30">
                                <!--<i class="fa fa-search"></i>-->
                                <button type="submit" id='Go' title='Search users matching specified criteria' name="Go" class="btn btn-sm btn-blue searchButton"> <i class="fa fa-search"></i></button>

                            </span> <span class="text-right"> <a href="courses.php" class="btn  btn-blue btn-reset"> <i class="fa fa-refresh"></i> </a> </span> </div>
                    </div>
                </form>
            </div>
        </div>

    </section>


    <section class="">

        <div class="rightHead text-center bgWt" style='min-height:40px'>

            <section class="col-md-12 col-sm-12">
                <div class="row m-l-none m-r-none bg-light lter">
                    <div class="col-sm-4 col-md-4 padder-v  text-left" style="padding-left: 0px;">

                        <div class="clear" style="padding-top: 0px;"></div>
                        <a class="clear" href="#">
                            <span class="h3  m-t-xs"><strong><?php echo $cGroupName; ?> Courses:</strong></span>
                            <small class="text-muted text-uc count">
                                <? echo $totalnum
                                ?>
                            </small>
                        </a>
                    </div>
                    <!--<div class="col-sm-7 col-md-7 padder-v text-right">
                                <div class="clear" style="padding-top: 20px;"></div>
                              &nbsp;&nbsp;&nbsp;<a class="btn btn-lg btn-default bdrRadius20"  href='#'  title='Add New Course'><i class="fa fa fa-plus"></i>  Add New Course</a> </div>
				 -->
                    <!-- <div class="col-sm-4 col-md-4 padder-v text-right">

					<div class="clear" style="padding-top: 20px;"></div>
                  <a  class="btn btn-lg btn-voilet" id="btnBuildCourse" name="btnBuildCourse" href="#" title="Add New Course"> <i class="build fa fa fa-plus"></i> Add New Course</a>
                  </div>
                </div>->
              </section>
		  </div>

	<!--Responsive grid table -->
                </div>

            </section>

    </section>
    <form name="deletecourse" action="" method="post">
        <section class="scrollable">

            <section class="panel panel-default panelgridBg">
                <div class="panel row teacher-student-wrap" style=" margin-top:20px;">
                    <ul class="nav nav-tabs">
                        <?php
                        if ($cGroup == 'Basic') {
                        ?>
                            <li class="active"><a data-toggle="tab" href="#basic" onclick="courseGroupSubmit('Basic');">Basic</a></li>
                        <?php
                        } else {
                        ?>
                            <li><a data-toggle="tab" href="#basic" onclick="courseGroupSubmit('Basic');">Basic</a></li>
                        <?php
                        }
                        ?>


                        <?php
                        if ($cGroup == 'Intermediate') {
                        ?>
                            <li class="active"><a data-toggle="tab" href="#intermediate" onclick="courseGroupSubmit('Intermediate');">Intermediate</a></li>
                        <?php
                        } else {
                        ?>
                            <li><a data-toggle="tab" href="#intermediate" onclick="courseGroupSubmit('Intermediate');">Intermediate</a></li>
                        <?php
                        }
                        ?>

                        <?php
                        if ($cGroup == 'Advance') {
                        ?>
                            <li class="active"><a data-toggle="tab" href="#advanced" onclick="courseGroupSubmit('Advance');">Advanced</a></li>
                        <?php
                        } else {
                        ?>
                            <li><a data-toggle="tab" href="#advanced" onclick="courseGroupSubmit('Advance');">Advanced</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>

                    <div class="tab-content" style="    border: 1px solid #0000002b;border-radius:0px;border-top:0px;">
                        <div id="basic" class="tab-pane fade in active">
                            <!--Responsive grid table -->
                            <div class="table-responsive promo courseGroup">
                                <?
                                if (!$num) {
                                ?>
                                    <div class="noRecordeTable">
                                        <?
                                        if ($searchmsg == '1') {
                                            echo "No results found! Click the Back link to search again.";
                                        } else {
                                            echo "Courses not available!";
                                        }
                                        ?>
                                    </div>

                                <?
                                    exit();
                                }
                                ?>

                                <table class="table m-b-none dataTable">
                                    <thead>
                                        <tr>

                                            <th class="col-xs-3 text-left">Course Title</th>

                                            <th class="col-xs-2 text-center">Status</th>
                                            <th class="col-xs-3 text-center">Time Spent</th>
                                            <th class="col-xs-3 text-center">Score</th>
                                            <th class="col-xs-2 text-center">Launch</th>
                                    </thead>

                                    <?
                                    $i = 0;
                                    while ($i < $num) {
                                        //$classColor='';
                                        $row = mysqli_fetch_assoc($resultList);
                                        $id = $row['id'];

                                        //$docid = mysqli_result($resultList, $i, "A.id");
                                        $docid = $row['id'];


                                        //$fileTitle = mysqli_result($resultList, $i, "name");
                                        $fileTitle = $row['name'];

                                        //$fileDescription = mysqli_result($resultList, $i, "summary");
                                        $fileDescription = $row['summary'];

                                        //$sWidth = mysqli_result($resultList, $i, "width");
                                        $sWidth = $row['width'];

                                        //$sHeight = mysql_result($resultList, $i, "height");
                                        $sHeight = $row['height'];

                                        $userCourseStatus = getUserCourseStatus($user_rowid, $docid);
                                        $userCourseScore = getUserCourseScore($user_rowid, $docid);

                                        $userCourseCompletionDate = getUserCompletionDate($user_rowid, $docid);
                                        $userCourseTime = getUserCourseTime($user_rowid, $docid);
                                        $userCourseTime = substr($userCourseTime, 0, 8);

                                        // $courseType = mysql_result($resultList, $i, "course_type");
                                        $courseType = $row['course_type'];

                                        if ($userCourseCompletionDate == "-") {
                                            $userCourseCompletionDateFormatted = "-";
                                        } else {
                                            $userCourseCompletionDateFormatted = parseDate($userCourseCompletionDate);
                                        }

                                        if ($courseType == 'course') {
                                            $showUserScore = "NA";
                                        } else {
                                            $showUserScore = $userCourseScore;
                                            $classColor = 'style="background-color:#cadab8"';
                                        }

                                        if ($i % 2 == 0) $bgc = "row1";
                                        else $bgc = "row2";
                                        //mysql_close();

                                    ?>
                                        <tr <?php echo $classColor; ?>>

                                            <td class="col-xs-3 text-left" <?php echo $classColor; ?>>
                                                <!--    <a class="listitems" onFocus='this.blur()' onMouseOver='return showStatus();' href='course_details.php?cid=<?= $docid ?>&curPage=<?= $currpage ?>&cCategory=<?= $cCategory ?>&cContent=<?= $cContent ?>&cCode=<?= $cCode ?>&cTitle=<?= $cTitle ?>&cDesc=<?= $cDesc ?>&cKey=<?= $cKey ?>' title="<? echo ucfirst($fileTitle); ?>"><? echo ucfirst(TrimString($fileTitle)); ?></a>-->
                                                <a class="listitems" href="javascript:launch_content(<?= $docid ?>,<?= $docid ?>,<?= $sWidth ?>,<?= $sHeight ?>);">
                                                    <?php echo ucfirst(TrimString($fileTitle)); ?>
                                                </a>


                                            </td>

                                            <td class="col-xs-2 text-center"><?php echo ucfirst($userCourseStatus) ?></td>
                                            <td class="col-xs-3 text-center"><?php echo $userCourseTime ?></td>


                                            <td class="col-xs-3 text-center"><?php echo $showUserScore ?></td>
                                            <td class="col-xs-2 text-center">
                                                <a onFocus='this.blur()' onMouseOver='return showStatus();' title='Launch course' href="javascript:launch_content(<?php echo $docid ?>,<?php echo $docid ?>,<?php echo $sWidth ?>,<?php echo $sHeight ?>);"><img src='../../images/start-icon.png' border='0' width='20px' />
                                            </td>

                                            <!--<td align="center" class="Content"><?= $userCourseCompletionDateFormatted ?></td>
							<td align="center" class="Content"><?= $userCourseScore ?></td>-->

                                        </tr>

                                    <?
                                        $i++;
                                    }

                                    ?>
                                    <!------------------Show Certificate------------>
                                    <?php
                                    ////if($course_type=='assessment' && $showUserScore >= 60)
                                    if ($showUserScore >= 60) {
                                    ?>

                                        <tr>
                                            <td class="col-xs-3 text-left">Certificate - <?php echo $cGroup; ?></td>
                                            <td class="col-xs-2 text-center">&nbsp;</td>
                                            <td class="col-xs-3 text-center">&nbsp;</td>
                                            <td class="col-xs-3 text-center">&nbsp;</td>
                                            <td class="col-xs-2 text-center">
                                                <?php
                                                $download_status = 1;

                                                $stmt = $con->prepare("SELECT id,firstname,lastname,sex,education,user_country,user_state,user_city,zip_code,profession,education_details,profession_experience,organization,learn_from FROM tbl_users where username=?");
                                                $stmt->bind_param("s", $_SESSION['sess_uid']);
                                                $stmt->execute();
                                                $stmt->bind_result($user_id, $firstname, $lastname, $sex, $education, $user_country, $user_state, $user_city, $zip_code, $profession, $education_details, $profession_experience, $organization, $learn_from);
                                                $stmt->fetch();
                                                $stmt->close();
                                                //$user_query = "select * from tbl_users where  email=\"" . $_SESSION['sess_uid'] . "\"";
                                                //$user_query_result = mysql_db_query($database, $user_query) or die("Failed Query of" . $user_query);
                                                //$user_query_response = mysql_fetch_assoc($user_query_result);

                                                if (empty($sex) || empty($education) || empty($user_country) || empty($user_state) || empty($user_city) || empty($zip_code) || empty($profession)) {
                                                    $download_status = 0;
													
                                                }
                                                if (!empty($education) && empty($education_details)) {
                                                    $download_status = 0;
													
                                                }

                                                if (!empty($profession) && $profession != 'Student') {
                                                    if (empty($profession_experience) || empty($organization)) {
                                                        $download_status = 0;
														
                                                    }
                                                }

                                                $user_name = $firstname . ' ' . $lastname;
                                                $require_fildes = ['education' => 'Education', 'user_country' => 'Country', 'user_state' => 'State', 'user_city' => 'City', 'zip_code' => 'Code', 'organization' => 'Organization', 'profession' => 'Profession', 'education_details' => 'Education Details', 'profession_experience' => 'Profession Experience',];
                                                ?>
                                                <a onFocus='this.blur()' onMouseOver='return showStatus();' title='Download Certificate' href="javascript:open_cert('<?php echo $docid
                                                                                                                                                                        ?>','<?php echo $user_rowid
        ?>','<?php echo $cGroup
        ?>','<?php echo $download_status
        ?>','<?php echo $user_name
        ?>')">
                                                    <u> Download Certificate </u>
                                                </a>
                                                <br><br>
                                                <?php
                                                function getShareCertificateLinks($database, $user_rowid, $docid, $level_name)
                                                {

                                                    global $con;
                                                    $stmt = $con->prepare("SELECT id,cert_path FROM tbl_certificates where user_id=? and sco_id=? and level_name='$level_name'");
                                                    $stmt->bind_param("ii", $user_rowid, $docid);
                                                    $stmt->execute();
                                                    $stmt->bind_result($cert_id, $cert_path);
                                                    $stmt->fetch();
                                                    $stmt->close();

                                                    //$certificate_query = "SELECT * FROM tbl_certificates where user_id=$user_rowid and sco_id=$docid and level_name='$level_name'";
                                                    // $certificate_query_result = mysql_db_query($database, $certificate_query) or die("Failed Query of" . $certificate_query);
                                                    //$certificate_query_response = mysql_fetch_assoc($certificate_query_result);
                                                    //$share_url = !empty($certificate_query_response) ? $certificate_query_response['cert_path'] : '';
                                                    if (!empty($cert_id)) {
                                                        $share_url = $cert_path;
                                                    }

                                                    $create_path = 'webapi/certs/library/generate-and-share-certificate.php?docId=' . $docid . '&userRowId=' . $user_rowid . '&levelname=' . $level_name . '&social_share_type=';

                                                    $link = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
                                                    $link = $link . $_SERVER['SERVER_NAME'];

                                                    $share_link = '';
                                                    $share_links = [];

                                                    if (!empty($share_url)) {
                                                        $share_links['facebook'] =  'http://www.facebook.com/sharer.php?u=' . $share_url;
                                                        $share_links['linkedin'] =  'https://www.linkedin.com/shareArticle?mini=true&url=' . $share_url;
                                                        $share_links['twitter'] = 'https://twitter.com/intent/tweet?url=' . $share_url;
                                                    } else {
                                                        $share_link = $link . '/' . $create_path;

                                                        $share_links['facebook'] =  $share_link . 'facebook';
                                                        $share_links['linkedin'] =   $share_link . 'linkedin';
                                                        $share_links['twitter'] =  $share_link . 'twitter';
                                                    }

                                                    return $share_links;
                                                }
                                                $share_certificate_links = getShareCertificateLinks($database, $user_rowid, $docid, $cGroup);
                                                //print_r($share_certificate_links);die();
                                                ?>


                                                <a href="javascript:void(0)" onclick="openShareCertificateModel('<?php echo $download_status ?>','<?php echo $share_certificate_links['facebook'] ?>','<?php echo $share_certificate_links['linkedin'] ?>','<?php echo $share_certificate_links['twitter'] ?>')">
                                                    <u>Share Certificate</u>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <!------------------Show Certificate------------>


                                    <tr>
                                        <td class="col-xs-3 text-left"><span class="">L2Pro Survey Questionnaire</span>
                                        </td>
                                        <td class="col-xs-2 text-center">&nbsp;</td>
                                        <td class="col-xs-3 text-center">&nbsp;</td>
                                        <td class="col-xs-3 text-center">&nbsp;</td>
                                        <td class="col-xs-2 text-center">
                                            <?php
                                            if (ucfirst($userCourseStatus != 'Not Attempted')) {
                                            ?>
                                                <a class="pull-right btn btn-lg btn-default bdrRadius20 marginLeft5" onFocus='this.blur()' onMouseOver='return showStatus();' title='Take survey' href="javascript:launch_survey(<?= $user_rowid
                                                                                                                                                                                                                                    ?>)"><u>Take
                                                        Survey</u></a>
                                            <?php
                                            }
                                            ?>

                                        </td>
                                    </tr>




                                </table>

                            </div>
                            <div class="panel-footer">
                                <div class="row-centered">
                                    <div class="col-sm-12 col-xs-12 col-centered">

                                        <div class="text-center">
                                            <table width="100%" cellspacing="0" cellpadding="3">

                                                <tr>
                                                    <td align='center' class='contentBold'>

                                                        <?
                                                        if ($currpage != 0) {
                                                        ?>
                                                            <a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=0&cCategory=<?= $cCategory
                                                                                                                                                                ?>&cContent=<?= $cContent
            ?>&cCode=<?= $cCode
            ?>&cTitle=<?= $cTitle
            ?>&cDesc=<?= $cDesc
            ?>&cKey=<?= $cKey
        ?>" title="First page">First page</a>
                                                        <?
                                                        }
                                                        ?>

                                                        <?
                                                        if ($currpage != 0) {
                                                        ?>

                                                            &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $currpage - 1 ?>&cCategory=<?= $cCategory ?>&cContent=<?= $cContent ?>&cCode=<?= $cCode ?>&cTitle=<?= $cTitle ?>&cDesc=<?= $cDesc ?>&cKey=<?= $cKey ?>" title="Previous page">Previous page</a>

                                                        <?
                                                        }
                                                        ?>

                                                        <?
                                                        if ($totalPages > 1) {
                                                            $pagenum;
                                                            $temp = ceil(($currpage + 1) / 5);
                                                            $tempstart = 5 * ($temp - 1) + 1;
                                                            $tempend;

                                                            if ($tempstart + $pageSplit > $totalPages) {
                                                                $tempend = $totalPages;
                                                            } else {
                                                                $tempend = $tempstart + $pageSplit;
                                                            }

                                                            for ($j = $tempstart; $j <= $tempend; $j++) {
                                                                if ($j == $currpage + 1) {
                                                                    $pagenum = "<font color='#666666'>" . $j . "</font>";
                                                        ?>
                                                                    &nbsp;&nbsp;
                                                                    <? echo $pagenum
                                                                    ?>
                                                                <?
                                                                } else {
                                                                    $pagenum = $j;
                                                                ?>
                                                                    &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $j - 1 ?>&cCategory=<?= $cCategory ?>&cContent=<?= $cContent ?>&cCode=<?= $cCode ?>&cTitle=<?= $cTitle ?>&cDesc=<?= $cDesc ?>&cKey=<?= $cKey ?>" title=<?= $pagenum ?>>
                                                                        <? echo $pagenum
                                                                        ?>
                                                                    </a>
                                                                <?
                                                                }
                                                                ?>



                                                        <?
                                                            }
                                                        }
                                                        ?>


                                                        <?
                                                        if ($currpage + 1 < $totalPages) {
                                                        ?>

                                                            &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $currpage + 1 ?>&cCategory=<?= $cCategory ?>&cContent=<?= $cContent ?>&cCode=<?= $cCode ?>&cTitle=<?= $cTitle ?>&cDesc=<?= $cDesc ?>&cKey=<?= $cKey ?>" title="Next page">Next page</a>

                                                        <?
                                                        }
                                                        ?>

                                                        <?
                                                        if ($currpage + 1 < $totalPages) {
                                                        ?>

                                                            &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $totalPages - 1 ?>&cCategory=<?= $cCategory ?>&cContent=<?= $cContent ?>&cCode=<?= $cCode ?>&cTitle=<?= $cTitle ?>&cDesc=<?= $cDesc ?>&cKey=<?= $cKey ?>" title="Last page">Last page</a>
                                                        <?
                                                        }
                                                        ?>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div id="intermediate" class="tab-pane">
                            <!--Responsive grid table -->
                            <div class="table-responsive promo courseGroup">
                                <?
                                if (!$num) {
                                ?>
                                    <div class="noRecordeTable">
                                        <?
                                        if ($searchmsg == '1') {
                                            echo "No results found! Click the Back link to search again.";
                                        } else {
                                            echo "Courses not available!";
                                        }
                                        ?>
                                    </div>

                                <?
                                    exit();
                                }
                                ?>

                                <table class="table m-b-none dataTable">
                                    <thead>
                                        <tr>

                                            <th class="col-xs-3 text-left">Course Title</th>
                                            <th class="col-xs-2 text-center">Status</th>
                                            <th class="col-xs-3 text-center">Time Spent</th>
                                            <th class="col-xs-3 text-center">Score</th>
                                            <th class="col-xs-2 text-center">Launch</th>
                                    </thead>

                                    <?
                                    $i = 0;
                                    while ($i < $num) {

                                        $row = mysql_fetch_assoc($resultList);
                                        $id = $row['id'];
                                        $docid = mysql_result($resultList, $i, "A.id");

                                        $fileTitle = mysql_result($resultList, $i, "name");
                                        //$versioninfo=mysql_result($resultList,$i,"version_info");
                                        $fileDescription = mysql_result($resultList, $i, "summary");
                                        $sWidth = mysql_result($resultList, $i, "width");
                                        $sHeight = mysql_result($resultList, $i, "height");
                                        $userCourseStatus = getUserCourseStatus($user_rowid, $docid);
                                        $userCourseTime = getUserCourseTime($user_rowid, $docid);
                                        $userCourseTime = substr($userCourseTime, 0, 8);
                                        $userCourseScore = getUserCourseScore($user_rowid, $docid);
                                        $userCourseCompletionDate = getUserCompletionDate($user_rowid, $docid);
                                        if ($userCourseCompletionDate == "-") {
                                            $userCourseCompletionDateFormatted = "-";
                                        } else {
                                            $userCourseCompletionDateFormatted = parseDate($userCourseCompletionDate);
                                        }

                                        if ($i % 2 == 0) $bgc = "row1";
                                        else $bgc = "row2";
                                        //mysql_close();

                                    ?>
                                        <tr>



                                            <td class="col-xs-3 text-left">
                                                <!--    <a class="listitems" onFocus='this.blur()' onMouseOver='return showStatus();' href='course_details.php?cid=<?= $docid
                                                                                                                                                                    ?>&curPage=<?= $currpage
            ?>&cCategory=<?= $cCategory
                ?>&cContent=<?= $cContent
            ?>&cCode=<?= $cCode
            ?>&cTitle=<?= $cTitle
            ?>&cDesc=<?= $cDesc
            ?>&cKey=<?= $cKey
        ?>' title="<? echo ucfirst($fileTitle); ?>"><? echo ucfirst(TrimString($fileTitle)); ?></a>-->
                                                <a class="listitems" href="javascript:launch_content(<?= $docid ?>,<?= $docid ?>,<?= $sWidth ?>,<?= $sHeight ?>);">
                                                    <? echo ucfirst(TrimString($fileTitle)); ?>
                                                </a>


                                            </td>

                                            <td class="col-xs-2 text-center"><?= ucfirst($userCourseStatus) ?></td>
                                            <td class="col-xs-3 text-center"><?= $userCourseTime ?></td>
                                            <td class="col-xs-3 text-center"><?= $userCourseScore ?></td>
                                            <td class="col-xs-2 text-center">
                                                <a onFocus='this.blur()' onMouseOver='return showStatus();' title='Launch course' href="javascript:launch_content(<?= $docid ?>,<?= $docid ?>,<?= $sWidth ?>,<?= $sHeight ?>);"><img src='../../images/start-icon.png' border='0' width='20px' /></a>
                                            </td>

                                            <!--<td align="center" class="Content"><?= $userCourseCompletionDateFormatted ?></td>
							<td align="center" class="Content"><?= $userCourseScore ?></td>-->

                                        </tr>

                                    <?
                                        $i++;
                                    }

                                    ?>



                                    <tr>
                                        <td class="col-xs-3 text-left">L2Pro Survey Questionnaire</td>
                                        <td class="col-xs-2 text-center">&nbsp;</td>
                                        <td class="col-xs-3 text-center">&nbsp;</td>
                                        <td class="col-xs-3 text-center">&nbsp;</td>
                                        <td class="col-xs-2 text-center">
                                            <?php
                                            if (ucfirst($userCourseStatus != 'Not Attempted')) {
                                            ?>
                                                <a onFocus='this.blur()' onMouseOver='return showStatus();' title='Take survey' href="javascript:launch_survey(<?= $user_rowid
                                                                                                                                                                ?>)"><u>Take
                                                        Survey</u></a>
                                            <?php
                                            }
                                            ?>

                                        </td>
                                    </tr>


                                </table>

                            </div>


                            <div class="panel-footer">
                                <div class="row-centered">
                                    <div class="col-sm-12 col-xs-12 col-centered">

                                        <div class="text-center">
                                            <table width="100%" cellspacing="0" cellpadding="3">

                                                <tr>
                                                    <td align='center' class='contentBold'>

                                                        <?
                                                        if ($currpage != 0) {
                                                        ?>
                                                            <a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=0&cCategory=<?= $cCategory
                                                                                                                                                                ?>&cContent=<?= $cContent
            ?>&cCode=<?= $cCode
            ?>&cTitle=<?= $cTitle
            ?>&cDesc=<?= $cDesc
            ?>&cKey=<?= $cKey
        ?>" title="First page">First page</a>
                                                        <?
                                                        }
                                                        ?>

                                                        <?
                                                        if ($currpage != 0) {
                                                        ?>

                                                            &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $currpage - 1 ?>&cCategory=<?= $cCategory ?>&cContent=<?= $cContent ?>&cCode=<?= $cCode ?>&cTitle=<?= $cTitle ?>&cDesc=<?= $cDesc ?>&cKey=<?= $cKey ?>" title="Previous page">Previous page</a>

                                                        <?
                                                        }
                                                        ?>

                                                        <?
                                                        if ($totalPages > 1) {
                                                            $pagenum;
                                                            $temp = ceil(($currpage + 1) / 5);
                                                            $tempstart = 5 * ($temp - 1) + 1;
                                                            $tempend;

                                                            if ($tempstart + $pageSplit > $totalPages) {
                                                                $tempend = $totalPages;
                                                            } else {
                                                                $tempend = $tempstart + $pageSplit;
                                                            }

                                                            for ($j = $tempstart; $j <= $tempend; $j++) {
                                                                if ($j == $currpage + 1) {
                                                                    $pagenum = "<font color='#666666'>" . $j . "</font>";
                                                        ?>
                                                                    &nbsp;&nbsp;
                                                                    <? echo $pagenum
                                                                    ?>
                                                                <?
                                                                } else {
                                                                    $pagenum = $j;
                                                                ?>
                                                                    &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $j - 1 ?>&cCategory=<?= $cCategory ?>&cContent=<?= $cContent ?>&cCode=<?= $cCode ?>&cTitle=<?= $cTitle ?>&cDesc=<?= $cDesc ?>&cKey=<?= $cKey ?>" title=<?= $pagenum ?>>
                                                                        <? echo $pagenum
                                                                        ?>
                                                                    </a>
                                                                <?
                                                                }
                                                                ?>



                                                        <?
                                                            }
                                                        }
                                                        ?>


                                                        <?
                                                        if ($currpage + 1 < $totalPages) {
                                                        ?>

                                                            &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $currpage + 1 ?>&cCategory=<?= $cCategory ?>&cContent=<?= $cContent ?>&cCode=<?= $cCode ?>&cTitle=<?= $cTitle ?>&cDesc=<?= $cDesc ?>&cKey=<?= $cKey ?>" title="Next page">Next page</a>

                                                        <?
                                                        }
                                                        ?>

                                                        <?
                                                        if ($currpage + 1 < $totalPages) {
                                                        ?>

                                                            &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $totalPages - 1 ?>&cCategory=<?= $cCategory ?>&cContent=<?= $cContent ?>&cCode=<?= $cCode ?>&cTitle=<?= $cTitle ?>&cDesc=<?= $cDesc ?>&cKey=<?= $cKey ?>" title="Last page">Last page</a>
                                                        <?
                                                        }
                                                        ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="advanced" class="tab-pane fade">
                            <!--Responsive grid table -->
                            <div class="table-responsive promo courseGroup">
                                <?
                                if (!$num) {
                                ?>
                                    <div class="noRecordeTable">
                                        <?
                                        if ($searchmsg == '1') {
                                            echo "No results found! Click the Back link to search again.";
                                        } else {
                                            echo "Courses not available!";
                                        }
                                        ?>
                                    </div>

                                <?
                                    exit();
                                }
                                ?>

                                <table class="table m-b-none dataTable">
                                    <thead>
                                        <tr>

                                            <th class="col-xs-3 text-left">Course Title</th>
                                            <th class="col-xs-2 text-center">Status</th>
                                            <th class="col-xs-3 text-center">Time Spent</th>
                                            <th class="col-xs-3 text-center">Score</th>
                                            <th class="col-xs-2 text-center">Launch</th>
                                    </thead>

                                    <?
                                    $i = 0;
                                    while ($i < $num) {

                                        $row = mysql_fetch_assoc($resultList);
                                        $id = $row['id'];
                                        $docid = mysql_result($resultList, $i, "A.id");

                                        $fileTitle = mysql_result($resultList, $i, "name");
                                        //$versioninfo=mysql_result($resultList,$i,"version_info");
                                        $fileDescription = mysql_result($resultList, $i, "summary");
                                        $sWidth = mysql_result($resultList, $i, "width");
                                        $sHeight = mysql_result($resultList, $i, "height");
                                        $userCourseStatus = getUserCourseStatus($user_rowid, $docid);
                                        $userCourseTime = getUserCourseTime($user_rowid, $docid);
                                        $userCourseTime = substr($userCourseTime, 0, 8);
                                        $userCourseScore = getUserCourseScore($user_rowid, $docid);
                                        $userCourseCompletionDate = getUserCompletionDate($user_rowid, $docid);
                                        if ($userCourseCompletionDate == "-") {
                                            $userCourseCompletionDateFormatted = "-";
                                        } else {
                                            $userCourseCompletionDateFormatted = parseDate($userCourseCompletionDate);
                                        }

                                        if ($i % 2 == 0) $bgc = "row1";
                                        else $bgc = "row2";
                                        //mysql_close();

                                    ?>
                                        <tr>



                                            <td class="col-xs-3 text-left">
                                                <!--    <a class="listitems" onFocus='this.blur()' onMouseOver='return showStatus();' href='course_details.php?cid=<?= $docid
                                                                                                                                                                    ?>&curPage=<?= $currpage
            ?>&cCategory=<?= $cCategory
                ?>&cContent=<?= $cContent
            ?>&cCode=<?= $cCode
            ?>&cTitle=<?= $cTitle
            ?>&cDesc=<?= $cDesc
            ?>&cKey=<?= $cKey
        ?>' title="<? echo ucfirst($fileTitle); ?>"><? echo ucfirst(TrimString($fileTitle)); ?></a>-->
                                                <a class="listitems" href="javascript:launch_content(<?= $docid ?>,<?= $docid ?>,<?= $sWidth ?>,<?= $sHeight ?>);">
                                                    <? echo ucfirst(TrimString($fileTitle)); ?>
                                                </a>


                                            </td>

                                            <td class="col-xs-2 text-center"><?= ucfirst($userCourseStatus) ?></td>
                                            <td class="col-xs-3 text-center"><?= $userCourseTime ?></td>
                                            <td class="col-xs-3 text-center"><?= $userCourseScore ?></td>
                                            <td class="col-xs-2 text-center">
                                                <a onFocus='this.blur()' onMouseOver='return showStatus();' title='Launch course' href="javascript:launch_content(<?= $docid ?>,<?= $docid ?>,<?= $sWidth ?>,<?= $sHeight ?>);"><img src='../../images/start-icon.png' border='0' width='20px' /></a>
                                            </td>

                                            <!--<td align="center" class="Content"><?= $userCourseCompletionDateFormatted ?></td>
							<td align="center" class="Content"><?= $userCourseScore ?></td>-->

                                        </tr>

                                    <?
                                        $i++;
                                    }

                                    ?>



                                    <tr>
                                        <td class="col-xs-3 text-left">L2Pro Survey Questionnaire</td>
                                        <td class="col-xs-2 text-center">&nbsp;</td>
                                        <td class="col-xs-3 text-center">&nbsp;</td>
                                        <td class="col-xs-3 text-center">&nbsp;</td>
                                        <td class="col-xs-2 text-center">
                                            <?php
                                            if (ucfirst($userCourseStatus != 'Not Attempted')) {
                                            ?>
                                                <a onFocus='this.blur()' onMouseOver='return showStatus();' title='Launch survey' href="javascript:launch_survey(<?= $user_rowid
                                                                                                                                                                    ?>)"><u>Take
                                                        Survey</u></a>
                                            <?php
                                            }
                                            ?>

                                        </td>
                                    </tr>


                                </table>

                            </div>


                            <div class="panel-footer">
                                <div class="row-centered">
                                    <div class="col-sm-12 col-xs-12 col-centered">

                                        <div class="text-center">
                                            <table width="100%" cellspacing="0" cellpadding="3">

                                                <tr>
                                                    <td align='center' class='contentBold'>

                                                        <?
                                                        if ($currpage != 0) {
                                                        ?>
                                                            <a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=0&cCategory=<?= $cCategory
                                                                                                                                                                ?>&cContent=<?= $cContent
            ?>&cCode=<?= $cCode
            ?>&cTitle=<?= $cTitle
            ?>&cDesc=<?= $cDesc
            ?>&cKey=<?= $cKey
        ?>" title="First page">First page</a>
                                                        <?
                                                        }
                                                        ?>

                                                        <?
                                                        if ($currpage != 0) {
                                                        ?>

                                                            &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $currpage - 1 ?>&cCategory=<?= $cCategory ?>&cContent=<?= $cContent ?>&cCode=<?= $cCode ?>&cTitle=<?= $cTitle ?>&cDesc=<?= $cDesc ?>&cKey=<?= $cKey ?>" title="Previous page">Previous page</a>

                                                        <?
                                                        }
                                                        ?>

                                                        <?
                                                        if ($totalPages > 1) {
                                                            $pagenum;
                                                            $temp = ceil(($currpage + 1) / 5);
                                                            $tempstart = 5 * ($temp - 1) + 1;
                                                            $tempend;

                                                            if ($tempstart + $pageSplit > $totalPages) {
                                                                $tempend = $totalPages;
                                                            } else {
                                                                $tempend = $tempstart + $pageSplit;
                                                            }

                                                            for ($j = $tempstart; $j <= $tempend; $j++) {
                                                                if ($j == $currpage + 1) {
                                                                    $pagenum = "<font color='#666666'>" . $j . "</font>";
                                                        ?>
                                                                    &nbsp;&nbsp;
                                                                    <? echo $pagenum
                                                                    ?>
                                                                <?
                                                                } else {
                                                                    $pagenum = $j;
                                                                ?>
                                                                    &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $j - 1 ?>&cCategory=<?= $cCategory ?>&cContent=<?= $cContent ?>&cCode=<?= $cCode ?>&cTitle=<?= $cTitle ?>&cDesc=<?= $cDesc ?>&cKey=<?= $cKey ?>" title=<?= $pagenum ?>>
                                                                        <? echo $pagenum
                                                                        ?>
                                                                    </a>
                                                                <?
                                                                }
                                                                ?>



                                                        <?
                                                            }
                                                        }
                                                        ?>


                                                        <?
                                                        if ($currpage + 1 < $totalPages) {
                                                        ?>

                                                            &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $currpage + 1 ?>&cCategory=<?= $cCategory ?>&cContent=<?= $cContent ?>&cCode=<?= $cCode ?>&cTitle=<?= $cTitle ?>&cDesc=<?= $cDesc ?>&cKey=<?= $cKey ?>" title="Next page">Next page</a>

                                                        <?
                                                        }
                                                        ?>

                                                        <?
                                                        if ($currpage + 1 < $totalPages) {
                                                        ?>

                                                            &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $totalPages - 1 ?>&cCategory=<?= $cCategory ?>&cContent=<?= $cContent ?>&cCode=<?= $cCode ?>&cTitle=<?= $cTitle ?>&cDesc=<?= $cDesc ?>&cKey=<?= $cKey ?>" title="Last page">Last page</a>
                                                        <?
                                                        }
                                                        ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
                </div>
                <!-- row end here -->
            </section>
        </section>
    </form>


    <?php
    include '../intface/footer.php';


    function getCertificateShareUrl($user_id)
    {
        return $user_id;
    }
    ?>