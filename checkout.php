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
$page_title = "Checkout";
$class->title_page($page_title);
$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
$class->link('https://fonts.googleapis.com/css?family=Noto+Sans|Open+Sans&display=swap');
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

include_once 'objects/product.php';

?>

<style>
  html {
      overflow-y:scroll;
  }
  body {
    background-color: #F8F8F8;
  }
</style>

<div class="container-fluid" style="width:82%">
  <div class="row">
    <div class="col-12 col-md-8">
      <h2>Checkout Page</h2>
    </div>
  </div>
  <div class="row">

    <div class="col-12 col-md-8 div-steps shadow">
      <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link btn-coll" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <h3 class="" style="font-weight: bold"> <small>Step 1:</small> Details <i class="fa fa-check-circle-o fa-lg"></i> <i class="fa fa-times-circle fa-lg"></i>
                </h3>
              </button>
              <p class="subtitle">Enter your email address and/or contact number to receive updates regarding your order.</p>

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
                  <label for="check-phone">Phone number</label>
                  <input type="text" class="form-control" id="check-phone" placeholder="+639123456789">
                </div>
                <button id="check-proceed1" type="submit" class="btn">Proceed</button>
                <span style="width:50%; text-align:right"> <small>All information submitted are secured.</small> </span>
                <div class="">
                  <h4 style="text-align:left">Next steps</h4>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed btn-coll" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <h3><small>Step 2:</small> Shipping & delivery <i class="fa fa-check-circle-o fa-lg"></i> <i class="fa fa-times-circle fa-lg"></i>
                </h3>
              </button>
              <p class="subtitle">Select how you would like to receive your order.</p>

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
                  <input type="text" class="form-control" id="check-email" placeholder="Enter full name">
                </div>
                <div class="form-group">
                  <label for="check-country">Address</label>
                  <input type="text" class="form-control" id="check-email" placeholder="Enter address">
                </div>
                <div class="form-group">
                  <label for="check-country">City</label>
                  <input type="text" class="form-control" id="check-email" placeholder="Enter city">
                </div>
                <button id="check-proceed1" type="submit" class="btn">Proceed</button>
                <div class="">
                  <h4 style="text-align:left">Next steps</h4>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed btn-coll" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <h3><small>Step 3:</small> Payment details <i class="fa fa-check-circle-o fa-lg"></i> <i class="fa fa-times-circle fa-lg"></i>
                </h3>

              </button>
              <p class="subtitle">Choose a payment method and enter your payment details.</p>

            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">

                <form class="radio-form">
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="defaultGroupExample1" name="groupOfDefaultRadios">
                    <label class="custom-control-label" for="defaultGroupExample1">Option 1</label>
                  </div>

                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="defaultGroupExample2" name="groupOfDefaultRadios" checked>
                    <label class="custom-control-label" for="defaultGroupExample2">Option 2</label>
                  </div>

                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="defaultGroupExample3" name="groupOfDefaultRadios">
                    <label class="custom-control-label" for="defaultGroupExample3">Option 3</label>
                  </div>
                </form>

              <div class="">
                <h4 style="text-align:left">Next steps</h4>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header" id="headingFour">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed btn-coll" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <h3><small>Step 4:</small> Order confirmation <i class="fa fa-check-circle-o fa-lg"></i> <i class="fa fa-times-circle fa-lg"></i>
                </h3>

              </button>
              <p class="subtitle">Place your order and receive a confirmation email.</p>

            </h5>
          </div>
          <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
            <div class="card-body">
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              <div class="">
                <h4 style="text-align:left">Next steps</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4 div-check-cart">
      <h4 style="font-weight">Your orders (<a href="https://tbcmerchantservices.com/cart/">edit</a>) </h4>
      <table id="check-cart" class="table table-hover table-condensed">
            <thead>
            <tr>

            </tr>
          </thead>
          <tbody>

    <?php
    $product_ids = array();
    foreach($_SESSION['cart'] as $id=>$value){
      array_push($product_ids, $id);
    }
    $query = readByID($product_ids);
    $rs = mysql_query($query);
    while($row = mysql_fetch_assoc($rs)) {
      $sub_total = floatval($_SESSION['cart'][$row['Ctr']]['quantity'] * $row['Product_Price']);
      $total += $sub_total;
      ?>
              <tr>
                <td data-th="Product" style="width:65%">
                  <div class="rowdds">
                    <div class="col-sm-2 hidden-xs">
                      <a href=href='<?php echo "https://tbcmerchantservices.com/item/?product=".$row['Ctr'] ?>'>
                        <img src='<?php echo "https://tbcmerchantservices.com/products/".$row['Image'] ?>' alt="..." class="img-responsive"/>
                      </a>
                    </div>
                    <div class="col-sm-10">
                      <h5 style="text-align:left" class="nomargin"> <a href='<?php echo "https://tbcmerchantservices.com/item/?product=".$row['Ctr'] ?>'> <?php echo $row['Product_Name']; ?></a>
<br>
                        <small>Quantity: <?php echo $_SESSION['cart'][$row['Ctr']]['quantity']; ?></small>
                      </h5>
                    </div>
                  </div>
                </td>
                <td id='<?php echo "subtotal-".$row["Ctr"] ?>' data-th="Subtotal" class="text-left" style="width:35%">
                  <span>&#8369;</span><b>  <?php echo number_format($sub_total, 2) ?>  </b>
                </td>

              </tr>
      <?php
    }
    ?>
    </tbody>

    <tfoot>
      <!-- <tr class="visible-xs">
        <td class="text-center"><strong> Total <span>&#8369;</span> <?php echo number_format($total,2); ?></strong></td>
      </tr> -->
      <tr>
        <td>
          <div class="col-sm-2">
          </div>
          <div class="col-sm-10">
            <strong>Total</strong> </td>
          </div>
        <td class="text-left"><strong> <span>&#8369;</span> <?php echo number_format($total,2); ?></strong></td>
      </tr>
    </tfoot>
    </table>
    </div>
  </div>
