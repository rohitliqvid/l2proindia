<?php 
//session_start();
ini_set('display_errors', 1);
define("SERVER_URL","unwfp.englishedge.in");
//require_once('/var/www/html/wfp/webapi/certs/library/pdf/fpdf/fpdf.php');
//include('/var/www/html/wfp/connect.php');

require_once('/var/www/html/wfp/webapi/certs/library/pdf/fpdf/fpdf.php');
//include('/var/www/html/wfp/connect.php');

$con = createConnection();

$resultList1 = mysqli_query($con,"select a.firstname,a.lastname, b.userid, b.scormid,b.value from tbl_users a, tls_scorm_sco_tracking b where b.element='cmi.core.score.raw' and b.value >= 60 and b.scormid IN (83,87) and a.id=b.userid order by b.id"); 
$num=mysqli_num_rows($resultList1);
//echo $num;exit;
while($row1=mysqli_fetch_assoc($resultList1)) { 
	$level="";
	$firstname=$row1['firstname'];
	$lastname=$row1['lastname'];
	$userid=$row1['userid'];
	$scormid=$row1['scormid'];
	$value=$row1['value'];
	if($scormid==10 || $scormid==13)
	{
	$level="Level 1";
	$levelno=1;
	}
	
	$schoolName = getUserSchoolName($con,$userid);
	$blockName = getUserBlockName($con,$userid);
	$districtName = getUserDistrictName($con,$userid);
	$languageName = getUserLanguageName($con,$userid);
	$query="select * from tbl_certificates where user_id=".$userid." and sco_id=".$scormid." and level=".$levelno;
	//echo $query;exit;
	$certExists = mysqli_query($con,$query);
	$numExists=mysqli_num_rows($certExists);
	if($numExists==0)
	{
	
		$cert_path=getUserCertificateOnCourse($userid,$scormid,$firstname,$lastname,$level,$schoolName,$blockName,$districtName,$languageName);
		mysql_query("INSERT INTO tbl_certificates (user_id, sco_id,level_name,level,cert_path,created_date,modified_date) VALUES ($userid,$scormid,'$level',$levelno,'$cert_path',NOW(),NOW())");
	}
	else
	{
		$queryDel="delete from tbl_certificates where user_id=".$userid." and sco_id=".$scormid." and level=".$levelno;
		mysql_query($queryDel);
		$cert_path=getUserCertificateOnCourse($userid,$scormid,$firstname,$lastname,$level,$schoolName,$blockName,$districtName,$languageName);
		mysql_query("INSERT INTO tbl_certificates (user_id, sco_id,level_name,level,cert_path,created_date,modified_date) VALUES ($userid,$scormid,'$level',$levelno,'$cert_path',NOW(),NOW())");
	}
}




function getUserSchoolName($con,$userid)
{
	$resultList = mysqli_query($con,"select ts.school_name from tbl_schools ts, tbl_users tu where tu.school=ts.id and tu.id=".$userid.""); 
	$num=mysqli_num_rows($resultList);
	$row1=mysqli_fetch_assoc($resultList);
	if(count($row1>0)){
		$schoolName=$row1['school_name'];
	}else{
		$schoolName='';
	}
	return $schoolName;

}

function getUserBlockName($con,$userid)
{
	$resultList = mysqli_query($con,"select tb.block_name from tbl_block tb, tbl_users tu where tu.block=tb.id and tu.id=".$userid.""); 
	$num=mysqli_num_rows($resultList);
	$row1=mysqli_fetch_assoc($resultList);
	if(count($row1>0)){
		$block_name=$row1['block_name'];
	}else{
		$block_name='';
	}
	return $block_name;
}

function getUserDistrictName($con,$userid)
{
	$resultList = mysqli_query($con,"select tc.city_name from city tc, tbl_users tu where tu.city=tc.id and tu.id=".$userid.""); 
	$num=mysqli_num_rows($resultList);
	$row1=mysqli_fetch_assoc($resultList);
	if(count($row1>0)){
		$city_name=$row1['city_name'];
	}else{
		$city_name='';
	}
	return $city_name;
}

