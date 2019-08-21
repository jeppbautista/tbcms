<?php


class mydesign
{

	public function database_connect()
	{
		if ($this->isLocalhost()== true)
		{

			$conn = @mysql_connect('localhost', 'root', '');
			@mysql_select_db('xdb_tbcmerchantservices', $conn);

		}
		else{
			$conn = @mysql_connect('ebitshares.ipagemysql.com', 'urfren_samson', '091074889701_a');
			@mysql_select_db('xdb_tbcmerchantservices', $conn);

		}
		if (!$conn) {
			die('Could not connect: ' . mysql_error());
		}

	}

	public function isLocalhost($whitelist = ['127.0.0.1', '::1']) {
		return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
	}

	public function doc_type()
	{
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	}

	public function html_start($xmlns)
	{
		echo '<html xmlns="' . $xmlns . '">';
	}

	public function get_connection()
	{
		return $this->conn;
	}

	public function html_end()
	{
		echo '</html>';
	}

	public function head_start()
	{
		echo '<head>';
	}

	public function head_end()
	{
		echo '</head>';
	}

	public function link($href)
	{
		echo '<link href="' . $href . '" rel="stylesheet" />';
	}

	public function link_icon($icon)
	{
		echo '<link rel="shortcut icon" type="image/x-icon" href="' . $icon . '" />';
	}

	public function script($src)
	{
		echo '<script src="' . $src . '"></script>';
	}

	public function meta($http_equiv, $content, $name)
	{
		echo '<meta name="' . $name . '" http-equiv="' . $http_equiv . '" content="' . $content . '">';
	}

	public function title_page($title)
	{
		echo '<title>' . $title . '</title>';
	}

	public function body_start($attrib)
	{
		echo '<body ' . $attrib . '>';
	}

	public function body_end()
	{
		echo '</body>';
	}

	public function category_option()
	{
		$query = "select * from xtbl_category Order by Category ASC";
		$rs    = mysql_query($query);
		while ($row = mysql_fetch_assoc($rs)) {
			echo '<option value="' . $row['Category'] . '">' . $row['Category'] . '</option>';
		}
	}

	public function country_option()
	{
		$query = "select * from xtbl_country Order by Country ASC";
		$rs    = mysql_query(query);
		while ($row = mysql_fetch_assoc($rs)) {
			echo '<option value="' . $row['Country'] . '">' . $row['Country'] . '</option>';
		}
	}

