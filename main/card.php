<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
</head>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/TimePicker/navbar.php'); ?>
<?php
	//Prep database
	$db = new PDO('sqlite:/var/www/html/database/carrental.db');
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	//Returns the last 4 digits of the credit card number
	function last4Num($num) {
		$arr = str_split($num,12);
		return $arr[1];
	}

	$user = $_COOKIE['userlogin'];
	$user = $db -> query("SELECT dLicense FROM user WHERE username == '$user'");
	foreach($user as $tup) {
		$user = $tup[0];
		break;
	}
	$result = $db -> query("SELECT number FROM userbalance WHERE dLicense == '$user';");

	$numbers = array();
	$shortNums = array();
	foreach($result as $tuple) {
		$numbers[] = $tuple['number'];
		$shortNums[] = last4Num($tuple['number']);
	}

	$cost = $_POST['cost'];
	//Print out credit card numbers if they exist
	if(count($numbers) > 0) {
		echo "<section>";
		echo "<h3> Select a Credit Card </h3>";
		echo "<form action='payment.php' method='post'>";
		$notchecked = True;


		for($i = 0; $i < count($numbers); $i++) {
			if($notchecked){ //Set the first radio button as checked by default
				echo "<input type='radio' name='card' value = '$numbers[$i]' checked='checked'> ************".$shortNums[$i]."<br/>";

				$notchecked = False;
			}
			else{
				echo "<input type='radio' name='card' value = '$numbers[$i]'> ************".$shortNums[$i]."<br/>";
			}
		}

		//Passing on hidden information
		echo "<input type='hidden' name='cost' value='$cost'>";
		echo "<input type='hidden' name='user' value='$user'>";
		echo "<input type='hidden' name='make' value='$_POST[make]'>";
		echo "<input type='hidden' name='model' value='$_POST[model]'>";
		echo "<input type='hidden' name='year' value='$_POST[year]'>";
		echo "<input type='hidden' name='sdate' value='$_POST[sdate]'>";
		echo "<input type='hidden' name='stime' value='$_POST[stime]'>";
		echo "<input type='hidden' name='edate' value='$_POST[edate]'>";
		echo "<input type='hidden' name='etime' value='$_POST[etime]'>";
		echo "<input type='hidden' name='loc' value='$_POST[loc]'>";
		// echo "<input type='hidden' name='cs' value='$_POST[cs]'>";
		echo "<input type='hidden' name='vin' value='$_POST[vin]'>";
		echo "<input type='submit' value = 'Submit'>";
		echo "</form>";
		echo "</section> <br/>";
	}

?>


<form action="/main/addcard.php" method="post">
  <section>
    <h3> Add New Card </h3>
    <font color='red'>
    <?php
    	if(array_key_exists('err',$_GET)) {
    		echo $_GET['err']."<br/>";
    	}
    ?>
    </font>
    Card Number <br>
    <input type="integer" name="number" minlength="16" maxlength="16" required>
    <br>
    Expiration Date <br>
    <input type="text" name="expDate" placeholder="mm/yy" style="width: 65px;" required>
    &nbsp;   &nbsp;  &nbsp;
    <br>
    CVC <br>
    <input type="integer" name="CVC" style="width: 50px;"  minlength="3" maxlength="4" required>
    <br>

<?php
    echo "<input type='hidden' name='cost' value='$cost'>";
  	echo "<input type='hidden' name='user' value='$user'>";
    echo "<input type='hidden' name='make' value='$_POST[make]'>";
    echo "<input type='hidden' name='model' value='$_POST[model]'>";
    echo "<input type='hidden' name='year' value='$_POST[year]'>";
    echo "<input type='hidden' name='sdate' value='$_POST[sdate]'>";
    echo "<input type='hidden' name='stime' value='$_POST[stime]'>";
    echo "<input type='hidden' name='edate' value='$_POST[edate]'>";
    echo "<input type='hidden' name='etime' value='$_POST[etime]'>";
    echo "<input type='hidden' name='loc' value='$_POST[loc]'>";
    echo "<input type='hidden' name='vin' value='$_POST[vin]'>";

?>
    <input type="hidden" name="redirectCard" value="TRUE">

    <br/>
    <input type='submit' value = 'Add Card'>

  </section>

</form>








</html>
