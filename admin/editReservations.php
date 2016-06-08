<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
<link rel="stylesheet" type="text/css" href="/TimePicker/tablestuff.css" />
</head>


<?php
    if(!(array_key_exists('adminlogin', $_COOKIE))) {
      header("Location: /index.php");
    }
    echo"<section>";
    include_once('navbar-admin.php');
    echo"</section>";

    $admin = $_COOKIE['adminlogin'];

    //set time Zone
    date_default_timezone_set('America/Los_Angeles');
    try
    {
      //open the sqlite database file
      $db = new PDO('sqlite:/var/www/html/database/carrental.db');

      // Set errormode to exceptions
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


      //get admin function
      function getAdminID($db, $admin){
        //get adminID
        $adminID = $db->query("SELECT adminID from Admin where username == '$admin';");
        foreach($adminID as $tup)
        {
              $adminID = $tup['adminID'];
              break;
        }
        return $adminID;
      }

      //update Reservation table if new information was edited by the admin
      if(isset($_POST['update'])){
        //update database
        $db->exec("update Reservation set confirmNum = '$_POST[confirmNum]', dLicense = '$_POST[dLicense]', startTime = '$_POST[startTime]', endTime = '$_POST[endTime]', location = '$_POST[location]', priceTotal = '$_POST[priceTotal]', vin= '$_POST[vin]' where confirmNum == $_POST[original_cn] and dLicense == '$_POST[original_dl]';");
        $time = date(DATE_ATOM);

        //get admin ID
        $adminID = getAdminID($db, $admin);
        $db->exec("insert into EditsReservation values($adminID,'$_POST[vin]','$_POST[confirmNum]', '$time');");
      }

      if(isset($_POST['newReservation'])){
        //update database
        $db->exec("insert into Reservation values('$_POST[confirmNum]', '$_POST[dLicense]', '$_POST[startTime]', '$_POST[endTime]', '$_POST[location]', '$_POST[priceTotal]', '$_POST[vin]');");

        $time = date(DATE_ATOM);

        //get admin ID
        $adminID = getAdminID($db, $admin);
        $db->exec("insert into EditsReservation values($adminID, '$_POST[vin]','$_POST[confirmNum]', '$time');");
      }


	//set up the table
  echo '<section>';
  echo '<h1>All Reservations </h1>';
  echo '<table align="center">';
	echo '<table border = "1">';
	echo '<tr><td><b>Confirmation Number</b></td><td><b>Driver License</b></td><td><b>Start Time</b></td><td><b>End Time</b></td><td><b>Location</b></td><td><b>Price Total<b/></td><td><b>VIN</b></td><td></td><td></td></tr>';

     //select all reservations
     $result = $db->query('SELECT * FROM Reservation ORDER BY startTime DESC');

    //loop through each tuple in result set

	foreach($result as $tuple) {
	echo "<tr><td>".$tuple['confirmNum']."</td>";
	echo "<td>".$tuple['dLicense']."</td>";
	echo "<td>".$tuple['startTime']."</td>";
	echo "<td>".$tuple['endTime']."</td>";
	echo "<td>".$tuple['location']."</td>";
	echo "<td>".$tuple['priceTotal']."</td>";
  echo "<td>".$tuple['vin']."</td>";
	echo "<td> <a href= 'deleteReservation.php?cn=$tuple[confirmNum]&dl=$tuple[dLicense]'>Delete</a></td>";
	echo "<td> <a href='updateReservation.php?cn=$tuple[confirmNum]&dl=$tuple[dLicense]&st=$tuple[startTime]&et=$tuple[endTime]&l=$tuple[location]&pt=$tuple[priceTotal]&vin=$tuple[vin]'>Update</a></td>";
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

<section>
<form action='addReservation.php'>
  <input type="submit" value="Add Reservation">
</form>
</section>

</html>
