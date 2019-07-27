<?php
    session_start();
    include 'class_admin.php';  
    include_once 'templates/admin.php';
    include_once 'objects/admin.php';
    include_once 'objects/generic.php';

    $class = new mydesign;
    $class->database_connect();

    $view = new View;
    $admin = new Admin;

    date_default_timezone_set('Asia/Manila');
    $sessiondate=date('mdY');

    $limit=15;
    $page=$_SESSION['session_admpage'];

    if(isset($_POST['pageno'])) {
      $page=str_replace("'", '', $_REQUEST['pageno']);
      $page=str_replace('"', '', $page);
      $page=str_replace("<", '', $page);
      $page=str_replace('>', '', $page);

      $_SESSION['session_admpage']=$page;
      $page=$_SESSION['session_admpage'];
      echo '<script>window.location.assign("https://tbcmerchantservices.com/admin_doc/");</script>';
    }
    
    if(!isset($_SESSION['session_tbcmerchant_ctr_myadmin'.$sessiondate])){
      header("location: https://tbcmerchantservices.com/tbcmyadmin/");
    }

    #APPROVAL
    if(isset($_POST['temporary_value'])) {
      $temvalue=str_replace("'", '', $_POST['temporary_value']);
			$temvalue=str_replace('"', '', $temvalue);
			$temvalue=str_replace("<", '', $temvalue);
      $temvalue=str_replace('>', '', $temvalue);
      
      $admin->updatePaymentStatus($temvalue, 'APPROVED');
    }
    elseif (isset($_POST['temporary_valueD'])) {
      $temvalue=str_replace("'", '', $_POST['temporary_value']);
			$temvalue=str_replace('"', '', $temvalue);
			$temvalue=str_replace("<", '', $temvalue);
      $temvalue=str_replace('>', '', $temvalue);
      
      $admin->updatePaymentStatus($temvalue, 'DENIED');
    }

    $tbc_to_peso = getAllElements("xtbl_adminaccount")['Tbc_to_Peso'];

    $class->doc_type();
    $class->html_start('');
    $class->head_start();
    echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
    $class->title_page('TBCMS ADMIN');
    $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
    $class->script('https://tbcmerchantservices.com/js/bootstrap.js');
    $class->link('https://tbcmerchantservices.com/css/bootstrap.css');
    $class->script('https://tbcmerchantservices.com/js/jquery1.4.js');
    $class->head_end();
    $class->body_start('');

    $class->admin_page_header();

    $view->container_start();
    $view->table_header();
    $query = $admin->getPendingPayments();
    $rs=@mysql_query($query);
    while($payment = @mysql_fetch_assoc($rs)){
      ?>
        <tr>
          <td><?php echo $payment["Payment_Date"] ?></td>
          <td><?php echo $payment["Payment_Type"] ?></td>
          <td><?php echo $payment["Transaction"] ?></td>
          <td>
            <a class="btn btn-success" href="javascript:void(0)" <?php echo "onclick=btnaccept('".$payment[Ctr]."')";?> >ACCEPT</a>
            <a class="btn btn-danger" href="javascript:void(0)" <?php echo "onclick=btnadenied('".$payment[Ctr]."')";?> >DENIED</a>
          </td>
        </tr>
      <?php
    }
    $view->container_end();

    $view->modal_accept();
    $view->modal_denied();

?>