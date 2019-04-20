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
    echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
    $class->title_page('TBCMS: EUDODONA');
    $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
    $class->script('https://tbcmerchantservices.com/js/bootstrap.js');
    $class->link('https://tbcmerchantservices.com/css/bootstrap.css');
    $class->script('https://tbcmerchantservices.com/js/jquery1.1.js');
  $class->head_end();

  $class->body_start('');

?>
<style>
  td, th {height: 100px}
  table {border: none}
</style>

<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
      </tr>
    </tbody>
  </table>
</div>
