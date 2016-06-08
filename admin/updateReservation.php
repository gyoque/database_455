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

<form action="editReservations.php" method="post">
<section>
Confirmation Number<br>
<input type="number" name="confirmNum" value="<?PHP echo $_GET['cn']; ?>"><br>

<br>Driver License <br>
<input type="text" name="dLicense" value="<?PHP echo $_GET['dl']; ?>"><br>

<br>Start Time<br>
<input type="text" name ="startTime" value="<?php echo $_GET['st']; ?>"><br>

<br>End Time<br>
<input type="text" name ="endTime" value="<?php echo $_GET['et']; ?>"><br>

<br>Location<br>
<input type="text" name ="location" value="<?php echo $_GET['l']; ?>"><br>

<br>Price Total<br>
<input type="text" name ="priceTotal" value="<?php echo $_GET['pt']; ?>"><br>

VIN <br>
<input type="text" name="vin" value="<?PHP echo $_GET['vin']; ?>"><br>

<input type="Submit" name="update" value="Update">

<input type="hidden" name="original_cn" value = "<?php echo $_GET['cn']; ?>">
<input type="hidden" name="original_dl" value = "<?php echo $_GET['dl']; ?>">
</section>
</html>
