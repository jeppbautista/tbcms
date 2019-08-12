<?php
  class AdminMailer
  {
    public $to;
    public $from;
    public $subject;
    private $header;
    public $message;


    public function __construct(){
        $this->message = "<html>";
        $this->from = "TBCMerchantServices<automail@tbcmerchantservices.com>";
    }

    private function bodyStart(){
        return '<body style="font-family: Helvetica, Arial, sans-serif;">';
    }

    private function topDiv(){
      return '<div style="width: 80%; margin: auto; 
                box-shadow: 0 0.46875rem 2.1875rem rgba(63, 106, 216, 0.03), 
                0 0.9375rem 1.40625rem rgba(63, 106, 216, 0.03), 
                0 0.25rem 0.53125rem rgba(63, 106, 216, 0.05), 
                0 0.125rem 0.1875rem rgba(63, 106, 216, 0.03);
                border-radius: 1%;
                background-color: white;">';
    }

    private function navDiv(){
      return '<div style="background-color: #011B5B; height: auto; padding: 10px 20px;">
                <span style="font-family: Helvetica, Arial, sans-serif; font-size: 40px; color: #C4A101; font-weight:bold">TBCMS</span>
              </div>';
    }

    private function headerText($text){
      return '<div style="background-color: white; padding: 20px 35px">
                <p style="font-size: 30px">
                  '.$text.'.
                </p>
              </div>';
    }

    private function messageDivStart($customer){
      return '<div style="background-color: #F0F0F0; padding: 20px 35px">
                <p style="font-size: 15px">
                  Dear <b>'.$customer['Full_Name'].',</b> <br>
                  <br>';
    }

    private function messageDivMainShipping($orderCtr, $payment, $customer){
        return 'Your Order OR' . str_pad($orderCtr, 10, "0", STR_PAD_LEFT) . ' has been approved and is now being shipped
              on '.date('M d,Y').' with Transaction number '.$payment['Transaction'].' via '.$payment['Payment_Type'] . 
              '. You will receive another email after your order has been shipped and is on delivery. 
              <br><br>';
    }

    private function messageDivMainDelivery($orderCtr, $payment, $customer){
        return 'Your Order OR' . str_pad($orderCtr, 10, "0", STR_PAD_LEFT) . ' has been shipped and is now on delivery
        on '.date('M d,Y').' with Transaction number '.$payment['Transaction'].' via '.$payment['Payment_Type'] . 
        '. You will receive another email once your order has arrived to the shipping address. 
        <br><br>'; 
    }

    private function messageDivCanceled($orderCtr, $payment, $customer){
        return 'Your Order OR' . str_pad($orderCtr, 10, "0", STR_PAD_LEFT) . ' has been CANCELLED 
        on '.date('M d,Y').' with Transaction number '.$payment['Transaction']. 
        '. To know more regarding the cancellation, you may reach us on our <a target="_blank" href="https://tbcmerchantservices.com/contact">Contact Us</a> page. 
        <br><br>'; 
    }

    private function messageDivCompleted($orderCtr, $payment, $customer){
      return 'Thanks for shopping with us! We are glad to inform you that your Order OR' . str_pad($orderCtr, 10, "0", STR_PAD_LEFT) . ' has been delivered and collected in full.
      Today, '.date('M d,Y').' 
      We hope that you enjoy your purchase and continue to shop with TBC Merchant Services. <br><br>
      In case you have experience the following:
      <ol>
        <li>You have issues with the item you received.</li>
        <li>You did not receive the item.</li>
        <li>Others</li>
      </ol>
      Kindly contact us on our <a target="_blank" href="https://tbcmerchantservices.com/contact">Contact Us</a> page.
      <br><br>'; 
    }

    private function messageDivSubMessage(){
        return 'If the information provided below is incomplete and/or incorrect, you may cancel the initial order
              and place a new order with the correct details.
              <br><br>
              If you did not place the order, you may reach us on our <a target="_blank" href="https://tbcmerchantservices.com/contact">Contact Us</a> page. ';
    }

    private function messageShippingDiv($customer){
        return '<div style="background-color: white; padding: 20px 35px; ">
                <p style="font-size: 18px">Shipping details:</p>
                <div style="width: 45%; float:left; padding: 10px">
                  '.$customer["Shipping_Address"].'
                </div>
                <div style="width: 45%; float:right; padding: 10px">
                  Phone: '.$customer["Phone"].' <br>
                  Email Address: '.$customer["Email"].'
                </div>
              </div>';
    }

    private function messageSummaryDiv($payment, $products2){
        $m = '<div style="background-color: white; padding: 20px 35px; width: 80%; overflow: auto">
              <div style="width: 45%; float:left; padding: 10px"> Paid via: '
              .$payment["Payment_Type"].
              '</div>
              <div style="width: 45%; float:right; padding: 10px">
                <table style="float:right">
                  <tr>
                    <td style="width: 30%">Subtotal: </td>
                    <td style="width: 10%">&#8369; '. number_format($GLOBALS['subtotal'], 2) .'</td>
                  </tr>
                  <tr>
                      <td>Discount: </td>
                      <td>&#8369; 0.00</td>
                  </tr>
                  <tr>
                    <td>Shipping fee: </td>
                    <td>&#8369; 0.00</td>
                  </tr>
                  <tr>
                    <td><b>Total: </b></td>
                    <td><b>&#8369; '.number_format($GLOBALS['total'],2).'</b></td>
                  </tr>
                </table>
              </div>
              ';
        unset($GLOBALS['subtotal']);
        unset($GLOBALS['total']);
        return $m;
    }

    private function messageOrdersDiv($products){
        $m = '<div style="background-color: white; width: 100%; overflow: auto">
                    <br>
                    <p style="font-size: 18px; padding: 0px 35px; ">Order Details:</p>
                    <div style="padding: 20px 40px; ">';

        
        while($product = @mysql_fetch_assoc($products)){
            $GLOBALS['subtotal'] = floatval($product["Grand_Total"]) + floatval($products["Tax"]);
            $GLOBALS['total'] = floatval($product["Grand_Total"]);
            $_link = "https://tbcmerchantservices.com/item/?product=". $product["Ctr"];
            $m .= '<a href='.$_link.' style="text-decoration: none">
                    '.$product['Product_Name'].'
                </a>
                <br>
                <p>&#8369; '.number_format($product["Product_Price"], 2).'<br>
                Quantity: '.$product["Quantity"].'</p>
            ';
        }
        $m .= '</div></div><hr>';

        return $m;
               
    }

    private function breakLine(){
        return '<br>';
    }

    private function divEnd(){
        return '</div>';
    }

    private function bodyEnd(){
        return '</body>';
    }

    public function sendMail(){
        $this->header = "From:" . $this->from. "\r\n";
        $this->header .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail($this->to, $this->subject, $this->message, $this->header);
    }

    public function prepareTemplate($orderCtr, $products, $payment, $customer, $type){
        $this->message .= $this->bodyStart();
        $this->message .= $this->topDiv();
        $this->message .= $this->navDiv();

        if($type == "SHIPPING"){
            $this->message .= $this->headerText("Your Order is BEING SHIPPED");
            $this->message .= $this->messageDivStart($customer);
            $this->message .= $this->messageDivMainShipping($orderCtr, $payment, $customer);
            $this->message .= $this->messageDivSubMessage();

        }elseif($type == "ON DELIVERY"){
            $this->message .= $this->headerText("Your Order is ON DELIVERY");
            $this->message .= $this->messageDivStart($customer);
            $this->message .= $this->messageDivMainDelivery($orderCtr, $payment, $customer);
            $this->message .= $this->messageDivSubMessage();

        }elseif($type == "CANCELLED"){
            $this->message .= $this->headerText("Your Order has been CANCELLED");
            $this->message .= $this->messageDivStart($customer);
            $this->message .= $this->messageDivCanceled($orderCtr, $payment, $customer);
            $this->message .= $this->divEnd();
            $this->message .= $this->breakLine();
            $this->message .= $this->breakLine();
            $this->message .= $this->bodyEnd();
            return "";
        }elseif($type == "COMPLETED"){
            $this->message .= $this->headerText("Your Order has been Delivered");
            $this->message .= $this->messageDivStart($customer);
            $this->message .= $this->messageDivCompleted($orderCtr, $payment, $customer);
        }elseif ($type == "ACCEPT") {
            $this->message .= $this->headerText("Your Payment has been Accepted");
            $this->message .= $this->messageDivStart($customer);
            $this->message .= $this->messageDivMainShipping($orderCtr, $payment, $customer);
            $this->message .= $this->messageDivSubMessage();

        }elseif ($type == "DENIED"){
            $this->message .= $this->headerText("Your Payment has been Rejected");
            $this->message .= $this->messageDivStart($customer);
            $this->message .= $this->messageDivCanceled($orderCtr, $payment, $customer);
            $this->message .= $this->divEnd();
            $this->message .= $this->breakLine();
            $this->message .= $this->breakLine();
            $this->message .= $this->bodyEnd();
            return "";
        }
        $this->message .= $this->divEnd();
        $this->message .= $this->messageShippingDiv($customer);
        $this->message .= $this->messageOrdersDiv($products);
        $this->message .= $this->messageSummaryDiv($payment, $products);
        $this->message .= $this->divEnd();
        $this->message .= $this->breakLine();
        $this->message .= $this->breakLine();
        $this->message .= $this->bodyEnd();
    }

      
  }

 ?>
