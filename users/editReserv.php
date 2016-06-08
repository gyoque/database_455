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

  	date_default_timezone_set('America/Los_Angeles');

  	//Converts 24 hour time to 12 hour time
	function conv24to12($arg1) {
		$timeArr = explode(":",$arg1);
		$hour = $timeArr[0];
		$min = $timeArr[1];
		$half = 'am';
		//Check if pm time
		if($hour >= 12) {
			$half = 'pm';
			if($hour != 12) {
				$hour = $hour - 12;
			}
		}
		return $hour.":".$min.$half;
	}

	//Converts yyyy/mm/dd to mm/dd/yyyy
	function convDate($arg1) {
		$arr = explode("/",$arg1);
		return $arr[1]."/".$arr[2]."/".$arr[0];
	}

	//Converts database time format to user time format
	function convDT($arg1) {
		$dateTime = explode(" ",$arg1);
		return convDate($dateTime[0])." ".conv24to12($dateTime[1]);
	}

  	$user = $_COOKIE['userlogin'];
  	//Get Drivers License
  	$dlicense = $db->query("SELECT dLicense FROM User WHERE username == '$user';");
  	foreach($dlicense as $tup) {
  		$dlicense = $tup[0];
  		break;
  	}
  	//Get Reservations
  	$rsv = $db->query("SELECT * FROM Reservation WHERE dLicense = '$dlicense' ORDER BY startTime DESC;");
	//Get current time
	$now = date('Y/m/d H:i');

  	//Print reservations in table
  	echo '<section>';
	echo '<h2>Edit Reservations</h2><br>';
   	echo '<table border = "1">';
   	echo '<tr><td><b>Confirmation Number</b></td><td><b>Start Time</b></td><td><b>End Time</b></td><td><b>Location</b></td><td><b>Vehicle</b></td><td><b>Price</b></td><td></td></tr>';
    //loop through each tuple in result set
   	foreach($rsv as $tup) {
   		$cStart = convDT($tup['startTime']);
   		$cEnd = convDT($tup['endTime']);
	   	echo "<tr>";
	   	echo "<td>".$tup['confirmNum']."</td>";
	   	echo "<td>".$cStart."</td>";
	   	echo "<td>".$cEnd."</td>";
	   	echo "<td>".$tup['location']."</td>";
	   	$vehicle = $db->query("SELECT make, model, year FROM Vehicle WHERE vin = '$tup[vin]';");
	   	foreach($vehicle as $veh) {
	   		$vehicle = $veh['make']." ".$veh['model']." ".$veh['year'];
	   	}
	   	echo "<td>".$vehicle."</td>";
	   	echo "<td>$".$tup['priceTotal']."</td>";
	   	// echo "<td><form action='updateReserv.php' method='post'>
	   	// 		<input type='hidden' name='confirmNum' value=$tup[confirmNum]>
	   	// 		<input type='hidden' name='start' value=$cStart>
	   	// 		<input type='hidden' name='end' value=$cEnd>
	   	// 		<input type='hidden' name='location' value=$tup[location]>
	   	// 		<input type='hidden' name='vehicle' value=$vehicle>
	   	// 		<input type='hidden' name='price' value=$tup[priceTotal]>
	   	// 		<input type='submit' value='Update'>
	   	// 		</form></td>";
	   	if(strtotime($tup['startTime']) > strtotime($now)){
	   		echo "<td><form action='deleteReserv.php' method='post'>
	   			<input type='hidden' name='confirmNum' value=$tup[confirmNum]>
	   			<input type='submit' value='Cancel Reservation'>
	   			</form></td>";	
	   	}
	   	else{
	   		echo "<td></td>";
	   	}
	    echo "</tr>";
    }
    echo '</section>';
  
    $db=null;

?>
</html>