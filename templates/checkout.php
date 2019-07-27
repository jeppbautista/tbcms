<?php
  class View{
    
    function container_start(){
      ?>
      <form method="post">
        <input type="submit" name="btn-submit-payment" id="btn-submit-payment" hidden>
        <input type="text" name="txt-payment-type" id="txt-payment-type" hidden>
      <div class="container-fluid" >
      <?php
    }
  
    function checkout_navbar(){
      ?>
  
      <?php
    }
  
    function header_text($text){
      ?>
      <div class="row">
        <h1 class="table-header" id="checkout-finished" style="display:none">Order Completed</h1>
        <div class="col-12 col-md-8">
          <h2 id="header_text"><?php echo $text ?></h2>
        </div>
      </div>
      <?php
    }
  
    function checkout_steps_head(){
      ?>
      <div class="row">
        <?php $this->checkout_steps_head_hidden(); ?>
        <div class="col-12 col-md-8 div-steps shadow">
          <div class="accordion" id="accordionExample">
      <?php
    }
  
    function details_card(){
      ?>
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link btn-coll" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <h3 class="table-label" style="font-weight: bold"> <small>Step 1:</small> Details <i class="fa fa-check-circle-o fa-lg"></i> <i class="fa fa-times-circle fa-lg"></i>
              </h3>
            </button>
            <p class="subtitle">Enter your email address and/or contact number to receive updates regarding your order.</p>
  
          </h5>
          <br>
        </div>
  
        <div id="collapseOne" class="collapse in" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
              <div class="form-group col-12 col-md-12">
                <label for="check-email">Email address</label>
                <input value="jeppbautista@gmail.com" type="email" class="form-control" name="check-email" id="check-email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group col-12 col-md-12">
                <label for="check-phone">Phone number</label>
                <input value="123" type="text" class="form-control" name="check-phone" id="check-phone" placeholder="+639123456789">
              </div>
            <button id="check-proceed1"  class="btn check-proceed" type="button">Proceed</button>
              <span style="width:50%; text-align:right"> <small>All information submitted are secured.</small> </span>
              <div class="">
                <h4 style="text-align:left">Next steps</h4>
              </div>
          </div>
        </div>
      </div>
      <?php
    }
  
    function shipping_card(){
      ?>
  
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed btn-coll" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <h3 class="table-label"><small>Step 2:</small> Shipping & delivery <i class="fa fa-check-circle-o fa-lg"></i> <i class="fa fa-times-circle fa-lg"></i>
              </h3>
            </button>
            <p class="subtitle">Select how you would like to receive your order.</p>
          </h5>
          <br>
  
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
              <div class="form-group col-12 col-md-6">
                <label for="check-lastname">Last name</label>
                <input value="fullasd" type="text" class="form-control" name="check-lastname" id="check-lastname" placeholder="Enter last name">
              </div>
              <div class="form-group col-12 col-md-6">
                <label for="check-firstname">First name</label>
                <input value="fullasxxd" type="text" class="form-control" name="check-firstname" id="check-firstname" placeholder="Enter first name">
              </div>
              <div class="form-group col-12 col-md-12">
                <label for="check-address">Address <small>(House No., Street, Subdivision, Brgy., etc.)</small> </label>
                <input value="addr1" type="text" class="form-control" name="check-address" id="check-address" placeholder="Enter address">
              </div>
              <div class="form-group col-12 col-md-12 ">
                <label for="check-country">Country</label>
                <input value="Ph" type="text" class="form-control" name="check-country" id="check-country" placeholder="Enter country">
              </div>
              <div class="form-group col-12 col-md-12">
                <label for="check-city">City</label>
                <input value="QC" type="text" class="form-control" name="check-city" id="check-city" placeholder="Enter city">
              </div>
              <!-- <div class="form-group col-12 col-md-6">
                <label for="check-brgy">Brgy.</label>
                <input type="text" class="form-control" id="check-brgy" placeholder="Enter brgy.">
              </div> -->
  
              <div class="form-group col-12 col-md-12">
                <label for="check-others">Other notes <small>(Landmarks, markers, etc.)</small> </label>
                <textarea class="form-control rounded-0" name="check-others" id="check-others" rows="2"></textarea>
              </div>
            <button id="check-proceed2" class="btn check-proceed" type="button">Proceed</button>
              <div class="">
                <h4 style="text-align:left">Next steps</h4>
              </div>
          </div>
        </div>
      </div>
  
      <?php
    }
  
    function payment_card(){
      ?>
      <div class="card">
        <div class="card-header" id="headingThree">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed btn-coll" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <h3 class="table-label"><small>Step 3:</small> Payment and Confirmation <i class="fa fa-check-circle-o fa-lg"></i> <i class="fa fa-times-circle fa-lg"></i>
              </h3>
            </button>
            <p class="subtitle">Choose a payment method and place your order.</p>
          </h5>
          <br>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
          <div class="card-body">
  
  
                <!-- <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" id="pay-cod" name="groupOfDefaultRadios">
                  <label class="custom-control-label" for="pay-cod">Cash on Delivery</label>
                </div> -->
  
                <div class="custom-control custom-radio" style="border: 2px solid #214E11; background: #F6F6EE;">
                  <input type="radio" class="custom-control-input"  id="pay-paypal" name="groupOfDefaultRadios" checked>
                  <label class="custom-control-label" for="pay-paypal">Paypal</label>
                  <span>
                    <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_37x23.jpg" border="0" alt="PayPal">
                  </span>
  
                </div>
  
                <div class="custom-control custom-radio" >
                  <input type="radio" class="custom-control-input" id="pay-coinsph" name="groupOfDefaultRadios" >
                  <label class="custom-control-label" for="pay-coinsph">Coins.PH</label>
                  <span>
                    <img src="https://tbcmerchantservices.com/images/coinsph2.png" border="0" alt="Coins.PH">
                  </span>
  
                </div>
  
                <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" id="pay-gcash" name="groupOfDefaultRadios" >
                  <label class="custom-control-label" for="pay-gcash">GCash</label>
                  <span>
                    <img src="https://tbcmerchantservices.com/images/gcash.png" border="0" alt="Gcash">
                  </span>
                </div>
  
                <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" id="pay-kringle" name="groupOfDefaultRadios">
                  <label class="custom-control-label" for="pay-kringle">Kringle Cash</label>
                  <span>
                    <img src="https://tbcmerchantservices.com/images/kringle.png" border="0" alt="Kringle">
                  </span>
                </div>
              <br>
  
              <div class="">
                <div class="div-pay">
  
                  <!-- <div class="order-div" id="order-cod" for="pay-cod">
                    Pay COD
                  </div> -->
  
                  <!-- Paypal -->
                  <div class="order-div" id="order-paypal" for="pay-paypal" style="display:block">
                    <!-- <div id="paypal-button-container"></div> -->
                    <b> <p>Payment Instructions:</p> </b>
  
                    <ol>
                      <li>Click the <b>Paypal</b> button below.</li>
  
                      <li>Proceed to your Paypal Payment.</li>
                      <li>Copy the <b>Transaction number</b> and paste it in the field below.</li>
                    </ol>
                    <br>
  
                    <table border="0" cellpadding="10" cellspacing="0" align="center">
                      <tr><td align="center"></td></tr>
                      <tr>
                        <td align="center"><a href="https://www.paypal.me/tbcmerchantservices" title="How PayPal Works"
                          onclick="javascript:window.open('https://www.paypal.me/tbcmerchantservices','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;">
                          <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-large.png" alt="Buy now with PayPal" /><br>
                          <small style="text-decoration:none">You will be redirected to our paypal payment page.</small>
                        </td>
                      </tr>
                    </table>
                    <br>
  
                      <div class="txt-transaction" id="trans-paypal">
                        <div class="input-group" style="z-index:0">
                          <input type="text" class="form-control" name="txt-trans-paypal" id="txt-trans-paypal" placeholder="Transaction number here">
                          <span class="input-group-btn">
                            <button class="btn btn-primary btn-submit" type="button" id="paypal">
                              Submit
                            </button>
                          </span>
                        </div>
                      </div>
                    <br>
                  </div>
                  <!-- Paypal end -->
  
                  <!-- Coins.PH -->
                  <div class="order-div" id="order-coinsph" for="pay-coinsph">
                    <b>  <p>Payment Instructions</p> </b>
                    <ol>
                      <li>Scan the QR code below OR use the Coins.PH Wallet Address.</li>
                      <li>Proceed to Coins.PH payment.</li>
                      <li>Copy the <b>Transaction number</b> and paste it in the field below.</li>
                    </ol>
                    <br>
                    <!--
                      ========= BTC or PHP ===========
                    <div class="" style="text-align:center">
                      <label id="radio-coinsph-php" class="radio-inline">
                        <input class="coinsph-control-input" type="radio" name="optradio" for="qrcoins-php" checked>PHP</label>
                      <label id="radio-coinsph-btc" class="radio-inline">
                        <input class="coinsph-control-input" type="radio" name="optradio" for="qrcoins-btc">BTC</label>
                    </div> -->
                    <br>
                    <div class="div-qrcoins" style="text-align:center">
                      Scan the QR code:
                      <br>
                      <br>
                      <img style="visibility:visible" class="qrcode" id="qrcoins-php" src="https://tbcmerchantservices.com/images/qr-coinsph.png" alt="">
                      <img style="display:none" class="qrcode" id="qrcoins-btc" src="https://tbcmerchantservices.com/images/qr-coinsph-btc.png" alt="">
                      <br>
                      <p>OR</p>
                      <p>Copy the wallet address below and send your payment</p>
                      <b>3A9qBQkV9tu3zQ7cDosenG5ev3TyJ56CfG</b>
                    </div>
                    <br>
                      <div class="txt-transaction" id="trans-paypal">
                        <div class="input-group" style="z-index:0">
                          <input type="text" class="form-control" name="txt-trans-coinsph" id="txt-trans-coinsph" placeholder="Transaction number here">
                          <span class="input-group-btn">
                            <button class="btn btn-primary btn-submit" type="button" id="coinsph">
                              Submit
                            </button>
                          </span>
                        </div>
                      </div>
                    <br>
                  </div>
                  <!-- Coins.PH end -->
  
                  <!-- GCash -->
                  <div class="order-div" id="order-gcash" for="pay-gcash">
                    <b>  <p>Payment Instructions</p> </b>
                    <ol>
                      <li>Send the required amount to this mobile number: <b>09758680883</b>.</li>
                      <li>Copy the <b>Transaction number</b> and paste it in the field below.</li>
                    </ol>
                    <br>
                      <div class="txt-transaction" id="trans-gcash">
                        <div class="input-group" style="z-index:0">
                          <input type="text" class="form-control" name="txt-trans-gcash" id="txt-trans-gcash" placeholder="Transaction number here">
                          <span class="input-group-btn">
                            <button class="btn btn-primary btn-submit" type="button" id="gcash">
                              Submit
                            </button>
                          </span>
                        </div>
                      </div>
                    <br>
                  </div>
                  <!-- GCash end -->
  
                  <div class="order-div" id="order-kringle" for="pay-kringle">
                    <b>  <p>Payment Instructions</p> </b>
                    <ol>
                      <li>Scan the QR code below OR use the KRINGLE Wallet Address.</li>
                      <li>Proceed to KRINGLE payment.</li>
                      <li>Copy the <b>Transaction number</b> and paste it in the field below.</li>
                    </ol>
                    <br>
                    <br>
                    <div class="div-qrcoins" style="text-align:center">
                      Scan the QR code:
                      <br>
                      <img class="qrcode" id="qrcoins-btc" src="https://tbcmerchantservices.com/images/qr-coinsph-btc.png" alt="">
                      <br>
                      <p>OR</p>
                      <p>Copy the wallet address below and send your payment</p>
                      <b>NBGD3A-5BZ4B4-AUQ3XE-3I4B4Y-KX7C4I-OTAX5C-FZ36</b>
                    </div>
                    <br>
                      <div class="txt-transaction" id="trans-kringle">
                        <div class="input-group" style="z-index:0">
                          <input type="text" class="form-control" name="txt-trans-kringle" id="txt-trans-kringle" placeholder="Transaction number here">
                          <span class="input-group-btn">
                            <button class="btn btn-primary btn-submit" type="button" id="kirngle">
                              Submit
                            </button>
                          </span>
                        </div>
                      </div>
                    <br>
                  </div>
                </div>
                <br>
              </div>
  
  
            <div class="">
              <h4 style="text-align:left">Next steps</h4>
            </div>
          </div>
        </div>
      </div>
  
  
      <?php
    }
  
    function order_card(){
      ?>
      <div class="card">
        <div class="card-header" id="headingFour">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed btn-coll" id="btn-4" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              <h3 class="table-label">Complete Order <i class="fa fa-check-circle-o fa-lg"></i> <i class="fa fa-times-circle fa-lg"></i>
              </h3>
  
            </button>
            <p class="subtitle">Complete your order and receive a confirmation email.</p>
  
          </h5>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
          <div class="card-body">
            <div style="text-align:center">
              <h4>Please fill-up all the necessary forms.</h4>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
  
    function checkout_steps_foot(){
      ?>
        </div>
      </div>
      <?php
    }
  
    function cart_head(){
      ?>
      <div class="col-12 col-md-4 div-check-cart">
        <h4 class="table-header" style="font-weight">YOUR ORDERS (<a href="https://tbcmerchantservices.com/cart/">edit</a>) </h4>
        <table id="check-cart" class="table table-hover table-condensed">
          <thead>
          </thead>
          <tbody>
      <?php
    }
  
    function product_row($product, $sub_total){
      $id = $product['Ctr'];
      $quantity = $_SESSION['cart'][$product['Ctr']]['quantity'];
      $image = $product['Image'];
      $product_name = $product['Product_Name'];
      $product_desc = $product['Product_Description'];
      $product_price = $product['Product_Price'];
      ?>
      <tr>
        <td data-th="Product" style="width:65%">
          <div class="rowdds">
            <div class="col-sm-2 hidden-xs">
              <a href=href='<?php echo "https://tbcmerchantservices.com/item/?product=".$id?>'>
                <img src='<?php echo "https://tbcmerchantservices.com/products/".$image?>' alt="..." class="img-responsive"/>
              </a>
            </div>
            <div class="col-sm-10">
              <h5 style="text-align:left" class="nomargin">
                <a href='<?php echo "https://tbcmerchantservices.com/item/?product=".$id?>'>
                  <?php echo $product_name; ?>
                </a>
                <br>
                <small>Quantity: <?php echo $quantity; ?></small>
              </h5>
            </div>
          </div>
        </td>
        <td id='<?php echo "subtotal-".$id?>' data-th="Subtotal" class="text-left" style="width:35%">
          <span>&#8369;</span><b>  <?php echo number_format($sub_total, 2) ?>  </b>
        </td>
  
      </tr>
      <?php
    }
  
    function cart_foot($total){
      ?>
      </tbody>
      <tfoot>
        <tr>
          <td>
            <div class="col-sm-10">
              <strong>Total</strong> 
            </div>
          </td>
          <td class="text-left"><strong> <span>&#8369;</span> <?php echo number_format($total,2); ?></strong></td>
        </tr>
      </tfoot>
      </table>
  
      <br>
  
      <div class="div-discount shadow">
      <label for="txt-discount">Discount</label>
        <div class="input-group" style="z-index:0">
          <input type="text" class="form-control" name="txt-discount" id="txt-discount" placeholder="Discount code here">
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button" id="btn-discount">
                Submit
              </button>
            </span>
        </div>
      </div>
  
      </div>
      <?php
      $this->final_form_footer();
    }
  
    function div_end(){
      ?>
        </div>
        </div>
        </form>
      <?php
    }
  
    function final_header_message(){
      ?>
      <div class="div-order-final" style="display:none">
        <hr>
        <div class="row order-complete">
          <img src="https://tbcmerchantservices.com/images/order-complete.png" alt="">
          <br>
          <br>
          <p class="thankyou-message">THANK YOU FOR SHOPPING WITH US
          </p>
          <p class="message1">We have sent you an email/SMS about the confirmation of your order.
          </p>
          <p class="message1">We will send another email/SMS once we confirm your payment. Thank you for shopping with us.
          </p>
        </div>
        <hr>
      <?php
    }
  
    function final_customer_details(){
      ?>
        <div class="col-12 col-md-6 div-final-details" id="customer">
            <table class="table table-borderless table-condensed" id="details">
              <thead>
                <tr>
                  <th colspan="2">
                    <h4 class="table-header">CUSTOMER DETAILS
                    </h4>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="table-label" style="width: 25%">Email:
                  </td>
                  <td style="width: 75%" id="email"> <?php echo $_POST['check-email'] ?>
                  </td>
                </tr>
                <tr>
                  <td class="table-label">Phone:
                  </td>
                  <td><?php echo $_POST['check-phone'] ?>
                  </td>
                </tr>
              </tbody>
            </table>
            <hr>
            <table class="table table-borderless table-condensed" id="shipping">
              <thead>
                <tr>
                  <th>
                    <h4 class="table-header">SHIPPING TO
                    </h4>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td id="name"><?php echo $_POST['check-firstname'] . " " . $_POST['check-lastname'] ?>
                  </td>
                </tr>
                <tr>
                  <td id="address"> <?php echo $_POST['check-address'] ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
      <?php
    }
  
    function final_order_details(){
      ?>
        <div class="col-12 col-md-6 div-final-details" id="order">
            <table class="table table-borderless table-condensed" id="order">
              <thead>
                <tr>
                  <th colspan="2">
                    <h4 class="table-header">ORDER DETAILS
                    </h4>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="table-label" style="width: 40%">Order Number:
                  </td>
                  <td style="width: 60%" id="order-number"><?php echo "OR" . str_pad($_POST["orderNumber"], 10, "0", STR_PAD_LEFT); ?>
                  </td>
                </tr>
                <tr>
                  <td class="table-label">Type of payment:
                  </td>
                  <td id="payment-type"><?php echo $_POST["paymentType"]; ?>
                  </td>
                </tr>
                <tr>
                  <td class="table-label">Transaction Number:
                  </td>
                  <td id="payment-type"><?php echo $_POST["transactionNum"]; ?>
                  </td>
                </tr>
                <tr>
                  <td class="table-label">Date of transaction:
                  </td>
                  <td id="dot"><?php echo date_format($_POST["transactionDate"], "M d, Y"); ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
      <?php
    }
  
    function final_form_footer(){
      ?>
        <div class="row div-order-final" style="display:none">
          <div class="col-12 col-md-12">
            <div style="text-align:center">
            <br>
              <a class="btn" href="https://tbcmerchantservices.com/shopping/" style="font-size:18px; color:#C4A101; border: 1px solid #C4A101;">
                &larr; Back to shopping
              </a>
            </div>
          </div>
        </div>
        <br>
      <?php
    }
  
    function final_div(){
      ?>
        <div class="row div-order-final col-12 col-md-8" style="display:none">
          <br>
          <?php 
            $this->final_customer_details(); 
            $this->final_order_details();
            
          ?>
        </div>
      <?php
    }
  
    function checkout_steps_head_hidden(){
        $this->final_header_message();
        $this->final_div();
      ?>
      </div>
      <?php
  
    }
  }
  
?>
