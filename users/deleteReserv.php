<?php
	//Prep database
	$db = new PDO('sqlite:/var/www/html/database/carrental.db');
  	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  	//confirm num
  	$conf = $_POST['confirmNum'];

  	//Delete the reservation from the database
  	$db->exec("DELETE FROM Reservation WHERE confirmNum == $conf");

  	$db = Null;

  	header("Location: editReserv.php");
?>