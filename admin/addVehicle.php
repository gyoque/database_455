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
  ?>
  <section>
<form action="editVehicles.php" method="post">

VIN <br>
<input type="text" name="vin" ><br>

<br>Price per Hour<br>
<input type="text" name ="pph" ><br>

<br>make<br>
<input type="text" name ="make" ><br>

<br>model<br>
<input type="text" name ="model" ><br>

<br>Year<br>
<input type="number" name="year" min="1900" max="2100">

<br>Transmission<br>
<select name="trans">
    <option value="">- Please Select -</option>
    <option value="Automatic">Automatic</option>
    <option value="Manual">Manual</option>
  </select>

<br>Seats<br>
<input type="number" name="seats" min="1" max="10">
<br><br>
<input type="Submit" name="newCar" value="Add New Car">
</section>
</html>
