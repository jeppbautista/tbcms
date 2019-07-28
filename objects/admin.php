<?php
class Admin{
    function getPendingPayments(){
        $query = "
            SELECT * 
            FROM shop_xtbl_payment
            WHERE Status='PENDING'";

        return $query;
    }

    function getOrderedProducts($orderCtr){
        $query = "
            SELECT p.Product_Name,
                p.Image,
                od.Price,
                od.Quantity,
                
        ";
    }

    function updatePaymentStatus($paymentCtr, $status){
        $query = "
            UPDATE shop_xtbl_payment
            SET Status='$status'
            WHERE Ctr='$paymentCtr'";

        @mysql_query($query);
    }
}

?>