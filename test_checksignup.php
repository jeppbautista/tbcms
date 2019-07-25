<?php
	if(isset($_POST['submit'])){
		echo $_REQUEST['firstname'];
	}
?>

<form method="post">

	<form >
	First name:<br>
	<input type="text" name="firstname" value="Mickey"><br>
	Last name:<br>
	<input type="text" name="lastname" value="Mouse"><br><br>
	</form> 

	<input type="submit" value="Submit" id='submit' name='submit'>


</form>

