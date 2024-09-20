<?php

/*function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}*/

$curdate=Date("d-m-Y");
require('fpdf/fpdf.php');
//$uname="Devendra Sahai Saxena";
if(isset($_GET['uname']) && isset($_GET['cname']) && isset($_GET['cdate']) && isset($_GET['scormID']))
{

$uname=encrypt_decrypt('decrypt',$_GET['uname']);


$unameNew=str_replace("_"," ",$uname);
$cname=encrypt_decrypt('decrypt',$_GET['cname']);
$cname=str_replace("_"," ",$cname);
$cdate=$_GET['cdate'];

if($cdate=="")
{
	$cdate="NA";
}
else
{
$cdate=gmdate("d-m-Y", $cdate);
}

$scormID=$_GET['scormID'];
$fileName=$uname."_".$scormID.".pdf";


$pdf= new FPDF();
//$pdf = new FPDF('P','mm',array(150,100));
$pdf = new FPDF('P','mm',array(220,150));
//$pdf = new FPDF('P','mm','legal');
$pdf->SetAuthor('AUTHOR');
$pdf->SetTitle('CERTIFICATE');
$pdf->SetFont('Times','',20);
$pdf->SetTextColor(0,0,0);
$pdf->AddPage('L'); 
//$pdf->SetDisplayMode(real,'default');
$pdf->Image('http://courses.englishedge.in/learncms/pdf/bg.png',0,0,220,0,'PNG');
$pdf->SetXY(65,30);
$pdf->SetFont('Times','',30);
$pdf->SetDrawColor(50,60,100);
//$pdf->Cell(100,10,'Learner Certificate',0,0,'C',0);
$pdf->SetXY(15,54);
$pdf->SetFontSize(17);
$pdf->MultiCell(155,10,'This is to certify that Mr./Ms. '.$unameNew.' has successfully completed the '.$cname.' course by Liqvid.');
////$pdf->SetXY(15,70);
////$pdf->Write(5,'');
$pdf->SetXY(15,86);
$pdf->Write(5,'Date: '.$cdate);
$pdf->Output($fileName,'D');
}
else
{
echo "Invalid Data Recieved. Please try again!";
exit;
}
?> 