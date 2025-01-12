<?php
ini_set('display_errors', 1);
define("SERVER_URL","l2pro-stg.adurox.com");
require_once('./pdf/fpdf/fpdf.php');
include('../../../connect.php');
$con = createConnection();

if(isset($_REQUEST['docId']) && $_REQUEST['docId']!="" && isset($_REQUEST['userRowId']) && $_REQUEST['userRowId']!="" && $_REQUEST['social_share_type']!=""){
   

    $docId = trim($_REQUEST['docId']);
    $userRowId = trim($_REQUEST['userRowId']);
    $levelno = trim($_REQUEST['levelname']);

    $resultList1 = mysqli_query($con,"select a.firstname,a.lastname, b.userid, b.scormid,b.value from tbl_users a, tls_scorm_sco_tracking b where b.element='cmi.core.score.raw' and b.scormid = '$docId' and a.id=b.userid and a.id='$userRowId' order by b.id LIMIT 1"); 

    $num=mysqli_num_rows($resultList1);

    if($num > 0){
        $row1=mysqli_fetch_assoc($resultList1);
        
        $firstname=$row1['firstname'];
		$lastname=$row1['lastname'];
		$userid=$row1['userid'];
		$scormid=$row1['scormid'];


        $query="select * from tbl_certificates where user_id=".$userid." and sco_id='".$scormid."' and level_name='".$levelno."' LIMIT 1";
		$certExists = mysqli_query($con,$query);
		$numExists=mysqli_num_rows($certExists);
        $cert_path = '';
        if ($numExists > 0) {
            $certificate  =mysqli_fetch_assoc($certExists);
            $cert_path = $certificate['cert_path'];
            
        }else{
            $certdate = mysql_query ("SELECT * FROM tbl_sco_completion where userid=$userid and scoid=$scormid"); 
		    $num2=mysql_numrows($certdate);
		    $certdatevalue=mysql_result($certdate,0,"comp_date");

            $cert_path=getUserCertificateOnCourse($userid,$scormid,$firstname,$lastname,$levelno,$certdatevalue);

            $query = "INSERT INTO tbl_certificates (user_id, sco_id,level_name,cert_path,created_date,modified_date) VALUES ($userid,$scormid,'$levelno','$cert_path',NOW(),NOW())";
            mysqli_query($con,$query);
        }

        $url = '';

        if ( $_REQUEST['social_share_type'] == 'facebook') {
            $url = 'http://www.facebook.com/sharer.php?u='.$cert_path;
        }
        if ( $_REQUEST['social_share_type'] == 'linkedin') {
            $url = 'https://www.linkedin.com/shareArticle?mini=true&url='.$cert_path;
        }
        if ( $_REQUEST['social_share_type'] == 'twitter') {
            $url = 'https://twitter.com/intent/tweet?url='.$cert_path;
        }
        header('Location: '.$url);
		exit;
    
    }else{
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}


function getUserCertificateOnCourse($userid,$scormid,$firstname,$lastname,$levelno,$certdatevalue){
		
    $levelno = $levelno;
    
    $cdate=Date("d-m-Y");
    $fileName= $userid."-".$scormid."-".$levelno."-".md5($firstname).".pdf";
    $destination='../'.$fileName;
    $pdflink="https://".SERVER_URL."/webapi/certs/".$fileName;
    
    if(file_exists($destination))
    {
        @unlink($destination);
    }


    if(!file_exists($destination))
    {
        $pdf= new FPDF();
        //print_r($pdf);exit;
        $pdf = new FPDF('P','mm',array(220,120));
        //$pdf = new FPDF('P','mm',array(220,155));
        //$pdf = new FPDF('P','mm','legal');
        $pdf->SetAuthor('AUTHOR');
        $pdf->SetTitle('CERTIFICATE');
        $pdf->AddPage('L'); 
        //$pdf->SetDisplayMode(real,'default');
        
        if($levelno=='Basic')
        {
            $bgImage="https://".SERVER_URL."/webapi/certs/library/pdf/Basic.jpg";
        }
        else if($levelno=='Intermediate')
        {
            $bgImage="https://".SERVER_URL."/webapi/certs/library/pdf/Intermediate.jpg";
        }
        else if($levelno=='Advance')
        {
            $bgImage="https://".SERVER_URL."/webapi/certs/library/pdf/Advance.jpg";
        }
        
        //echo $bgImage;exit;
        $pdf->Image($bgImage,0,0,220,0,'JPG');
        $pdf->SetXY(65,10);
        
        $pdf->AddFont('Montserrat-Bold','','MONTSERRAT-BOLD.php');
        $pdf->SetFont('Montserrat-Bold','',20);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetDrawColor(50,60,100);
        
        //$pdf->SetXY(85,78);
        //$pdf->Write(5, $firstName.' '.$lastName);
        
        // Move to 8 cm to the right
        $pdf->SetXY(70,48);
        $pdf->Cell(-33);
        // Centered text in a framed 20*10 mm cell and line break
        $pdf->Cell(150,10,$firstname.' '.$lastname,0,0,'C');
        
        //$pdf->SetXY(40,100);
        //$pdf->Write(5,$courseName.' course');

        $pdf->SetXY(67,87);
        $pdf->Cell(-30);
        // Centered text in a framed 20*10 mm cell and line break
        //$pdf->Cell(150,10,$levelno,0,1,'C');
        $pdf->SetXY(85,83);
        $formatDate = date_format(date_create($certdatevalue), 'jS F Y');
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


