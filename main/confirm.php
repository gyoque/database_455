<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
</head>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/TimePicker/navbar.php'); ?>
<?php
	//Returns the cost of the reservation
	function calcCost($sdate, $stime, $edate, $etime, $pph) {
		date_default_timezone_set('America/Los_Angeles');
		//Get individual values
		$sdarr = explode("/",$sdate);
		$edarr = explode("/",$edate);
		$starr = explode(":",$stime);
		$etarr = explode(":",$etime);
		//Get time in seconds
		$start = mktime($starr[0],$starr[1],0,$sdarr[1],$sdarr[2],$sdarr[0]);
		$end = mktime($etarr[0],$etarr[1],0,$edarr[1],$edarr[2],$edarr[0]);
		$hours = ($end-$start)/3600;
		return $hours*$pph;
	}

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

	//Get variables
	$make = $_GET['make'];
	$model = $_GET['model'];
	$year = $_GET['year'];
	$pph = $_GET['pph'];
	$trans = $_GET['trans'];
	$seats = $_GET['seats'];
	$sdate = $_GET['sdate'];
	$stime = $_GET['stime'];
	$edate = $_GET['edate'];
	$etime = $_GET['etime'];
	// $cs = $_GET['cs'];
	$loc = str_replace(" ","_",$_GET['loc']);
	$vin = $_GET['vin'];
	//Function variables
	$cost = calcCost($sdate,$stime,$edate,$etime,$pph);
	$convstime = conv24to12($stime);
	$convetime = conv24to12($etime);
	$convsdate = convDate($sdate);
	$convedate = convDate($edate);

	//Printed Stuff
	echo "<section>";
	echo "<h2> Confirm Reservation </h2>";
	echo "<p>You are about to reserve the $make $model $year 
		with $trans transmission and $seats seats from $convsdate $convstime
		to $convedate $convetime at a cost of $$pph per hour (a total of $$cost).</p>";
	echo "</section>";

	echo '<section>';
	//If no user is logged in, force them to login or signup
	if(!array_key_exists('userlogin',$_COOKIE)) {
		echo '<form action="/users/login.php" method="post">';
		echo '<input type="hidden" name="redirect" value="redirect">';
	}
	else {
		echo '<form action="card.php" method="post">';
	}
		echo "<input type='hidden' name='cost' value=$cost>";
		echo "<input type='hidden' name='stime' value='$stime'>";
		echo "<input type='hidden' name='sdate' value='$sdate'>";
		echo "<input type='hidden' name='etime' value='$etime'>";
		echo "<input type='hidden' name='edate' value='$edate'>";
		echo "<input type='hidden' name='make' value='$make'>";
		echo "<input type='hidden' name='model' value='$model'>";
		echo "<input type='hidden' name='year' value='$year'>";
		echo "<input type='hidden' name='loc' value='$loc'>";	
		//echo "<input type='hidden' name='cs' value='$cs'>";
		echo "<input type='hidden' name='vin' value='$vin'>";	
		echo "<input type='submit' value='Proceed to Payment'>";
	echo '</form>';
	echo '<form action="/index.php">';
		echo '<input type="submit" value="Cancel">';
	echo '</form>';
	echo '</section>';
?>
</html>