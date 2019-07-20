<?php
  function container_start(){
    ?>
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
      <div class="col-12 col-md-8">
        <h2 id="header_text"><?php echo $text ?></h2>
        <h1 id="checkout-finished" style="display:none">Order Completed</h1>
      </div>
    </div>
    <?php
  }

  function checkout_steps_head(){
    ?>
    <div class="row">
      <?php checkout_steps_head_hidden(); ?>
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
            <h3 class="" style="font-weight: bold"> <small>Step 1:</small> Details <i class="fa fa-check-circle-o fa-lg"></i> <i class="fa fa-times-circle fa-lg"></i>
            </h3>
          </button>
          <p class="subtitle">Enter your email address and/or contact number to receive updates regarding your order.</p>

        </h5>
        <br>
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
    <?php
  }

  function shipping_card(){
    ?>

    <div class="card">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed btn-coll" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <h3><small>Step 2:</small> Shipping & delivery <i class="fa fa-check-circle-o fa-lg"></i> <i class="fa fa-times-circle fa-lg"></i>
            </h3>
          </button>
          <p class="subtitle">Select how you would like to receive your order.</p>
        </h5>
        <br>

      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
          <form class="form-shipping">
            <div class="form-group col-12 col-md-12">
              <label for="check-fullname">Full name</label>
              <input type="text" class="form-control" id="check-fullname" placeholder="Enter full name">
            </div>
            <div class="form-group col-12 col-md-12">
              <label for="check-address">Address <small>(House No., Street, Subdivision)</small> </label>
              <input type="text" class="form-control" id="check-address" placeholder="Enter address">
            </div>
            <div class="form-group col-12 col-md-12 ">
              <label for="check-region">Region</label>
              <input type="text" class="form-control" id="check-region" placeholder="Enter region">
            </div>
            <div class="form-group col-12 col-md-6">
              <label for="check-city">City</label>
              <input type="text" class="form-control" id="check-city" placeholder="Enter city">
            </div>
            <div class="form-group col-12 col-md-6">
              <label for="check-brgy">Brgy.</label>
              <input type="text" class="form-control" id="check-brgy" placeholder="Enter brgy.">
            </div>

            <div class="form-group col-12 col-md-12">
              <label for="check-others">Other notes <small>(Landmarks, markers, etc.)</small> </label>
              <textarea class="form-control rounded-0" id="check-others" rows="2"></textarea>
            </div>

            <button id="check-proceed1" type="submit" class="btn">Proceed</button>
            <div class="">
              <h4 style="text-align:left">Next steps</h4>
            </div>
          </form>
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
            <h3><small>Step 3:</small> Payment details <i class="fa fa-check-circle-o fa-lg"></i> <i class="fa fa-times-circle fa-lg"></i>
            </h3>
          </button>
          <p class="subtitle">Choose a payment method and enter your payment details.</p>
        </h5>
        <br>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
        <div class="card-body">

            <form class="radio-form">


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
            </form>
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

                  <form class="form-payment-paypal">
                    <div class="txt-transaction" id="trans-paypal">
                      <div class="input-group" style="z-index:0">
                        <input type="text" class="form-control" id="txt-trans-paypal" placeholder="Transaction number here">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button">
                            Submit
                          </button>
                        </span>
                      </div>
                    </div>
                  </form>
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
                  <form class="form-payment-coinsph">
                    <div class="txt-transaction" id="trans-paypal">
                      <div class="input-group" style="z-index:0">
                        <input type="text" class="form-control" id="txt-trans-coinsph" placeholder="Transaction number here">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button">
                            Submit
                          </button>
                        </span>
                      </div>
                    </div>
                  </form>
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
                  <form class="form-payment-gcash">
                    <div class="txt-transaction" id="trans-gcash">
                      <div class="input-group" style="z-index:0">
                        <input type="text" class="form-control" id="txt-trans-gcash" placeholder="Transaction number here">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button">
                            Submit
                          </button>
                        </span>
                      </div>
                    </div>
                  </form>
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
                  <form class="form-payment-kringle">
                    <div class="txt-transaction" id="trans-kringle">
                      <div class="input-group" style="z-index:0">
                        <input type="text" class="form-control" id="txt-trans-kringle" placeholder="Transaction number here">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button">
                            Submit
                          </button>
                        </span>
                      </div>
                    </div>
                  </form>
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
            <h3><small>Step 4:</small> Order confirmation <i class="fa fa-check-circle-o fa-lg"></i> <i class="fa fa-times-circle fa-lg"></i>
            </h3>

          </button>
          <p class="subtitle">Place your order and receive a confirmation email.</p>

        </h5>
      </div>
      <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
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
      <h4 style="font-weight">Your orders (<a href="https://tbcmerchantservices.com/cart/">edit</a>) </h4>
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
    <?php
  }

  function div_end(){
  ?>
  </div>
    </div>
    <?php
  }

  function checkout_steps_head_hidden(){
    ?>
    <div class="div-order-final col-12 col-md-8" style="display:none">
      <div class="" >

      </div>
    </div>

    <?php
  }
?>
