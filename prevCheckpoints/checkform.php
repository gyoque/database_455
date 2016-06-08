<?php  
try{
  //Prepare Database
  $db = new PDO('sqlite:database/airport.db');
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  //Prepare error messages
  $fErr = $lErr = $sErr = "";
  $success = true; //True if no errors

  //Check if first name field is empty
  if(empty($_POST['firstname'])){
    $fErr = "*First Name is Required";
    $success = false;
  }
  //Check if last name field is empty
  if(empty($_POST['lastname'])){
    $lErr = "*Last Name is Required";
    $success = false;
  }
  //Check if ssn field is empty
  if(empty($_POST['ssn'])){
    $sErr = "*SSN is Required";
    $success = false;
  }
  //Check if ssn matches the proper form
  elseif(!preg_match("#\b[0-9]{3}-[0-9]{2}-[0-9]{4}\b#",$_POST['ssn'])){
    $sErr = "*SSN has to be of the form ???-??-????";
    $success = false;
  }

  //If no errors, Success
  if($success == true) {
    $db->exec("INSERT INTO passengers VALUES('$_POST[firstname]', NULL, '$_POST[lastname]', '$_POST[ssn]')");
    echo "SUCCESS!!!!!!";
    echo "<br />";
  }
  //If errors, redirect to form with error variables
  else {
    $Err = "All fields are required";
    header("Location: /formtest.php?f=$fErr&l=$lErr&s=$sErr");
  }

  //If no errors, print out passenger information
  $result=$db->query('SELECT * FROM passengers');
  foreach($result as $tuple) {
    echo "$tuple[ssn] $tuple[f_name] $tuple[l_name]";
    echo "<br />";
  }
}
catch(PDOException $e) {
  echo 'Exception:'.$e->getMessage();
}
?>
