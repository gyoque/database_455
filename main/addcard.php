<?php
//error_reporting(E_ERROR | E_PARSE);

try{
  //Prepare Database
  $db = new PDO('sqlite:/var/www/html/database/carrental.db');
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  //get username
  $user = $_COOKIE['userlogin'];

  //get dLicense
  $qLicense = $db->query("SELECT dLicense from User WHERE username ='$user';");
  $driversL = "";
  foreach ($qLicense as $row)
    $driversL = $row['dLicense'];

  $success = True;
  $edErr = "";
  if(!preg_match("/^[0-9]{2}\/[0-9]{2}$/", $_POST['expDate'])){
  	$edErr = "*Expiration date must be of the form mm/yy";
  	$success = False;
  }

  if($success){
  	$db->exec("INSERT INTO UserCreditCArd VALUES('$_POST[number]', '$_POST[expDate]', '$_POST[CVC]')");

  	$db->exec("INSERT INTO UserBalance VALUES('$driversL', '$_POST[number]',0.0)");
  }

  $db=null;


  if(array_key_exists('redirectCard', $_POST)){
  	if($success) {
    	echo "<form id='cardform' action='/main/card.php' method='post'>";
	}
	else {
    	echo "<form id='cardform' action='/main/card.php?err=$edErr' method='post'>";
	}
    //resubmit hidden values from reservation (in progress)
    echo "<input type='hidden' name='cost' value='$_POST[cost]'>";
  	echo "<input type='hidden' name='user' value='$_POST[user]'>";
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

    <!-- autosubmit form -->
      <script type="text/javascript">
        document.getElementById('cardform').submit();
      </script>


<?php
    //end form which then redirects to card.php
    echo "</form>";

  } else{
  	if($success) {
    	$redirect = "/users/viewCards.php";
    	header("Location: $redirect");
	}
	else {
		$redirect = "/users/viewCards.php?&expDate=$edErr";
		header("Location: $redirect");
	}
  }
}
catch(PDOException $e) {
  echo 'Exception:'.$e->getMessage();
}
?>
