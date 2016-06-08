<?php
try{
	//set time zone
	date_default_timezone_set('America/Los_Angeles');
	//Prepare error messages
	$sdErr = $edErr = $stErr = $etErr = $zcsErr = $cmpErr = "";
	$success = true; //True if no errors
	$nonEmptyDates = true;

	//Check if a date is past another
	function compareDates($date1, $time1, $date2, $time2) {
		//Get individual values
		$d1arr = explode("/",$date1);
		$t1arr = explode("/",$time1);
		$d2arr = explode("/",$date2);
		$t2arr = explode("/",$time2);
		//Get time in seconds
		$start = mktime($t1arr[0],$t1arr[1],0,$d1arr[1],$d1arr[2],$d1arr[0]);
		$end = mktime($t2arr[0],$t2arr[1],0,$d2arr[1],$d2arr[2],$d2arr[0]);
		return $start >= $end;
	}

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

	//Check if start date is empty
	if(empty($_POST['startdate'])) {
		$sdErr = "*Start Date is Required";
		$success = false;
		$nonEmptyDates = false;
	}
	//Check if start time is empty
	if(empty($_POST['starttime'])) {
		$stErr = "*Start Time is Required";
		$success = false;
		$nonEmptyDates = false;
	}
	//Check if end date is empty
	if(empty($_POST['enddate'])) {
		$edErr = "*End Date is Required";
		$success = false;
		$nonEmptyDates = false;
	}
	//Check if end time is empty
	if(empty($_POST['endtime'])) {
		$etErr = "*End Time is Required";
		$success = false;
		$nonEmptyDates = false;
	}
	//Check if the end date is before the start date
	if($nonEmptyDates) {
		if(compareDates($_POST['startdate'],$_POST['starttime'],$_POST['enddate'],$_POST['endtime'])){
			$cmpErr = "*End Date must be after the Start Date";
			$success = false;
		}
	}
	//Check if start date is after current date
	$now = date('Y/m/d H:i');
	if(strtotime(convDate($_POST['startdate'])." ".conv12to24($_POST['starttime'])) < strtotime($now)) {
		$cmpErr = "*Start time has to be after the current time";
		$success = false;
	}
	// Check if zipcode or city and state are empty
	// if(empty($_POST['zip'])) {
		// if(empty($_POST['state']) && empty($_POST['city'])) {
		// 	$zcsErr = "*Please input a city and state";
		// 	$success = false;
		// }
		// elseif(empty($_POST['city']) && !empty($_POST['state'])) {
		// 	$zcsErr = "*Please input a city name";
		// 	$success = false;
		// }
		// elseif(empty($_POST['state']) && !empty($_POST['city'])) {
		// 	$zcsErr = "*Please input the corresponding state";
		// 	$success = false;
		// }
		// //Check if state is the 2 character abbreviation
		// elseif(!preg_match("#\b[a-zA-Z]{2}\b#",$_POST['state'])) {
		// 	$zcsErr = "*Please input a the 2 character abbreviation of the state";
		// 	$success = false;
		// }
	// }
	//Check that zipcode is 5 digits long
	// else{
	// 	if(!preg_match("#\b[0-9]{5}\b#",$_POST['zip'])) {
	// 		$zcsErr = "*Please input a 5 digit zipcode";
	// 		$success = false;
	// 	}
	// }


	//If no errors, success
	if($success == true) {
		$sd = $_POST['startdate'];
		$st = $_POST['starttime'];
		$ed = $_POST['enddate'];
		$et = $_POST['endtime'];
		$loc = $_POST['loc'];
		// $zip = $_POST['zip'];
		// $city = ucwords(strtolower($_POST['city']));
		// $state = strtoupper($_POST['state']);
		header("Location: /main/results.php?sd=$sd&st=$st&ed=$ed&et=$et&loc=$loc");
	}
	//If errors, redirect back to home page with error variables
	else {
		header("Location: /index.php?sd=$sdErr&st=$stErr&ed=$edErr&et=$etErr&zcs=$zcsErr&cmp=$cmpErr");
	}
}
catch(PDOException $e) {
	echo 'Exception:'.$e->getMessage();
}
?>