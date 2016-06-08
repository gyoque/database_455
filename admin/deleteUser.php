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

    //delete tuple from user & Login
    //we weren't able to get foreign key cascading on delete to work...
    $db-> exec("DELETE from User where username == '$_GET[un]'");
    $db-> exec("DELETE from Login where username == '$_GET[un]'");
    //disconnect from database
    $db = null;

    header("Location: /admin/editUsers.php");

}
catch(PDOException $e)
{
    echo 'Exception : '.$e->getMessage();
}

?>
