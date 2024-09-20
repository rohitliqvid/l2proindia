<?php 
//session_start();
define("SERVER_URL","tse.englishedge.in");
require_once(dirname(__FILE__).'/pdf/fpdf/fpdf.php');

//getUserCertificateOnCourse("Devendra Saxena","4","Dev","Saxena");
//echo "Certificate generated!";

function getUserCertificateOnCourse($username,$level,$firstName,$lastName){
		
		$courseName = 'LEVEL '. $level;
		
		$cdate=Date("d-m-Y");
		$fileName= md5($username)."-".$level.".pdf";
		$destination=$_SERVER['DOCUMENT_ROOT'].'/services/certificate/certs/'.$fileName;
		$pdflink="https://".SERVER_URL."/services/certificate/certs/".$fileName;
		
        unlink($destination);
        
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
			if($level=='1')
			{
				$bgImage="https://".SERVER_URL."/services/certificate/pdf/cl1.png";
			}
			else if($level=='2')
			{
				$bgImage="https://".SERVER_URL."/services/certificate/pdf/cl2.png";
			}
			else if($level=='3')
			{
				$bgImage="https://".SERVER_URL."/services/certificate/pdf/cl3.png";
			}
			else if($level=='4')
			{
				$bgImage="https://".SERVER_URL."/services/certificate/pdf/cl4.png";
			}
			//echo $bgImage;exit;
			$pdf->Image($bgImage,0,0,220,0,'PNG');
			$pdf->SetXY(65,30);
			
			$pdf->AddFont('Montserrat-Bold','','MONTSERRAT-BOLD.php');
			$pdf->SetFont('Montserrat-Bold','',19);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetDrawColor(50,60,100);
			/*$pdf->SetXY(85,78);
			$pdf->Write(5, $firstName.' '.$lastName);
			*/
			// Move to 8 cm to the right
			$pdf->SetXY(65,80);
			$pdf->Cell(-30);
			// Centered text in a framed 20*10 mm cell and line break
			$pdf->Cell(150,10,$firstName.' '.$lastName,0,0,'C');
			/*$pdf->SetXY(40,100);
			$pdf->Write(5,$courseName.' course');*/
			///show date///$pdf->SetXY(65,93);
			///show date///$pdf->Cell(-30);
			// Centered text in a framed 20*10 mm cell and line break
			///show level///$pdf->Cell(150,10,$courseName,0,1,'C');
			///show date///$pdf->SetXY(108,104);
			///show date///$formatDate = date_format(date_create($cdate), 'jS F Y');
			///show date///$pdf->AddFont('Montserrat-Regular','','Montserrat-Regular.php');
			///show date///$pdf->SetFont('Montserrat-Regular','',13);
			///show date///$pdf->Write(5, $formatDate);
			//$pdf->Output($fileName,'D');
			$pdf->Output($destination,'F');
		}

		$certificate = new stdClass();
		$certificate->userId = strval($username);
		//$certificate->courseId = str_replace("CRS-","",$courseId);
		$certificate->webRedirectionLink = $pdflink;
		//$results=json_encode($finalArr);
		//return $results;
		return $certificate;		
	}