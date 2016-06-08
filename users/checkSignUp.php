<?php
error_reporting(E_ERROR | E_PARSE);
try{

  //Prepare Database
  $db = new PDO('sqlite:/var/www/html/database/carrental.db');
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  //Prepare error messages
  $fErr = $lErr = $dErr =$pErr = $mErr = $sErr = $cErr = $aErr = $zErr = $unErr = $passERR ="";
  $success = true; //True if no errors

  //need to check if name is valid
  if(empty($_POST['firstname'])){
    $fErr = "Error";
    $success = false;
  }
  //check if last name is valid
  if(empty($_POST['lastname'])){
    $lErr = "Error";
    $success = false;
  }

  //Check if valid DL (HOW)
  //capitlize all letters?
  if(empty($_POST['dLicense'])){
    $dErr = "";
    $success = false;
  }
  //Check if phone matches regex of (xxx)-xxx-xxxx
  if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $_POST['phone'])){
    $pErr = "*Phone Number needs to be XXX-XXX-XXXX";
    $success = false;
  }
  //Check if email is valid
  if(strpos($_POST['email'], "@") === false || strpos($_POST['email'],".") === false){
    $mErr = "*Please input a valid e-mail address";
    $success = false;
  }

  //Check if ADDRESS field is empty
  //might not need this since previous form says its required
  if(empty($_POST['street'])){
    $sErr = "";
    $success = false;
  }
  if(empty($_POST['city'])){
    $cErr = "";
    $success = false;
  }
  if(empty($_POST['state'])){
    $aErr = "";
    $success = false;
  }
  if(!preg_match("/^[0-9]{5}$/", $_POST['zip'])){
    $zErr = "*Please input a valid zip code";
    $success = false;
  }

  //check that username is unique
  $username = $_POST['username'];
  $result = $db->query("SELECT * FROM User WHERE username = '$username';");
  $unique = True;
  foreach($result as $tup) {
    $unique = False;
    break;
  }
  if(!$unique) {
    $unErr = "*Username is already taken";
    $success = false;
  }


  //encrypt password
  $enc = openssl_encrypt($_POST['password'],'aes128','cRypT');

  if($enc == FALSE){
    $passErr = 'Password could not be stored';
    $success = false;
  }

  //Set redirect path
  if(array_key_exists('redirect',$_POST)) {
    $redirect = True;
  }
  else {
    $redirect = False;
  }
  //If no errors, Success
  if($success == true) {
    //store user
    $db->exec("INSERT INTO User VALUES('$_POST[dLicense]','$_POST[firstname]', '$_POST[lastname]',
                                        '$_POST[phone]', '$_POST[email]',
                                        '$_POST[street]', '$_POST[city]', '$_POST[state]','$_POST[zip]', '$_POST[username]')");

    //store encyrpted password in db
    $db->exec("INSERT INTO Login VALUES('$_POST[username]', '$enc')");

    setcookie('userlogin', $_POST['username'] , time()+60*60*24, "/");

    //If redirect, then go back to reservation process
    if($redirect) {
      echo "BUT WILL YOU REDIRECT";
      echo "<form action='/main/card.php' method='post' id='rd'>";
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
      $db=null;
      ?>
      <script type="text/javascript">
        document.getElementById('rd').submit();
      </script>
<?php
    }
    else{
    //forward users to home
      header("Location: /");
    }
  }
  //If errors, redirect to form with error variables
  else {
    $db=null;
    $Err = "There was an error. Please try again.";
    header("Location: /users/signUp.php?unErr=$unErr&f=$fErr&l=$lErr&d=$dErr&p=$pErr&m=$mErr&s=$sErr&c=$cErr&a=$aErr&z=$zErr&pass=$passERR ");
  }
}
catch(PDOException $e) {
  echo 'Exception:'.$e->getMessage();
}
?>
