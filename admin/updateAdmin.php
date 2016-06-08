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
<form action="editAdmins.php" method="post">

<section>
Admin ID<br>
<input type="integer" name="adminID" value="<?PHP echo $_GET['adminID']; ?>"><br>

<br>First name<br>
<input type="text" name ="fname" value="<?php echo $_GET['fn']; ?>"><br>

<br>Last name<br>
<input type="text" name="lname" value="<?php echo $_GET['ln']; ?>"><br>

<br>Username<br>
<input type="text" name ="username" value="<?php echo $_GET['un']; ?>"><br>

<br>Password<br>
<input type="text" name ="password"><br>


<input type="Submit" name="update" value="Update">

<input type="hidden" name="original" value = "<?php echo $_GET['adminID']; ?>">
</section>
</html>
