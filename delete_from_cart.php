<?php
  session_start();
  date_default_timezone_set('Asia/Manila');
  $sessiondate=date('mdY');

  $id = $_GET['id'];
  unset($_SESSION['cart'][$id]);
  $temp_cart = $_SESSION['cart'];
  $user = $_SESSION['session_tbcmerchant_ctr'.$sessiondate];
  session_destroy();
  session_start();
  $_SESSION['cart'] = $temp_cart;
  $_SESSION['session_tbcmerchant_ctr'.$sessiondate] = $user;
  header('Location: https://tbcmerchantservices.com/cart?action=removed&product=' . $id);
 ?>
