<?php include ('../intface/std_top.php'); 

?>

<SCRIPT language="JavaScript" src="fvalidate.js"></SCRIPT>
<script>
//function to clear all the input fields (not used)
function clearFields()
{
////Commmented to retain the values when the user returns back to modify the details
//document.userInfo.fnm.value="";
//document.userInfo.lnm.value="";
//document.userInfo.uid.value="";
//document.userInfo.pwd.value="";
//document.userInfo.cpwd.value="";
}

</script>

<!-- mid section -->
		
 <!-- <section class="padder">

<section class="">
  <div class=""   style="height:60px;margin-top:20px;margin-bottom:10px">
	
		<div class="col-lg-12 col-sm-12 col-md-12 ">
		 
		</div>
  </div>
  
  
</section></section>-->
 <section class="">
<!--<section class="">
<img src="../../images/feedback.jpg" class="img-responsive" style="width:100%;height:260px">
</section>-->

    <!-- ####### Show table Grid -->
			
		<!--	<form name="feedform"  onSubmit="return ValidateInfo();" action="submit_feedback.php" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data"> -->
			<section class="scrollable padder mTop">
            <div class="rightContent newcourse">
              
              <div >
                <p>Your survey has been sent to the Administrator. Click the Back post survey again. Click any of the links in the left panel to continue.
                
                </p><div class="paddTop10 divider"></div>
              </div>

   <div class="col-lg-12 col-sm-12 col-md-12 "  style="margin-top:20px;">
                    <div class="row">
                      
                            <div class="pull-right text-right searchbg" style="padding-left:10px">
                                <div class="search inline"> <span class="text-right">    <a onfocus="this.blur()" onmouseover="return showStatus();" href="survey.php" target="_self" title="Go back">Back</a></span> </div>
                            </div>
                        
                    </div>
                </div>

</div>		
		
           </div>
			
      <!--end right  content bar -->
   
    

  <!--End Midlle container -->

<!-- </form> -->					
<?php
include ('../intface/footer.php');
?>

