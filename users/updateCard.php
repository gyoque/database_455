<?php
	//Prep database
	$db = new PDO('sqlite:/var/www/html/database/carrental.db');
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	//Variables
	$number = $_POST['number'];
	$pay = $_POST['pay'];
	$oldbal = $_POST['oldbal'];

	$newbal = $oldbal + $pay;

	//Update Database
	$db->exec("UPDATE UserBalance
				SET balance = $newbal
				WHERE
					number = $number;");

	$db = Null;
	header("Location: viewCards.php");
?>