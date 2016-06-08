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
<form action="editUsers.php" method="post">

Driver's License <br>
<input type="text" name="dLicense" value="<?PHP echo $_GET['dl']; ?>"><br>

<br>Username<br>
<input type="text" name ="username" value="<?php echo $_GET['un']; ?>"><br>

<br>First name<br>
<input type="text" name ="fname" value="<?php echo $_GET['fn']; ?>"><br>

<br>Last name<br>
<input type="text" name="lname" value="<?php echo $_GET['ln']; ?>"><br>

<br>Phone<br>
<input type="text" name="phone" value="<?php echo $_GET['p']; ?>"><br>

<br>Email<br>
<input type="text" name="email" value="<?php echo $_GET['e']; ?>"><br>

<br>Street<br>
<input type="text" name="street" value="<?php echo $_GET['street']; ?>"><br>

<br>City<br>
<input type="text" name="city" value="<?php echo $_GET['city']; ?>"><br>

<br>State<br>
<input type="text" name="state" value="<?php echo $_GET['state']; ?>"><br>

<br>Zipcode<br>
<input type="integer" name="zip" value="<?php echo $_GET['z']; ?>"><br>

<br>(Optional) Reset Password<br>
<input type="text" name="password"><br>

<input type="Submit" name="update" value="Update">

<input type="hidden" name="original" value = "<?php echo $_GET['dl']; ?>">
</section>
</html>
