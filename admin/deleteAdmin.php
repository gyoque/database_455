<!-- checking are you sure -->
<?php
try
{
  if(!(array_key_exists('adminlogin', $_COOKIE))) {
      header("Location: /index.php");
    }

    //open the sqlite database file
    $db = new PDO('sqlite:/var/www/html/database/carrental.db');

    // Set errormode to exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //delete tuple from planes
    $db-> exec("DELETE from Admin where username == '$_GET[username]'");
    $db-> exec("DELETE from Login where username == '$_GET[username]'");

    //disconnect from database
    $db = null;

    header("Location: /admin/editAdmins.php");

}
catch(PDOException $e)
{
    echo 'Exception : '.$e->getMessage();
}

?>
