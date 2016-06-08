<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
<link rel="stylesheet" type="text/css" href="/TimePicker/tablestuff.css" />
</head>

<!-- Login Signup Links-->
<!-- Login Signup Links-->
<section>
<?php
    if(!(array_key_exists('adminlogin', $_COOKIE))) {
      header("Location: /index.php");
    }

    include_once('navbar-admin.php');
    echo "<p align='right'>";
    if(array_key_exists('adminlogin', $_COOKIE)) {
        echo "<p align='right'>";
        echo "Welcome, ".$_COOKIE['adminlogin']." &nbsp; &nbsp;";
        echo "</p>";
    }
    echo"</p>";
?>

</section>



<div align="center">

<h1>Welcome to the administrative page!</h1>

<font size = "6">
<a href="editUsers.php">  Edit Users  </a> <br/>

<a href ="editVehicles.php"> Edit Vehicles </a> <br/>

<a href="editReservations.php"> Edit Reservations</a> <br/>
<br/>
<br/>
<a href="editAdmins.php"> Edit Admins </a><br/>
<a href="history.php"> View Admin History</a> <br/>
</font>
</div>

</html>
