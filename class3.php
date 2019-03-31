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

	}
?>
