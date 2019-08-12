<?php 
require('../../../libraries/fpdf/fpdf.php');
require(__DIR__.'../../mailer/generic_mailer.php');
class PDF extends FPDF{

	private $file;

	function BillingTo($orderNumber,$typeOfPayment,$transactionNumber,$dateOfTransaction,$name,$address,$phone,$email,$city,$country){

		$this->SetFont('Arial','B',9);
		$this->Cell(90,10,'BILLING TO','B',0,'L');
		$this->Ln();

		$this->SetFont('Arial','B',11);
		$this->SetTextColor(80,80,80);
		$this->Cell(0,10,$name);
		$this->Ln();

		$this->SetFont('Arial','',9);
		$this->SetTextColor(50,50,50);
		$this->Cell(0,7,$address);
		$this->Ln();

		$this->Cell(0,7,$city);
		$this->Ln();

		$this->Cell(0,7,$country);
		$this->Ln(20);
	}
	function ProductInformation($product){
		$this->SetFont('Arial','I',9);
		// $this->MultiCell(0, 5, "Your Orders");
		// $header = ['Details','Quantity','Unit Price'];
		$header = ['PRODUCT','AMOUNT','VAT', 'PRICE', 'TOTAL'];
		

		$this->SetFont('Arial','B',9);
		// Column widths
		$w = array(80, 20, 20 ,35,35);

   		// Header
		for($i=0;$i<count($header);$i++){
			$align = 'C';
			if($i == 0 ){
				$align = 'L';
			}else{
				$align = 'C';
			}
			$this->Cell($w[$i],7,$header[$i],'B',0,$align);
		}
		
		$this->Ln();

		$sum = 0;
		$totalVat = 0;
    	// product data
		$this->SetFont('Arial','',9);
		foreach($product as $row)
		{
			$this->Cell($w[0],9,$row[0],0);
			$this->Cell($w[1],9,number_format($row[1]),0,0,'C');
			$this->Cell($w[2],9,number_format($row[2]),0,0,'C');
			$this->Cell($w[3],9,number_format($row[3]),0,0,'C');
			$this->Cell($w[4],9,number_format($row[4]),0,0,'C');
			$totalVat += $row[2];
			$sum += $row[4];
			$this->Ln();
		}
		// Setting amount of Total
		$this->SetFont('Arial','B',9);
		$this->Cell($w[0],9,'',0);
		$this->Cell($w[1],9,'',0);
		$this->Cell($w[2],9,'',0);
		$this->Cell($w[3],9,'VAT %',0,0,'L');
		$this->Cell($w[4],9,'P '.number_format($totalVat),0,0,'L');
		$this->Ln();
		// Setting amount of Total
		$this->SetFont('Arial','B',9);
		$this->Cell($w[0],9,'',0);
		$this->Cell($w[1],9,'',0);
		$this->Cell($w[2],9,'',0);
		$this->Cell($w[3],9,'Total',0,0,'L');
		$this->Cell($w[4],9,'P '.number_format($sum),0,0,'L');
		$this->Ln();

		$calcuatedTotalDue = $sum - $totalVat;
		// Setting amount of Total
		$this->SetFont('Arial','B',9);
		$this->Cell($w[0],9,'',0);
		$this->Cell($w[1],9,'',0);
		$this->Cell($w[2],9,'',0);
	   	$this->SetDrawColor(50,80,180);
		$this->SetFillColor(0,0,0);
		$this->SetTextColor(255,255,255);
		$this->Cell($w[3],9,'Total Due',0,0,'L',true);
	  	$this->SetDrawColor(255,255,255);
		$this->SetFillColor(0,0,0);
		$this->SetTextColor(255,255,255);
		$this->Cell($w[4],9,'P '.number_format($calcuatedTotalDue),'L',0,'L',true);
		$this->Ln();
    	// Closing line
		$this->Cell(array_sum($w),'','',0,'T');
	}

	function Invoice($reference,$billingDate,$dueDate){

		$this->SetFont('Helvetica','B',50);
		$this->Cell(65,10,"TBCMS",0,0,'R');

		$this->SetX(100);
		$this->SetFont('Helvetica','B',20);
		$this->Cell(100,10,"INVOICE",0,0,'R');
		$this->Ln();

		$this->SetX(140);
		$this->SetFont('Helvetica','B',9);
		$this->Cell(50,5,"REFERENCE:",0,0,'L');
		$this->SetX(150);
		$this->SetFont('Helvetica','',9);
		$this->Cell(50,5,$reference,0,0,'R');
		$this->Ln();	

		$this->SetX(140);
		$this->SetFont('Helvetica','B',9);
		$this->Cell(50,5,"BILLING DATE:",0,0,'L');
		$this->SetX(150);
		$this->SetFont('Helvetica','',9);
		$this->Cell(50,5,$billingDate,0,0,'R');
		$this->Ln();	

		$this->SetX(140);
		$this->SetFont('Helvetica','B',9);
		$this->Cell(50,5,"DUE DATE:",0,0,'L');
		$this->SetX(150);
		$this->SetFont('Helvetica','',9);
		$this->Cell(50,5,$dueDate,0,0,'R');
		$this->Ln();	
		$this->Ln();
	}
	function CompileInvoice($reference,$billingDate,$dueDate,$orderNumber,$typeOfPayment,$transactionNumber,$dateOfTransaction,$name,$address,$phone,$email,$city,$country,$product){

		$this->AddPage();
		$this->SetTitle("Title");
		$this->SetFont('Arial','B',16);
		$this->Invoice("20191564123142","07.31.2019","07.31.2019");

		// Setting Billing To
		$this->BillingTo(11221,"Gcash",110222,"Dec 20 1997","Amelito Estrada Jr.","acestrada02@gmail.com","0999999","6999 Azalea Street","Caloocan City","PH");
		$this->ProductInformation($product);

		// This is the diriectory
		$this->file = __DIR__.'/invoice_pdf/'.$reference.'.pdf';
		$this->Output($this->file,'F');
	}

	public function getInvoice(){
		return $this->file;
	}
}
// Instantiation of classes
$pdf = new PDF();
/*START - This is a sample input or usage of this class */

// Set value
$product = array(
	['B-Boost Oral Vitamin Spray','3','0.00', '1500','1500'],
	['B-Boost Oral Vitamin Spray','3','0.00', '1500','1500']);

/*
The data injection is set thru CompileInvoice method of PDF class
	@Param = $reference,$billingDate,$dueDate,$orderNumber,$typeOfPayment,$transactionNumber,$dateOfTransaction,$name,$address,$phone,$email,$city,$country,$product
*/
$pdf->CompileInvoice(20191564123142,"07.31.2019","07.31.2019",11221,"Gcash",110222,"Dec 20 1997","Amelito Estrada Jr.","acestrada02@gmail.com","0999999","6999 Azalea Street","Caloocan City","PH",$product);
/*END */

/*
The data injection is set thru constructor of SendMail class
	File Class =  \assets\utils\mailer\generic_mailer.php
	
		@param = $attachedFile,$sendTo 
*/

$mail = new SendMail($pdf->getInvoice(),'jeppbautista@gmail.com');
?>