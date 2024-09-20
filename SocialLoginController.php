<?php

include ("./connect.php");
$con=createConnection();
function loginAndRegister($data)
{   
	global $con;
    $social_login_type = $data['social_login_type'];
    $social_login_id = $data['id'];
    $social_input_field = 'google_id';
    if ( $social_login_type == 'facebook') {
        $social_input_field = 'facebook_id';
    }
    if ( $social_login_type == 'linkedin') {
        $social_input_field = 'linkedin_id';
    }
    if ( $social_login_type == 'twitter') {
        $social_input_field = 'twitter_id';
    }
    if(empty($data['email'])){

        //$social_exist_user =  mysql_query("SELECT * FROM tbl_users where social_login_type='$social_login_type' AND $social_input_field ='$social_login_id'");

		$query2 = "SELECT * FROM tbl_users where social_login_type='$social_login_type' AND $social_input_field ='$social_login_id'";
		$social_exist_user = mysqli_query($con,$query2);
		$num=mysqli_num_rows($social_exist_user);

        if ($num > 0) {
            $social_exist_user_data =  mysqli_fetch_assoc($social_exist_user);
            setSessionAndRedirectDashbord($social_exist_user_data);
         
            die();
           
        }else{
            $_SESSION['social_login_data'] = $data;
            $_SESSION['REGISTRATION']['ERR']['MSG'] = 'Login email Not  Found';
	        header('Location:index.php#item2');
	        die;
        }
    
    }

    $firstname = isset($data['firstname'])  ? $data['firstname'] :'';
    $lastname = isset($data['lastname'])  ? $data['lastname'] :'';
    $email = isset($data['email'])  ? $data['email'] :'';
    $password =  md5($email);
    $sex = isset($data['gender'])  ? $data['gender'] :'';
    $sex = !empty($sex) ? "'$sex'" : "NULL";
	$dtenrolled = date('Y-m-d');

        $query4 = "SELECT * FROM tbl_users where email='$email'";
		$exist_user = mysqli_query($con,$query4);
		$num4=mysqli_num_rows($exist_user);
	//$exist_user =  mysql_query("SELECT * FROM tbl_users where email='$email'");
    if ($num4 > 0) {
        $exist_user_data =    mysqli_fetch_assoc($exist_user);
        $user_id = $exist_user_data['id'];
        if ($exist_user_data['is_social_login'] == 1) {
            if ($exist_user_data['social_login_type'] = $social_login_type) {
                setSessionAndRedirectDashbord($exist_user_data);
            }else{
                //mysql_query("UPDATE tbl_users SET social_login_type='$social_login_type', $social_input_field='$social_login_id' WHERE id='$user_id'");
				$query1 = "UPDATE tbl_users SET social_login_type='$social_login_type', $social_input_field='$social_login_id' WHERE id=?";
				$stmt = $con->prepare($query1);
				$stmt->bind_param("s", $user_id);
				$stmt->execute();
				$stmt->close();

                
				
				setSessionAndRedirectDashbord($exist_user_data);
            }
        }else{
            //mysql_query("UPDATE tbl_users SET social_login_type='$social_login_type', $social_input_field='$social_login_id',is_social_login=1 WHERE id='$user_id'");
				$query1 = "UPDATE tbl_users SET social_login_type='$social_login_type', $social_input_field='$social_login_id',is_social_login=1 WHERE id=?";
				$stmt = $con->prepare($query1);
				$stmt->bind_param("s", $user_id);
				$stmt->execute();
				$stmt->close();
            setSessionAndRedirectDashbord($exist_user_data);
          	
        }
    }else{
      
     
$dtenrolled = date('Y-m-d');
    //$reguster_query = mysql_query("INSERT INTO tbl_users (firstname,lastname,username,password,userregistered,usertype,email,sex,mobile,education,learn_from,profession,allow_email_for_marketing,allow_email_for_campaign,social_login_type,$social_input_field) VALUES ('$firstname','$lastname','$email','$password','1','1','$email',$sex,NULL,NULL,NULL,NULL,'false','false','$social_login_type','$social_login_id')");
    
	$query2 = "INSERT INTO tbl_users (firstname,lastname,username,password,userregistered,usertype,dtenrolled,email,sex,mobile,education,learn_from,profession,allow_email_for_marketing,allow_email_for_campaign,social_login_type,$social_input_field) VALUES ('$firstname','$lastname','$email','$password','1','0','$dtenrolled','$email',$sex,NULL,NULL,NULL,NULL,'false','false','$social_login_type','$social_login_id')";
	$stmt = $con->prepare($query2);
	//$stmt->bind_param("s", $user_id);
	$stmt->execute();
	$stmt->close();
	$lastId = $con->insert_id;
	
	if ($lastId) {
            //$lastId = mysql_insert_id();


           // $get_user_data_query="select * from tbl_users where  id='$lastId' ";
            //$get_user_data_query_result = mysql_db_query('l2pro_stg', $get_user_data_query) or die("Failed Query of " . $get_user_data_query); 
	       // $user_query_response =    mysql_fetch_assoc($get_user_data_query_result);

		    $get_user_data_query = "select * from tbl_users where  id='$lastId' ";
			$get_user_data_query_result = mysqli_query($con,$get_user_data_query);
			$user_query_response =  mysqli_fetch_assoc($get_user_data_query_result);
		

            AssignUserCourses($user_query_response);
            setSessionAndRedirectDashbord($user_query_response);
        }else{
      
      		header("location: index.php");
        }
    }
}

