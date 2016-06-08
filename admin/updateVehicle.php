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

<form action="editVehicles.php" method="post">
<section>
VIN <br>
<input type="text" name="vin" value="<?PHP echo $_GET['vin']; ?>"><br>

<br>Price per Hour<br>
<input type="text" name ="pph" value="<?php echo $_GET['pph']; ?>"><br>

<br>Make<br>
<input type="text" name ="make" value="<?php echo $_GET['make']; ?>"><br>

<br>Model<br>
<input type="text" name="model" value="<?php echo $_GET['model']; ?>"><br>

<br>Year<br>
<input type="number" name="year" min="1900" max="2100" value="<?php echo $_GET['year']; ?>">
<!--<input type="integer" name="year" value="<?php echo $_GET['year']; ?>"><br>-->

<br>Transmission<br>
<select name="trans" >
    <!--Use PHP to determine which value should be selected by default--!>
    <option value="Automatic" <?php if($_GET['trans']=='Automatic') echo "selected='selected'";?>> Automatic</option>
    <option value="Manual" <?php if($_GET['trans']=='Manual') echo "selected='selected'";?>> Manual</option>
  </select>

<br>Seats<br>
<input type="number" name="seats" min="1" max="10" value="<?php echo $_GET['seats']; ?>">
<br><br><br>
<input type="Submit" name="update" value="Update">

<input type="hidden" name="original" value = "<?php echo $_GET['vin']; ?>">
</section>
</html>
