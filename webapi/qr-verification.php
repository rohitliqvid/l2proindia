<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>L2Pro India</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid" style="padding: 0;">
        <div class="row" style="background-color: #06169596; padding: 0px; margin: 0px">
           <!-- <div style="background-color: #fff;">
                <img src="https://l2proindia.com/assets/images/logonew.png" alt="" style="height:30px">
            </div>-->
            <span style="font-size: 3rem; font-weight: bold; color: #fff;">Confirmation</span>
        </div>
		<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../connect.php");
include("../global/functions.php");
$qr_code=$_REQUEST['uid'];

if(empty($qr_code))
{
	header("Location: https://l2proafrica.com");
	exit;
}

$con=createConnection();
$stmt = $con->prepare("SELECT user_id,sco_id,level_name,created_date FROM tbl_certificates WHERE qr_code=?");
$stmt->bind_param("s",$qr_code);
$stmt->execute();
$stmt->bind_result($user_id,$sco_id,$level_name,$created_date);
$stmt->fetch();
$stmt->close();	


if(empty($user_id))
{
	echo "<br><br>&nbsp;&nbsp;Invalid Certificate";
	exit;
}
else {

	$stmt = $con->prepare("SELECT firstname,lastname FROM tbl_users WHERE id=?");
	$stmt->bind_param("s",$user_id);
	$stmt->execute();
	$stmt->bind_result($firstname,$lastname);
	$stmt->fetch();
	$stmt->close();	

	////Get the course name
	$stmt = $con->prepare("SELECT name FROM tls_scorm WHERE id=?");
	$stmt->bind_param("i",$sco_id);
	$stmt->execute();
	$stmt->bind_result($coursename);
	$stmt->fetch();
	$stmt->close();	

	

	/*echo "Name: ".$firstname." ".$lastname."<br>";
	echo "Level: ".$level_name."<br>";
	echo "Course: ".$coursename."<br>";
	echo "Date: ". date_format(date_create($created_date), 'jS F Y')."<br>";
	exit;*/

}
closeConnection($con);


?>
        <div class="row" style="padding: 1rem 1rem 1rem 2rem; margin: 0;">
            <div class="row" style="border: 5px solid #06169596; border-radius: 20px;padding-top:30px;">
                <img src="https://l2proindia.com/assets/images/logonew.png" alt="" style="height:50px;width:306px;text-align:center;">
                <div style="margin-top : 5rem; margin-bottom : 4.5rem" class="personInfo">
                    <div style="display: flex; font-size: 2rem; font-weight: bold; margin-bottom: 0.5rem;">
                        <div><?php echo $firstname." ".$lastname;?> </div> 
                    </div>
                    <div style="display: flex; font-size: 1.5rem; margin-bottom: 0.5rem;">
                        <div><b> Level: </b><?php echo $level_name;?></div> 
                    </div>
                    <!--<div style="display: flex; font-size: 1.5rem; margin-bottom: 0.5rem;">
                        <div><b> Course: </b>IP Fundamentals: General Introduction, Patents</div> 
                    </div>
                    <div style="display: flex; font-size: 1.5rem; margin-bottom: 0.5rem;">
                        <div><b>Time Spent: </b> ? hours</div>
                    </div>-->
                </div>
                <div style="display: flex; font-size:1.5rem; margin-bottom: 0.5rem; font-weight: bold;">
                    <div>Date: <?php echo date_format(date_create($created_date), 'jS F Y');?></div>
                </div>
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
