<?php
  function container_start(){
    ?>
    <div class="container-fluid" style="width:82%">
    <?php
  }

  function header_text($text){
    ?>
    <div class="row">
      <div class="col-12 col-md-8">
        <h2><?php echo $text ?></h2>
      </div>
    </div>
    <?php
  }

  function checkout_steps_head(){
    ?>
    <div class="row">
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
    <?php
  }

  function order_card(){
    ?>
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

  function cart_foot(){
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
?>
