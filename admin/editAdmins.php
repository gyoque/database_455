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
  //For encrypting passwords
  error_reporting(E_ERROR | E_PARSE);
    try
    {
      //open the sqlite database file
      $db = new PDO('sqlite:/var/www/html/database/carrental.db');

      // Set errormode to exceptions
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      //update Admin table if new information was edited by an admin
      if(isset($_POST['update'])){
        //update database
        $db->exec("UPDATE Admin set adminID = $_POST[adminID], fname = '$_POST[fname]', lname = '$_POST[lname]', username = '$_POST[username]' where adminID == $_POST[original];");
        $db->exec("UPDATE Login set username = '$_POST[username]' where username == '$_POST[original]';");
        if(!($_POST['password'] == "")){
          //encrypt password
          $enc = openssl_encrypt($_POST['password'],'aes128','cRypT');
          $db->exec("UPDATE Login set password = '$enc' where username == '$_POST[original]';");
        }
      }

      if(isset($_POST['newAdmin'])){
        //encrypt password
        $enc = openssl_encrypt($_POST['password'],'aes128','cRypT');
        $db->exec("INSERT INTO Admin values('$_POST[adminID]', '$_POST[fname]', '$_POST[lname]', '$_POST[username]');");
        $db->exec("INSERT INTO Login VALUES('$_POST[username]', '$enc')");
      }


	//set up the table
  echo '<section>';
  echo '<table align="center">';
  echo '<h1>All Admins</h1>';
	echo '<table border = "1">';
	echo '<tr><td><b>Admin ID </b></td><td><b>Name</b></td><td><b>Username</b></td><td></td><td></td></tr>';

     //select all reservations
     $result = $db->query('SELECT * FROM Admin');

    //loop through each tuple in result set

	foreach($result as $tuple) {
	echo "<tr><td>".$tuple['adminID']."</td>";
	echo "<td>".$tuple['fname']." ".$tuple['lname']."</td>";
	echo "<td>".$tuple['username']."</td>";
  echo "<td> <a href= 'deleteAdmin.php?username=$tuple[username]'>Delete</a></td>";
  echo "<td> <a href='updateAdmin.php?adminID=$tuple[adminID]&fn=$tuple[fname]&ln=$tuple[lname]&un=$tuple[username]'>Update</a></td>";
  echo "</tr>";
  }
  echo "</table>";
  echo '</section>';

  //disconnect from database
  $db = null;
}
catch(PDOException $e)
{
    echo 'Exception : '.$e->getMessage();
    //echo "Couldnt add entry";
}
?>


<br>
<section>
<form action='addAdmin.php'>
  <input type="submit" value="Add Admin">
</form>
</section>

</html>
