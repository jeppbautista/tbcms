
<?php
include 'class.php';
$class = new mydesign;
$class->doc_type();
$class->html_start('');
$class->head_start();
echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
$class->title_page('TBC Merchant Services');
$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
$class->script('https://tbcmerchantservices.com/js/bootstrap-datetimepicker.js');
$class->link('https://tbcmerchantservices.com/css/bootstrap-datetimepicker.css');
$class->script('https://tbcmerchantservices.com/js/jquery.js');

if (isset($_POST['signup'])){
	$date = $_REQUEST["txttbc_bday_signup"];
	$dt = DateTime::createFromFormat("Y-m-d", $date);
	echo $dt !== false && !array_sum($dt::getLastErrors());
}



?>
<br><br><br><br><br>
<div class="col-md-2" style="padding: 3px;">
		<h4 style="color: #A9A9A9;">Birthday</h4>
		<form method="POST" id="signup_form_submit2" action="https://tbcmerchantservices.com/test_welcome.php">
		<input id="birth-text" name="txttbc_bday_signup" class="form-control" type="text" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%; background-color: white" placeholder="YYYY-MM-DD" />
		<input id="signup" type="submit" name = "signup"/>
	</form>
</div>
