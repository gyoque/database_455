<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
</head>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/TimePicker/navbar.php'); ?>
<?php
	if(!array_key_exists('adminlogin', $_COOKIE) or !array_key_exists('userlogin', $_COOKIE)) {
      header("Location: /index.php");
  }
?>

<form action="addcard.php" method="post">

  <section>
    Card Number <br>
    <input type="integer" name="number" required>
    <br>
    Expirpation Date <br>
    <input type="text" name="expDate" placeholder="mmyyyy" style="width: 65px;" required>
    &nbsp;   &nbsp;  &nbsp;
    <br>
    CVC <br>
    <input type="integer" name="CVC" style="width: 50px;"  required>
    <br>
  </section>

  <section> <input type='submit' value = 'Submit'> </section>

</form>


</html>
