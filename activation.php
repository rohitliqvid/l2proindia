<?php
include ("connect.php");
@session_start();
?>
<?php 

if(isset($_REQUEST['key']) && $_REQUEST['key']!=""){
	
	
	$key =trim($_REQUEST['key']);
	//Assign course to user 21-5-2019

	
			$con=createConnection();
			//$resultList = mysql_query("SELECT * FROM tbl_users where hash_key='$key' "); 
			//$num=mysql_numrows($resultList);

			$query2 = "SELECT id,email,isActive FROM tbl_users where hash_key='$key' ";
			$resultList = mysqli_query($con,$query2);
			$num=mysqli_num_rows($resultList);
			
			if($num>0){
				$i=0;
				while($i<$num) {
					
					 $row = mysqli_fetch_assoc($resultList);
					$user_id = $row['id'];
					$email=$row['email'];;
					$isActive=$row['isActive'];
					$i++;
				}
			
				if($isActive=='1'){
					$_SESSION['msg']='Your account has been already activated.';
					$_SESSION['err']=1;
				}
				else{
					
					//$resultList = mysql_query("update tbl_users set hash_key='',isActive='1' where id='$user_id'"); 

					$query = "update tbl_users set hash_key='',isActive='1' where id=?";
					$stmt = $con->prepare($query);
					$stmt->bind_param("i", $user_id);
					$stmt->execute();
					$stmt->close();
					if($stmt){
						
						$_SESSION['msg']='Your account has been activated successfully.';
						$_SESSION['err']=0;
					}
					else{
						
						$_SESSION['msg']='Your account has not been activated. Please try again.';
						$_SESSION['err']=1;
					}
				
				}
			
			
			
			}else{
				$_SESSION['msg']='Invalid link.';
				$_SESSION['err']=1;
				
			}
}else{
	$_SESSION['msg']='Invalid link.';
	$_SESSION['err']=1;
}
closeConnection($con);
header('location:activeSucces.php');
exit
?>


