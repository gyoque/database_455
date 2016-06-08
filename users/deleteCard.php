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

	//Get credit card number to be editted
	$number = $_POST['number'];
	//Get balance
  $bal = $db->query("SELECT balance FROM UserBalance WHERE number = $number;");
  foreach($bal as $tup) {
    $bal = $tup[0];
    break;
  }
  //Delete credit card if the balance is not negative
  if($bal < 0) {
    $negErr = "Cannot delete card with negative balance. Please pay off your card first.";
    $db = Null;
    header("Location: viewCards.php?err=$negErr");
  }
  else {
    $db->exec("DELETE FROM UserCreditCard WHERE number = $number");
    $db->exec("DELETE FROM UserBalance WHERE number = $number");
    $db = Null;
    header("Location: viewCards.php");
  }
?>
</html>