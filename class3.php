<?php

  	class mydesign {

		public function database_connect() {
			// PRODUCTION MYSQL
	      	$conn = @mysql_connect('ebitshares.ipagemysql.com', 'urfren_samson', '091074889701_a');
	      	// For localhost Connection
  	 	 	// $conn = @mysql_connect('localhost', 'root', 'telusdb');
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

	    public function dateformat($bdate) {
	    	if($bdate=='0000-00-00') { echo ' ';}
	    	else {
	    		if($bdate[5].$bdate[6]=='01') {$bday='January';}
	    		else if($bdate[5].$bdate[6]=='02') {$bday='February';}
	    		else if($bdate[5].$bdate[6]=='03') {$bday='March';}
	    		else if($bdate[5].$bdate[6]=='04') {$bday='April';}
	    		else if($bdate[5].$bdate[6]=='05') {$bday='May';}
	    		else if($bdate[5].$bdate[6]=='06') {$bday='June';}
	    		else if($bdate[5].$bdate[6]=='07') {$bday='July';}
	    		else if($bdate[5].$bdate[6]=='08') {$bday='August';}
	    		else if($bdate[5].$bdate[6]=='09') {$bday='September';}
	    		else if($bdate[5].$bdate[6]=='10') {$bday='October';}
	    		else if($bdate[5].$bdate[6]=='11') {$bday='November';}
	    		else if($bdate[5].$bdate[6]=='12') {$bday='December';}
	    		echo $bday.' '.$bdate[8].$bdate[9].', '.$bdate[0].$bdate[1].$bdate[2].$bdate[3];
	    	}
	    }

	    public function page_home_header_start() {
	    ?>
	    	<div style="background-color: rgb(255,255,255,0.5); height: auto; padding-top: 10px;
	    	background-image: url('https://tbcmerchantservices.com/images/Picture3.jpg'); background-size: 100% auto">
	    <?php
	    }

	   	public function page_home_header_end() {
	   		echo '</div>';
	    }

            public function chatscript(){
?>
			<script type="text/javascript">
				var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
				(function(){
				var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
				s1.async=true;
				s1.src='https://embed.tawk.to/58d65cbff97dd14875f5a16b/default';
				s1.charset='UTF-8';
				s1.setAttribute('crossorigin','*');
				s0.parentNode.insertBefore(s1,s0);
				})();
			</script>
<?php
            }

	    public function page_home_header_content() {
	    ?>
	    	<div class="container">
	    		<div class="col-md-10" style="padding-bottom: 5px;">
            <a href="https://tbcmerchantservices.com/home/">
	    			<img width="230px" src="https://tbcmerchantservices.com/images/tbsheader.png">
	    		</div>
	    		<div class="col-md-2" style="padding-bottom: 5px; text-align: center;">
	    			<a href="https://tbcmerchantservices.com/xdestroy/" style="color: red">
	    				LOGOUT <img width="35px" src="https://tbcmerchantservices.com/images/1484042800_exit.png">
	    			</a>
	    		</div>
	    	</div>
	    <?php
	    }

	    public function page_shopping_header_content1() {
	   	?>
	   		<div class="container">
	    		<div class="col-md-10" style="padding-bottom: 5px;">
            <a href="https://tbcmerchantservices.com/home/">
	    			<img width="230px" src="https://tbcmerchantservices.com/images/tbsheader.png">
	    		</div>
	   			<div class="col-md-2" style="padding-top: 5px;padding-bottom: 5px;">
	   				<a href="https://tbcmerchantservices.com/welcome/" class="btn btn-success btn-block"
	   					style="border-radius: 0px">Login</a>
	   			</div>
	   		</div>
	   	<?php
	    }

	    public function page_shopping_navbar_content1() {
	    	$query="select * from xtbl_product_type order by Type ASC";
	    	$rs=mysql_query($query);
	    ?>
	    	<br>
	    	<div class="container" align="center">
	    			 <form method="POST" hidden>
	    				<input name="shoptype" <?php echo 'id="shoptypei0" value=""';?> />
	    				<input type="submit" <?php echo 'name="shoptypes0"';?> />
	    			</form>
	    			<div style="padding-bottom:10px;display: inline-block;"><a id="shoptype0" href="javascript:void(0)" onclick=$("[name=shoptypes0]").click(); class="btn btn-danger"
	    					style="border-radius:13px">ALL Categories</a> &nbsp</div>
	    		<?php
	    			while($row=mysql_fetch_assoc($rs)) {
	    		?>
	    			<form method="POST" hidden>
	    				<input name="shoptype" <?php echo 'id="shoptypei'.$row['Ctr'].'" value="'.$row['Type'].'"';?> />
	    				<input type="submit" <?php echo 'name="shoptypes'.$row['Ctr'].'"';?> />
	    			</form>

	    		<?php
	    				echo '<div style="padding-bottom:10px;display: inline-block;"><a id="shoptype'.$row['Ctr'].'" href="javascript:void(0)" onclick=$("[name=shoptypes'.$row['Ctr'].']").click(); class="btn btn-danger"
	    					style="border-radius:13px">'.$row['Type'].'</a> &nbsp</div>';
	    			}
	    		?>
	    	</div>
	    <?php
	    }

	    public function page_home2_header_content() {
	    ?>
      <div class="container">
        <div class="col-md-4" style="padding-bottom: 5px;">
          <a href="https://tbcmerchantservices.com/home/">
          <img width="230px" src="https://tbcmerchantservices.com/images/tbsheader.png">
        </div>

        <div class="col-md-8" style="padding-bottom: 5px; text-align: center;">
          <div class="col-md-2 dropdown" style="padding-top: 10px; font-size: 12px;">

             <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
              aria-haspopup="true" aria-expanded="false">
              <img width="120px" src="https://tbcmerchantservices.com/images/my_account.png">
             </a>
             <ul class="dropdown-menu">

              <li><a href="https://tbcmerchantservices.com/details/"><img width="30px" src="https://tbcmerchantservices.com/images/settimng.png">&nbsp DETAILS</a></li>
              <li><a href="https://tbcmerchantservices.com/xdestroy/"><img width="30px" src="https://tbcmerchantservices.com/images/1484042800_exit.png">
              &nbsp SIGNOUT</a></li>
             </ul>
          </div>

          <div class="col-md-2" style="padding-top: 10px;">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
              aria-haspopup="true" aria-expanded="false">
              <img width="120px" src="https://tbcmerchantservices.com/images/my_wallet.png">
            </a>
             <ul class="dropdown-menu">
              <li><a href="https://tbcmerchantservices.com/transaction/"><img width="30px" src="https://tbcmerchantservices.com/images/1484054944_wallet.png">&nbsp TRANSACTION</a></li>
              <li><a href="https://tbcmerchantservices.com/request/"><img width="30px" src="https://tbcmerchantservices.com/images/1484055386_sent.png">&nbsp REQUEST COIN</a></li>
             </ul>
          </div>

          <div class="col-md-2" style="padding-top: 10px;">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
              aria-haspopup="true" aria-expanded="false">
              <img width="120px" src="https://tbcmerchantservices.com/images/my_store.png">
            </a>
            <ul class="dropdown-menu">
              <li><a href="https://tbcmerchantservices.com/my_store/"><img width="30px" src="https://tbcmerchantservices.com/images/Store_Promotion.png">&nbsp MY STORE</a></li>
              <li><a href="https://tbcmerchantservices.com/shopping/"><img width="30px" src="https://tbcmerchantservices.com/images/shopping-cart.png">&nbsp SHOPPING</a></li>
             </ul>
          </div>

          <div class="col-md-2" style="padding-top: 10px;">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
              aria-haspopup="true" aria-expanded="false">
              <img width="120px" src="https://tbcmerchantservices.com/images/my_points.png">
            </a>
            <ul class="dropdown-menu">
              <li><a href="https://tbcmerchantservices.com/my_points/"><img width="30px" src="https://tbcmerchantservices.com/images/148405598ant_32.png">&nbsp MY POINTS</a></li>
              <li><a href="https://tbcmerchantservices.com/share/"><img width="30px" src="https://tbcmerchantservices.com/images/1488353208_Gift.png">&nbsp SHARE</a></li>
             </ul>
          </div>

          <div class="col-md-2" style="padding-top: 10px;">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
              aria-haspopup="true" aria-expanded="false">
              <img width="120px" src="https://tbcmerchantservices.com/images/tbc_exchange.png">
            </a>
            <ul class="dropdown-menu">
              <li><a target="_blank" href="https://tbcmerchantservices.com/edudona/"><img width="30px" src="https://tbcmerchantservices.com/images/edudona_.png">&nbsp EDUDONA</a></li>
            </ul>
            <!-- <a href="https://tbcmerchantservices.com/exchange/"> -->
            </a>
          </div>
        </div>

      </div>
	    <?php
	    }

	    public function page_home3_header_content() {
	   	?>
	   		<div class="container">
	   			<div class="col-md-4" style="padding-bottom: 5px;">
            <a href="https://tbcmerchantservices.com/home/">
	   				<img width="230px" src="https://tbcmerchantservices.com/images/tbsheader.png">
	   			</div>

	   			<div class="col-md-8" style="padding-bottom: 5px; text-align: center;">

	   				<div class="col-md-2 dropdown" style="padding-top: 10px; font-size: 12px;">
	       				 <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
	    				 	aria-haspopup="true" aria-expanded="false">
	    				 	<img width="120px" src="https://tbcmerchantservices.com/images/my_account.png">
	    				 </a>
	    				 <ul class="dropdown-menu">
	    				 	<li><a href="https://tbcmerchantservices.com/details/"><img width="30px" src="https://tbcmerchantservices.com/images/settimng.png">&nbsp DETAILS</a></li>
	    				 	<li><a href="https://tbcmerchantservices.com/xdestroy/"><img width="30px" src="https://tbcmerchantservices.com/images/1484042800_exit.png">
	    				 	&nbsp SIGNOUT</a></li>
	    				 </ul>
	    			</div>

	    			<div class="col-md-2" style="padding-top: 10px;">
	    				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
	    					aria-haspopup="true" aria-expanded="false">
	    					<img width="120px" src="https://tbcmerchantservices.com/images/my_wallet.png">
	    				</a>
	    				 <ul class="dropdown-menu">
	    				 	<li><a href="https://tbcmerchantservices.com/transaction/"><img width="30px" src="https://tbcmerchantservices.com/images/1484054944_wallet.png">&nbsp TRANSACTION</a></li>
	    				 	<li><a href="https://tbcmerchantservices.com/request/"><img width="30px" src="https://tbcmerchantservices.com/images/1484055386_sent.png">&nbsp REQUEST COIN</a></li>
	    				 </ul>
	    			</div>

	    			<div class="col-md-2" style="padding-top: 10px;">
	    				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
	    					aria-haspopup="true" aria-expanded="false">
	    					<img width="120px" src="https://tbcmerchantservices.com/images/my_store.png">
	    				</a>
	    				<ul class="dropdown-menu">
	    				 	<li><a href="https://tbcmerchantservices.com/shopping/"><img width="30px" src="https://tbcmerchantservices.com/images/shopping-cart.png">&nbsp SHOPPING</a></li>
	    				 </ul>
	    			</div>

	    			<div class="col-md-2" style="padding-top: 10px;">
	    				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
	    					aria-haspopup="true" aria-expanded="false">
	    					<img width="120px" src="https://tbcmerchantservices.com/images/my_points.png">
	    				</a>
	    				<ul class="dropdown-menu">
	    				 	<li><a href="https://tbcmerchantservices.com/my_points/"><img width="30px" src="https://tbcmerchantservices.com/images/148405598ant_32.png">&nbsp MY POINTS</a></li>
	    				 	<li><a href="https://tbcmerchantservices.com/share/"><img width="30px" src="https://tbcmerchantservices.com/images/1488353208_Gift.png">&nbsp SHARE</a></li>
	    				 </ul>
	    			</div>

            <div class="col-md-2" style="padding-top: 10px;">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">
                <img width="120px" src="https://tbcmerchantservices.com/images/tbc_exchange.png">
              </a>
              <ul class="dropdown-menu">
                <li><a target="_blank" href="https://tbcmerchantservices.com/edudona/"><img width="30px" src="https://tbcmerchantservices.com/images/edudona_.png">&nbsp EDUDONA</a></li>
              </ul>
              <!-- <a href="https://tbcmerchantservices.com/exchange/"> -->
              </a>
            </div>

	   			</div>
	   		</div>
	   	<?php
	    }

      public function page_home4_header_content(){
      ?>


      <div class="container">
        <div class="col-md-4" style="padding-bottom: 5px;">
          <a href="https://tbcmerchantservices.com/home/">
          <img width="230px" src="https://tbcmerchantservices.com/images/tbsheader.png">
        </div>

        <div class="col-md-8" style="padding-bottom: 5px; text-align: center;">

          <div class="col-md-2 dropdown" style="padding-top: 10px; font-size: 12px;">
               <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
              aria-haspopup="true" aria-expanded="false">
              <img width="120px" src="https://tbcmerchantservices.com/images/my_account.png">
             </a>
             <ul class="dropdown-menu">
              <li><a href="https://tbcmerchantservices.com/details/"><img width="30px" src="https://tbcmerchantservices.com/images/settimng.png">&nbsp DETAILS</a></li>
              <li><a href="https://tbcmerchantservices.com/xdestroy/"><img width="30px" src="https://tbcmerchantservices.com/images/1484042800_exit.png">
              &nbsp SIGNOUT</a></li>
             </ul>
          </div>


        </div>
      </div>

      <?php
      }

	    public function page_welcome_header_content_start_footer() {
		?>
    <br>
    <br>
    <br>
			<div class="footer" style="background:#008B8B;width:100%;height:42px;position:fixed;bottom:0;left:0; font-size: 15px">
				<div class="container" align="center">
					<span style="color: white">Copyright 2016-2018 @TheBillionCoin Merchant Services</span>

				</div>
			</div>
		<?php
      }
      
      public function page_welcome_header_content_start_footer_new()
      {
        ?>
        <div class="footer container-fluid">
          <div class="container" align="center">
            <div class="row" style="color: #eee">
              <h3>Location</h3>
              <br>
              <div class="col-md-6 col-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2729.066336361882!2d121.08279428422526!3d14.68527764210799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ba0692c1d0c5%3A0xb5254793a2126741!2s30+Sta.+Catalina+St%2C+Quezon+City%2C+1127+Metro+Manila!5e0!3m2!1sen!2sph!4v1566368430462!5m2!1sen!2sph" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
              <div class="col-md-6 col-12" style="">
                <p style="text-align: left; font-size: 16px">Everyone is invited to attend TBCMS' regular seminars and orientation and to be updated of the blog news from the admin of TBC.</p>
                <br>
                <div class="col-md-6">
                  <p style="text-align: left; font-size: 18px">
                  <b>Address</b>
                  </p>
                  <p style="text-align: left; font-size: 16px">
                  30-B Sta. Catalina Street Holy Spirit, Quezon City, Philippines
                  </p>
                  <br>
                  <p style="text-align: left; font-size: 18px">
                  <b>Contacts</b>
                  </p>
                  <ul style="text-align: left">
                    <li>+639 45-883-3876</li>
                    <li>tbcmservices@gmail.com</li>
                  </ul>
                </div>
                <div class="col-md-6">
                  <p style="text-align: left; font-size: 18px">
                  <b>Useful links</b>
                  </p>
                  <ul style="text-align: left">
                    <li><a href="https://tbcmerchantservices.com/shopping">Shop</a></li>
                    <li><a href="https://tbcmerchantservices.com/edudona">Edudona trading</a></li>
                    <li><a href="https://tbcmerchantservices.com/contact">Contact Us</a></li>
                  </ul>
                  
                </div>
              </div>
            </div>
            <br>
            <hr style="border: 1px solid #333">
            <div class="row">
              <div class="col-md-12">
                <div style="float:right">
                  <span style="color: white">Copyright @ 2016-2018 TheBillionCoin Merchant Services</span>
                </div>
                <div style="float:left">
                  <a href="https://www.facebook.com/tbcmerchantservices/"><span style="color: white; margin: 0 5px" class="ti-facebook"></span></a>
                  <a href="https://twitter.com/Tbcmsshop"><span style="color: white; margin: 0 5px" class="ti-twitter-alt"></span></a>
                  <a href="https://www.youtube.com/channel/UCvM6o2yveIHMICslz5yovBg"><span style="color: white; margin: 0 5px" class="ti-youtube"></a>
                  <a href="https://play.google.com/store/apps/details?id=tbcservices.thebillioncoinapp&hl=en"><span style="color: white; margin: 0 5px" class="ti-android"></a>
                  
                </div>
              </div>
              
  
            </div>
            
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

      public function show_user_details($fullname, $lastname, $firstname, $middlename, $cellphone, $birthday, $address) {
        ?>

        <div class="col-md-8 alert">
          <h1><b style="color:#A52A2A"><?php echo $fullname;?></b><br><span style="font-size: 25px;"><?php echo $cellphone;?></span>
          </h1>
          <h3><b>PROFILE INFORMATION</b></span></h3><hr>
          <form method="post">
            <div>
              <div class="col-md-3">LastName:</div>
              <div class="col-md-9"><h4 id = "desc_last"><b><?php if (empty($lastname)){echo  "-";}else{ echo  $lastname;}?></b></h4>
                <input hidden id = "txt_last" type="text" name="last_name" style="width: 100%" value= '<?php echo $lastname; ?>' >
              </div>
            </div>
            <div>
              <div class="col-md-3">FirstName:</div>
              <div class="col-md-9"><h4 id = "desc_first"><b><?php if (empty($firstname)){echo  "-";}else{ echo  $firstname;} ?></b></h4>
                <input hidden id = "txt_first" type="text" name="first_name" style="width: 100%" value= '<?php echo $firstname; ?>' >
              </div>
            </div>
            <div>
              <div class="col-md-3">MiddleName:</div>
              <div class="col-md-9"><h4 id = "desc_middle"><b><?php if (empty($middlename)){echo  "-";}else{ echo  $middlename;} ?></b></h4>
                <input hidden id = "txt_middle" type="text" name="middle_name" style="width: 100%" value= <?php echo $middlename; ?> >
              </div>
            </div>
            <div>
              <div class="col-md-3">Birthday:</div>
              <div class="col-md-9"><h4 id = "desc_birth"><b><?php $this->dateformat($birthday);?></b></h4>
                <input hidden id = "txt_birth" type="text" name="birth_day" style="width: 100%" value= <?php echo $birthday; ?> >
              </div>
            </div>
            <div>
              <div class="col-md-3">Contact:</div>
              <div class="col-md-9"><h4 id = "desc_cell"><b><?php if (empty($cellphone)){echo  "-";}else{ echo  $cellphone;} ?></b></h4>
                <input hidden id = "txt_cell" type="text" name="cell_phone" style="width: 100%" value= '<?php echo $cellphone;?>' >
              </div>
            </div>
            <div>
              <div class="col-md-3">Address:</div>
              <div class="col-md-9"><h4 id = "desc_address"><b><?php if (empty($address)){echo  "-";}else{ echo  $address;} ?></b></h4>
                <textarea hidden id = "txt_address" type="text" name="addr" style="width: 100%" > <?php echo $address;?>  </textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3"></div>
              <br><br>
              <div class="col-md-9" style= "width:100%; padding-left:40px">
                <span id="edit_profile_btn"> <a  style= "margin: auto; float:right; width:30%" href="javascript:void(0)" onclick=edit_profile();
                                          class="btn btn-warning btn-md"> Edit Details </a>
                </span>
                <span hidden id="confirm_profile_btn"> <a style= "margin: auto; float:right; width:20%" href="javascript:void(0)" onclick=$("#profile_edit").click();
                                          class="btn btn-info  btn-md"> Confirm </a>
                </span>
                <span hidden id="cancel_profile_btn"> <a style= "margin: auto; float:right; width:20%" href="javascript:void(0)" onclick=cancel_edit_profile()
                                          class="btn btn-danger  btn-md"> Cancel </a>
                </span>
                <input hidden type = "submit" name = "profile_edit" id = "profile_edit">

              </div>
            </div>


          </form>

        </div>

        <?php
      }
      public function show_merchant_details($ctr, $business_name, $business_category, $business_description, $business_country, $fullname, $birthday, $cellphone, $address){
        ?>

        <div class="col-md-8 alert">
          <div>
            <img src="https://tbcmerchantservices.com/images/TBCMSTOS.png" width="100%">
          </div>
          <form method="post">

          <h1><b id="desc_bussiness_name" style="color:#A52A2A"><?php if (empty($business_name)){echo  "-";}else{ echo  $business_name;} ?></b>
            <input hidden id = "txtm_business_name" type="text" name="txtm_business_name" style="width: 100%" value= '<?php echo $business_name; ?>' >
            <br><span style="font-size: 25px;"><?php echo $business_category;?></span>
          </h1><hr>
          <h4 id="desc_business_desc"><?php if (empty($business_description)){echo  "-";}else{ echo  $business_description;}?></h4>
          <input hidden id = "txtm_business_desc" type="text" name="txtm_business_desc" style="width: 100%" value= '<?php echo $business_description; ?>' >

          <hr><h3><b>TBC BUSINESS REGISTRATION</b></span></h3><hr>
          <div>
            <div class="col-md-3">Country:</div>
            <div class="col-md-9"><h4 id="desc_country"><b><?php if (empty($business_country)){echo  "-";}else{ echo  $business_country;}?></b></h4>
              <input hidden id = "txtm_country" type="text" name="txtm_country" style="width: 100%" value= '<?php echo $business_country; ?>' >
            </div>
          </div>
          <div>
            <div class="col-md-3">Registered by:</div>
            <div class="col-md-9"><h4 id="desc_fullname"><b><?php if (empty($fullname)){echo  "-";}else{ echo  $fullname;}?></b></h4>
              <input hidden id = "txtm_fullnamexx" type="text" name="txtm_fullnamexx" style="width: 100%" value= '<?php echo $fullname; ?>' >
            </div>
          </div>
          <div>
            <div class="col-md-3">Birthday:</div>
            <div class="col-md-9"><h4 id="desc_birth"><b><?php $this->dateformat($birthday);?></b></h4>
              <input hidden id = "txtm_birthday" type="text" name="txtm_birthday" style="width: 100%" value= <?php echo $birthday; ?> >
            </div>
          </div>
          <div>
            <div class="col-md-3">Cellphone:</div>
            <div class="col-md-9"><h4 id="desc_cell"><b><?php  if (empty($cellphone)){echo  "-";}else{ echo  $cellphone;} ?></b></h4>
              <input hidden id = "txtm_cellphone" type="text" name="txtm_cellphone" style="width: 100%" value= <?php echo $cellphone; ?> >
            </div>
          </div>
          <div>
            <div class="col-md-3">Address:</div>
            <div class="col-md-9"><h4 id="desc_address"><b><?php if (empty($address)){echo  "-";}else{ echo  $address;} ?></b></h4>
              <textarea hidden id = "txtm_addr" type="text" name="txtm_addr" style="width: 100%" > <?php echo $address; ?> </textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3"></div>
            <br><br>
            <div class="col-md-9" style= "width:100%; padding-left:40px">
              <span id="edit_merchantprofile_btn"> <a  style= "margin: auto; float:right; width:30%" href="javascript:void(0)" onclick=edit_merchantprofile();
                                        class="btn btn-warning btn-md"> Edit Details </a>
              </span>
              <span hidden id="confirm_merchantprofile_btn"> <a style= "margin: auto; float:right; width:20%" href="javascript:void(0)" onclick=$("#merchantprofile_edit").click();
                                        class="btn btn-info  btn-md"> Confirm </a>
              </span>
              <span hidden id="cancel_merchantprofile_btn"> <a style= "margin: auto; float:right; width:20%" href="javascript:void(0)" onclick=cancel_edit_merchantprofile()
                                        class="btn btn-danger  btn-md"> Cancel </a>
              </span>
              <input hidden type = "submit" name = "merchantprofile_edit" id = "merchantprofile_edit">

            </div>
          </div>
        </form>

          <h3><b>SUPPORTING DOCUMENTS</b></span></h3><hr>
          <div>
            <?php
              $doc_query="select * from xtbl_requirements where Main_Ctr='$ctr' limit 3";
              $doc_rs=mysql_query($doc_query);
              $doc_counter=0;
              while($doc_rows=mysql_fetch_assoc($doc_rs)){
                echo '<div class="col-md-4">
                    <img src="https://tbcmerchantservices.com/'.$doc_rows['Image'].'" width="100%">
                  </div>';
              }
            ?>
            <form action="" enctype="multipart/form-data" method="post">
				<input id='upload' name="upload[]" type="file" multiple="multiple" accept="image/*"/><br>
				<input id="txtsubmit_upload" type="submit" hidden name="submit" value="Submit" />
				<a href="javascript:void(0)" onclick="$('#txtsubmit_upload').click();" id="btn_upload_requirements" class="btn btn-primary btn-lg">
						SEND IMAGES</a>
			</form><br>
          </div>

        </div>

        <?php
      }
      public function pre_process_form($form){
        $form=str_replace("'", '', $form);
        $form=str_replace('"', '', $form);
        $form=str_replace("<", '', $form);
        $form=str_replace('>', '', $form);

        return $form;
      }

	}
?>
