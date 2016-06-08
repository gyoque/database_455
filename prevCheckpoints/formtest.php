<!DOCTYPE html>
<html>
<body>

<form action="checkform.php" method="post">

<!-- First name field -->
First name:<br>
<input type="text" name="firstname">
<!-- Display error message if any -->
<font color="red">
  <?php
    if(array_key_exists("f", $_GET)){
      echo $_GET['f'];
    }
  ?>
</font>
  <br>

<!-- Last name field -->
Last name:<br>
<input type="text" name="lastname">
<!-- Display error message if any -->
<font color ="red">
  <?php 
    if(array_key_exists("l", $_GET)){
      echo $_GET['l'];
    }
  ?>
</font>
  <br>

<!-- SSN field -->
SSN:<br>
<input type="text" name ="ssn">
<!-- Display error message if any -->
<font color = "red">
  <?php 
    if(array_key_exists("s", $_GET)){
      echo $_GET['s'];
    }
  ?>
</font>
<br><br>

<!-- Submit button -->
<input type="submit" value = "Submit">

</form>
</body>
</html>
