<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
</head>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/TimePicker/navbar.php'); ?>
<?php
	//Prep database
	$db = new PDO('sqlite:/var/www/html/database/carrental.db');
  	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  	$user = $_COOKIE['userlogin'];
  	$userinfo = $db->query("SELECT * FROM User WHERE username == '$user';");
  	foreach($userinfo as $info) {
  		$userinfo = $info;
  		break;
  	}
?>
<section>
<h2>Edit Your Personal Information</h2> <br>
<font color='blue' size='4'>
<?php
	if(array_key_exists('sc',$_GET)) {
		echo "-".$_GET['sc']."-";
	}
?>
</font>
<form action='updateInfo.php' method='post'>
	First Name: <br>
	<input type='text' name='fname' value=<?php echo $userinfo['fname'];?>><br>
	Last Name: <br>
	<input type='text' name='lname' value=<?php echo $userinfo['lname'];?>><br>
	Driver's License Number: <br>
	<input type='text' name='dLicense' value=<?php echo $userinfo['dLicense'];?>> <br>
	Phone Number: <br>
	<input type='text' name='phone' value=<?php echo $userinfo['phone'];?>> <br>
	E-mail: <br>
	<input type='text' name='email' value=<?php echo $userinfo['email'];?>> <br>
	Address: <br>
	<?php echo "<input type='text' name='street' value='$userinfo[street]' placeholder='Street'> <br>";?>
	<input type='text' name='city' value=<?php echo $userinfo['city'];?> placeholder='City' size='13'>
	<input type='text' name='state' value=<?php echo $userinfo['state'];?> placeholder='State' size='1'> <br>
	<input type='text' name='zip' value=<?php echo $userinfo['zip'];?> placeholder='Zip'> <br> <br>
	<input type='submit' value='Submit'>
</form>
</section>

<?php $db=null; ?>

</html>