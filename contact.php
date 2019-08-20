<?php
session_start();
date_default_timezone_set('Asia/Manila');
$sessiondate     = date('mdY');

include 'class3.php';
include_once 'templates/main.php';
include_once 'templates/contact.php';
include 'assets/utils/mailer/contact.php';

$class = new mydesign;
$view = new ContactView;
$main = new MainView;
$mailer = new ContactMailer;

if(isset($_POST["send"])){
    $name = $_REQUEST['name'];
    $message = $_REQUEST['message'];
    $from = $_REQUEST['email'];
    $subject = $_REQUEST['subject'];

    $mailer->subject = $subject;
    $mailer->message .= "From: ".$name."<br> Email: ".$from."<br>";
    $mailer->message .= $message;

    $mailer->sendMail();

}

$main->docType();
$main->htmlStart();
$main->headStart();
$main->linkIcon("https://tbcmerchantservices.com/images/tbslogo.png");
$main->titlePage("Contact Us");
$main->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
$main->script('https://tbcmerchantservices.com/js/bootstrap.js');
$main->link('https://tbcmerchantservices.com/css/bootstrap.css');
$main->link('https://tbcmerchantservices.com/css/style-contact.css');
$main->headEnd();

if (!isset($_SESSION['session_tbcmerchant_ctr' . $sessiondate])) {
  $class->body_start('');
  $class->page_home_header_start();
  $class->page_shopping_header_content1();
  $class->page_home_header_end();
}

?>

    <body>
    <div class="container"> 
        <div class="row" style="margin-top: 10vh" >
          <div class="div-email" style="text-align:center">
            <img id="open-email" src="https://tbcmerchantservices.com/images/open-email.jpg" alt="" style="max-height: 150px;">
          </div>
        </div>
        <div class="row" style="text-align:center">
          <b>
            <h1> <b>Contact Us.</b> 
            </h1>
          </b>
          <p>Got questions for us? Send us an email. Our team will come back to you in a jiffy.
          </p>
        </div>
        <br><br>
        <form method="post">
          <div class="row">
            <div class="col-12 col-md-8 shadow" style="margin-bottom: 100px">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Your name">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Your email">
                </div>
                <div class="form-group">
                  <label for="subject">Subject</label>
                  <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea class="form-control" id="message" name="message" cols="30" rows="10" style="width:100%"></textarea>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-12 col-md-4">
                  <button class="btn btn-success" type="submit" name="send" style="float:right">
                    Send Mail
                  </button>
                </div>
              
              </div>
            </div>

            <div class="col-12 col-md-4">
              Our Office
              <hr>
              <p>
                <b>TBC Merchant Services</b><br>
                30-B Sta. Catalina Street Holy Spirit, Quezon City, Philippines <br>
                tbcmservices@gmail.com <br>
                0945-883-38-76
              </p>
            </div>
              
          </div>
          
        </form>
       
      </div>
    </body>