<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
<link rel="stylesheet" type="text/css" href="/TimePicker/tablestuff.css" />
</head>
<section>
<?php
if(!(array_key_exists('adminlogin', $_COOKIE))) {
    header("Location: /index.php");
  }
  include_once('navbar-admin.php');
  ?>
</section>

<section>
<form action="editAdmins.php" method="post">

Admin ID <br>
<input type="integer" name="adminID" ><br>

<br>First name<br>
<input type="text" name ="fname" ><br>

<br>Last name<br>
<input type="text" name="lname" ><br>

<br>Username<br>
<input type="text" name ="username" ><br>

<br>Password<br>
<input type="password" name ="password" ><br>


<input type="Submit" name="newAdmin" value="Add Admin">
</section>
</html>
