<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
<link rel="stylesheet" type="text/css" href="/TimePicker/tablestuff.css" />
</head>

<?php
  echo "<section>";
  if(!(array_key_exists('adminlogin', $_COOKIE))) {
    header("Location: /index.php");
  }
    include_once('navbar-admin.php');

   echo "</section>";

    try
    {
      //open the sqlite database file
      $db = new PDO('sqlite:/var/www/html/database/carrental.db');

      // Set errormode to exceptions
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo '<section>';
  echo "<h1>Admin History</h1>";
  echo '</section>';

  //ALL EDITED RESERVATIONS
  echo '<section>';
  echo '<h1> Edited Reservations</h1>';
	//set up the table
  echo '<table align="center">';
	echo '<table border = "1">';
	echo '<tr><td><b>Admin ID</b></td><td><b>VIN & Confirmation Number</b></td><td><b>Time</b></td></tr>';

     //select all reservations
     $result = $db->query('SELECT * FROM EditsReservation ORDER BY timeEdited');

  //loop through each tuple in result set
	foreach($result as $tuple) {
	echo "<tr><td>".$tuple['adminID']."</td>";
	echo "<td>".$tuple['vin']." & ".$tuple['confirmNum']."</td>";
  echo "<td>".$tuple['timeEdited']."</td>";
  echo "</tr>";
  }
  echo "</table>";
  echo "</section>";

  //All EDITED VEHICLES
  echo '<section>';
  echo '<h1> Edited Vehicles</h1>';
  //set up the table
  echo '<table align="center">';
  echo '<table border = "1">';
  echo '<tr><td><b>Admin ID</b></td><td><b>VIN</b></td><td><b>Time</b></td></tr>';

     //select all edited vehicles
     $result = $db->query('SELECT * FROM EditsVehicle ORDER BY timeEdited');

    //loop through each tuple in result set

  foreach($result as $tuple) {
  echo "<tr><td>".$tuple['adminID']."</td>";
  echo "<td>".$tuple['vin']."</td>";
  echo "<td>".$tuple['timeEdited']."</td>";
  echo "</tr>";
  }
  echo "</table>";
  echo '</section>';

  //ALL EDITED USERS
  echo '<section>';
  echo '<h1> Edited Users</h1>';
	//set up the table
  echo '<table align="center">';
	echo '<table border = "1">';
	echo '<tr><td><b>Admin ID</b></td><td><b>Driver\'s License</b></td><td><b>Time</b></td></tr>';

     //select all edited users
     $result = $db->query('SELECT * FROM EditsUser ORDER BY timeEdited');

    //loop through each tuple in result set

	foreach($result as $tuple) {
	echo "<tr><td>".$tuple['adminID']."</td>";
	echo "<td>".$tuple['driversLicense']."</td>";
  echo "<td>".$tuple['timeEdited']."</td>";
  echo "</tr>";
  }
  echo "</table>";
  echo '</section>';


  //disconnect from database
  $db = null;
}
catch(PDOException $e)
{
    echo 'Exception : '.$e->getMessage();
    //echo "Couldnt add entry";
}
?>



</html>