function AssignUserCourses($user_query_response)
{       
    global $con;
	$lastId = $user_query_response['id'];
    //mysql_query("INSERT INTO tbl_company_user (company_id, user_id) VALUES (1,$lastId)");

	$query2 = "INSERT INTO tbl_company_user (company_id, user_id) VALUES (1,$lastId)";
	$stmt = $con->prepare($query2);
	$stmt->execute();
	$stmt->close();


    $user_id = $user_query_response['email'];

    $static_url = $_SERVER['SERVER_NAME'] . '/online/b2c/index.php';
    $final_url = '';
    $final_launch_url = '';
    //Assign course to user 21-5-2019
	////$resultList = mysql_query("SELECT * FROM tls_scorm where coursetype='WBT' order by id asc");
	////$num = mysql_numrows($resultList);
	$query5 = "SELECT course,name FROM tls_scorm where coursetype='WBT' order by id asc";
	$resultList = mysqli_query($con,$query5);
	$num=mysqli_num_rows($resultList);

    $i = 0;
	$userCourseId = $user_id;
	$arrCourseNames = array();
	while ($i < $num) {
		$row = mysqli_fetch_assoc($resultList);

		$course_id = $row['course'];
		$crsName = $row['name'];

			//if not assigned, assign the course to user in b2client
			//$bundleCourse = mysql_query("select bundle from tbl_b2client_bundle where bundle_desc='$course_id'");
			//$row = mysql_fetch_assoc($bundleCourse);
      		
      		$bundle_id = '';
            //if ($row && array_key_exists('bundle',$row)) {
             //   $bundle_id = $row['bundle'];
            //}
			//$bundle_id = mysql_result($bundleCourse, 0, "bundle");

			$query6 = "select bundle from tbl_b2client_bundle where bundle_desc='$course_id'";
			$bundleCourse = mysqli_query($con,$query6);
			$num2=mysqli_num_rows($bundleCourse);
			$row2 = mysqli_fetch_assoc($bundleCourse);
			$bundle_id = $row2['bundle'];

			$curdate = date('Y-m-d');
			$password = "password";
			$todayDate = date("Y-m-d");
			$expiryDate = date('Y-m-d', strtotime(date("Y-m-d") . ' + 90 days'));
			$date = date_create();
			$client_id = 5;
			$company_id = 1;
			$launch_token = md5($client_id . "-" . $userCourseId . "-" . $bundle_id . "-" . $curdate);
			$token = md5($client_id . "-" . $userCourseId . "-" . $course_id . "-" . $curdate);
			$final_launch_url	= $static_url . '?token=' . $launch_token;
			$final_url .= $static_url . '?token=' . $token;
			//$assignCourse = mysql_query("INSERT INTO tbl_b2client (client_id, username, password, token, launch_token, order_id , bundle_id ,  course_id, registration_date, expiry_date , status ) VALUES ('$client_id','$userCourseId','$password','$token','$launch_token','SignUp' , '$bundle_id','$course_id','$todayDate','$expiryDate' , '0')");

			$query7 = "INSERT INTO tbl_b2client (client_id, username, password, token, launch_token, order_id , bundle_id ,  course_id, registration_date, expiry_date , status ) VALUES ('$client_id','$userCourseId','$password','$token','$launch_token','SignUp' , '$bundle_id','$course_id','$todayDate','$expiryDate' , '0')";
			$stmt = $con->prepare($query7);
			$stmt->execute();
			$stmt->close();

			array_push($arrCourseNames, $crsName);
			$i++;
	}
    return 1;
}

function setSessionAndRedirectDashbord($user_query_response)
{
    //session_start();
    $_SESSION['startTime']=time();	
    $_SESSION['login_user']=$user_query_response['username'];
    $_SESSION['isLogin']="yes";
    $_SESSION['sess_fname'] =$user_query_response['firstname'];
    $_SESSION['sess_uid'] = $user_query_response['username'];
    $_SESSION['perms'] = '1';
    $_SESSION['login_user_type'] = 'student';
    $_SESSION['dashbord_path'] = 'student/intface/index.php';
    setcookie("loginSession", json_encode($_SESSION),  time()+(3600*24*7), "/", NULL);
    //mysql_query("INSERT INTO tbl_entry_log (username, user_id, user_ip, user_entry) VALUES ('$myusername', $usRowId, '$userip','$curdate')");
  	header("location: student/intface/index.php");
    exit();
}