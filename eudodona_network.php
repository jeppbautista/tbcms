<?php

session_start();
date_default_timezone_set('Asia/Manila');
$sessiondate=date('mdY');
include 'class_admin.php';
$class=new mydesign;
$class->database_connect();

if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
  header("location: https://tbcmerchantservices.com/welcome/");
}

$Mainctr=$_SESSION['session_tbcmerchant_ctr'.$sessiondate];


$class->doc_type();
$class->html_start('');
  $class->head_start();
    echo '<link rel="shortcut icon" type="image/x icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
    $class->title_page('TBCMS: EUDODONA');
    $class->script('https://tbcmerchantservices.com/js/jquery 3.1.1.js');
    $class->script('https://tbcmerchantservices.com/js/bootstrap.js');
    $class->link('https://tbcmerchantservices.com/css/bootstrap.css');
    $class->script('https://tbcmerchantservices.com/js/jquery1.1.js');
  $class->head_end();

  $class->body_start('');

?>

<div style="background-color: rgb(255,255,255,0.5); height: auto; padding-top: 10px; background-image: url('https://tbcmerchantservices.com/images/Picture3.jpg'); background-size: 100% auto">
    <div class="container">
      <div class="col-md-10" style="padding-bottom: 5px;">
        <img width="230px" src="https://tbcmerchantservices.com/images/tbsheader.png">
      </div>
      <div class="col-md-2" style="padding-bottom: 5px; text-align: center;">
      </div>
    </div>
  </div>

  <div class="container"><h3>Welcome back,  <b>Something something</b></h3></div>
  <br>
  <hr>

<div class="container">
  <table class="table borderless">
    <thead>
      <tr >
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>

      </tr>
    </thead>
    <tbody>
      <tr style="height : 100px">
        <th scope="col"> </th>
        <th scope="col"> </th>
        <th scope="col"> </th>
        <th scope="col"><img src="https://tbcmerchantservices.com/images/network.png"></th>
        <th scope="col"> </th>
        <th scope="col"> </th>
        <th scope="col"> </th>
      </tr>
      <tr style="height : 20px">
        <th scope="col"> </th>
        <th scope="col"> </th>
        <th scope="col"> </th>
        <th scope="col">value #1</th>
        <th scope="col"> </th>
        <th scope="col"> </th>
        <th scope="col"> </th>
      </tr>
      <tr style="height : 100px">
        <th scope="col"><img src="https://tbcmerchantservices.com/images/network.png"></th>
        <th scope="col"><img src="https://tbcmerchantservices.com/images/network.png"></th>
        <th scope="col"><img src="https://tbcmerchantservices.com/images/network.png"></th>
        <th scope="col"> </th>
        <th scope="col"><img src="https://tbcmerchantservices.com/images/network.png"></th>
        <th scope="col"><img src="https://tbcmerchantservices.com/images/network.png"></th>
        <th scope="col"><img src="https://tbcmerchantservices.com/images/network.png"></th>
      </tr>
      <tr style="height : 20px">
        <th scope="col">value #2</th>
        <th scope="col">value #3</th>
        <th scope="col">value #4</th>
        <th scope="col"> </th>
        <th scope="col">value #5</th>
        <th scope="col">value #6</th>
        <th scope="col">value #7</th>
      </tr>
    </tbody>
  </table>
</div>

<style>
  td, th { border: none !important; vertical-align: center; text-align: center;}
</style>
