<?php 
  session_start();
  date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');
  include '../class.php';
  $class=new mydesign;
  $class->database_connect();
  $Mainctr=$_SESSION['session_tbcmerchant_ctr'.$sessiondate];

  $query="select * from xtbl_eudodona WHERE MainCtr='$Mainctr'";
  $rs=mysql_query($query);
  $row=mysql_fetch_assoc($rs);

  $rows=mysql_num_rows($rs);

  if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
    if($class->isLocalhost()==true)
    {
      header("location: ../welcome.php");
    }
    else
    {
      header("location: https://tbcmerchantservices.com/welcome/");
    }
  
  }

  # TODO fix this: if already paid
  // if($rows == 1)
  // {
  //   // header("location: main.php");
  //   header("location: landing.php");
  // }
  // else
  // {
  //   header("location: landing.php");
  // }
  
?>