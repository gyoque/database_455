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
    //set time Zone
    date_default_timezone_set('America/Los_Angeles');
    $admin = $_COOKIE['adminlogin'];

    try
    {
      //open the sqlite database file
      $db = new PDO('sqlite:/var/www/html/database/carrental.db');

      // Set errormode to exceptions
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      //get admin function
      function getAdminID($db, $admin){
        //get adminID
        $adminID = $db->query("SELECT adminID from Admin where username == '$admin';");
        foreach($adminID as $tup)
        {
              $adminID = $tup['adminID'];
              break;
        }
        return $adminID;
      }

      //update User table if new information was edited by the admin

      ////////if user info was updated
      if(isset($_POST['update'])){
        //update database

        $db->exec("update User set dLicense = '$_POST[dLicense]', username = '$_POST[username]', fname = '$_POST[fname]', lname = '$_POST[lname]', phone = '$_POST[phone]', email = '$_POST[email]', street= '$_POST[street]', city= '$_POST[city]', state= '$_POST[state]', zip = '$_POST[zip]' where dLicense == '$_POST[original]';");
        //update password if a password reset occurred
        if(!($_POST['password'] == "")){
          //encrypt password
          $enc = openssl_encrypt($_POST['password'],'aes128','cRypT');
          $db->exec("update Login set password = '$enc' where username = '$_POST[username]';");
          //echo "password was updated";
        }
        //get adminID
        $adminID = getAdminID($db, $admin);
        $time = date(DATE_ATOM);
        $db->exec("insert into EditsUser values($adminID,'$_POST[dLicense]', '$time');");
      }

      /////////if a new user was created
      if(isset($_POST['newUser'])){
        //update database
        $db->exec("insert into User values('$_POST[dLicense]', '$_POST[fname]', '$_POST[lname]', '$_POST[phone]', '$_POST[email]', '$_POST[street]', '$_POST[city]', '$_POST[state]', $_POST[zip], '$_POST[username]')");
        //encrypt password
        $enc = openssl_encrypt($_POST['password'],'aes128','cRypT');
        //update Login Table
        $db->exec("INSERT INTO Login VALUES('$_POST[username]', '$enc')");

        ///get adminID
        $adminID = getAdminID($db, $admin);
        $time = date(DATE_ATOM);
        $db->exec("INSERT INTO EditsUser VALUES($adminID,'$_POST[dLicense]','$time');");
      }

      ///if balance was updated
      if(isset($_POST['newBalance'])){
        $db->exec("UPDATE UserBalance SET balance == '$_POST[balance]' where dLicense == '$_POST[dLicense]'");
      }


	//set up the table
  echo '<section>';
  echo '<h1>All Users</h1>';
	echo '<table border = "1">';
	echo '<tr><td><b>Driver\'s License</b></td><td><b>Username</b></td><td><b>Name</b></td><td><b>Phone number</b></td><td><b>Email</b></td><td><b>Address</b></td><td></td><td></td><td></td></tr>';

  //select all users
  $result = $db->query('SELECT * FROM User ORDER BY fname');

  //loop through each tuple in result set

	foreach($result as $tuple) {

	echo "<tr><td>".$tuple['dLicense']."</td>";
	echo "<td>".$tuple['username']."</td>";
	echo "<td>".$tuple['fname']." ".$tuple['lname']."</td>";
	echo "<td>".$tuple['phone']."</td>";
	echo "<td>".$tuple['email']."</td>";
	echo "<td>".$tuple['street']." ".$tuple['city'].", ".$tuple['state']." ".$tuple['zip']."</td>";
	echo "<td> <a href= 'deleteUser.php?un=$tuple[username]'>Delete</a></td>";
  echo "<td> <a href='updateUser.php?dl=$tuple[dLicense]&un=$tuple[username]&fn=$tuple[fname]&ln=$tuple[lname]&p=$tuple[phone]&e=$tuple[email]&street=$tuple[street]&city=$tuple[city]&state=$tuple[state]&z=$tuple[zip]'>Update</a></td>";
  echo "<td> <a href='updateBalance.php?dl=$tuple[dLicense]'>Update Balances</a></td>";
  echo "</tr>";
  }
  echo "</table>";
  echo '</section>';

  echo "<section>";
  echo"<form action='addUser.php'>";
  echo"<input type='submit' value='Add User'>";
  echo"</form>";
  echo"</section>";

  //disconnect from database
  $db = null;
}
catch(PDOException $e)
{
    echo 'Exception : '.$e->getMessage();
}
?>


</html>
