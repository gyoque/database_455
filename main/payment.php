<?php
	try{
		//Prep Database
		$db = new PDO('sqlite:/var/www/html/database/carrental.db');
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		//Set variables
		$cost = $_POST['cost'];
		$card = $_POST['card'];
		$user = $_POST['user'];
		$sdate = $_POST['sdate'];
		$stime = $_POST['stime'];
		$edate = $_POST['edate'];
		$etime = $_POST['etime'];
		$start = $sdate." ".$stime;
		$end = $edate." ".$etime;
		// $cs = $_POST['cs'];
		$loc = str_replace("_"," ",$_POST['loc']);
		$vin = $_POST['vin'];
		//Get old balance
		$result = $db->query("SELECT balance FROM UserBalance WHERE dLicense == '$user' AND number == $card;");
		$oldbal = 0;
		foreach($result as $tuple) {
			$oldbal = $tuple[0];
			break;
		}
		//Update balance
		$newbal = $oldbal - $cost;
		$db->exec("UPDATE UserBalance SET balance = $newbal WHERE dLicense == '$user' AND number == $card;");

		//Checks if the given confirmation number is in the database already
		function confNumExists($num,$db) {
			//Will be empty if confirmation number doesn't exist
			$vals = $db->query("SELECT * FROM Reservation WHERE confirmNum==$num;");
			//Check if empty
			$exists = False;
			foreach($vals as $tuple) {
				$exists = True;
				break;
			}
			return $exists;
		}
		//Get random number until you find one not in the database
		//Will slow down the database as the number of total reservations approaches 10000000
		$randNum = mt_rand(10000000,99999999);
		while(confNumExists($randNum,$db)) {
			$randNum = mt_rand(10000000,99999999);
		}
		//Add reservation with confirmation number
		echo $_POST['stime'];
		$db->exec("INSERT INTO Reservation VALUES ($randNum, '$user', '$start', '$end', '$loc', $cost, '$vin');");

		//Relocate to success page with GET variables
		$make = $_POST['make'];
		$model = $_POST['model'];
		$year = $_POST['year'];

		//close database
		$db = null;

		header("Location: success.php/?make=$make&model=$model&year=$year&stime=$stime&sdate=$sdate&etime=$etime&edate=$edate&loc=$loc");
	}
	catch(PDOException $e){
		echo 'Exception: '.$e->getMessage();
	}
?>
