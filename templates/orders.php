<?php 
    class View{

        function container_start(){
        ?>
            <div class="container">
        <?php
        }

        function header_text($text){
            ?>
            <div class="row">
              <div class="col-12 col-md-12">
                <h2 id="header_text"><?php echo $text ?></h2>
              </div>
            </div>
            <?php
        }

        function table_header($customer, $orderCtr){
        ?>
            <table class="table table-hover tabl-condensed">
                <thead>
                    <td colspan="2">Order # <?php echo "OR" . str_pad($orderCtr, 10, "0", STR_PAD_LEFT); ?> </td>
                    <td> <?php echo $customer['Full_Name'] ?> </td>
                </thead>

        <?php
        }

        function product_row($product){
        ?>
            <tr>
                <td style="width: 50%"> 
                <div class="row">
                    <div class="col-sm-2">
                    <img class="img-responsive" src=<?php echo "https://tbcmerchantservices.com/products/".$product["Image"] ?>  alt="">
                    </div>
                    <div class="col-sm-10">
                    <?php echo $product["Product_Name"] ?> 
                    </div>
                </div>
                </td>
                <td style="width: 20%"> <?php echo $product["Quantity"] . " pcs"?> </td>  
                <td style="width: 30%"> <?php echo '&#8369;' . $product["Product_Price"] ?> </td>          
            </tr>

        <?php
        }

        function container_end(){
        ?>
            </div>
        <?php
        }

        function breakline(){
        ?>
            <br>
        <?php
        }
    }
?>