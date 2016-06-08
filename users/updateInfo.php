<?php
	//Prep database
	$db = new PDO('sqlite:/var/www/html/database/carrental.db');
  	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  	//Variables
  	$user = $_COOKIE['userlogin'];
  	$fname = $_POST['fname'];
  	$lname = $_POST['lname'];
  	$dLicense = $_POST['dLicense'];
  	$phone = $_POST['phone'];
  	$email = $_POST['email'];
  	$street = $_POST['street'];
  	$city = $_POST['city'];
  	$state = $_POST['state'];
  	$zip = $_POST['zip'];

  	//Update user information
  	$db->exec("UPDATE user
  				SET fname = '$fname',
  					lname = '$lname',
  					dLicense = '$dLicense',
  					phone = '$phone',
  					email = '$email',
  					street = '$street',
  					city = '$city',
  					state = '$state',
  					zip = '$zip'
  				WHERE username == '$user';");

  	//Relocate with success message
  	$success = "Update Successful";
  	header("Location: useraccount.php?sc=$success");
	$db=null;
?>