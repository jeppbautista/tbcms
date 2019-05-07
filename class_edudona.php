<?php

class mydesign {
  public function database_connect() {
        $conn = @mysql_connect('ebitshares.ipagemysql.com', 'urfren_samson', '091074889701_a');
        if (!$conn) { die('Could not connect: ' . mysql_error());  }
        mysql_select_db('xdb_tbcmerchantservices', $conn);
    }

    public function doc_type() {
      echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    }

    public function html_start($xmlns) {
      echo '<html xmlns="'.$xmlns.'">';
    }

  public function html_end() {
      echo '</html>';
    }

    public function head_start() {
      echo '<head>';
    }

    public function head_end() {
      echo '</head>';
    }

    public function link($href){
      echo '<link href="'.$href.'" rel="stylesheet" />';
    }

    public function link_icon($icon) {
      echo '<link rel="shortcut icon" type="image/x-icon" href="'.$icon.'" />';
    }

    public function script($src){
      echo '<script src="'.$src.'"></script>';
    }

    public function meta($http_equiv, $content, $name){
      echo '<meta name="'.$name.'" http-equiv="'.$http_equiv.'" content="'.$content.'">';
    }

    public function title_page($title) {
      echo '<title>'.$title.'</title>';
    }

    public function body_start($attrib) {
      echo '<body '.$attrib.'>';
    }

  public function body_end() {
      echo '</body>';
    }

    public function category_option() {
      $query="select * from xtbl_category Order by Category ASC";
      $rs=mysql_query($query);
      while($row=mysql_fetch_assoc($rs)) {
        echo '<option value="'.$row['Category'].'">'.$row['Category'].'</option>';
      }
    }

    public function country_option() {
      $query="select * from xtbl_country Order by Country ASC";
      $rs=mysql_query($query);
      while($row=mysql_fetch_assoc($rs)) {
        echo '<option value="'.$row['Country'].'">'.$row['Country'].'</option>';
      }
    }

    public function page_welcome_header_start() {
    ?>
      <div style="background-color: rgb(255,255,255,0.5); height: auto; padding-top: 10px;
      background-image: url('https://tbcmerchantservices.com/images/Picture3.jpg'); background-size: 100% auto">
    <?php

    }

    public function page_welcome_header_end() {
      echo '</div>';
    }

    public function show_alert($message) {
      echo "<script>alert('$message')</script>";
    }

    public function page_welcome_header_content_start_footer2()
    {
?>
            <div class="footer" style="background:#008B8B;width:100%;height:42px;position:fixed;bottom:0;left:0; font-size: 15px">
                <div class="container" align="center">
                    <span style="color: white">Copyright @ 2016-2018 TheBillionCoin Merchant Services</span>

                </div>
            </div>

            <!-- <div class="footer" style="background:#008B8B;width:100%;height:42px;position:fixed;bottom:0;left:0; font-size: 15px">
                <div class="container" align="right">
                    <span style="color: white">Copyright @TheBillionCoin Merchant</span>
                    <span style="color: white; text-align: right;" >
                        <a style="color: white;" href="javascript:void(0)">About</a> |
                        <a style="color: white;" href="javascript:void(0)">Advertise</a> |
                        <a style="color: white;" href="javascript:void(0)">Online Store</a> |
                        <a style="color: white;" href="javascript:void(0)">Exchange</a> |
                        <a style="color: white;" href="javascript:void(0)">Terms and Condition</a>
                    </span>
                </div>
            </div> -->
        <?php
    }

