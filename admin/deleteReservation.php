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
    $db-> exec("delete from Reservation where confirmNum == $_GET[cn] AND dLicense == '$_GET[dl]'");

    //disconnect from database
    $db = null;

    header("Location: /admin/editReservations.php");

}
catch(PDOException $e)
{
    echo 'Exception : '.$e->getMessage();
}

?>
