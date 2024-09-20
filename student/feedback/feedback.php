<?php include ('../intface/std_top.php'); 
//if(!$_SESSION['token'])
//{
//header("Location:../../index.php#item1");
//exit();
//}
$con=createConnection();
?>

<SCRIPT language="JavaScript" src="fvalidate.js"></SCRIPT>
<script>
//function to clear all the input fields (not used)
function clearFields()
{

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

	  <?php


$stmt = $con->prepare("SELECT id,name FROM tbl_feedback_category");
//$stmt->bind_param("ss",$userid,$opwd);
$stmt->execute();
$stmt->bind_result($id,$name);
$stmt->fetch();

?>
      <!-- Services Start -->
      <div class="container-fluid services py-5">
         <div class="container">
		 <form name="feedform"   action="submit_feedback.php" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data">
		 <div class=" pb-5 wow fadeIn" data-wow-delay=".3s" ">
               <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  pb-2 mb-3  border-bottom ">
                  <h1 class="text-primary">Feedback</h1>
                  <div>        <a href="feedback_report.php" class="pull-right btn btn-primary  btn-sm ">My Feedback</a></div>
               </div>
               <div class="row">
                  <div class="col-sm-6 col-xs-12  mt-4">
                     <label class="pb-3"> Feedback Category <span class="mandatory">*</span> </label>
                     <select id="feedbackCat" name="feedbackCat" class="form-select input-lg form-control" data-required="true">
					<option value="">Select</option> 
					<?
					$i=0;
					while($stmt->fetch()){

					$catid=$id;
					$catname=$name;
					if($catid==$company_id)
					{
					$selStr1="selected";
					}
					else
					{
					$selStr1="";
					}
					?>
						<OPTION value="<?php echo $catid; ?>" <?=$selStr1?>><? echo $catname; ?></OPTION>
					<?
					}	
					$stmt->close();	
					?>   
				</select>
				<label class="required" id="lblFeedbackCat"></label>
                  </div>
                  <div class="col-sm-6 col-xs-12  mt-4">
                     <label class="pb-3"> Subject <span class="mandatory">*</span> </label>
                     <input class='form-control input-lg' name="subject" type="text" id="subject" size="40" maxlength="250" data-required="true" data-maxlength="[250]" autocomplete="off"> 
					<label class="instructionlabel">(Maximum 250 characters)</label>
				<label class="required" id="userIdError"></label>
                  </div>
                  <div class="col-sm-12 col-xs-12  mt-4">
                     <label class="pb-3"> Description <span class="mandatory">*</span> <small>(Maximum 1000 characters)</small></label>
                     <TEXTAREA onKeyDown="textCounter(this.form.description,this.form.remLen,1000);" onKeyUp="textCounter(this.form.description,this.form.remLen,1000);" NAME="description" class='form-control input-lg textarea' id="description" COLS=42 ROWS=6 maxlength="1000" style="height:100px" data-required="true"  data-maxlength="[1000]"></TEXTAREA>
						<label class="instructionlabel"></label>
			  <label class="required" id="userIdError"></label>
			<input readonly style='visibility:hidden;border:0px' type=text name='remLen' size=2 maxlength=4 value="1000">

                  </div>
                  <div class="text-end mt-4">   <input type='reset' class='btn btn-primary'  id='reset' title='Clear all fields to enter fresh information' value='&nbsp;&nbsp;Reset&nbsp;&nbsp;'/>
				  <button class=" btn btn-primary ">Save</button></div>
               </div>
            </div>
         </div>
        </form>
      </div>
      <!-- Services End -->
       <?php include('../intface/std_footer.php');  ?>
   </body>
</html>