    public function show_payforms(){
      ?>
      <div class="container">
      <h4><img src="https://tbcmerchantservices.com/images/coinph.png" width="80px"> </h4>


      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="col-md-12">
            <form method="POST">
              <a href="javascript:void(0)" id="btn_php_payment" class="btn btn-warning" style="width: 48%">PHP/Dollar</a>
              <a href="javascript:void(0)" id="btn_btc_payment" class="btn btn-warning" style="width: 48%">BTC</a>
            </form>
          </div>
        </div>
        <div class="col-md-4"></div>

      </div>
      <div id = "div-PHP">
        Send Amount to our PHP Address below <span style="color: red"><?php echo $error2;?></span>
        <input class="form-control"/ readonly name="txtemail_phpeud_trans_id"
               placeholder="PHP Transaction ID Here" value=<?php echo '"3A9qBQkV9tu3zQ7cDosenG5ev3TyJ56CfG"';?> >
        <span style="font-size: 5px">&nbsp</span>
        <form method="POST">
          <div width="50%">
            <input class="form-control"/ name="txtphpeud_trans_id" placeholder="PHP Transaction ID Here">
          </div><br>
          <input name="submit_phpeud_transact2" type="submit" hidden />
          <a href="javascript:void(0)" id="btn_phpeud_transact" class="btn btn-primary btn-lg">SEND REQUEST</a>
        </form>
      </div>

      <div id = "div-BTC" hidden>
        Send Amount to our BTC Address below <span style="color: red"><?php echo $error2;?></span>
        <input class="form-control"/ readonly name="txtemail_btceud_trans_id"
               placeholder="BTC Transaction ID Here" value=<?php echo '"3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL"';?> >
        <span style="font-size: 5px">&nbsp</span>
        <form method="POST">
          <div width="50%">
            <input class="form-control"/ name="txtbtceud_trans_id" placeholder="BTC Transaction ID Here">
          </div><br>
          <input name="submit_btceud_transact" type="submit" hidden />
          <a href="javascript:void(0)" id="btn_btceud_transact" class="btn btn-primary btn-lg">SEND REQUEST</a>
        </form>
      </div>
    </div>
      <?php
    }

    public function show_payforms2(){
      ?>

      <div class="container">
      <h4><img src="https://tbcmerchantservices.com/images/coinph.png" width="80px"> </h4>


      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="col-md-12">
            <form method="POST">
              <a href="javascript:void(0)" id="btn_php_payment" class="btn btn-warning" style="width: 48%">PHP/Dollar</a>
              <a href="javascript:void(0)" id="btn_btc_payment" class="btn btn-warning" style="width: 48%">BTC</a>
            </form>
          </div>
        </div>
        <div class="col-md-4"></div>

      </div>
      <div id = "div-PHP">
        Send Amount to our PHP Address below <span style="color: red"><?php echo $error2;?></span>
        <input class="form-control"/ readonly name="txtemail_phpeud_trans_id2"
               placeholder="PHP Transaction ID Here" value=<?php echo '"3A9qBQkV9tu3zQ7cDosenG5ev3TyJ56CfG"';?> >
        <span style="font-size: 5px">&nbsp</span>
        <form method="POST">
          <div width="50%">
            <input class="form-control"/ name="txtphpeud_trans_id2" placeholder="PHP Transaction ID Here">
          </div><br>
          <input name="submit_phpeud_transact2" type="submit" hidden />
          <a href="javascript:void(0)" id="btn_phpeud_transact2" class="btn btn-primary btn-lg">SEND REQUEST</a>
        </form>
      </div>

      <div id = "div-BTC" hidden>
        Send Amount to our BTC Address below <span style="color: red"><?php echo $error2;?></span>
        <input class="form-control"/ readonly name="txtemail_btceud_trans_id2"
               placeholder="BTC Transaction ID Here" value=<?php echo '"3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL"';?> >
        <span style="font-size: 5px">&nbsp</span>
        <form method="POST">
          <div width="50%">
            <input class="form-control"/ name="txtbtceud_trans_id2" placeholder="BTC Transaction ID Here">
          </div><br>
          <input name="submit_btceud_transact2" type="submit" hidden />
          <a href="javascript:void(0)" id="btn_btceud_transact2" class="btn btn-primary btn-lg">SEND REQUEST</a>
        </form>
      </div>
    </div>


      <?php
    }

    public function display_nologin() {
      ?>
        <div id="article">
        <h1>Oops! Looks like you're not yet logged in</h1>
        <div>
            <p>Please log-in your TBCMS account first, or register if you don't have one yet.</p>
            <p>— TBCMS</p>
            <a class="btn btn-success" href = "https://tbcmerchantservices.com/welcome/" target = "_blank"> Click here to log in </a>
        </div>
        </div>

        <style type="text/css">
          body { text-align: center; padding: 150px; }
          h1 { font-size: 50px; }
          body { font: 20px Helvetica, sans-serif; color: #333; }
          #article { display: block; text-align: left; width: 650px; margin: 0 auto; }
          a { color: #dc8100; text-decoration: none; margin:auto;}
          a:hover { color: #333; text-decoration: none; }
        </style>
      <?php
    }
}

?>
