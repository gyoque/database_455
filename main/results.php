<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
    <link rel="stylesheet" type="text/css" href="/TimePicker/tablestuff.css" />
</head>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/TimePicker/navbar.php'); ?>
<?php
	try{
		//Prep Database
		$db = new PDO('sqlite:/var/www/html/database/carrental.db');
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		//function to convert from 12 hr time to 24 hr time
		function conv12to24($arg1) {
			//check if single hour, if so add a 0 in front
			$arr1 = explode(":",$arg1);
			$hour = $arr1[0];
			if(strlen($arr1[0]) == 1) {
				$hour = '0'.$hour;
			}
			//Check if am or pm
			$arr2 = str_split($arr1[1],2);
			$min = $arr2[0];
			if($arr2[1] == 'pm') {
				$hour += 12;
			}
			return $hour.":".$min;
		}

		//Converts mm/dd/yyyy to yyyy/mm/dd
		function convDate($arg1) {
			$arr = explode("/",$arg1);
			return $arr[2]."/".$arr[0]."/".$arr[1];
		}

		//Prep variables
		$sdate = convDate($_GET['sd']);
		$stime = conv12to24($_GET['st']);
		$edate = convDate($_GET['ed']);
		$etime = conv12to24($_GET['et']);
		$start = $sdate." ".$stime;
		$end = $edate." ".$etime;
		// $zip = $_GET['zip'];
		// $citystate = $_GET['city'].",".$_GET['state'];
		$loc = $_GET['loc'];
		$makes = $db->query("SELECT make FROM vehicle;"); //Get all makes owned
		$seats = $db->query("SELECT DISTINCT seats FROM vehicle;"); //Get all possible number of seats
		
		//Filters
		$filMake = $filTrans = $filSeats = $filPrice = "";
		//Set Filters
		if(array_key_exists("filMake", $_POST) && $_POST['filMake'] != 'all') {
			$filMake = "AND make == '$_POST[filMake]'";
		}
		if(array_key_exists("filTrans", $_POST) && $_POST['filTrans'] != 'all') {
			$filTrans = "AND transmission == '$_POST[filTrans]'";
		}
		if(array_key_exists("filSeats", $_POST) && $_POST['filSeats'] != 'all') {
			$filSeats = "AND seats == $_POST[filSeats]";
		}
		if(array_key_exists("filPrice", $_POST) && $_POST['filPrice'] != 'all') {
			if($_POST['filPrice'] == 'asc'){
				$filPrice = "ORDER BY pricePerHour";
			}
			else {
				$filPrice = "ORDER BY pricePerHour DESC";
			}
		}

		//Select all available cars with search results
		$result = $db->query("	SELECT round(pricePerHour,2),* FROM vehicle 
								WHERE vin NOT IN (
								SELECT vin FROM reservation 
								WHERE location == '$loc' AND (((startTime < '$start') AND (endTime > '$start')) OR ((startTime < '$end') AND (endTime > '$end'))))
								$filMake $filTrans $filSeats $filPrice;");

		//Set up secondary filter
		echo "<section>";
		echo "<form action='$_SERVER[REQUEST_URI]' method=post>";
		echo "<b>Filter Results by: </b>";
		//Make drop down
		echo "Make <select name='filMake'>";
		echo "<option selected='selected' value='all'>-Select All-</option>";
		foreach($makes as $tup) {
			echo "<option value=$tup[0]>$tup[0]</option>";
		}
		echo "</select>&nbsp; &nbsp;";
		//Transmission drop down
		echo "Transmission <select name='filTrans'>";
		echo "<option selected='selected' value='all'>-Select All-</option>";
		echo "<option value='Automatic'>Automatic</option>";
		echo "<option value='Manual'>Manual</option>";
		echo "</select>&nbsp; &nbsp;";
		//Seats drop down
		echo "Seats <select name='filSeats'>";
		echo "<option selected='selected' value='all'>-Select All-</option>";
		foreach($seats as $tup) {
			echo "<option value=$tup[0]>$tup[0]</option>";
		}
		echo "</select>&nbsp; &nbsp;";
		//Price arrangement
		echo "Sort Price <select name='filPrice'>";
		echo "<option selected='selected' value='all'>-Select All-</option>";
		echo "<option value='asc'>Lowest to Highest </option>";
		echo "<option value='des'>Highest to Lowest </option>";
		//Submit
		echo "<input type='submit' value=Search>";
		echo "</form>";
		echo "</section>";

		//set up the table
		echo '<section>';
	   	echo '<table border = "1">';
	   	echo '<tr><td><b>Make Model Year</b></td><td><b>Transmission</b></td><td><b>Seats</b></td><td><b>Price Per Hour</b></td><td></td></tr>';
	    //loop through each tuple in result set
	   	foreach($result as $tuple) {
		   	echo "<tr>";
		   	echo "<td>".$tuple['make']." ".$tuple['model']." ".$tuple['year']."</td>";
		   	echo "<td>".$tuple['transmission']."</td>";
		   	echo "<td>".$tuple['seats']."</td>";
		   	echo "<td>"."$".$tuple['pricePerHour']."</td>";
		   	echo "<td> <a href='confirm.php?vin=$tuple[vin]&pph=$tuple[pricePerHour]&make=$tuple[make]&model=$tuple[model]&year=$tuple[year]&trans=$tuple[transmission]&seats=$tuple[seats]&sdate=$sdate&stime=$stime&edate=$edate&etime=$etime&loc=$loc'>Select</a></td>";
		    echo "</tr>";
	    }
	    echo '</section>';
		//close database
		$db = null;
	}
	catch(PDOException $e){
		echo 'Exception: '.$e->getMessage();
	}
?>
</html>