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
    //set time zone
    date_default_timezone_set('America/Los_Angeles');
    $admin = $_COOKIE['adminlogin'];

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

    //update Vehicle table if new information was edited by the admin
    if(isset($_POST['update'])){
      //update database
      $db->exec("update Vehicle set vin = '$_POST[vin]', pricePerHour = '$_POST[pph]', make = '$_POST[make]', model = '$_POST[model]', year = '$_POST[year]', transmission = '$_POST[trans]', seats= '$_POST[seats]' where vin == '$_POST[original]';");
      //get adminID
      $adminID =  getAdminID($db, $admin);
      $time = date(DATE_ATOM);
      $db->exec("insert into EditsVehicle values($adminID,'$_POST[vin]','$time');");
    }

    if(isset($_POST['newCar'])){
      //update database
      $db->exec("insert into Vehicle values('$_POST[vin]', '$_POST[pph]', '$_POST[make]', '$_POST[model]', '$_POST[year]', '$_POST[trans]', '$_POST[seats]');");
      //get adminID
      $adminID =  getAdminID($db, $admin);
      $time = date(DATE_ATOM);
      $db->exec("insert into EditsVehicle values($adminID,'$_POST[vin]','$time');");
    }




    //set up the table
    echo '<section>';
    echo '<h1>All Vehicles</h1>';
   	echo '<table border = "1">';
   	echo '<tr><td><b>VIN</b></td><td><b>Price Per Hour</b></td><td><b>Make model year</b></td><td><b>Transmission</b></td><td><b>Seats</b></td><td></td><td></td></tr>';

    //select all vehicles
    $result = $db->query('SELECT * FROM Vehicle ORDER BY vin');

    //loop through each tuple in result set
   	foreach($result as $tuple) {

   	echo "<tr><td>".$tuple['vin']."</td>";
   	echo "<td>".$tuple['pricePerHour']."</td>";
   	echo "<td>".$tuple['make']." ".$tuple['model']." ".$tuple['year']."</td>";
   	echo "<td>".$tuple['transmission']."</td>";
   	echo "<td>".$tuple['seats']."</td>";
   	echo "<td> <a href= 'deleteVehicle.php?vin=$tuple[vin]'>Delete</a></td>";
   	echo "<td> <a href='updateVehicle.php?vin=$tuple[vin]&pph=$tuple[pricePerHour]&make=$tuple[make]&model=$tuple[model]&year=$tuple[year]&trans=$tuple[transmission]&seats=$tuple[seats]'>Update</a></td>";
    echo "</tr>";
     }
    echo "</table>";
    echo "</section>";

   //disconnect from database
    $db = null;
}
catch(PDOException $e)
{
    echo 'Exception : '.$e->getMessage();
}
?>

<section>
<form action='addVehicle.php'>
  <input type="submit" value="Add Vehicle">
</form>
</section>

</html>
