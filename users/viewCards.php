<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
    <link rel="stylesheet" type="text/css" href="/TimePicker/tablestuff.css" />
</head>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/TimePicker/navbar.php'); ?>
<?php
	date_default_timezone_set('America/Los_Angeles');

	//Checks if the expiration date is still valid
	function checkExpDate($date){
		$arr = explode("/",$date);
		$year = $arr[1];
		$month = $arr[0];
		$currYear = substr(date('Y'),-2);
		$currMonth = date('m');
		if($year > $currYear) {
			return True;
		}
		else if($year = $currYear && $month > $currMonth) {
			return True;
		}
		else {
			return False;
		}
	}

	//Prep database
	$db = new PDO('sqlite:/var/www/html/database/carrental.db');
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	//Returns the last 4 digits of the credit card number
	function last4Num($num) {
		$arr = str_split($num,12);
		return $arr[1];
	}

	$user = $_COOKIE['userlogin'];
	$dl = $db->query("SELECT dLicense FROM User WHERE username = '$user';");
	foreach($dl as $tup) {
		$dl = $tup[0];
	}
	$cards = $db->query("SELECT * FROM UserBalance WHERE dLicense == '$dl';");

	echo '<section>';
	echo '<h2>Your Credit Cards</h2><br>';
	echo '<font color="blue">';
	if(array_key_exists('sc',$_GET)) {
		echo "-".$_GET['sc']."-";
	}
	echo '</font>';
	echo '<font color="red">';
	if(array_key_exists('err',$_GET)){
		echo $_GET['err'];
	}
	echo '</font>';
	echo '<table border = "1">';
 	echo '<tr><td><b>Credit Card Number</b></td><td><b>Expiration Date</b></td><td><b>CVC</b></td><td><b>Balance</b></td><td></td><td></td></tr>';
 	foreach($cards as $tup) {
 		$cardinfo = $db->query("SELECT * FROM UserCreditCard WHERE number == $tup[number]");
 		foreach($cardinfo as $info) {
 			$cardinfo = $info;
 			break;
 		}
 		echo "<tr>";
 		$num = last4num($tup['number']);
 		echo "<td>************$num</td>";
 		echo "<td>$cardinfo[expDate]</td>";
 		echo "<td>$cardinfo[CVC]</td>";
 		echo "<td>$tup[balance]</td>";
 		if(checkExpDate($cardinfo['expDate'])) {
	 		echo "<td><form action='editCard.php' method='post'>
	 				<input type='hidden' name='number' value=$tup[number]>
	 				<input type='submit' value='Pay'>
	 				</form></td>";
 		}
 		else {
 			echo "<td>";
 			echo "<font color='red'>";
 			echo "Card is expired!";
 			echo "</font>";
 			echo "</td>";
 		}
 		echo "<td><form action='deleteCard.php' method='post'>
              <input type='hidden' name='number' value=$tup[number]>
              <input type='submit' value='Delete'>
              </form></td>";
 		echo "</tr>";
 	}
 	echo '</table>';
 	echo '</section>';

 	$redirect = "/main/addcard.php?redirect=$_SERVER[REQUEST_URI]";

 	echo '<section>';
 	echo "<h3> Add a Credit Card</h3>";
 	echo "<font color='red'>";
 	if(array_key_exists('expDate', $_GET)) {
 		echo $_GET['expDate']."<br/>";
 	}
 	echo "</font>";
 	echo "<form action='$redirect' method='post'>";
 	echo "Credit Card Number: <br>";
 	echo "<input type='text' name='number' minlength='16' maxlength='16' required> <br>";
 	echo "Expiration Date: <br>";
 	echo "<input type='text' name='expDate' placeholder='mm/yy' required> <br>";
 	echo "CVC: <br>";
 	echo "<input type='text' name='CVC' minlength='3' maxlength='4' required> <br><br>";
 	echo "<input type='submit' value='Submit'>";
 	echo "</form>";
 	echo '</section>';

  	$db = Null;
?>
