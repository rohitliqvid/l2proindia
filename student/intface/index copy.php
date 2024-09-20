<?php 

include ('std_top.php'); 

$isUpdaetd=isUserUpdated($userid);

?>

<?
/* session_start();
if (!isset($_SESSION['sess_fname'])) 
{
//if the session does not exit, then take the user to login page
header("Location: ../../");
exit();
}
include("../../connect.php"); //Connection to database 
include("../../global/functions.php"); 
$userid = $_SESSION['sess_uid'];
validateUser($userid,'0'); */
?>

<!-- main panel ends -->
	 <section class="scrollable">
		  <section class="panel panel-default padder contentTop">	 
		  <div class="col-lg-9 col-md-9 col-sm-9 show-mon">
            <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong> Welcome <? echo $fname ?> !</strong></span> </div>
          </div> <div class="col-lg-3 col-sm-3 col-md-3 tablegrid"> </div>
        </div>
  </section>
 <section class="panel panel-default panelgridBg padder">
<style>ul {
  list-style-type: upper-roman;
  list-style-position: inside;
  list-style-image: none;
  padding-left: 0px;
}</style>

<div class="col-md-12 col-sm-12 ">
<p><img src="../../images/l2pro_welcome.png" style="height:80px;max-width:100%;float: left;    
 margin: 0 20px 0 0;" alt="Welcome to the L2Pro India" />Welcome to the L2Pro India IP e-learning platform. The L2PRO (Learn to Protect,
Secure, and Maximize Your Innovations) IP e-learning platform has been designed
to educate Indian startups, Micro, Small, and Medium Enterprises (MSMEs), and
innovators on the fundamentals of Intellectual Property. Here we will Learn 2 Protect (L2Pro)</p>
<p>Qualcomm and the Centre for Innovation, Intellectual Property and Competition (CIIPC) at
National Law University Delhi (NLUD) have collaborated with the Cell for IPR Promotion and
Management (CIPAM) of the Department for Promotion of Industry and Internal Trade (DPIIT),
Ministry of Commerce and Industry, Government of India for this initiative.</p>
<p>The L2PRO IP e-learning Platform will increase intellectual property (IP) awareness and enable
innovators to access tools to help bring innovations quickly to market. The various e-learning
modules will aid in better understanding of the intellectual property (IP) domain, how to protect
innovations with patents, use copyrights to protect software, develop trademarks, integrate IP
considerations into company business models, and obtain value from research and
development (R&amp;D) efforts.</p>
<p>The L2PRO IP e-Learning Platform has 11 modules, which, based on the level of knowledge,
are distributed into three levels: basic, intermediate, and advanced.</p>
<ul>
	<h5><strong>Basic Level</strong></h5>
	<li>IP Fundamentals: General Introduction, Patents</li>
	<li> IP Fundamentals: Trademarks &amp; Geographical Indications</li>
	<li> IP Fundamentals: Copyrights &amp; Neighbouring Rights, Industrial Designs Protection</li>
	<li> IP Fundamentals: Unfair Competition, Trade Secrets, Plant Variety Protection</li>

	<h5><strong>Intermediate Level</strong></h5>
	<li> Securing your IP: Filing and acquisition of IP.</li>
	<li> Market Assessment: IP Searches and FTO</li>
	<li> IP Commercialization: Assignment and Licensing Arrangements</li>
	<li> Managing IP Portfolios: Territorial Considerations and Relevance of Restrictive Covenants</li>

	<h5><strong>Advance Level</strong></h5>
	<li> Access to Funding and Venture Capital and IP</li>
	<li> Introduction to Standards and Standard Setting Organizations (SSOs)</li>
	<li> Dealing with Disputes: Infringement, Validity and Defenses, arbitration</li>
</ul>

<p>Each module comprises four quadrants consisting of e-text for understanding concepts, short-
animated videos of the concepts, links to additional resources on the subject, and quizzes and
case studies for assessment and grading the learner’s knowledge and understanding of the
topic. Learners can access the platform through desktop or mobile apps (Android and IoS
platform). Joint e-certificates by DPIIT-CIPAM, NLUD, and Qualcomm after successfully
completing the e-learning modules at each level. The passing score is 60%.</p>

<p>The learning is going to be fun with interactive lessons, videos, brain teasers, self-assessment exercises,
and an array of practical information that will help you in protecting and making use of your IP. So let&#39;s get
started!</p>
<br><br>
<p>You are logged in as <?=$role?>.<br><br>To continue, click any of the links in the left panel.	
	  </p>
	<?
  if($isUpdaetd=='0')
  {
  ?><p>
		<b>Important Information:</b> You must update your details in <b>'My Profile'</b> section.
	  </p> <?
  }	  
  ?>
<br><br><br><br>
</section>
	 

 </section> 

