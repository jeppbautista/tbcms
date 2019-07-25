<?php
function readByID($ids){
  $ids_arr = implode(", ", $ids);
  $query = "
    SELECT Ctr,
      Product_Name,
      Product_Description,
      Product_Price,
      Image
    FROM xtbl_product WHERE Ctr IN ($ids_arr)";

  return $query;
}

function getProducts($product){
  $query = "select * from xtbl_product WHERE Ctr='" . $product . "'";
  $rs = mysql_query($query);
  $row = mysql_fetch_assoc($rs);
  return $row;
}

function insertCustomer($lastname, $firstname, $shipping_address, $country, $city, $phone, $email, $is_member){
  $query = "
    INSERT INTO shop_xtbl_customer 
      (Last_Name, First_Name, 
      Middle_Name, Shipping_Address, 
      Country, City, 
      Phone, Email, 
      Is_Member)
    VALUES
      ('$lastname', '$firstname',
      '', '$shipping_address',
      '$country', '$city',
      '$phone', '$email',
      '$is_member')
  ";
  return $query;
}

function insertCustomerDetail($customer_ctr){
  $query = "
    INSERT INTO shop_xtbl_customer_detail 
      (Customer_Ctr, Main_Ctr)
    VALUES ('$customer_ctr', '-1')";
  return $query;
}

function insertOrderDetail($id, $quantity, $order_ctr){

  $product_price = getProducts($id)['Product_Price'];
  $discount = number_format(0.00, 2, '.', '');
  $sub = number_format((floatval($quantity) * floatval($product_price)), 2, '.', '');
  $total_price = number_format((floatval($sub) - $discount), 2, '.', '');

  $query = "
    INSERT INTO shop_xtbl_order_detail
      (Product_Ctr, Order_Number, Product_Price, Quantity, Discount, Total)
    VALUES('$id', '$order_ctr', '$product_price', '$quantity', '$discount', '$total_price')";
  return $query;
}

function insertOrders($customer_detail_ctr, $payment_id){
  $query = "
    INSERT INTO shop_xtbl_orders
      (Customer_Ctr, Payment_Ctr, Shipper_Ctr, Tax , Deleted,  Status)
    VALUES('$customer_detail_ctr', '$payment_id', 0, 0.00, 0, 'PENDING')";
  return $query;
}

function insertPayment($payment_type, $transaction_num){
  $query = "
    INSERT INTO shop_xtbl_payment 
      (Payment_Type, Transaction, Status)
    VALUES ('$payment_type', '$transaction_num', 'PENDING')";
  return $query;
}


?>