</div>

<?php
$class->page_welcome_header_content_start_footer();
$class->body_end();
$class->html_end();
?>

<!-- 
if (isset($_POST['txtitem_quantity']) && isset($_POST['txtitem_quantityandamounta']) && isset($_POST['txtitem_quantityandamountc']) && isset($_POST['txtitem_totalprice']) && isset($_POST['txtitem_name']) && isset($_POST['txtitem_addressn']) && isset($_POST['txtitem_number']) && isset($_POST['txtitem_idena']) && isset($_POST['txtitem_idenc']) && isset($_POST['txtitem_persida']) && isset($_POST['txtitem_persidc'])) {
    $txtitem_quantity           = str_replace("'", '', $_POST['txtitem_quantity']);
    $txtitem_quantity           = str_replace('"', '', $txtitem_quantity);
    $txtitem_quantity           = str_replace("<", '', $txtitem_quantity);
    $txtitem_quantity           = str_replace('>', '', $txtitem_quantity);
    $txtitem_quantity           = str_replace('.', '', $txtitem_quantity);
    $txtitem_quantityandamounta = str_replace("'", '', $_POST['txtitem_quantityandamounta']);
    $txtitem_quantityandamounta = str_replace('"', '', $txtitem_quantityandamounta);
    $txtitem_quantityandamounta = str_replace("<", '', $txtitem_quantityandamounta);
    $txtitem_quantityandamounta = str_replace('>', '', $txtitem_quantityandamounta);
    $txtitem_totalprice         = str_replace("'", '', $_POST['txtitem_totalprice']);
    $txtitem_totalprice         = str_replace('"', '', $txtitem_totalprice);
    $txtitem_totalprice         = str_replace("<", '', $txtitem_totalprice);
    $txtitem_totalprice         = str_replace('>', '', $txtitem_totalprice);
    $txtitem_name               = str_replace("'", '', $_POST['txtitem_name']);
    $txtitem_name               = str_replace('"', '', $txtitem_name);
    $txtitem_name               = str_replace("<", '', $txtitem_name);
    $txtitem_name               = str_replace('>', '', $txtitem_name);
    $txtitem_address            = str_replace("'", '', $_POST['txtitem_addressn']);
    $txtitem_address            = str_replace('"', '', $txtitem_address);
    $txtitem_address            = str_replace("<", '', $txtitem_address);
    $txtitem_address            = str_replace('>', '', $txtitem_address);
    $txtitem_number             = str_replace("'", '', $_POST['txtitem_number']);
    $txtitem_number             = str_replace('"', '', $txtitem_number);
    $txtitem_number             = str_replace("<", '', $txtitem_number);
    $txtitem_number             = str_replace('>', '', $txtitem_number);
    $txtitem_idena              = str_replace("'", '', $_POST['txtitem_idena']);
    $txtitem_idena              = str_replace('"', '', $txtitem_idena);
    $txtitem_idena              = str_replace("<", '', $txtitem_idena);
    $txtitem_idena              = str_replace('>', '', $txtitem_idena);
    $txtitem_idenc              = str_replace("'", '', $_POST['txtitem_idenc']);
    $txtitem_idenc              = str_replace('"', '', $txtitem_idenc);
    $txtitem_idenc              = str_replace("<", '', $txtitem_idenc);
    $txtitem_idenc              = str_replace('>', '', $txtitem_idenc);
    $txtitem_persida            = str_replace("'", '', $_POST['txtitem_persida']);
    $txtitem_persida            = str_replace('"', '', $txtitem_persida);
    $txtitem_persida            = str_replace("<", '', $txtitem_persida);
    $txtitem_persida            = str_replace('>', '', $txtitem_persida);
    $txtitem_persidc            = str_replace("'", '', $_POST['txtitem_persidc']);
    $txtitem_persidc            = str_replace('"', '', $txtitem_persidc);
    $txtitem_persidc            = str_replace("<", '', $txtitem_persidc);
    $txtitem_persidc            = str_replace('>', '', $txtitem_persidc);
    if (!is_numeric($txtitem_quantity)) {
        $error = "<span style='color:red'>Quantity not Valid</span>";
    } else if (!is_numeric($txtitem_quantityandamounta)) {
        $error = "<span style='color:red'>Some Error Occured</span>";
    } else if ($_POST['txtitem_quantityandamountc'] != md5(md5($txtitem_quantityandamounta))) {
        $error = "<span style='color:red'>Some Error Occured</span>";
    } else if ($txtitem_totalprice != ($txtitem_quantity * $txtitem_quantityandamounta)) {
        $error = "<span style='color:red'>Some Error Occured</span>";
    } else if ($txtitem_name == "" || strlen($txtitem_name) < 4) {
        $error = "<span style='color:red'>Name must atleast 4 Characters</span>";
    } else if ($txtitem_address == "" || strlen($txtitem_address) < 10) {
        $error = "<span style='color:red'>Address must atleast 10 Characters</span>";
    } else if ($txtitem_number == "" || strlen($txtitem_number) < 5) {
        $error = "<span style='color:red'>Contact No. must atleast 5 Characters</span>";
    } else if ($txtitem_persidc != md5(md5($txtitem_persida))) {
        $error = "<span style='color:red'>Some Error Occured 1001</span>";
    } else if ($txtitem_idenc != md5(md5($txtitem_idena))) {
        $error = "<span style='color:red'>Some Error Occured 1002</span>";
    } else if ($ctr == $txtitem_persida) {
        $error = "<span style='color:red'>You cant buy your own product</span>";
    } else {
        $txtitem_totalprice = $txtitem_quantity * $txtitem_quantityandamounta;
        $txtitem_totaltbc   = $txtitem_totalprice / $tbc_to_peso;
        $query              = "select * from xtbl_mytransaction" . $ctr . " WHERE Status='ACTIVE'";
        $rs                 = mysql_query($query);
        $my_amount          = 0;
        while ($row = mysql_fetch_assoc($rs)) {
            $my_amount = $my_amount + $row['Amount'];
        }
        if (($tbc_to_peso * $my_amount) < $txtitem_totalprice) {
            $error = "<span style='color:red'>Insufficient Balance</span>";
        } else {
            $trans_id = md5(md5($ctr) . md5(date('mdYHis'))) . md5(md5(date('mdYHis')) . md5($ctr));
            $query    = "
              insert into xtbl_product_request(
                From_Ctr,
                To_Ctr, Product_Ctr,
                Amount, Tbc_Value,
                Status, Quantity,
                Address, Name,
                Transact_Id,
                Datetime, Contact)
              values(
                '$ctr',
                '$txtitem_persida', '$txtitem_idena',
                '$txtitem_totalprice', '$txtitem_totaltbc',
                'Submitted', '$txtitem_quantity',
                '$txtitem_address', '$txtitem_name',
                '$trans_id',
                '" . date('Y-m-d H:i:s') . "', '$txtitem_number');";
            $rs       = @mysql_query($query);

            $query    = "
              insert into xtbl_mytransaction" . $ctr . " (
                Amount, Status,
                Transact_Id, Type,
                Date)
              values(
              '-$txtitem_totaltbc', 'ACTIVE',
              '$trans_id', 'SEND',
              '" . date('Y-m-d H:i:s') . "')";
            $rs       = @mysql_query($query);

            $query    = "
              insert into xtbl_mytransaction" . $txtitem_persida . " (
                Amount, Status,
                Transact_Id, Type,
                Date)
              values(
                '$txtitem_totaltbc', 'ACTIVE',
                '$trans_id', 'RECEIVE',
                '" . date('Y-m-d H:i:s') . "')";
            $rs       = @mysql_query($query);

            echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';
        }
    }
} -->
