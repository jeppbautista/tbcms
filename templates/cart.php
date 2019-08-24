<?php
  class View{
    
    function container_start(){
      ?>
      <div class="" style="width:96%; margin:auto;">
      <?php
    }
  
    function header_text($text){
      ?>
      <div class="col-12">
        <h2 style="text-align:left"> <?php echo $text ?>
        </h2>
      </div>
      <?php
    }
  
    function table_header(){
      ?>
      <div class="col-12 col-md-8">
        <form class="go-to-checkout-form" method="post">
          <br>
          <table id="cart" class="table table-hover table-condensed">
            <thead>
              <tr>
                <th style="width:50%">Product </th>
                <th style="width:10%">Price </th>
                <th style="width:8%">Quantity </th>
                <th style="width:22%" class="text-center">Subtotal </th>
                <th style="width:10%"> </th>
              </tr>
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
         <td data-th="Product">
           <div class="rowdds">
             <div class="col-sm-2 hidden-xs">
               <a href=href='<?php echo "https://tbcmerchantservices.com/item/?product=" . $id;?>'>
                 <img src='<?php echo "https://tbcmerchantservices.com/products/" . $image;?>' alt="..." class="img-responsive"/>
               </a>
             </div>
             <div class="col-sm-10">
               <h4 class="nomargin">
                 <a href='<?php echo "https://tbcmerchantservices.com/item/?product=" . $id;?>'>
                   <?php echo $product_name;?> </a>
               </h4>
               <p class="hidden-xs">
                 <?php echo mb_strimwidth($product_desc, 0, 120, "...");?>
               </p>
             </div>
           </div>
         </td>
         <td id='<?php echo "price-" . $id; ?>' data-th="Price" >
           <span>&#8369;</span>
           <b><?php echo number_format($product_price, 2);?></b>
         </td>
         <td data-th="Quantity">
           <input id='<?php echo "quantity-" . $id; ?>' type="number"
                  name='<?php echo "quantity-" . $id; ?>' type="number"
                  class="form-control text-center quantity-field" value='<?php echo $quantity;?>'
                  min="1">
         </td>
         <td id='<?php echo "subtotal-" . $id; ?>' data-th="Subtotal" class="text-center">
           <span>&#8369; </span>
           <b> <?php echo number_format($sub_total, 2); ?> </b>
         </td>
         <td class="actions" data-th="">
           <a href= <?php echo "https://tbcmerchantservices.com/delete_from_cart.php?id=" . $id; ?>
             class="btn btn-sm delete-btn" id='<?php echo "delete-" . $id;?>' >
             <i class="fa fa-times-circle fa-2x"> </i>
           </a>
       </td>
     </tr>
  
      <?php
    }
  
    function table_footer(){
      ?>
        </tbody>
        <tfoot>
         <tr>
           <td>
             <a href="https://tbcmerchantservices.com/shopping" >
               <i class="fa fa-angle-left"></i> Continue Shopping
             </a>
           </td>
           <td colspan="2" class="hidden-xs"> </td>
           <td>
             <button type="submit" id = "btn-go-to-checkout" name = "btn-go-to-checkout" class="btn btn-block btn-checkout">Checkout
               <i class="fa fa-angle-right"> </i>
             </button>
           </td>
         </tr>
       </tfoot>
       </table>
      </form>
      <hr>
    </div>
      <?php
    }
  
    function order_summary($total, $tax, $shipping){
      ?>
      <div class="col-12 col-md-4">
        <table id="summary" class="table table-hover table-condensed">
          <thead>
            <tr>
              <th colspan="2" style="width:100%">
                <h4 id="summary-header">ORDER SUMMARY
                </h4>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="width:65%">
                <h5>
                  Subtotal
                </h5>
              </td>
              <td id="summ-subtotal" style="width:35%">
                <h5>
                  <span>&#8369;
                  </span>
                  <b>
                    <?php echo number_format($total, 2);?>
                 </b>
                </h5>
              </td>
            </tr>
            <tr>
              <td>
                <h5>
                  <b>Tax
                  </b>
                </h5>
              </td>
              <td id="summ-tax">
                <h5>
                  <span>&#8369;
                  </span>
                  <b>
                    <?php echo number_format($tax, 2);?>
                 </b>
                </h5>
              </td>
            </tr>
            <tr>
              <td>
                <h5>
                  Shipping fee
                </h5>
              </td>
              <td id="summ-shipping">
                <h5>
                  <span>&#8369;
                  </span>
                  <b>
                    <?php echo number_format($shipping, 2);?>
                 </b>
                </h5>
              </td>
            </tr>
            <tr id="summary-total">
              <td >
                <h4>
                  Total
  
                </h4>
              </td>
              <td id="summ-total" >
                <h4>
                  <span>&#8369;
                  </span>
                  <b>
                    <?php echo number_format($total + $tax + $shipping, 2);?>
                  </b>
                </h4>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <?php
    }
  
    function div_end(){
      ?>
      </div>
      <?php
    }
  
    function empty_cart(){
      ?>
      <div class="container">
        <div class="row" >
          <div class="div-empty">
            <img src="https://tbcmerchantservices.com/images/empty_cart.png" alt="">
          </div>
        </div>
        <div class="row" style="text-align:center">
          <b>
            <h1> Uh Oh! Looks like your cart is
              <span style="color:#F11C30">empty
              </span>.
            </h1>
          </b>
          <br>
          <p>You must first add items to your shopping cart before proceeding to checkout.
            <br>
            You can find amazing products in the TBCMS shopping page.
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
