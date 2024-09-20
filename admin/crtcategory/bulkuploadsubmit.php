<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
include("../connect.php"); //Connection to database 
include("../global/functions.php"); //Connection to database 
$curdate=date('Y-m-d');

if(isset($_FILES["userfile"]["name"]) && $_FILES["userfile"]["name"]!="")
				{
					$filesize=$_FILES["userfile"]["size"]/1024;
					$filetype=$_FILES["userfile"]["type"];
					//if($filetype=="application/vnd.ms-excel")
					//{
							$temp=explode(".",$_FILES["userfile"]["name"]);
							$ext=$temp[1];
							$filename="user.".$ext;
							
							$upload_file="../excel/".$filename;
							move_uploaded_file($_FILES["userfile"]["tmp_name"],$upload_file);
				}

     					require_once '../excel/reader.php';
						// ExcelFile($filename, $encoding);
						$data = new Spreadsheet_Excel_Reader();
						// Set output Encoding.
						$data->setOutputEncoding('CP1251');
						$data->read('../excel/user.xls');


						error_reporting(E_ALL ^ E_NOTICE);

						$k=0;
						$num=0;
						$user1=array();
						for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
							for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
								//echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
								$user1[$k]=$data->sheets[0]['cells'][$i][$j];
								$k++;
							}
						
						$statusMsg="";
						$isIncorrect=false;

							if($user1[0]!="")
							{
							$sql_select="select * from tbl_company where company_name='{$user1[0]}'";
							$res_select=mysql_query($sql_select); 

								if(mysql_num_rows($res_select)!=0)
								{
								$statusMsg=$statusMsg."Duplicate Country Name.<br>";
								$isIncorrect=true;
								}
							}

							if($user1[3]=="")
							{
								$statusMsg=$statusMsg."User Limit can not be blank.<br>";
								$isIncorrect=true;
							}

							if($user1[3]!="" && (trim(strlen($user1[3]))>4))
							{
								$statusMsg=$statusMsg."User Limit can not be more than 4 digits.<br>";
								$isIncorrect=true;
							}

							if($user1[3]!="" && !is_numeric($user1[3]))
							{
								$statusMsg=$statusMsg."User Limit must be an integer value.<br>";
								$isIncorrect=true;
							}
							if($user1[3]!="" && $user1[3]<100)
							{
								$statusMsg=$statusMsg."User Limit can not be less than 100.<br>";
								$isIncorrect=true;
							} 
							if($user1[4]=="")
							{
								$statusMsg=$statusMsg."User Expiry can not be blank.<br>";
								$isIncorrect=true;
							}

							if($user1[4]!="" && (trim(strlen($user1[4]))>4))
							{
								$statusMsg=$statusMsg."User Expiry can not be more than 4 digits.<br>";
								$isIncorrect=true;
							}

							if($user1[4]!="" && !is_numeric($user1[4]))
							{
								$statusMsg=$statusMsg."User Expiry must be an integer value.<br>";
								$isIncorrect=true;
							}


							if($isIncorrect==true)
							{
							$insertempsql="INSERT INTO tbl_comp_bulkstatus (company_name, status,flag) VALUES ('{$user1[0]}','$statusMsg','1')";
							mysql_query($insertempsql);
							}
							else
							{
							$user1[1]=addslashes($user1[1]);
							$user1[2]=addslashes($user1[2]);
							$insersql="INSERT INTO tbl_company (company_name, company_desc, company_address, company_user_limit, company_user_expiry, company_created_by) VALUES ('{$user1[0]}','{$user1[1]}','{$user1[2]}','{$user1[3]}','{$user1[4]}','admin')";
							mysql_query($insersql);

							$statusMsg="Country created successfully!";
							$insertempsql="INSERT INTO tbl_comp_bulkstatus (company_name, status,flag) VALUES ('{$user1[0]}','$statusMsg','0')";
							mysql_query($insertempsql);
							}
						
							$k=0;
						}
					unlink($upload_file);
					header("Location:bulkusercrtd.php");
					exit;
?>