	public function page_welcome_header_start()
	{
		?>
		<!-- START - UI Change content -->
		<nav class="navbar navbar-default" style="margin: 0;">
			<!-- END - UI Change content -->
<!-- <div style="background-color: rgb(255,255,255,0.5); height: auto; padding-top: 10px;
background-image: url('https://tbcmerchantservices.com/images/Picture3.jpg'); background-size: 100% auto">
-->
<?php

}

public function page_welcome_header_end()
{
	echo '</div>';
}


public function chatscript()
{
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

public function page_welcome_header_content_start($error)
{
	if ($error == 1) {
		$error = 'Email Format Invalid';
	} else if ($error == 2) {
		$error = 'Email not Available';
	}
	?>
	<!-- START - NEW UI Change content -->
	<div class="container-fluid" style="padding-right: 0; background: #fff;">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="https://tbcmerchantservices.com/home/">
				<img width="150px" src="https://tbcmerchantservices.com/images/tbsheader.png"> </a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<!-- Reopen to add new items -->
					<!-- <ul class="nav navbar-nav">
						<li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
					</ul> -->
				<!-- //Reopen to add new items -->

				<ul class="nav navbar-nav navbar-right">
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >Sign up <span class="caret"></span></a>
						<ul class="dropdown-menu" style="width: 280px;padding: 20px;left: auto; right: 0;font-size: 14px;" >
							<form method="POST">
								<li style="color: red; text-align: right;"><?php echo $error;?></li>
								<li>
									<p>Fill in this form to create your account!</p>
									<div class="form-group">
										<input name="txttbc_email_checksignup" style="text-align: center;" class="form-control" placeholder="EMAIL ADDRESS"/>
									</div>
								</li>
								<li role="separator" class="divider"></li>
								<li>
									<div class="form-group">
										<input name="submit_email_signup" hidden type="submit" />
										<button class="btn btn-primary btn-block" onclick='$("[name=submit_email_signup]").click();'>SUBMIT</button>
									</div>
								</li>
							</form>
						</ul>
					</li>

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="background: #214E11; color: white;">Login  <span class="caret"></span></a>
						<ul class="dropdown-menu" style="width: 320px;padding: 20px;left: auto; right: 0;font-size: 14px;" >
							<form method="POST">
								<?php
								$randomcapcha = mt_rand(1, 12);
								?>
								<li style="color: red; text-align: right;"><?php echo $error;?></li>
								<p>Please fill the following forms.</p>
								<div class="form-group">
									<div class="input-group" style="margin-bottom: 0.5rem;">
										<span class="input-group-addon" id="sizing-addon2" >
											<span class="ti-user"></span>
										</span>
										<input name="tbctxt_username_login" class="form-control"  placeholder="Username" />
									</div>

									<div class="input-group" style="margin-bottom: 0.5rem;">
										<span class="input-group-addon" id="sizing-addon2" >
											<span class="ti-lock"></span>
										</span>
										<input name="tbctxt_password_login" class="form-control"  placeholder="Password"
										type="password" />
									</div>
									<div class="input-group" style="margin-bottom: 0.5rem;">
										<?php
										echo '<input name="tbctxt_capchaval_login" hidden value="' . $randomcapcha . '"/>';
										echo '<img width="100%" src="https://tbcmerchantservices.com/captcha/' . $randomcapcha . '.jpg">';
										?>
										<input name="tbctxt_captcha_login" class="form-control" width="100%" placeholder="Enter the characters above." />
									</div>
									<!-- <p>Type the characters you see below to prove you are human.</p> -->
									<input hidden id="loginsubmit" type="submit"/>
									<li role="separator" class="divider"></li>
									<div class="row">
										<div class="col-md-6">
											<a href="https://tbcmerchantservices.com/reset/" class="btn">Forgot Password?</a>
										</div>
										<div class="col-md-6">
											<a href="javascript:void(0)" onclick="$('#loginsubmit').click()" class="btn btn-primary form-control"
									>LOGIN</a>
										</div>
									</div>
								</div>
								
							</form>
						</ul>
					</li>

				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<!-- END - NEW UI Change content -->

	<!-- START - OLD Version -->
	<!-- <div class="container">
		<div class="col-md-5" style="padding-bottom: 5px;">
			<a href="https://tbcmerchantservices.com/home/">
			<img width="230px" src="https://tbcmerchantservices.com/images/tbsheader.png"> </a>
		</div>
		<div class="col-md-3" style="color: red; text-align: right;">
			<?php echo $error; ?>
		</div>
		<div class="col-md-4">

			<form method="POST">
				<div class="col-md-7" style="padding-right: 0px;padding-left: 0px; padding-bottom: 3px;padding-top: 3px;">
					<input name="txttbc_email_checksignup" style="text-align: center;border-radius: 0px" class="form-control" placeholder="EMAIL ADDRESS"/>
				</div>
				<div class="col-md-5" style="padding-right: 0px;padding-left: 0px;padding-top: 3px;">
					<input name="submit_email_signup" hidden type="submit" />
					<button class="btn btn-success btn-block" style="border-radius: 0px" onclick='$("[name=submit_email_signup]").click();'>SIGN UP</button>
				</div>
			</form>

		</div>
	</div>	
 -->
	<!-- END - OLD Version -->
		<?php
	}

	public function page_welcome_header_content_start_body($error)
	{
		$membercountquery = "select * from xtbl_main_info";
		$membercountrs    = mysql_query($membercountquery);
		$memberrcountrows = mysql_num_rows($membercountrs);

		?>

		
		<!-- START - NEW UI Change content -->
		<div class="container-fluid" style="background: url(https://tbcmerchantservices.com/images/Picture3.jpg) center no-repeat; min-height: 93vh; background-size: cover; padding: 0; background-attachment: fixed;">
<!-- 		<div class="container-fluid" style="background: url('./assets/images/btc-blockchain.jpg') center no-repeat; min-height: 90vh; background-size: cover; padding: 0;"> -->
			<div style="position: absolute; background: rgba(0,0,0,0.5); height: 93%;width: 100%;">
				<div class="container">
					<div class="row">
						<div class="col-md-12" style="color: #fff; margin-top: 30vh;">
							<h1 style="color: #BC9F3B;">The Billion Coin Merchant Services</h1>
							<h3>A Digital Store Powered By The Billion Coin</h3>
							<h5> Join us with <strong><?php echo $memberrcountrows; ?> 200 </strong> other TBCMS users!
							</h5>
						</div>
					</div>
					<div class="row" style="margin-top: 12%">
						<div class="center">
							<div class="col-md-12">
							<p style="color: white; text-align: center">Enter your email to get started.</p>
							<form method="POST">
								<div class="input-group" style="width: 40%; margin: auto;" id="email-group">
									<input type="text" id="txttbc_email_checksignup" name="txttbc_email_checksignup" class="form-control" placeholder="your_email@email.com">
									<span class="input-group-btn">
										<input name="submit_email_signup" hidden type="submit" />
										<button class="btn btn-warning" type="button" onclick='$("[name=submit_email_signup]").click();'>
									Get Started! </button>
									</span>
								</div>
							</form>
							
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>

			<!-- START - NEWS Update -->
			<div class="container" style="padding: 2rem;">
				<div class="row" style="margin-bottom: 1rem;">
					<div class="col-md-12 text-center" >
						<h2 style="margin-bottom: 0;">NEWS UPDATE</h2>
						<h3><small></small></h3>
					</div>
				</div>
				<div class="row news-update-panels">
					<div class="col-md-6">
						
						<div class="panel panel-default border-frame-dark" style="padding: 3rem; text-align: center; width: auto; height: 250px;">
							<div class="panel-body">
							<a href="https://tbcmerchantservices.com/shopping/"  style="text-decoration: none;">
								<span style="font-size: 3em;"><i class="ti-shopping-cart" style="color: #BC9F3B;"></i></span>
								<hr>
								<h3 style="text-transform: uppercase;">NEW AND IMPROVED SHOP</h3>
							</a>
							</div>
						</div>
					</div>

					<div class="col-sm-12 col-md-6 col-lg-6">
						<a href="https://tbcmerchantservices.com/edudona/" style="text-decoration: none;">
							<div class="panel panel-default border-frame-dark" style="padding: 3rem; text-align: center; width: auto; height: 250px;">
								<div class="panel-body">
									<span style="font-size: 3em;"><i class="ti-heart" style="color: #ff9eb5;"></i></span>
									<hr>
									<h3 style="text-transform: uppercase;">Donate and Earn using EDUDONA</h3>
								</div>
							</div>
						</a>
					</div>
				</div>

	<!-- 			<div class="row" style="text-align: center;">
					<h2>Other Services</h2>
					<div class="col-md-12"> </div>
				</div> -->
			</div>
			<!-- END - NEWS Update -->
			<!-- START - Intorduction -->
			<div class="container-fluid" style="background: url('./assets/images/backgrounds-blank-blue.jpg') fixed; background-size: cover;">
				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-6" style="padding: 8% 3rem; color: #fff; "> 
						<h2 style="text-align: left;">WHAT IS TBCMS?</h2>
						<hr style="width: 18%;">
						<p>TBCMS is a third party merchant adoption of The Billion Coin. It is an online e-commerce platform that provides the users as buyers and sellers. 
							This TBCMS system is empowered by the digital currency payment process known as Kringle Cash using 50/50 engagement for purchasing of the products sold in the store.</p>
							</div>
					<div class="col-sm-12 col-md-6 col-lg-6" style="padding: 3rem;"> 
						<div style="margin: 3rem;">
							<iframe class="border-frame-light" width="100%" height="300" src="https://www.youtube.com/embed/gnQjV8gTk88" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
						
					</div> 
				</div>	
				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-6" style="padding: 8% 3rem; color: #fff; "> 
						<h2 style="text-align: left;">Mission & Vision</h2>
						<hr style="width: 18%;">
						<p>To uphold the mission & vision of  The Billion Coin & Kringle Cash in the promotion and usage as money to pay for products and services in 50/50% process until it would be strongly developed into 100% full TBC lifetime.</p>
							</div>
					<div class="col-sm-12 col-md-6 col-lg-6" style="padding: 3rem;"> 
						<div style="margin: 3rem;">
							<iframe class="border-frame-light" width="100%" height="300" src="https://www.youtube-nocookie.com/embed/2IDLo0lWeOg?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div> 		
				</div>
			</div>
			<!-- END - Intorduction -->

			<div class="container-fluid" style="background-color: #fff;" >
				<div class="col-md-12 col-sm-12 col-lg-12" style="padding: 2rem 0rem;text-align: center; color: #fff;">
					<div>
						<!-- <div style="margin-bottom: 1rem;">
							<span class="btn btn-circle btn-xl" style="font-size: 2.5rem; color: #214E11; background: #fff;"><i class="far fa-handshake" style="margin: 10px -2px;"></i></span>
						</div> -->
						<h2 style="color: #333;">OUR LATEST MERCHANTS</h2>
								<br> 
						<hr width="50%" style="margin:auto">
						<br>
						<!-- <h2> <small style="color: #fff;">With Our Latest Merchants</small> </h2> -->
					</div>
<!-- 					
					<div class="present-carousel">
						<div class="present-carousel-item">
							<div class="wrap">
								<div class="overlay">
									<div class="text">Turtle1</div>
								</div>	
								<img class="border-frame-light img-responsive" src="./assets/images/dump_images/dump-image-1.jpeg">
							</div>
						</div>
	    				<div class="present-carousel-item">
							<div class="wrap">
								<div class="overlay">
									<div class="text">Foobar</div>
								</div>	
								<img class="border-frame-light" src="./assets/images/dump_images/dump-image-2.jpg">
							</div>
	    				</div>
	    				<div class="present-carousel-item">
	    					<div class="wrap">
								<div class="overlay">
									<div class="text">Girl</div>
								</div>	
								<img class="border-frame-light" src="./assets/images/dump_images/dump-image-3.jpg">
							</div>
						</div>
						<div class="present-carousel-item">
							<div class="wrap">
								<div class="overlay">
									<div class="text">Turtle</div>
								</div>	
								<img class="border-frame-light" src="./assets/images/dump_images/dump-image-1.jpeg">
							</div>
						</div>
	    				<div class="present-carousel-item">
	    					<div class="wrap">
								<div class="overlay">
									<div class="text">Turtle</div>
								</div>	
								<img class="border-frame-light" src="./assets/images/dump_images/dump-image-2.jpg">
							</div>
	    				</div>
	    				<div class="present-carousel-item">
	    					<div class="wrap">
								<div class="overlay">
									<div class="text">Girl2</div>
								</div>	
								<img class="border-frame-light" src="./assets/images/dump_images/dump-image-3.jpg">
							</div>
						</div>
						<div class="present-carousel-item">
							<div class="wrap">
								<div class="overlay">
									<div class="text">Turtle3</div>
								</div>	
								<img class="border-frame-light" src="./assets/images/dump_images/dump-image-1.jpeg">
							</div>
						</div>
	    				<div class="present-carousel-item">
	    					<div class="wrap">
								<div class="overlay">
									<div class="text">Man with Glasses</div>
								</div>	
								<img class="border-frame-light" src="./assets/images/dump_images/dump-image-2.jpg">
							</div>
	    				</div>
	    				<div class="present-carousel-item">
	    					<div class="wrap">
								<div class="overlay">
									<div class="text">Man with Glasses</div>
								</div>	
								<img class="border-frame-light" src="./assets/images/dump_images/dump-image-2.jpg">
							</div>
						</div>
						<div class="present-carousel-item">
							<div class="wrap">
								<div class="overlay">
									<div class="text">Man with Glasses</div>
								</div>	
								<img class="border-frame-light" src="./assets/images/dump_images/dump-image-2.jpg">
							</div>
						</div>
	    				<div class="present-carousel-item">
	    					<div class="wrap">
								<div class="overlay">
									<div class="text">Man with Glasses</div>
								</div>	
								<img class="border-frame-light" src="./assets/images/dump_images/dump-image-2.jpg">
							</div>
	    				</div>
	    				<div class="present-carousel-item">
						<div class="wrap">
								<div class="overlay">
									<div class="text">Man with Glasses</div>
								</div>	
								<img class="border-frame-light" src="./assets/images/dump_images/dump-image-2.jpg">
							</div>
						</div>
						<div class="present-carousel-item">
						<div class="wrap">
								<div class="overlay">
									<div class="text">Man with Glasses</div>
								</div>	
								<img class="border-frame-light" src="./assets/images/dump_images/dump-image-2.jpg">
							</div>
						</div>
	    				<div class="present-carousel-item">
						<div class="wrap">
								<div class="overlay">
									<div class="text">Man with Glasses</div>
								</div>	
								<img class="border-frame-light" src="./assets/images/dump_images/dump-image-2.jpg">
							</div>
	    				</div>
	    				<div class="present-carousel-item">
						<div class="wrap">
								<div class="overlay">
									<div class="text">Man with Glasses</div>
								</div>	
								<img class="border-frame-light" src="./assets/images/dump_images/dump-image-2.jpg">
							</div>
	    				</div>
					</div>	 -->
	<section class="carousel-wrapper">
		<div class="">
		<div class="row">

			<ul class="col-md-12 present-carousel text-center">
			<li>
				<a href="#">
				<div class="img_cont">
					<img class="img-responsive" src="../assets/images/dump_images/dump-image-1.jpeg" alt="">

					<div class="overlay">
					<div class="overlay-content">
						<h4>content</h4>
					</div>
					</div>
				</div>
				</a>
			</li>
			<li>
				<a href="#">
				<div class="img_cont">
					<img class="img-responsive" src="../assets/images/dump_images/dump-image-1.jpeg" alt="">

					<div class="overlay">
					<div class="overlay-content">
						<h4>content</h4>
					</div>
					</div>
				</div>
				</a>
			</li>
			<li>
				<a href="#">
				<div class="img_cont">
					<img class="img-responsive" src="../assets/images/dump_images/dump-image-1.jpeg" alt="">

					<div class="overlay">
					<div class="overlay-content">
						<h4>content</h4>
					</div>
					</div>
				</div>
				</a>
			</li>
			<li>
				<a href="#">
				<div class="img_cont">
					<img class="img-responsive" src="../assets/images/dump_images/dump-image-1.jpeg" alt="">

					<div class="overlay">
					<div class="overlay-content">
						<h4>content</h4>
					</div>
					</div>
				</div>
				</a>
			</li>
			<li>
				<a href="#">
				<div class="img_cont">
					<img class="img-responsive" src="../assets/images/dump_images/dump-image-1.jpeg" alt="">

					<div class="overlay">
					<div class="overlay-content">
						<h4>content</h4>
					</div>
					</div>
				</div>
				</a>
			</li>
			<li>
				<a href="#">
				<div class="img_cont">
					<img class="img-responsive" src="../assets/images/dump_images/dump-image-1.jpeg" alt="">

					<div class="overlay">
					<div class="overlay-content">
						<h4>content</h4>
					</div>
					</div>
				</div>
				</a>
			</li>
			<li>
				<a href="#">
				<div class="img_cont">
					<img class="img-responsive" src="../assets/images/dump_images/dump-image-1.jpeg" alt="">

					<div class="overlay">
					<div class="overlay-content">
						<h4>content</h4>
					</div>
					</div>
				</div>
				</a>
			</li>
			<li>
				<a href="#">
				<div class="img_cont">
					<img class="img-responsive" src="../assets/images/dump_images/dump-image-1.jpeg" alt="">

					<div class="overlay">
					<div class="overlay-content">
						<h4>content</h4>
					</div>
					</div>
				</div>
				</a>
			</li>

			<li>
				<a href="#">
				<div class="img_cont">
					<img class="img-responsive" src="../assets/images/dump_images/dump-image-1.jpeg" alt="">

					<div class="overlay">
					<div class="overlay-content">
						<h4>content</h4>
					</div>
					</div>
				</div>
				</a>
			</li>
			<li>
				<a href="#">
				<div class="img_cont">
					<img class="img-responsive" src="../assets/images/dump_images/dump-image-1.jpeg" alt="">

					<div class="overlay">
					<div class="overlay-content">
						<h4>content</h4>
					</div>
					</div>
				</div>
				</a>
			</li>
			<li>
				<a href="#">
				<div class="img_cont">
					<img class="img-responsive" src="../assets/images/dump_images/dump-image-1.jpeg" alt="">

					<div class="overlay">
					<div class="overlay-content">
						<h4>content</h4>
					</div>
					</div>
				</div>
				</a>
			</li>
			<li>
				<a href="#">
				<div class="img_cont">
					<img class="img-responsive" src="../assets/images/dump_images/dump-image-1.jpeg" alt="">

					<div class="overlay">
					<div class="overlay-content">
						<h4>content</h4>
					</div>
					</div>
				</div>
				</a>
			</li>
			<li>
				<a href="#">
				<div class="img_cont">
					<img class="img-responsive" src="../assets/images/dump_images/dump-image-1.jpeg" alt="">

					<div class="overlay">
					<div class="overlay-content">
						<h4>content</h4>
					</div>
					</div>
				</div>
				</a>
			</li>
			<li>
				<a href="#">
				<div class="img_cont">
					<img class="img-responsive" src="../assets/images/dump_images/dump-image-1.jpeg" alt="">

					<div class="overlay">
					<div class="overlay-content">
						<h4>content</h4>
					</div>
					</div>
				</div>
				</a>
			</li>

			</ul>

		</div>
		</div>
	</section>
					
					

				</div>
			</div>

			<div class="container-fluid" style="background: #599DC0;">
				<div class="row">
					<div class="col-sm-6 col-md-12 col-lg-12" style="padding: 13%; text-align: center;"> 
						<div style="margin-bottom: 1rem;">
							<span class="btn btn-circle btn-xl" style="font-size: 3rem; color: #fff; background: #214E11;"><i class="fas fa-hand-holding-usd"></i></span>
						</div>
						<h1 class="header-secondary" style="color:white">THE CURRENT PRICE</h1>
						<hr style="margin: 1rem 33%; width: 32%; border: 0.5px solid #214E11;">
						<p class="light" style="color:white">The Current Price is increased once every 24 hours according to the Formula embedded within the software until it reaches its Ultimate Price. The value of The Billion Coin is not attached to the volatility of the markets, and both Buyers and Sellers of TBC use the Current Price to conduct transactions.</p>
					</div> 
				</div>
			</div>
		<!-- END - NEW UI Change content -->
			<?php
		}

		public function page_welcome_header_content_start_footer()
		{
			?>
			<div class="footer container-fluid">
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

		public function page_welcome_header_content_signup()
		{
			?>
			<div class="container">
				<div class="col-md-5" style="padding-bottom: 5px;">
					<a href="https://tbcmerchantservices.com/welcome/">
						<img width="230px" src="https://tbcmerchantservices.com/images/tbsheader.png">
					</a>
				</div>
				<div class="col-md-3" style="color: red; text-align: right;"></div>
				<div class="col-md-4"></div>
			</div>

			<?php
		}

		public function page_welcome_header_content_signup_body($email)
		{
			?>
			<form method="POST" id="signup_form_submit">
				<div class="container">
					<h3><b>PERSONAL INFORMATION</b>
						<span id="personal_error" style="color: red; font-size: 16px;font-weight: bold"></span>
					</h3>
				</div>

				<div class="container">
					<div>
						<div class="col-md-1" style="padding: 3px;">
							<h4 style="color: #A9A9A9">Referral ID</h4>
						</div>
						<div class="col-md-4" style="padding: 3px">
							<input name="txttbc_referral_signup" class="form-control" readonly style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%"/>
						</div>
						<div class="col-md-7" style="padding: 3px">&nbsp</div>
					</div>
				</div>

				<div class="container">
					<div>
						<div class="col-md-1" style="padding: 3px;">
							<h4 style="color: #A9A9A9">Email</h4>
						</div>
						<div class="col-md-4" style="padding: 3px">
							<input name="txttbc_email_signup" class="form-control" readonly style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%"
							<?php
							echo 'value="' . $email . '"';
							?> />
						</div>
						<div class="col-md-7" style="padding: 3px">&nbsp</div>
					</div>
				</div>

				<div class="container">
					<div>
						<div class="col-md-4" style="padding: 3px;">
							<h4 style="color: #A9A9A9;">Last Name</h4>
							<input name="txttbc_lastname_signup" class="form-control" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%"
							placeholder="Enter Last Name" />
						</div>
						<div class="col-md-4" style="padding: 3px">
							<h4 style="color: #A9A9A9">First Name</h4>
							<input name="txttbc_firstname_signup" class="form-control" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%"
							placeholder="Enter First Name"/>
						</div>
						<div class="col-md-3" style="padding: 3px">
							<h4 style="color: #A9A9A9">Middle Name</h4>
							<input name="txttbc_middlename_signup" class="form-control" style="font-size: 18px; height: 40px; border-radius: 0px;width: 80%"
							placeholder="Enter Middle Name" />
						</div>
					</div>
				</div>

				<div class="container">
					<div class="col-md-2" style="padding: 3px;">
						<h4 style="color: #A9A9A9;">Birthday</h4>
						<input id = "birth-text" name="txttbc_bday_signup" class="form-control" type="text" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%; background-color: white"  placeholder="YYYY-MM-DD" />
					</div>
					<div class="col-md-3" style="padding: 3px;">
						<h4 style="color: #A9A9A9;">Cellphone No.</h4>
						<input name="txttbc_cellphone_signup" class="form-control" type="text" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%;" placeholder="Cellphone No" />
					</div>
					<div class="col-md-7" style="padding: 3px;">
						<h4 style="color: #A9A9A9;">Address</h4>
						<input name="txttbc_address_signup" class="form-control" type="text" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%;" placeholder="Your Address" />
					</div>
				</div><br>

				<input name="txttbc_test" class="form-control", type="hidden" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%;", value=<?php
				echo $GLOBALS['test'];
				?>>

				<div class="container" style="border-top: 1px solid green">
					<h3><b style="display: inline">BUSINESS INFORMATION</b> (<input checked style="display: inline; zoom:1.5;" type="checkbox" value="YES" name="txttbc_signasmerchantornot_signup" /> <small>Sign as Merchant</small>) <span id="business_error" style="color: red; font-size: 16px;font-weight: bold"></span></h3>
				</div>
				<script>

				</script>

				<span id="spanbuyerormerchant">
					<div class="container">
						<div class="col-md-2" style="padding: 3px;">
							<h4 style="color: #A9A9A9;">Business Name</h4>
						</div>
						<div class="col-md-5" style="padding: 3px;">
							<input name="txttbc_businessname_signup" class="form-control" type="text" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%;" placeholder="Business Name" />
						</div>
					</div>

					<div class="container">
						<div class="col-md-2" style="padding: 3px;">
							<h4 style="color: #A9A9A9;">Business Category</h4>
						</div>
						<div class="col-md-5" style="padding: 3px;">
							<select name="txttbc_businesscategory_signup" value="notjing" class="form-control" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%;">
								<?php
								mydesign::category_option();
								?>
							</select>
						</div>
					</div>

					<div class="container">
						<div class="col-md-2" style="padding: 3px;">
							<h4 style="color: #A9A9A9;">Description</h4>
						</div>
						<div class="col-md-10" style="padding: 3px;">
							<input name="txttbc_businessdescription_signup" class="form-control" type="text" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%;" placeholder="Business Description" />
						</div>
					</div>

					<div class="container">
						<div class="col-md-2" style="padding: 3px;">
							<h4 style="color: #A9A9A9;">Origin Country</h4>
						</div>
						<div class="col-md-5" style="padding: 3px;">

							<input name="txttbc_businesscountry_signup" class="form-control" type="text" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%;" placeholder="Country" />
						</div>
					</div><br>
				</span>
				<script>

				</script>

				<div class="container" style="border-top: 1px solid green">
					<h3><b>WALLET INFORMATION  </b> <span id="wallet_error" style="color: red; font-size: 16px;font-weight: bold"></span></h3>
				</div>

				<div class="container">
					<div class="col-md-2" style="padding: 3px;">
						<h4 style="color: #A9A9A9;">BTC Wallet</h4>
					</div>
					<div class="col-md-10" style="padding: 3px;">
						<input name="txttbc_walletbtc_signup" class="form-control" type="text" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%;" placeholder="Your BTC wallet address" />
					</div>
				</div>

				<div class="container">
					<div class="col-md-2" style="padding: 3px;">
						<h4 style="color: #A9A9A9;">CoinsPH Wallet</h4>
					</div>
					<div class="col-md-10" style="padding: 3px;">
						<span style="font-size: 15px; font-weight: bold; color: grey">
							If you dont have CoinsPh or BTC,
							<a href="https://coins.ph/invite/rzlard" target="_blank">Click HERE to Register</a>
						</span>
						<input name="txttbc_walletcoinsph_signup" class="form-control" type="text" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%;" placeholder="Your CoinsPH wallet address" />
					</div>
				</div>

				<div class="container">
					<div class="col-md-2" style="padding: 3px;">
						<h4 style="color: #A9A9A9;">Paypal Email</h4>
					</div>
					<div class="col-md-10" style="padding: 3px;">
						<input name="txttbc_walletpaypal_signup" class="form-control" type="text" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%;" placeholder="Your Paypal Email address" />
					</div>
				</div><br>

				<div class="container" style="border-top: 1px solid green">
					<h3><b>ACCOUNT INFORMATION</b> <span id="account_error" style="color: red; font-size: 16px;font-weight: bold"></span></h3>
				</div>

				<div class="container">
					<div class="col-md-2" style="padding: 3px;">
						<h4 style="color: #A9A9A9;">Username</h4>
					</div>
					<div class="col-md-4" style="padding: 3px;">
						<input name="txttbc_accountusername_signup" class="form-control" type="text" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%;" placeholder="Your Username" />
					</div>
				</div>

				<div class="container">
					<div class="col-md-2" style="padding: 3px;">
						<h4 style="color: #A9A9A9;">Password</h4>
					</div>
					<div class="col-md-4" style="padding: 3px;">
						<input name="txttbc_accountpassword_signup" class="form-control" type="password" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%;" placeholder="Your Password" />
					</div>
				</div>

				<div class="container">
					<div class="col-md-2" style="padding: 3px;">
						<h4 style="color: #A9A9A9;">Re-Password</h4>
					</div>
					<div class="col-md-4" style="padding: 3px;">
						<input name="txttbc_accountrepassword_signup" class="form-control" type="password" style="font-size: 18px; height: 40px; border-radius: 0px;width: 100%;" placeholder="Re-Enter Password" />
					</div>
				</div><br>

				<div class="container">
					<div class="col-md-2" ></div>
					<div class="col-md-2" style="padding: 3px;">
						<input hidden id="signup" type="submit" />
						<a href="javascript:void(0)"id="submit_complete_signupbutton" class="btn btn-primary btn-block btn-lg">
							PROCEED &nbsp<span class="glyphicon glyphicon-arrow-right"></span>
						</a>
					</div>
				</div>
			</form>
			<?php
		}

		public function page_welcome_displaymerchants_marquee(){
			$query = "select Main_Ctr from xtbl_account_info WHERE
			Email_Status='ACTIVE' AND Account_Type='MERCHANT' AND Account_Status='ACTIVE'
			AND Card_Status='ACTIVE' ORDER BY Ctr DESC LIMIT 100";
			$rs    = mysql_query($query);
			echo '<div class="">';
			echo '<h3>Our Latest Merchants</h3><hr>';
			?>
			<MARQUEE behavior="scroll" direction="left" width="100%" scrollamount="15">
				<?php
				while ($row = mysql_fetch_assoc($rs)) {
					$query2 = "select * from xtbl_main_info WHERE Ctr='" . $row['Main_Ctr'] . "'";
					$rs2    = mysql_query($query2);
					$row2   = mysql_fetch_assoc($rs2);
					$img = "";
					if (file_exists('business/' . $row2['Business_Logo'])) {
						$img = "https://tbcmerchantservices.com/business/" . $row2['Business_Logo'];
						$label = $row2['Business_Name'];
					}else{
						$img = "https://tbcmerchantservices.com/images/tbslogo.png";
						$label = $row2['Business_Name'];
					}
					?>

					<img class="mySlides"  src="<?php echo $img; ?>" width="200px" height="200px">
					<span style="margin-right: 40px; font-size: 17px;"><?php echo $label; ?> &#8226;</span>
				<?php } ?>

			</MARQUEE>
			<?php

		}



		public function page_welcome_displaymerchants_carousel()
		{
			$query = "select Main_Ctr from xtbl_account_info WHERE
			Email_Status='ACTIVE' AND Account_Type='MERCHANT' AND Account_Status='ACTIVE'
			AND Card_Status='ACTIVE' ORDER BY Ctr DESC LIMIT 100";
			$rs    = mysql_query($query);
			echo '<div class="container">';
			echo '<h3>Our Latest Merchants</h3><hr>';

			?>

			<div class="w3-content w3-display-container" style="width=200px; margin-bottom:38px">


				<?php
				while ($row = mysql_fetch_assoc($rs)) {
					$query2 = "select * from xtbl_main_info WHERE Ctr='" . $row['Main_Ctr'] . "'";
					$rs2    = mysql_query($query2);
					$row2   = mysql_fetch_assoc($rs2);
					$img = "";
					if (file_exists('business/' . $row2['Business_Logo'])) {
						$img = "https://tbcmerchantservices.com/business/" . $row2['Business_Logo'];
						$label = $row2['Business_Name'];
					}else{
						$img = "https://tbcmerchantservices.com/images/tbslogo.png";
						$label = $row2['Business_Name'];
					}
					?>

					<center><img class="mySlides"  src="<?php echo $img; ?>" width="280px" height="280px"></center>
					<div class="w3-display-bottommiddle w3-container w3-black w3-padding-16 labels " style="margin-bottom: -38px;">
						<?php echo $label; ?>
					</div>

				<?php } ?>

<!-- <button class="w3-button w3-sand w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
	<button class="w3-button w3-sand w3-display-right" onclick="plusDivs(1)">&#10095;</button> -->


</div>

<script>
	var slideIndex = 1;
	showDivs(slideIndex);

	function plusDivs(n) {
		showDivs(slideIndex += n);
	}

	function showDivs(n) {
		var i;
		var x = document.getElementsByClassName("mySlides");
		var y = document.getElementsByClassName("labels");
		if (n > x.length) {slideIndex = 1}
			if (n < 1) {slideIndex = x.length}
				for (i = 0; i < x.length; i++) {
					x[i].style.display = "none";
					y[i].style.display = "none";
				}
				slideIndex++;
				if (slideIndex > x.length) {slideIndex = 1}
					x[slideIndex-1].style.display = "block";
				y[slideIndex-1].style.display = "block";
				setTimeout(showDivs, 3000);
			}
		</script>
		<?php

	}

	public function page_welcome_displaymerchants()
	{
		$query = "select Main_Ctr from xtbl_account_info WHERE
		Email_Status='ACTIVE' AND Account_Type='MERCHANT' AND Account_Status='ACTIVE'
		AND Card_Status='ACTIVE' ORDER BY Ctr DESC LIMIT 100";
		$rs    = mysql_query($query);

		echo '<div class="container">';
		echo '<h3>Our Latest Merchants</h3><hr>';
		while ($row = mysql_fetch_assoc($rs)) {
			$query2 = "select * from xtbl_main_info WHERE Ctr='" . $row['Main_Ctr'] . "'";
			$rs2    = mysql_query($query2);
			$row2   = mysql_fetch_assoc($rs2);

			if (file_exists('business/' . $row2['Business_Logo'])) {
				echo '    <div class="col-md-3">
				<center>
				<img class="img-circle" src="https://tbcmerchantservices.com/business/' . $row2['Business_Logo'] . '" width="240px" height="240px">
				<h4>' . ucwords($row2['Business_Name']) . '</h4>
				</center>
				</div>';
			} else {
				echo '<div class="col-md-3">
				<center>
				<img class="img-circle" src="https://tbcmerchantservices.com/images/tbslogo.png" width="240px" height="240px">
				<h4>' . ucwords($row2['Business_Name']) . '</h4>
				</center>
				</div>';
			}

		}
		echo '</div><br><br><br>';
	}
}

class btc_Address
{

	public function validate($address)
	{
		$decoded = btc_Address::decodeBase58($address);

		$d1 = hash("sha256", substr($decoded, 0, 21), true);
		$d2 = hash("sha256", $d1, true);

		if (substr_compare($decoded, $d2, 21, 4)) {
			throw new Exception("bad digest");
		}
		return true;
	}

	public function decodeBase58($input)
	{
		$alphabet = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";

		$out = array_fill(0, 25, 0);
		for ($i = 0; $i < strlen($input); $i++) {
			if (($p = strpos($alphabet, $input[$i])) === false) {
				throw new Exception("invalid character found");
			}
			$c = $p;
			for ($j = 25; $j--;) {
				$c += (int) (58 * $out[$j]);
				$out[$j] = (int) ($c % 256);
				$c /= 256;
				$c = (int) $c;
			}
			if ($c != 0) {
				throw new Exception("address too long");
			}
		}

		$result = "";
		foreach ($out as $val) {
			$result .= chr($val);
		}

		return $result;
	}

}
?>
