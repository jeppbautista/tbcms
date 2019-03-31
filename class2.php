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
	    				<a href="https://tbcmerchantservices.com/exchange/">
	    					<img width="120px" src="https://tbcmerchantservices.com/images/tbc_exchange.png">
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
    <br><br><br>
			<div class="footer" style="background:#008B8B;width:100%;height:42px;position:fixed;bottom:0;left:0; font-size: 15px">
				<div class="container" align="center">
					<span style="color: white">Copyright @TheBillionCoin Merchant</span>

				</div>
			</div>
		<?php
	    }

	    public function home_tbcinfo() {
	    ?>
			<div class="container">

				<div class="col-md-6">
			 <br></br>	<img src="https://tbcmerchantservices.com/images/SLIDE1_1.png" width="100%">
				<br></br>	<h4 align="center">MISSION</h4>
					To provide a better and clearer Financial Road Map of users of TBC, The Billion Coin valuing and using it through Merchant Services in Advertising, Online Store and Exchange Platforms for the benefit of TBC Community and the fulfilment of TBC Mission.
				<br></br>	<h4 align="center">VISION</h4>
					An Abundant and Prosperous Global Community empowered by The Billion Coin towards Financial equality  showing  respect and love to  humanity and God the Almighty.<br><br>
				</div>

				<div class="col-md-6">
					<br></br> <img src="https://tbcmerchantservices.com/images/SLIDE3_1.png" width="100%">
				<br></br><br></br>	As a verified merchant of TBCMS, you will be given a lifetime full access to the online system for free. You can surely update the store in its services. This will be your Online Shopping Mall where users of TBCMS can buy products and delivered to their home.
  					<br><br>
    				As a regular verified user of TBCMS, you will have an access to the Online Shopping Mall as a customer only. You will be also earning points in using this platform and referring others. Each point is equivalent to one peso.<br><br>
				</div>

			</div>

			<div class="container">

				<div class="col-md-6">
				<br></br>	<img src="https://tbcmerchantservices.com/images/SLIDE2_1.png" width="100%">
					<h4 align="center">MISSION</h4>
					This TBCMS Platform helps  the merchants advertise their products and services to more direct customers from the verified users of the site. Thus, in using the system and referring to others earn points. Each point is equivalent to one peso.
				</div>

				<div class="col-md-6">
				<br></br>	<img src="https://tbcmerchantservices.com/images/SLIDE4_1.png" width="100%">
				<br></br>	As verified TBCMS Merchant and regular user or customer of the system, you are exclusively qualified for this Online Exchange of TBC Coins to be exchanged with the local currency and debited to your assigned ATM which can be withdrawn from accredited ATM machine globally.
<br></br>
<br></br>
<br></br>
				</div>
			<br></br>
			</div>
	    <?php
	    }

	}
?>
