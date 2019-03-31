<?php
	date_default_timezone_set("Asia/Bangkok");
	if($_POST['submit']) {}
	else {

        $conn = @mysql_connect('localhost', 'root');
        if (!$conn) { die('Could not connect: ' . mysql_error());  }
        mysql_select_db('db_obs', $conn);

		$extensions = array("jpeg","jpg","png"); 
		
		//if(isset($_FILES['imgupload']) ){
		    $file_name = $key.$_FILES['imgupload']['name'];
		    $file_size =$_FILES['imgupload']['size'];
		    $file_tmp =$_FILES['imgupload']['tmp_name'];
		    $file_type=$_FILES['imgupload']['type'];
		    $newfile=$ctr.date('HisYmds').'.jpg';
		    move_uploaded_file($file_tmp,"requirements/".$newfile);


		    
		//}
	}
?>