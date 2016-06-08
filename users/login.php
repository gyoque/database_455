<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
</head>

<body>

<!-- > will want to submit this <form action="______" method="post"> <!-->


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
<h1>Log In</h1>

<section class="loginform cf">
<form name="login" action="checkUser.php" method="post" accept-charset="utf-8">
<ul>
	<font color = "red">
	<?php
		if(array_key_exists('p',$_GET)) {
			echo $_GET['p']."<br/>";
		}
	?>
	</font>
    <label for="username">Username</label>
    <input type="text" name="username" placeholder="username" required><br/>
    <label for="password">Password</label>
    <input type="password" name="password" placeholder="password" required><br/>

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
    <br/>
    <input type="submit" value="Login">
</ul>
</form>
</section>
<section>
If you don't have an account, 
<?php
	echo "<form action='signUp.php' method='post'>";
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
	echo "<input type='submit' value='Sign up'>";
?>
 for free!
</section>
</form>
</center>
</body>
</html>
