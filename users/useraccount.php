<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
    <link rel="stylesheet" type="text/css" href="/TimePicker/tablestuff.css" />
    <style>
		table#fixed {
		    border-collapse: collapse;
		    border-spacing: 0;
		    width: 300px;
		}
    </style>
</head>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/TimePicker/navbar.php'); ?>
<center>
<?php
	//Prep database
	$db = new PDO('sqlite:/var/www/html/database/carrental.db');
  	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  	//Timezone nuisance
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
  	//Get user's info
  	$info = $db -> query("SELECT * FROM User WHERE username == '$user';");
  	foreach($info as $tup) {
  		$info = $tup;
  		break;
  	}
  	//Print user's name
  	$name = ucfirst($info['fname'])." ".ucfirst($info['lname']);
  	echo "<section>";
  	echo "<h2> Welcome, $name </h2>";
?>
</section>
<!-- Print user information -->
<section>
<font size = "5"> Your Information </font><br>
	<b><font color='blue'>
	<?php
		if(array_key_exists('sc',$_GET)){
			echo "-".$_GET['sc']."-";
		}
	?>
	</font></b>
	<table border='1' id='fixed'>
	<tr><td><b>Driver's License</b></td><td><?php echo $info['dLicense']?></td></tr>
	<tr><td><b>Phone Number</b></td><td><?php echo $info['phone']?></td></tr>
	<tr><td><b>E-mail Address</b></td><td><?php echo $info['email']?></td></tr>
	<tr><td><b>Address</b></td><td><?php echo $info['street']?></td></tr>
	<tr><td></td><td><?php echo $info['city'].", ".$info['state']?></td></tr>
	<tr><td></td><td><?php echo $info['zip']?></td></tr>
	</table>
</section>
<a href='editInfo.php'>Edit Your Information </a><br>
<?php echo "<a href='viewCards.php'>View Credit Card Information </a>";?>

<!-- Print User Reservations -->
<?php
	$now = date('Y/m/d H:i');
	//Get reservations
  	$rsv = $db->query("SELECT * FROM Reservation WHERE dLicense = '$info[dLicense]' AND startTime > '$now' ORDER BY startTime DESC;");
	//Print reservations in table	
  	echo '<section>';
	echo '<font size = "5"> Your Upcoming Reservations </font><br>';
   	echo '<table border = "1">';
   	echo '<tr><td><b>Confirmation Number</b></td><td><b>Start Time</b></td><td><b>End Time</b></td><td><b>Location</b></td><td><b>Vehicle</b></td><td><b>Price</b></td></tr>';
    //loop through each tuple in result set
   	foreach($rsv as $tup) {
	   	echo "<tr>";
	   	echo "<td>".$tup['confirmNum']."</td>";
	   	echo "<td>".convDT($tup['startTime'])."</td>";
	   	echo "<td>".convDT($tup['endTime'])."</td>";
	   	echo "<td>".$tup['location']."</td>";
	   	$vehicle = $db->query("SELECT make, model, year FROM Vehicle WHERE vin = '$tup[vin]';");
	   	foreach($vehicle as $veh) {
	   		$vehicle = $veh['make']." ".$veh['model']." ".$veh['year'];
	   	}
	   	echo "<td>".$vehicle."</td>";
	   	echo "<td>$".$tup['priceTotal']."</td>";
	    echo "</tr>";
    }
    echo '</table>';
    echo '</section>';
    
    $db=null;

?>
<a href='editReserv.php'> View/Edit Your Reservations </a> <br>
</center>
</html>