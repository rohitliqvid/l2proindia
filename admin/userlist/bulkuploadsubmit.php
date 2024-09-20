<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
ini_set('max_execution_time', 2400000);    // Increase 'timeout' time 
include("../connect.php"); //Connection to database 
include("../../global/functions.php"); //Connection to database 
include("../../pages/helpers/phpMailer/mail.php"); //Connection to database 

$curdate=date('Y-m-d');
//echo "1";


if(isset($_FILES["userfile"]["name"]) && $_FILES["userfile"]["name"]!="")
				{
					$filesize=$_FILES["userfile"]["size"]/1024;
					$filetype=$_FILES["userfile"]["type"];
					//if($filetype=="application/vnd.ms-excel")
					//{
							$temp=explode(".",$_FILES["userfile"]["name"]);
							$ext=$temp[1];
							$filename="user-".time().".".$ext;
							
							$upload_file="../excel/".$filename;
							move_uploaded_file($_FILES["userfile"]["tmp_name"],$upload_file);
				}
						
     					//require_once '../excel/reader.php';
						// ExcelFile($filename, $encoding);
						//$data = new Spreadsheet_Excel_Reader();
						// Set output Encoding.
						//$data->setOutputEncoding('CP1251');
						require_once '../excel/excel_reader2.php';
						$data = new Spreadsheet_Excel_Reader();
						$data->setOutputEncoding('CP1251');
						$data->read('../excel/'.$filename);
						//echo "-->".$data->sheets[0]['numRows'];
						//$data = new Spreadsheet_Excel_Reader('../excel/'.$filename,true,"UTF-16");
						//exit;

							//echo "2";
						//error_reporting(E_ALL ^ E_NOTICE);

						$k=0;
						$num=0;
						$grid=array();
						$user_array=array();
						$user_emlarr=array();
						$isIncorrect=false;
						for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
							for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
								//echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
								$grid[$k]=$data->sheets[0]['cells'][$i][$j];
								$k++;
							}
			
						$statusMsg="";
						$errLine="Error: on row ".$i."<br>";

						$userId=trim($grid[0]);
						
						$password=trim($grid[1]);
						$firstName=trim($grid[2]);
						$lastName=trim($grid[3]);
						$email=trim($grid[0]);
                        $phone=trim($grid[4]);
						$client=trim($_POST['client_id']);
						
						
						
						
					//Check user details
					$statusMsg=empty($firstName)?$statusMsg.'First name required.<br>':$statusMsg;
					$statusMsg=empty($lastName)?$statusMsg.'Last name required.<br>':$statusMsg;
					$statusMsg=empty($email)?$statusMsg.'Email required.<br>':$statusMsg;
					$statusMsg=empty($password)?$statusMsg.'Password required.<br>':$statusMsg;
					
					if($phone!=""){
						if(preg_match('/^[0-9]{10}+$/', $phone)) {

						}else{
							$statusMsg=$statusMsg.'Phone number should be a valid phone.<br>';
						}
					}
					$containsLetter  = preg_match('/[a-zA-Z]/', $password);
					$containsDigit   = preg_match('/\d/',$password);
					$containsSpecial = preg_match('/[^a-zA-Z\d]/',$password);
					if(!$containsLetter || !$containsDigit || !$containsSpecial || strlen($password) < 6 || strlen($password) > 12) {
						$statusMsg=$statusMsg.'Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character.<br>';
					}						
					////check for firstname length
						if(trim(strlen($firstName))>50)
						{
						$statusMsg=$statusMsg."First name can not be more than 50 characters.<br>";
						}
						/////////////////////////
					
						////check for lastname length

						if(trim(strlen($lastName))>50)
						{
						$statusMsg=$statusMsg."Last name can not be more than 50 characters.<br>";
						}
						////check for email length
						if(trim(strlen($email))>250)
						{
						$statusMsg=$statusMsg."Email can not be more than 250 characters.<br>";
						}				
						
						
					
						////////////////////////////


						/* ////check for duplicate username
						$sql_select="select username from tbl_users where username='$userId'";
						$res_select=mysql_query($sql_select); 

						if(mysql_num_rows($res_select)!=0)
						{
						$statusMsg=$statusMsg."Duplicate Username.<br>";
						$isIncorrect=true;
						} */
						
						
						////check for duplicate username
						//$sql_select="select username from tbl_users where email='$email'";
						//$res_select=mysql_query($sql_select); 

						$query1 = "select username from tbl_users where email='$email'";
						$result1 = mysqli_query($con,$query1);
						$num2=mysqli_num_rows($result1);

						if($num2!=0)
						{
						$statusMsg=$statusMsg."Duplicate Email.<br>";
						$isIncorrect=true;
						}
						//////////////////////////////

						if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
							$statusMsg=$statusMsg."Email is not valid.<br>";
							$isIncorrect=true;
							}
						/////////////////////////////

						if($client=="")
						{			
						////check for username length
						$statusMsg=$statusMsg."Client can not be blank.<br>";
						$isIncorrect=true;
						}
						
						if($statusMsg!=""){
							$isIncorrect=true;
						}	

						//Check email duplicate in array
						
						if(in_array($email,$user_emlarr))
						  {
							  ////check for username length
							$statusMsg=$statusMsg."Duplicate email found in excel.<br>";
							$isIncorrect=true;
						  }
						array_push($user_emlarr,$email);

						if($isIncorrect==true)
						{
							
							//$insertempsql="INSERT INTO tbl_users_bulkstatus (userid, status, flag) VALUES ('$userId','$statusMsg','1')";
							//mysql_query($insertempsql);
							$insb_query = "INSERT INTO tbl_users_bulkstatus (userid, status, flag) VALUES ('$userId','$statusMsg','1')";
							$stmt = $con->prepare($insb_query);
							$stmt->execute();
							$stmt->close();
							
						
						}
						else
						{
					
						
						$bcm = new stdClass();
						$bcm->firstName = $firstName;
						$bcm->lastName = $lastName;
						$bcm->email = $email;
						$bcm->phone = $phone;
						$bcm->password = $password;
						array_push($user_array,$bcm);
						
					}
						
							$k=0;
					}
						
						
					


					
						
					if($isIncorrect==false){
						if(count($user_array>0)){	
							
						foreach($user_array as $key=>$val){	
							
						$firstName = $val->firstName;
						$lastName = $val->lastName;
						$email = $val->email;
						$phone = $val->phone;
						$password = $val->password;
						
						
						$setPass=md5($password);
						$key=md5($email);
						
							
						//$insersql="INSERT INTO tbl_users (firstname, lastname, username, password, userregistered, usertype, dtenrolled, email, mobile, country, city, business_type, client,hash_key) VALUES ('$firstName','$lastName','$userId','$setPass','1','0','$curdate','$email','$phone',100,1,'1','$client','$key')";
					
					   // mysql_query($insersql);
						//$lastId=mysql_insert_id();

						$ins_query = "INSERT INTO tbl_users (firstname, lastname, username, password, userregistered, usertype, dtenrolled, email, mobile, country, city, business_type, client,hash_key) VALUES ('$firstName','$lastName','$email','$setPass','1','0','$curdate','$email','$phone',100,1,'1','$client','$key')";
						$stmt = $con->prepare($ins_query);
						$stmt->execute();
						$stmt->close();
						$lastId = $con->insert_id;
						
						if($lastId!=""){
							
							//Send activation mail
							if(isset($_SERVER['HTTPS'])) {
								$http='https://';
							}
							else{ $http='http://';}
							$activationlink=$http.$_SERVER['HTTP_HOST'].'/activation.php?key='.$key;

							
						$firstName=ucfirst($firstName);	
						$subject = "L2Pro India: Verification mail to complete registration";
						$message = "Hi $firstName <br><br>Thank you for showing interest in L2Pro India Program. This is an initiative to spread awareness on how to protect Intellectual Property Right!<br><br>Please confirm that $email is your email address by clicking on the below link.<br><br><a href=".$activationlink." > Click here to verify Email </a><br><br>If you have not registered, please ignore the email.<br><br>L2Pro India Team.";
						$mailStatus = sendMailer($email, $subject, $message);

	
						}
						
						//mysql_query("INSERT INTO tbl_company_user (company_id, user_id) VALUES (1,$lastId)");

						$com_query = "INSERT INTO tbl_company_user (company_id, user_id) VALUES (1,$lastId)";
						$stmt = $con->prepare($com_query);
						$stmt->execute();
						$stmt->close();

						$todayDate = date("Y-m-d");
						$expiryDate = date('Y-m-d', strtotime(date("Y-m-d") . ' + 365 days'));
						$date = date_create();
						$company_id=1;
						
						
						
												
						//Assign course to user 21-5-2019
						//$resultList = mysql_query ("SELECT * FROM tls_scorm where coursetype='WBT' order by id asc"); 
						//$num=mysql_numrows($resultList);
						$query5 = "SELECT course,name FROM tls_scorm where coursetype='WBT' order by id asc";
						$resultList = mysqli_query($con,$query5);
						$num=mysqli_num_rows($resultList);
						$i=0;
						$userCourseId=$email;
						$arrCourseNames=array();
						while($i<$num) {
							$row = mysqli_fetch_assoc($resultList);
							$course_id=$row['course'];
							$crsName=$row['name'];

							//if not assigned, assign the course to user in b2client
							$query6 = "select bundle from tbl_b2client_bundle where bundle_desc='$course_id'";
							$bundleCourse = mysqli_query($con,$query6);
							$num2=mysqli_num_rows($bundleCourse);
							$row2 = mysqli_fetch_assoc($bundleCourse);
							$bundle_id = $row2['bundle'];

							$curdate = date('Y-m-d');
							$password="password";
							$todayDate = date("Y-m-d");
							$expiryDate = date('Y-m-d', strtotime(date("Y-m-d") . ' + 90 days'));
							$date = date_create();
							$client_id=$client;
							$company_id=1;
							$launch_token = md5($client_id . "-" . $userCourseId . "-" . $bundle_id . "-" . $curdate);
							$token = md5($client_id . "-" . $userCourseId . "-" . $course_id . "-" . $curdate);

							//$assignCourse=mysql_query("INSERT INTO tbl_b2client (client_id, username, password, token, launch_token, order_id , bundle_id ,  course_id, registration_date, expiry_date , status ) VALUES ('$client_id','$userCourseId','$password','$token','$launch_token','SignUp' , '$bundle_id','$course_id','$todayDate','$expiryDate' , '0')");
							
							$query7 = "INSERT INTO tbl_b2client (client_id, username, password, token, launch_token, order_id , bundle_id ,  course_id, registration_date, expiry_date , status ) VALUES ('$client_id','$userCourseId','$password','$token','$launch_token','SignUp' , '$bundle_id','$course_id','$todayDate','$expiryDate' , '0')";
							$stmt = $con->prepare($query7);
							$stmt->execute();
							$stmt->close();
							array_push($arrCourseNames,$crsName);
							$i++; 
						}
												
						$statusMsg="Registration Successful!";
						
						$query7 = "INSERT INTO tbl_users_bulkstatus (userid, status, flag) VALUES ('$userId','$statusMsg','0')";
							$stmt = $con->prepare($query7);
							$stmt->execute();
							$stmt->close();

						//$insertempsql="INSERT INTO tbl_users_bulkstatus (userid, status, flag) VALUES ('$userId','$statusMsg','0')";
						//mysql_query($insertempsql);
					
					
					}
					  	$_SESSION['msg']="Records saved successfully.";
						$_SESSION['danger']="No";
						unlink($upload_file);
						header("Location: bulkupload.php");
						exit; 
					}
				
					else{
							$_SESSION['danger']="Yes";
							$_SESSION['msg']='No record inserted.';
							unlink($upload_file);
							header("Location: bulkupload.php");
							exit;
							
						}
					}
					else{
						$_SESSION['danger']="Yes";
						echo $_SESSION['msg']=$errLine.' '.$statusMsg;
						unlink($upload_file);
						header("Location: bulkupload.php");
						exit;
						
					}
						
						
						
						
						
						
						
						
						
						
					
?>

