<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
</head>

<body>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/TimePicker/navbar.php'); ?>
<?php
	if(array_key_exists('adminlogin', $_COOKIE)) {
      header("Location: /admin/index.php");
  }
	if(array_key_exists('userlogin', $_COOKIE)){
		header("Location: /users/useraccount.php");
	}
?>

<center>
  <br>
  <div style="text-align: center;">
    <section>
    <h1>  Sign Up </h1>
    </section>

  <div style="display: inline-block; text-align: left">

    <form action="checkSignUp.php" method="post">

    <!--BASIC USER INFO -->
    <section>
      <!-- First Name -->
      First Name: <br>
      <input type="text" name="firstname" required>
      <br>
      <!-- Last Name -->
      Last Name:<br>
      <input type="text" name="lastname" required>
      <br>
      <!-- Driver's License-->
      Driver's License: <br>
      <input type="text" name="dLicense" required>
      <br>
    </section>


    <!--CONTACT INFO-->
    <section>
      <!-- phone, text, must be 15 characters, need to check regex -->
      <font color='red'>
      <?php
        if(array_key_exists('p',$_GET)) {
          echo $_GET['p']."<br>";
        }
      ?>
      </font>
      <font color='red'>
      <?php
        if(array_key_exists('m',$_GET)) {
          echo $_GET['m']."<br>";
        }
      ?>
      </font>
      Phone Number: <br>
      <input type="text" name="phone" placeholder="XXX-XXX-XXXX" required>
      <br>

      <!-- email text, unique, (try email input type)-->
      Email: <br>
      <input type="text" name="email" placeholder="youremail@email.com" required>
      <br>
    </section>

    <!--ADDRESS-->
    <section>
      <!-- address with street, city,zipcode, state (2 char)-->
      <font color='red'>
      <?php
        if(array_key_exists('z',$_GET)) {
          echo $_GET['z']."<br>";
        }
      ?>
      </font>
      Address: <br>
      <input type="text" name="street" placeholder="street" required>
      <br>
      <input type="text" name="city" placeholder="city" required>
      <br>
      <input type="text" name="zip" placeholder="zipcode" style="width: 70px;" required minlength='5' maxlength='5'>
      <input type ="text" name="state" placeholder="state" style="width: 32px;" required minlength='2' maxlength='2'>
    </section>


    <!-- USERNAME -->
    <section>
    <!-- username -->
        <font color='red'>
        <?php
          if(array_key_exists('unErr',$_GET)) {
            echo $_GET['unErr']."<br>";
          }
        ?>
        </font>
        <label for="username">Username</label> &nbsp;
        <input type="text" name="username" placeholder="username" required>
        <br>
    <!-- password -->
        <label for="password">Password</label> &nbsp;
        <input type="password" name="password" placeholder="password" required>
        <br>

    </section>


    <?php
      if(array_key_exists('redirect',$_POST)) {
        echo "<input type='hidden' name='redirect' value='$_POST[redirect]'>";
        echo "<input type='hidden' name='cost' value=$_POST[cost]>";
        echo "<input type='hidden' name='stime' value='$_POST[stime]'>";
        echo "<input type='hidden' name='sdate' value='$_POST[sdate]'>";
        echo "<input type='hidden' name='etime' value='$_POST[etime]'>";
        echo "<input type='hidden' name='edate' value='$_POST[edate]'>";
        echo "<input type='hidden' name='make' value='$_POST[make]'>";
        echo "<input type='hidden' name='model' value='$_POST[model]'>";
        echo "<input type='hidden' name='year' value='$_POST[year]'>";
        echo "<input type='hidden' name='loc' value='$_POST[loc]'>";
        //echo "<input type='hidden' name='cs' value='$_POST[cs]'>";
        echo "<input type='hidden' name='vin' value='$_POST[vin]'>";
      }
    ?>

    <section>
      <input type="submit" value="Submit">
    </section>


  </div>
  </div>
</center>

</form>
</body>
</html>
