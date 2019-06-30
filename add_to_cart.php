<?php
  session_start();

  $id = isset($_GET['id']) ? $_GET['id'] : "";
  $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $quantity=$quantity<=0 ? 1 : $quantity;

  // add new item on array
  $cart_item=array(
      'quantity'=>$quantity
  );
  if(!isset($_SESSION['cart'])){
      $_SESSION['cart'] = array();
  }

  if(array_key_exists($id, $_SESSION['cart'])){
      header('Location: https://tbcmerchantservices.com/test_welcome?action=exists&product=' . $id);
  }
  else{
      $_SESSION['cart'][$id]=$cart_item;
      header('Location: https://tbcmerchantservices.com/test_welcome?action=added&product=' . $id);
  }
#TODO actions added on shopping

?>
