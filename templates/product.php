<?php

class View{

  function product_details_start($products, $tbc_to_peso){
    ?>
      <br>
      <div class="container product-div-1">
    <?php
        if (isset($_GET['action'])) {
          if ($_GET['action'] == "added") {
    ?>
            <div class="alert alert-info" role="alert" style="text-align:center">
                Item added in cart.
            </div>
    <?php
          }
          if ($_GET['action'] == "exists"){
    ?>
            <div class="alert alert-info" role="alert" style="text-align:center">
                Item already in cart.
            </div>
    <?php
          }
        }
    ?>
      <div class="col-md-7 product-image-outer">
          <div class="product-image">
    <?php
            if (file_exists('products/' . $products['Image'])) {?>
              <img <?php echo 'src="https://tbcmerchantservices.com/products/' . $products['Image'] . '"';?> >
    <?php
            } else {
    ?>
              <img <?php echo 'src="https://tbcmerchantservices.com/products/0000.jpg"';?> >
    <?php
            }
    ?>
        </div>
        </div>
        <div class="col-md-5 product-details">
          <h2>
            <b>
              <?php echo $products['Product_Name'];?>
          </b>
            <br>
            <small>
              <a href="https://tbcmerchantservices.com/shopping/">Back to shopping
              </a>
            </small>
          </h2>
          <h3 style="color:red">
            <b>
              <?php echo '&#8369;' . number_format($products['Product_Price'], 2);?>
          </b>
            <br>
            <small>(
              <?php echo number_format($products['Product_Price'] / $tbc_to_peso, 8);?> TBC)
            </small>
          </h3>
          <br>
    <?php
  }

  function product_forms($product){
    ?>
      <div class="div-shop">
        <form class="add-to-cart-form">
          <input id="quantity" type="number" name="quantity" value="1" hidden>
          <input id = "product" type="number" name="product" value='<?php echo $product;?>' hidden>
          <button type="submit" id = "btn-add-to-cart" class="btn  btn-md btn-add-to-cart">Add to Cart
          </button>
        </form>
        <a href= "" class="btn btn-md btn-checkout" onclick="alert('This is not yet available')">Go to Checkout
        </a>
      </div>
    <?php
  }

  function product_merchant_details($main_info, $personal, $is_member){
    if($is_member == 1){
  ?>
      <div class="div-merchant-details">
        <h4>Merchant Name:
          <b>
            <?php echo $main_info['Business_Name'];?>
        </b>
        </h4>
        <h4>Email:
          <b>
            <?php echo $main_info['Email'];?>
        </b>
        </h4>
        <h4>Seller Name:
          <b>
            <?php echo $personal['Fname'] . ' ' . $personal['Lname'];?>
        </b>
        </h4>
        <h4>Cell #:
          <b>
            <?php echo $personal['Cellphone'];?>
        </b>
        </h4>
        <br>
      </div>
    </div>
  <?php
    }else{
  ?>
      <div class="div-merchant-details">
        <h4>Merchant Name:
          <b>
            <?php echo $main_info['Business_Name'];?>
        </b>
        </h4>
        <h4>Seller Name:
          <b>
            <?php echo $personal['Fname'] . ' ' . $personal['Lname'];?>
        </b>
        </h4>
      </div>
    </div>
  <?php
    }
  }

  function product_description($products){
  ?>
    <div class="container">
      <div class="col-md-7 col-12 product-div-2">
        <h5>
          <?php echo nl2br($products['Product_Description']);?>
      </h5>
        <br>
        <br>
      </div>
    </div>
  <?php
  }

  function floating_cart(){
  ?>
    <a href="https://tbcmerchantservices.com/cart/" class="float">
      <i class="fa fa-shopping-cart fa-lg my-float">
      </i>
    </a>
  <?php
  }

  function missingProduct(){
    ?>
      <div class="container">
        <div class="row" >
          <div class="div-empty">
            <img src="https://tbcmerchantservices.com/images/empty_cart.png" alt="">
          </div>
        </div>
        <div class="row" style="text-align:center">
          <b>
            <h1> Uh Oh! Looks like this product is
              <span style="color:#F11C30">unavailable.
              </span>.
            </h1>
          </b>
          <br>
          <p>This product may have been deleted by the administrator or the merchant.
            <br>
            You can find other amazing products in the TBCMS shopping page.
          </p>
        </div>
        <div class="row">
          <div class="div-go-back">
            <a href="https://tbcmerchantservices.com/shopping" class="btn btn-md btn-add-to-cart">Back to shopping
            </a>
            <br>
          </div>
        </div>
      </div>
    <?php
  }
}

?>
