<?php
if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
//   header("location: https://tbcmerchantservices.com/shopping/");
}
 ?>
<div class="navbar navbar-default navbar-static-top" role="navigation">
   <div class="container">

       <div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           </button>
           <a style="color:#008B8B" class="navbar-brand" href= <?php echo $page_title=="Cart" ? "https://tbcmerchantservices.com/cart" : "https://tbcmerchantservices.com/shopping" ?> >
             <?php echo $page_title=="Cart" ? "Shopping Cart" : "TBCMS shop"; ?>
           </a>
       </div>

       <div class="navbar-collapse collapse">
           <ul class="nav navbar-nav">

               <li <?php echo $page_title=="Cart" ? "" : "class='active'" ; ?>>
                   <a href="https://tbcmerchantservices.com/shopping" style="color:#008B8B" class="dropdown-toggle">Shopping</a>
               </li>

               <li <?php echo $page_title=="Cart" ? "class='active'" : ""; ?> >
                   <a href="https://tbcmerchantservices.com/cart" style="color:#008B8B">
                       <?php
                       // count products in cart
                       $cart_count=count($_SESSION['cart']);
                       ?>
                       Cart <span class="badge" id="comparison-count"><?php echo $cart_count; ?></span>
                   </a>
               </li>
           </ul>

       </div><!--/.nav-collapse -->

   </div>
</div>

<?php
echo "<div class='col-md-12'>";
    if($action=='added'){
        echo "<div class='alert alert-info'>";
            echo "Product was added to your cart!";
        echo "</div>";
    }

    if($action=='exists'){
        echo "<div class='alert alert-info'>";
            echo "Product already exists in your cart!";
        echo "</div>";
    }
echo "</div>";
?>
