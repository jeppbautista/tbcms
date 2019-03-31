<?php

//----------------------------------------------------------------------------------------CHECKLOGIN START
	session_start();
	include 'class_admin.php';
	$class=new mydesign;
	$class->database_connect();

	date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');

	$error='';
	$logerror='';
	if (isset($_POST['username_login']) && isset($_POST['password_login'])  ) {

		if (empty($_POST['username_login']) || empty($_POST['password_login'])) {
			$logerror='<span style="color: red">Invalid Username or Password</span>';
		}
		else {
			$user=str_replace("'", '', $_POST['username_login']);
			$user=str_replace('"', '', $user);
			$user=str_replace("<", '', $user);
			$user=str_replace('>', '', $user);

			$pass=str_replace("'", '', $_POST['password_login']);
			$pass=str_replace('"', '', $pass);
			$pass=str_replace("<", '', $pass);
			$pass=str_replace('>', '', $pass);

			$pass=md5(md5($pass).md5($user));

			$rs = mysql_query("select * from xtbl_admin_password where Username='$user' and Password='$pass'");
			$rows = mysql_num_rows($rs);
			$row = mysql_fetch_assoc($rs);

			if ($rows == 1) {
				$_SESSION['session_tbcmerchant_ctr_myadmin'.$sessiondate]=$row['Ctr'];
			}
			else{
				$logerror='<span style="color: red">Invalid Username or Password</span>';
			}
		}
	}

	if(isset($_SESSION['session_tbcmerchant_ctr_myadmin'.$sessiondate])){
		header("location: https://tbcmerchantservices.com/admin_home/");
	}
//----------------------------------------------------------------------------------------CHECKLOGIN END

//----------------------------------------------------------------------------------------SIGNUP_FORM START
	$class->doc_type();
	$class->html_start('');
		$class->head_start();
			echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
			$class->title_page('TBCMS ADMIN');
			$class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
			$class->script('https://tbcmerchantservices.com/js/bootstrap.js');
			$class->link('https://tbcmerchantservices.com/css/bootstrap.css');
		$class->head_end();

		$class->body_start('');	
		?>
			<div class="container">
				<center><img src="https://tbcmerchantservices.com/images/tbslogo.png" width="300px"></center>
				<div class="alert">
					
					<center>
						<?php echo $logerror.'<br>';?>
						<form method="POST">
						<input name="username_login" class="form-control" placeholder="Username" 
							style="width: 280px" required/><br>
						<input name="password_login" class="form-control" placeholder="Password" 
							style="width: 280px" type="password" required/><br>
						<input name="submit_login" class="btn btn-primary" type="submit" value="SIGN IN"/>
						</form>
					</center>
				</div>
			</div>

		<?php
		$class->body_end();	
	$class->html_end();

?>

