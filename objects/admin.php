<?php
class Admin{
    function getPendingPayments(){
        $query = "
            SELECT * 
            FROM shop_xtbl_payment
            WHERE Status='PENDING'
            ORDER BY Payment_Date DESC";
        return $query;
    }

    function getApprovedOrders(){
        $query = "
            SELECT *
            FROM shop_xtbl_orders ord
            WHERE Status <> 'PENDING'
            ORDER BY Ctr DESC
        ";

        return $query;
    }

    function getOrderedProducts($orderCtr){
        // $query = "
        //     SELECT p.Product_Name,
        //         p.Image,
        //         od.Product_Price,
        //         od.Quantity,
        //         ord.Grand_Total,
        //         c.Shipping_Address,
        //         CONCAT(c.First_Name, ' ', c.Middle_Name, ' ', c.Last_Name) as Full_Name
        //     FROM shop_xtbl_order_detail AS od
        //     LEFT JOIN shop_xtbl_orders AS ord
        //         ON od.Order_Number = ord.Ctr
        //     INNER JOIN xtbl_product AS p
        //         ON od.Product_Ctr = p.Ctr
        //     INNER JOIN shop_xtbl_customer_detail AS cd
        //         ON ord.Customer_Ctr = cd.Customer_Ctr
        //     LEFT JOIN shop_xtbl_customer AS c
        //         ON cd.Customer_Ctr = c.Ctr
        //     WHERE ord.Ctr = '$orderCtr'
        // ";

        $query = "
            SELECT 
            p.Ctr,
            p.Product_Name,
            p.Image,
            od.Product_Price,
            od.Quantity,
            ord.Tax,
            ord.Grand_Total

            FROM shop_xtbl_order_detail AS od
            LEFT JOIN shop_xtbl_orders AS ord
                ON od.Order_Number = ord.Ctr
            INNER JOIN xtbl_product AS p
                ON od.Product_Ctr = p.Ctr
            WHERE ord.Ctr = '$orderCtr'
        ";

        return $query;
    }

    function getCustomerDetails($orderCtr){
        $query = "
            SELECT c.*, CONCAT(c.First_Name, ' ', c.Middle_Name, ' ', c.Last_Name) AS Full_Name
            FROM shop_xtbl_orders AS ord
            LEFT JOIN shop_xtbl_customer_detail AS cd
                ON ord.Customer_Ctr = cd.Customer_Ctr
            LEFT JOIN shop_xtbl_customer AS c
                ON cd.Customer_Ctr = c.Ctr
            WHERE ord.Ctr = '$orderCtr'
        ";

        return $query;
    }

    function updatePaymentStatus($paymentCtr, $status){
        $query = "
            UPDATE shop_xtbl_payment
            SET Status='$status'
            WHERE Ctr='$paymentCtr'";

        @mysql_query($query);
    }

    function updateOrderStatus($paymentCtr, $status){
        $query = "
            UPDATE shop_xtbl_orders
            SET Status='$status'
            WHERE Payment_Ctr = '$paymentCtr'
        ";

        @mysql_query($query);
    }
}

?>