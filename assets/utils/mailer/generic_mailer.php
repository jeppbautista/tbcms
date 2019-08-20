<?php 
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require($_SERVER['DOCUMENT_ROOT'].'/libraries/PHPMailer/src/PHPMailer.php');
require($_SERVER['DOCUMENT_ROOT'].'/libraries/PHPMailer/src/Exception.php');
require($_SERVER['DOCUMENT_ROOT'].'/libraries/PHPMailer/src/SMTP.php');

class SendMail extends PHPMailer{

	public function __construct($invoiceFile,$sendTo,$attachmentName){
		try{
			new PHPMailer(true);

			$this->SMTPConfig();
			$this->configureAccountCredentials();
			$this->recipient($sendTo);
			$this->content();
			$this->attachment($invoiceFile, $attachmentName);

			$this->send();
			echo 'Message has been sent';
		}catch(Exception $e){
			 echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	
	}
	private function SMTPConfig(){
		//Server settings
	    $this->isSMTP();                                            // Set mailer to use SMTP
	    $this->SMTPDebug = 2;                                       // Enable verbose debug output
	    $this->Port       = 587;                                    // TCP port to connect to
       	$this->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
		$this->SMTPAuth   = true;                                   // Enable SMTP authentication			
	    $this->Host       = 'smtp.ipage.com';  						// Specify main and backup SMTP servers
	}

	private function configureAccountCredentials(){
	    // Configure Account credential
	    $this->Username   = 'ebitshares';              // SMTP username
	    $this->Password   = '2019TBCMScsbn7270#####$$$$$$';                     // SMTP password
	}

	private function recipient($sendTo){
		//Recipients
	    $this->setFrom('automail@tbcmerchantservices.com', 'TBCMerchantServices');
	    // $mail->addAddress($sendTo, 'Joe User');     // Add a recipient
	    $this->addAddress($sendTo);     // Add a recipient
	}

	private function attachment($invoiceFile, $attachmentName){
		// Attachments
	    $this->addAttachment($invoiceFile, $attachmentName);    // Optional name
	}

	private function content(){
	    // Content
	    $this->isHTML(true);                                  // Set email format to HTML
	    $this->Subject = 'Here is the subject';
	    $this->Body    = 'This is the HTML message body <b>in bold!</b>';
	    $this->AltBody = 'This is the body in plain text for non-HTML mail clients';

	}
}

?>