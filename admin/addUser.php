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
<input type="text" name="dLicense" ><br>

<br>Username<br>
<input type="text" name ="username" ><br>

<br>Password<br>
<input type="text" name="password"><br>

<br>First name<br>
<input type="text" name ="fname" ><br>

<br>Last name<br>
<input type="text" name="lname" ><br>

<br>Phone<br>
<input type="text" name="phone" ><br>

<br>Email<br>
<input type="text" name="email" ><br>

<br>Street<br>
<input type="text" name="street"><br>

<br>City<br>
<input type="text" name="city"><br>

<br>State<br>
<input type="text" name="state"><br>

<br>Zipcode<br>
<input type="integer" name="zip" ><br>


<input type="Submit" name="newUser" value="Add User">
</section>
</html>
