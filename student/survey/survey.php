<?php include ('../intface/survey_top.php'); 

      $user_id = $_GET['user_id'];
?>

<SCRIPT language="JavaScript" src="fvalidate.js"></SCRIPT>

<!-- mid section -->
		
<section class="panel panel-default  padder">

<section>
   <div class="panel-body nobot panelBg" style="margin-top:20px">
                <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                    <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>L2Pro - Survey Questionnaire </strong></span> </div>
                </div>  
				</div>

</section>
 <section class="">

			<form name="surveyform"   action="submit_survey.php?user_id=<?php echo $user_id;  ?>&action=close" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data">
			<section class="scrollable padder mTop">
            

  <div class="row-centered">
       
       <div class="col-sm-12 col-xs-12"> 
			<div class="divider"></div>    <div class="clear"></div>
			
			<!-- Feedback Form  -->
			
			<div class="col-sm-12 text-left">
				<p class="control-label"><b>Question 1: I was able to get a good introduction to Intellectual Property</b></p><br/>

				<input class='form-control1 ' name="1" value ="1"  type="radio"> Strongly Agree<br>
				<input class='form-control1 ' name="1" value ="2"  type="radio"> Agree<br>
				<input class='form-control1 ' name="1" value ="3"  type="radio"> Undecided/ Neutral<br>
				<input class='form-control1 ' name="1" value ="4"  type="radio"> Disagree<br>
				<input class='form-control1 ' name="1" value ="5"  type="radio"> Strongly Disagree<br>
                
            </div>
			<div class="divider"></div>    <div class="clear"></div>
			
				<div class="col-sm-12 text-left">
				<p class="control-label"><b>Question 2: Course language and instructions were very easy to understand</b></p><br/>

				<input class='form-control1 ' name="2" value ="1"  type="radio"> Strongly Agree<br>
				<input class='form-control1 ' name="2" value ="2"  type="radio"> Agree<br>
				<input class='form-control1 ' name="2" value ="3"  type="radio"> Undecided/ Neutral<br>
				<input class='form-control1 ' name="2" value ="4"  type="radio"> Disagree<br>
				<input class='form-control1 ' name="2" value ="5"  type="radio"> Strongly Disagree<br>
                
            </div>
			<div class="divider"></div>    <div class="clear"></div>
			
			
			<div class="col-sm-12 text-left">
				<p class="control-label"><b>Question 3: Course developed my ability to apply theory to practice</b></p><br/>

				<input class='form-control1 ' name="3" value ="1"  type="radio"> Strongly Agree<br>
				<input class='form-control1 ' name="3" value ="2"  type="radio"> Agree<br>
				<input class='form-control1 ' name="3" value ="3"  type="radio"> Undecided/ Neutral<br>
				<input class='form-control1 ' name="3" value ="4"  type="radio"> Disagree<br>
				<input class='form-control1 ' name="3" value ="5"  type="radio"> Strongly Disagree<br>
                
            </div>
			<div class="divider"></div>    <div class="clear"></div>
			
			
			<div class="col-sm-12 text-left">
				<p class="control-label"><b>Question 4: Course had sufficient examples to help me understand the concept.</b></p><br/>

				<input class='form-control1 ' name="4" value ="1"  type="radio"> Strongly Agree<br>
				<input class='form-control1 ' name="4" value ="2"  type="radio"> Agree<br>
				<input class='form-control1 ' name="4" value ="3"  type="radio"> Undecided/ Neutral<br>
				<input class='form-control1 ' name="4" value ="4"  type="radio"> Disagree<br>
				<input class='form-control1 ' name="4" value ="5"  type="radio"> Strongly Disagree<br>
                
            </div>
			<div class="divider"></div>    <div class="clear"></div>
			
			<div class="col-sm-12 text-left">
				<p class="control-label"><b>Question 5: Course was easy to navigate and find information</b></p><br/>

				<input class='form-control1 ' name="5" value ="1"  type="radio"> Strongly Agree<br>
				<input class='form-control1 ' name="5" value ="2"  type="radio"> Agree<br>
				<input class='form-control1 ' name="5" value ="3"  type="radio"> Undecided/ Neutral<br>
				<input class='form-control1 ' name="5" value ="4"  type="radio"> Disagree<br>
				<input class='form-control1 ' name="5" value ="5"  type="radio"> Strongly Disagree<br>
                
            </div>
			<div class="divider"></div>    <div class="clear"></div>
			
			<div class="col-sm-12 text-left">
				<p class="control-label"><b>Question 6: Course had good mix of media assets and presentation</b></p><br/>

				<input class='form-control1 ' name="6" value ="1"  type="radio"> Strongly Agree<br>
				<input class='form-control1 ' name="6" value ="2"  type="radio"> Agree<br>
				<input class='form-control1 ' name="6" value ="3"  type="radio"> Undecided/ Neutral<br>
				<input class='form-control1 ' name="6" value ="4"  type="radio"> Disagree<br>
				<input class='form-control1 ' name="6" value ="5"  type="radio"> Strongly Disagree<br>
                
            </div>
			<div class="divider"></div>    <div class="clear"></div>
			
			<div class="col-sm-12 text-left">
				<p class="control-label"><b>Question 7: Course assessments covered the content knowledge appropriately</b></p><br/>

				<input class='form-control1 ' name="7" value ="1"  type="radio"> Strongly Agree<br>
				<input class='form-control1 ' name="7" value ="2"  type="radio"> Agree<br>
				<input class='form-control1 ' name="7" value ="3"  type="radio"> Undecided/ Neutral<br>
				<input class='form-control1 ' name="7" value ="4"  type="radio"> Disagree<br>
				<input class='form-control1 ' name="7" value ="5"  type="radio"> Strongly Disagree<br>
                
            </div>
			<div class="divider"></div>    <div class="clear"></div>
			
			<!-- End Feedback Form  -->
			
			<div class="col-sm-12 col-xs-12 text-center">
			
			<button type="submit"  class=' btn btn-red'  id='submit' title='Submit/Survey'><i class="build fa fa fa-file-text-o"></i> Save</button>
          </div> <div class="divider"></div>    <div class="clear"></div>
	</div>
  </div>
        
		</section>	
    
  <!--End Midlle container -->

</form>	
			
<?php
include ('../intface/footer.php');
?>

