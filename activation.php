<?php

if(isset($_GET['key']))
{
  include 'class.php';
	$class=new mydesign;
	$class->database_connect();

  $key = $_GET['key'];

  $query = "SELECT * FROM xtbl_account_info WHERE email_verification='$key'";
  $rs=mysql_query($query);
  $rows=mysql_num_rows($rs);
  $row=mysql_fetch_assoc($rs);
  

  if($rows==1)
  {
    $update_query="update xtbl_account_info SET Email_Status='ACTIVE' WHERE email_verification='$key'";
    $update_rs=@mysql_query($update_query);
    date_default_timezone_set('Asia/Manila');
    $sessiondate=date('mdY');
    $_SESSION['session_tbcmerchant_ctr'.$sessiondate]=$new_ctr;
    $_SESSION['test'] = 1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <meta http-equiv="refresh" content="5;url=https://tbcmerchantservices.com/home/" />
    <title>Site Maintenance</title>
    <style type="text/css">
      body { text-align: center; padding: 150px; }
      h1 { font-size: 50px; }
      body { font: 20px Helvetica, sans-serif; color: #333; }
      #article { display: block; text-align: left; width: 650px; margin: 0 auto; }
      a { color: #dc8100; text-decoration: none; }
      a:hover { color: #333; text-decoration: none; }
    </style>

</head>
<body>
    <div id="article">
    <h1>Email verified!</h1>
    <div>
        <p>Your email has been successfully verified. You will be redirected to the homepage in 5 seconds or you may click <a href="">here</a></p>
    </div>
    </div>
</body>
</html>

<?php
  }
  else {
    echo 'FAILED. Please contact the administrator using this site: <a href="https://www.tbcmsonlineshop.com">https://www.tbcmsonlineshop.com</a>';
  }

}
else {

}
 ?>
