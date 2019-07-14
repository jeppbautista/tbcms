<?php
session_start();
include 'class3.php';
$class=new mydesign;
$class->database_connect();

date_default_timezone_set('Asia/Manila');
$sessiondate=date('mdY');
$GLOBALS['test'] = 0;

if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
    echo '<script>window.location.assign("https://tbcmerchantservices.com/welcome/");</script>';
}
// else {
// 	header("location: https://tbcmerchantservices.com/welcome/");
// }
// if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
// 	header("location: https://tbcmerchantservices.com/welcome/");
// }
$ctr=$_SESSION['session_tbcmerchant_ctr'.$sessiondate];

$class->doc_type();
$class->html_start('');
$class->head_start();
echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
$page_title = "Cart";
$class->title_page($page_title);
$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
$class->link('https://fonts.googleapis.com/css?family=Noto+Sans&display=swap');
$class->link('https://tbcmerchantservices.com/css/style-shop.css');
$class->script('https://tbcmerchantservices.com/js/jquery1.3.js');
$class->link('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
$class->head_end();

$query="select * from xtbl_account_info WHERE Main_Ctr='$ctr'";
$rs=mysql_query($query);
$row=mysql_fetch_assoc($rs);
$account_type=$row['Account_Type'];

if($account_type=='MERCHANT') {
  $class->page_home_header_start();
    $class->page_home2_header_content();
  $class->page_home_header_end();
}
else { //if buyer
  $class->page_home_header_start();
    $class->page_home3_header_content();
  $class->page_home_header_end();
}

?>

<style>
  html {
      overflow-y:scroll;
  }
</style>

<div class="container">
<div class="row">
  <div class="col-12 col-md-7">
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <h3>Details<br>
                <small>Enter your email address and/or contact number to receive updates regarding your order.</small>
              </h3>
            </button>
          </h5>
        </div>

        <div id="collapseOne" class="collapse in" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="check-email">Email address</label>
                <input type="email" class="form-control" id="check-email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="check-phone"></label>
                <input type="text" class="form-control" id="check-phone" placeholder="+639123456789">
              </div>
              <button id="check-proceed1" type="submit" class="btn">Proceed</button>
              <span style="width:50%; text-align:right"> <small>All information submitted are secured.</small> </span>
              <div class="">
                <h3 style="text-align:left">Next steps</h3>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <h3>Shipping & Delivery<br>
                <small>Select how you would like to receive your order</small>
              </h3>

            </button>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="check-country">Country</label>
                <input type="text" class="form-control" id="check-email" placeholder="Enter country">
              </div>
              <div class="form-group">
                <label for="check-country">Full name</label>
                <input type="text" class="form-control" id="check-email" placeholder="Enter country">
              </div>
              <div class="form-group">
                <label for="check-country">Address</label>
                <input type="text" class="form-control" id="check-email" placeholder="Enter country">
              </div>
              <div class="form-group">
                <label for="check-country">City</label>
                <input type="text" class="form-control" id="check-email" placeholder="Enter country">
              </div>
              <button id="check-proceed1" type="submit" class="btn">Proceed</button>
              <div class="">
                <h3 style="text-align:left">Next steps</h3>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingThree">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <h3>Payment Details <br>
                <small>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus</small>
              </h3>

            </button>
          </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
          <div class="card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


</div>
