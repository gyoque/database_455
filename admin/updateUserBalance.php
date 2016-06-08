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
<?php echo "<form action='updateBalance.php?dl=$_GET[dl]' method='post'>"; ?>
<?php
echo "<h1>Edit balance for ".$_GET['fn']."</h1>";
?>

<br>Balance<br>
<input type="text" name="balance" value="<?php echo $_GET['bal']; ?>"><br>

<input type="Submit" name="newBalance" value="Update">

<input type="hidden" name="dLicense" value = "<?php echo $_GET['dl']; ?>">
</section>
</html>
