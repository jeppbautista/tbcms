<?php
session_start();
include 'class2.php';
$class=new mydesign;
$class->database_connect();

date_default_timezone_set('Asia/Manila');
$sessiondate=date('mdY');
$GLOBALS['test'] = 0;

if (isset($_GET['test'])) {
    $GLOBALS['test'] = 1;
}

if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
  header("location: https://tbcmerchantservices.com/welcome/");
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

include 'nav_shop.php';
include_once 'objects/product.php';

if(count($_SESSION['cart'])>0){
  $product_ids = array();
  foreach($_SESSION['cart'] as $id=>$value){
    array_push($product_ids, $id);
  }
  $query = readByID($product_ids);
  $rs = mysql_query($query);
  while($row = mysql_fetch_assoc($rs)) {
    ?>
    <div class="container">
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
						<tr>
							<td data-th="Product">
								<div class="rowdds">
									<div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
									<div class="col-sm-10">
										<h4 class="nomargin"> <?php echo $row['Product_Name']; ?> </h4>
										<p> <?php echo mb_strimwidth($row['Product_Description'], 0, 150, "..."); ?> </p>
									</div>
								</div>
							</td>
							<td data-th="Price"> <?php echo $row['Product_Price'] . " PHP" ?>  </td>
							<td data-th="Quantity">
								<input type="number" class="form-control text-center" value="1">
							</td>
							<td data-th="Subtotal" class="text-center">1.99</td>
							<td class="actions" data-th="">
								<button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
								<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
							</td>
						</tr>
					</tbody>

    <?php
    echo "<br><br>";
  }
  ?>
  <tfoot>
    <tr class="visible-xs">
      <td class="text-center"><strong>Total 1.99</strong></td>
    </tr>
    <tr>
      <td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
      <td colspan="2" class="hidden-xs"></td>
      <td class="hidden-xs text-center"><strong>Total $1.99</strong></td>
      <td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
    </tr>
  </tfoot>
</table>
</div>
  <?php
}
else{
  #TODO empty cart
}

 ?>
