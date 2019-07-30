<?php 
require('/libraries/fpdf/fpdf.php');

class PDF extends FPDF{
	// Invoice Header 
	function Header(){
		$title = 'THANK YOU FOR SUPPORTING WITH US';
		$sub_title1 = 'We have sent you an email/SMS about the confirmation of your order.';
		$sub_title2 = 'We will send another email/SMS once we confirm your payment. Thank you for your shopping with us.';
		$this->SetFont('Arial','B',15);
		$w = $this->GetStringWidth($title)+6;
		$this->SetX((210-$w)/2);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(50,50,50);
		$this->SetLineWidth(0);
		$this->Cell($w,9,$title,'C',true);
		$this->Ln(3);

		$this->SetX((219-$w)/2);
		$this->SetFont('Arial','',9);
		$this->Cell($w,0,$sub_title1,'C',true);
		$this->SetX((170-$w)/2);
		$this->Cell($w,9,$sub_title2,'C',true);

		$this->Ln(5);
		$this->y0 = $this->GetY();
	}

	function CustomerEmail($name,$email,$phone,$address){
		// Setting Addressee
		$this->SetFont('Helvetica','B',9);
		$this->Cell(0,10,'Dear '.$name.',','C',true);

		// Setting Body
		$this->CustomerEmailBody(11221,"Gcash",110222,"Dec 20 1997",$name,$address,$phone,$email);
		$this->GenerateItems();
	}	

	function CustomerEmailBody($orderNumber,$typeOfPayment,$transactionNumber,$dateOfTransaction,$name,$address,$phone,$email){

		$body = 'A package from your order #'.$orderNumber.' is being shipped and will be out for delivery within the next 24 hours. Please see below for the expected shipment arrival of your order.

		Your Order Details
		Type of Payment
		'.$typeOfPayment.'

		Transaction Number
		'.$transactionNumber.'

		Date of Transaction
		'.$dateOfTransaction.'

		Your order will be delivered to
		'.$name.'
		'.$address.'
		'.$phone.'
		';

		$this->SetFont('Arial','',9);
		$this->MultiCell(0, 5, $body);
	}

	function GenerateItems(){
		$this->SetFont('Arial','I',9);
		$this->MultiCell(0, 5, "Your Orders");

		$header = ['Details','Quantity','Unit Price'];
		$data = array(['B-Boost Oral Vitamin Spray','3', '1500']);

		$this->SetFont('Arial','',9);
		// Column widths
		$w = array(60, 35, 30 );
   		// Header
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C');
		$this->Ln();
    	// Data
		foreach($data as $row)
		{
			$this->Cell($w[0],6,$row[0],'LR');
			$this->Cell($w[1],6,number_format($row[1]),'LR',0,'R');
			$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
			$this->Ln();
		}
		$this->SetFont('Arial','B',9);
		$this->Cell($w[0],6,'','LR');
		$this->Cell($w[1],6,'Total','LR',0,'R');
		$this->Cell($w[2],6,'P '.number_format(4500),'LR',0,'R');
		$this->Ln();

    	// Closing line
		$this->Cell(array_sum($w),0,'','T');

	}

	function CompileInvoice(){
		$this->CustomerEmail("Ace","acestrada02@gmail.com","0999999","blkc 2 Katuparan st. Q.C.");
	}

}

// Instantiation of classes
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetTitle("Title");
$pdf->CompileInvoice();
$pdf->SetFont('Arial','B',16);
$pdf->Output();
?>