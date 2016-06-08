<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
<link rel="stylesheet" type="text/css" href="/TimePicker/tablestuff.css" />
</head>

<?php if(!(array_key_exists('adminlogin', $_COOKIE))) {
    header("Location: /index.php");
  }
  echo"<section>";
  include_once('navbar-admin.php');
  echo"</section>";
  ?>

  <section>
<form action="editReservations.php" method="post">

Confirmation Number<br>
<input type="number" name="confirmNum"><br>

<br>Driver License <br>
<input type="text" name="dLicense"><br>

<br>Start Time<br>
<input type="text" name ="startTime"><br>

<br>End Time<br>
<input type="text" name ="endTime"><br>

<br>Location<br>
<input type="text" name ="location"><br>

<br>Price Total<br>
<input type="text" name ="priceTotal"><br>

VIN <br>
<input type="text" name="vin"><br>

<input type="Submit" name="newReservation" value="Add Reservation">
</section>

</html>
