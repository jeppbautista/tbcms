
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
$total = 0.0;
$tax = 0.0;
$shipping = 0.0;

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

include 'nav_shop.php';
include_once 'objects/product.php';

if(count($_SESSION['cart'])>0){
  $product_ids = array();
  foreach($_SESSION['cart'] as $id=>$value){
    array_push($product_ids, $id);
  }
  $query = readByID($product_ids);
  $rs = mysql_query($query);
  ?>
  <div class="" style="width:96%; margin:auto;">
    <div class="col-12">
      <h2 style="text-align:left">Shopping Cart</h2>
    </div>
    <div class="col-12 col-md-8">

      <br>
      <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
              <th style="width:50%">Product</th>
              <th style="width:10%">Price</th>
              <th style="width:8%">Quantity</th>
              <th style="width:22%" class="text-center">Subtotal</th>
              <th style="width:10%"></th>
            </tr>
          </thead>
          <tbody>

    <?php
    while($row = mysql_fetch_assoc($rs)) {
      $sub_total = floatval($_SESSION['cart'][$row['Ctr']]['quantity'] * $row['Product_Price']);
      $total += $sub_total;
      ?>
              <tr>
                <td data-th="Product">
                  <div class="rowdds">
                    <div class="col-sm-2 hidden-xs">
                      <a href=href='<?php echo "https://tbcmerchantservices.com/item/?product=".$row['Ctr'] ?>'>
                        <img src='<?php echo "https://tbcmerchantservices.com/products/".$row['Image'] ?>' alt="..." class="img-responsive"/>
                      </a>
                    </div>
                    <div class="col-sm-10">
                      <h4 class="nomargin"> <a href='<?php echo "https://tbcmerchantservices.com/item/?product=".$row['Ctr'] ?>'> <?php echo $row['Product_Name']; ?></a>  </h4>
                      <p class="hidden-xs"> <?php echo mb_strimwidth($row['Product_Description'], 0, 120, "..."); ?> </p>
                    </div>
                  </div>
                </td>
                <td id='<?php echo "price-".$row["Ctr"] ?>' data-th="Price" >
                  <span>&#8369;</span> <b><?php echo number_format($row['Product_Price'], 2); ?> </b>
                </td>
                <td data-th="Quantity">
                  <input id='<?php echo "quantity-".$row["Ctr"] ?>' type="number" class="form-control text-center quantity-field" value="1" min="1">
                </td>
                <td id='<?php echo "subtotal-".$row["Ctr"] ?>' data-th="Subtotal" class="text-center">
                  <span>&#8369;</span><b>  <?php echo number_format($sub_total, 2) ?>  </b>
                </td>
                <td class="actions" data-th="">
                  <a href=<?php echo "https://tbcmerchantservices.com/delete_from_cart.php?id=".$row["Ctr"] ?> class="btn btn-sm delete-btn" id='<?php echo "delete-".$row["Ctr"]; ?>' ><i class="fa fa-times-circle fa-2x"></i></a>
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
        <td><a href="#" ><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
        <td colspan="2" class="hidden-xs"></td>
        <td></td>
        <!-- <td class="hidden-xs text-center"><strong>Total <span>&#8369;</span> <?php echo number_format($total,2); ?> </strong></td> -->
        <td><a href="#" class="btn btn-block btn-checkout">Checkout <i class="fa fa-angle-right"></i></a></td>
      </tr>
    </tfoot>
    </table>

    <hr>

    <!-- <div class="row">
    <div class="col-12 col-md-6">
      <div id="discount">
        <h5 style="text-align:left">ENTER YOUR DISCOUNT CODE</h5>
        <div class="input-group">
          <div class="form-group has-feedback has-clear">
            <input type="text" class="form-control" id="discount-text" placeholder="">
            <span class="form-control-clear glyphicon glyphicon-remove form-control-feedback hidden"></span>
          </div>
          <span class="input-group-btn">
            <button type="button" class="btn" id="discount-btn" onclick="alert('Invalid discount code')">Enter</button>
          </span>
        </div>
      </div>
    </div>
    </div> -->

    </div>

    <div class="col-12 col-md-4">
    <table id="summary" class="table table-hover table-condensed">
      <thead>
        <tr>
          <th colspan="2" style="width:100%"> <h4 id="summary-header">ORDER SUMMARY</h4> </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width:65%"> <h5> <b>Subtotal</b> </h5> </td>
          <td id="summ-subtotal" style="width:35%"><h5>
            <span>&#8369;</span> <b><?php echo number_format($total, 2); ?></b>  </h5></td>
        </tr>
        <tr>
          <td> <h5> <b>Tax</b> </h5> </td>
          <td id="summ-tax">
            <h5>
            <span>&#8369;</span> <b><?php echo number_format($tax,2); ?></b>  </h5></td>
        </tr>
        <tr>
          <td> <h5> <b>Shipping fee</b> </h5> </td>
          <td id="summ-shipping"><h5>
            <span>&#8369;</span> <b><?php echo number_format($shipping,2); ?></b>  </h5></td>
        </tr>
        <tr id="summary-total">
          <td > <h4> <b>Total</b> </h4> </td>
          <td id="summ-total" ><h4>
            <span>&#8369;</span> <b><?php echo number_format($total+$tax+$shipping,2);?> </b></h4>
          </td>
        </tr>
      </tbody>
    </table>
    </div>
  </div>

  <?php
}
else{
?>
  <div class="container">
    <div class="row" >
      <div class="div-empty">
        <img src="https://tbcmerchantservices.com/images/empty_cart.png" alt="">
      </div>
    </div>
    <div class="row" style="text-align:center">
      <b><h1> Uh Oh! Looks like your cart is <span style="color:#F11C30">empty</span>.</h1></b>
      <br>
      <p>You must first add items to your shopping cart before proceeding to checkout. <br>
         You can find amazing products in the TBCMS shopping page.</p>
    </div>
    <div class="row">
      <div class="div-go-back">
        <a href="https://tbcmerchantservices.com/shopping" class="btn btn-md btn-add-to-cart">Back to shopping</a> <br>
      </div>
    </div>
  </div>
<?php
}
$class->page_welcome_header_content_start_footer();
$class->body_end();
$class->html_end();
 ?>
