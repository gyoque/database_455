<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
</head>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/TimePicker/navbar.php'); ?>
<?php
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

	//Variables
	$make = $_GET['make'];
	$model = $_GET['model'];
	$year = $_GET['year'];
	$start = convDate($_GET['sdate'])." ".conv24to12($_GET['stime']);
	$end = convDate($_GET['edate'])." ".conv24to12($_GET['etime']);
	// $cs = $_GET['cs'];
	$loc = $_GET['loc'];
	//Print success statement
	echo "<section>";
	echo "<h2> Successful Reservation! </h2><br>";
	echo "You have successfully reserved the $make $model $year from $start to $end.";
	echo "</section>";
?>
<section>
<form action="/" method="post">
<input type="submit" value="Back to Home">
</form>
</section>
</html>
