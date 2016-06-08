<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
    <link rel="stylesheet" type="text/css" href="/TimePicker/tablestuff.css" />
</head>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/TimePicker/navbar.php'); ?>
<?php
	//Prep database
	$db = new PDO('sqlite:/var/www/html/database/carrental.db');
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	//Variables
	$number = $_POST['number'];
	//Get balance
	$bal = $db->query("SELECT balance FROM UserBalance WHERE number = $number;");
	foreach($bal as $tup) {
		$bal = $tup[0];
		break;
	}

	//Display balance
	echo "<section>";
	echo "Current balance: $$bal <br>";
	echo "<form action='updateCard.php' method='post'>";
	echo "Payment Amount: $";
	if($bal < 0) {
		$pay = -$bal;
	}
	else {
		$pay = 0.0;
	}
	echo "<input type='text' value=$pay name='pay' size='5'> &nbsp; &nbsp;";
	echo "<input type='hidden' value=$number name='number'>";
	echo "<input type='hidden' value=$bal name='oldbal'>";
	echo "<input type='submit' value='Pay'>";
	echo "</section>";

	$db = null;
?>
</html>