function getUserLanguageName($con,$userid)
{
	$resultList = mysqli_query($con,"select language_selected from tbl_users where id=".$userid.""); 
	$num=mysqli_num_rows($resultList);
	$row1=mysqli_fetch_assoc($resultList);
	if(count($row1>0)){
		$language =$row1['language_selected'];
	}else{
		$language ='';
	}
	return $language;
}



//getUserCertificateOnCourse("Devendra Saxena","4","Dev","Saxena");
//echo "Certificate generated!";

function getUserCertificateOnCourse($userid,$scormid,$firstname,$lastname,$level,$schoolName,$blockName,$districtName,$languageName){
		
		$courseName = 'LEVEL '. $level;
		
		$cdate=Date("d-m-Y");
		$fileName= $userid."-".$scormid."-".$level."-".md5($firstname).".pdf";
		$destination='/var/www/html/wfp/webapi/certs/'.$fileName;
		$pdflink="https://".SERVER_URL."/webapi/certs/".$fileName;
		
		if(file_exists($destination))
		{
			@unlink($destination);
		}


		if(!file_exists($destination))
		{
			$pdf= new FPDF();
			//print_r($pdf);exit;
			//$pdf = new FPDF('P','mm',array(150,100));
			$pdf = new FPDF('P','mm',array(220,155));
			//$pdf = new FPDF('P','mm','legal');
			$pdf->SetAuthor('AUTHOR');
			$pdf->SetTitle('CERTIFICATE');
			$pdf->AddPage('L'); 
			//$pdf->SetDisplayMode(real,'default');
			if($languageName=='en')
			{
				$bgImage="https://".SERVER_URL."/webapi/certs/library/pdf/cert-english.jpg";
			}
			else if($languageName=='hi')
			{
				$bgImage="https://".SERVER_URL."/webapi/certs/library/pdf/cert-hindi.jpg";
			}
			else if($languageName=='od')
			{
				$bgImage="https://".SERVER_URL."/webapi/certs/library/pdf/cert-oriya.jpg";
			}
			
			//echo $bgImage;exit;
			$pdf->Image($bgImage,0,0,220,0,'JPG');
			$pdf->SetXY(65,30);
			
			$pdf->AddFont('Montserrat-Bold','','MONTSERRAT-BOLD.php');
			$pdf->SetFont('Montserrat-Bold','',13);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetDrawColor(50,60,100);
			
			//$pdf->SetXY(85,78);
			//$pdf->Write(5, $firstName.' '.$lastName);
			
			// Move to 8 cm to the right
			$pdf->SetXY(70,68);
			$pdf->Cell(-33);
			// Centered text in a framed 20*10 mm cell and line break
			$pdf->Cell(150,10,$firstname.' '.$lastname.",".$schoolName.",".$blockName.",".$districtName,0,0,'C');
			
			//$pdf->SetXY(40,100);
			//$pdf->Write(5,$courseName.' course');

			$pdf->SetXY(67,87);
			$pdf->Cell(-30);
			// Centered text in a framed 20*10 mm cell and line break
			$pdf->Cell(150,10,$level,0,1,'C');
			$pdf->SetXY(92,100);
			$formatDate = date_format(date_create($cdate), 'jS F Y');
			$pdf->AddFont('Montserrat-Regular','','Montserrat-Regular.php');
			$pdf->SetFont('Montserrat-Regular','',13);
			$pdf->Write(5, $formatDate);
			//$pdf->Output($fileName,'D');
			$pdf->Output($destination,'F');
		}

		$certificate = new stdClass();
		$certificate->userId = strval($firstname);
		//$certificate->courseId = str_replace("CRS-","",$courseId);
		$certificate->webRedirectionLink = $pdflink;
		//$results=json_encode($finalArr);
		//return $results;
		return $pdflink;		
	}
	