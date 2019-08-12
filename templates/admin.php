<?php
    class View{
        function container_start(){
        ?>
            <div class="container">
        <?php
        }

        function table_header(){
        ?>
            <table class="table">
            <tr>

            </tr>
        <?php
        }

        function filter($filter){
        ?>
            <form method="POST">
                <input type="submit" id="filter-submit" name="filter-submit" hidden>
                <input type="text" id="filter-value" name="filter-value" value="*" hidden>
                <div class="dropdown" style="text-align:center">
                    Filter : <button id='dropdown-filter' class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"> <?php echo $filter ?>
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" id="filter-menu">
                            <li><a href="#">ALL</a></li>
                            <li><a href="#">SHIPPING</a></li>
                            <li><a href="#">ON DELIVERY</a></li>
                            <li><a href="#">COMPLETED</a></li>
                            <li><a href="#">CANCEL</a></li>
                        </ul>
                </div>
            </form>
            <hr>
        <?php
        }

        function orderHeader($orderCtr, $payment, $customer){
        ?>
            <div class="col-12 col-md-12 shadow" style="margin-bottom:15px;">
            <div class="row">
                <div class="col-12 col-md-4 header-txt">
                <b>Date of Transaction: </b> <?php echo $payment["Payment_Date"] ?><br>
                <b>Mode of Payment:</b> <?php echo $payment["Payment_Type"] ?><br>
                <b>Transaction Number:</b> <?php echo $payment["Transaction"] ?><br>

                </div>

                <div class="col-12 col-md-5 header-shipping">
                <b>Billing Address: </b> <?php echo $customer["Shipping_Address"]; ?><br> 
                <b>Customer: </b> <?php echo $customer["Full_Name"]; ?><br> 
                <b>Email: </b> <?php echo $customer["Email"]; ?><br> 
                <b>Phone: </b> <?php echo $customer["Phone"]; ?><br> 
                </div>

                <div class="col-12 col-md-3 header-btn">
                <div style="text-align: center">
                <?php 
                    if($payment["Status"] == "PENDING"){
                    ?>
                        <a class="btn btn-success" href="javascript:void(0)" <?php echo "onclick=btnaccept('".$payment['Ctr']."')";?> >ACCEPT</a>
                        <a class="btn btn-danger" href="javascript:void(0)" <?php echo "onclick=btndenied('".$payment['Ctr']."')";?> >DENIED</a>
                    <?php
                    }elseif ($payment["Status"] == "APPROVED") {
                        echo 'APPROVED';
                    }else{
                        echo 'DENIED';
                    }
                ?>
                
                </div>
                <br>
                <div class="row" style="text-align:center">
                    <a target="_blank" href='<?php echo "https://tbcmerchantservices.com/orders?id=".$orderCtr ?>' class="btn btn-warning">View Orders</a>
                </div>
                </div>
            </div>
            <br>
        <?php
        }

        function orderHeaderShipping($payment, $customer, $order){
        ?>
            <div class="col-12 col-md-12 shadow" style="margin-bottom:15px;">
            <div class="row">
                <div class="col-12 col-md-4 header-txt">
                <b>Date of Transaction: </b> <?php echo $payment["Payment_Date"] ?><br>
                <b>Mode of Payment:</b> <?php echo $payment["Payment_Type"] ?><br>
                <b>Transaction Number:</b> <?php echo $payment["Transaction"] ?><br>

                </div>

                <div class="col-12 col-md-5 header-shipping">
                <b>Billing Address: </b> <?php echo $customer["Shipping_Address"]; ?><br> 
                <b>Customer: </b> <?php echo $customer["Full_Name"]; ?><br> 
                <b>Email: </b> <?php echo $customer["Email"]; ?><br> 
                <b>Phone: </b> <?php echo $customer["Phone"]; ?><br> 
                </div>

                <div class="col-12 col-md-3 header-btn">
                    <form method="post">
                        <div class="dropdown" style="text-align:center">
                            <button id='<?php echo "dropdown-".$order["Ctr"] ?>' class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> <?php echo $order['Status'] ?>
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">SHIPPING</a></li>
                                <li><a href="#">ON DELIVERY</a></li>
                                <li><a href="#">COMPLETED</a></li>
                                <li><a href="#">CANCEL</a></li>
                            </ul>
                            <button id='<?php echo "btn-".$order["Ctr"] ?>' class="btn btn-success btn-shipping-confirm">Confirm</button>
                        </div>
                        <input type="text" name="order-id" value='<?php echo $order["Ctr"] ?>' hidden>
                        <input type="text" id='<?php echo "dropdown-val-".$order["Ctr"] ?>' name="submit" value='<?php echo $order['Status'] ?>' hidden >
                        <input type="submit" id='<?php echo "submit-".$order["Ctr"] ?>' name="submit" hidden >
                    </form>
                    
                    <br>
                    <div class="row" style="text-align:center">
                        <a target="_blank" href='<?php echo "https://tbcmerchantservices.com/orders?id=".$order["Ctr"] ?>' class="btn btn-warning">View Orders</a>
                    </div>
                </div>
            </div>
            <br>
        <?php  
        }

        function orderRow($products){
        ?>
            <tr>
                <td style="width: 50%"> 
                <div class="row">
                    <div class="col-sm-2">
                    <img class="img-responsive" src=<?php echo "https://tbcmerchantservices.com/products/".$products["Image"] ?>  alt="">
                    </div>
                    <div class="col-sm-10">
                    <?php echo $products["Product_Name"] ?> 
                    </div>
                </div>
                </td>
                <td style="width: 20%"> <?php echo $products["Quantity"] . " pcs"?> </td>  
                <td style="width: 30%"> <?php echo '&#8369;' . $products["Product_Price"] ?> </td>          
            </tr>

        <?php
        }

        function orderTotal($total){
        ?>
            <tr>
            <td></td>
            <td></td>
            <td>
            <b>Total: <?php echo '&#8369;' .  $total; ?></b>
            </td>
            </tr>
        <?php
        }

        function modal_accept(){
        ?>
            <div id="modal_accept" class="modal fade">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header"><h4>CONFIRMATION</h4></div>
                        <div class="modal-body">
                            <b>ARE YOU SURE YOU WANT TO ACCEPT THIS REQUEST?</b>
                        </div>
                        <div class="modal-footer">
                            <form method="POST">
                                <input name="temporary_value" hidden/>
                                <input type="submit" name="temporary_value_submit" hidden />
                            </form>
                            <a href="javascript:void(0)" onclick="$('[name=temporary_value_submit]').click();"
                                class="btn btn-primary">&nbsp YES &nbsp</a>
                            <a href="javascript:void(0)" class="btn btn-danger" data-dismiss="modal">
                                &nbsp&nbsp NO &nbsp&nbsp</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }

        function modal_denied(){
        ?>
            <div id="modal_denied" class="modal fade">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header"><h4>CONFIRMATION</h4></div>
                        <div class="modal-body">
                            <b>ARE YOU SURE YOU WANT TO DENY THIS REQUEST?</b>
                        </div>
                        <div class="modal-footer">
                            <form method="POST">
                                <input name="temporary_valueD" hidden/>
                                <input type="submit" name="temporary_value_submitD" hidden />
                            </form>
                            <a href="javascript:void(0)" onclick="$('[name=temporary_value_submitD]').click();"
                                class="btn btn-primary">&nbsp YES &nbsp</a>
                            <a href="javascript:void(0)" class="btn btn-danger" data-dismiss="modal">
                                &nbsp&nbsp NO &nbsp&nbsp</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }

        function table_footer(){
        ?>
            </table>
        <?php
        }

        function container_end(){
        ?>
            </div> 
        <?php
        }

        function div_end(){
        ?>
            </div>
        <?php
        }

        function line_break(){
        ?>
            <br>
        <?php
        }
    }
?>