<?php
error_reporting(E_ERROR | E_PARSE);

try{
  //Prepare Database
  $db = new PDO('sqlite:/var/www/html/database/carrental.db');
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  //error message
  $pErr = "";

  //encrypt password
  $enc = openssl_encrypt($_POST['password'],'aes128','cRypT');

  //select password from database for user
  $user = $_POST['username'];
  $pass = $db->query("SELECT password FROM Login WHERE username='$user'");

  //parse query to get string
  $realpass = "";
  foreach ($pass as $row)
    $realpass = $row['password'];

  $adquery = $db->query("SELECT username FROM Admin WHERE username='$user'");
  $admin = "";
  foreach ($adquery as $row)
    $admin = $row['username'];





  //compare given encrypted password to stored password
  if($enc==$realpass){

    if($admin==$user){ //set cookie for admin

      $cookie_name = 'adminlogin';

      setcookie($cookie_name, $admin , time()+60*60*24, "/");
      header("Location: /admin/index.php");

    } else { //set cookie for regular user

      $cookie_name = 'userlogin';

      setcookie($cookie_name, $user , time()+60*60*24, "/");

      if(array_key_exists('redirect',$_POST)) {
        echo "<form action='/main/card.php' method='post' id='hideform'>";
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
        echo "</form>"
      ?>
      <script type="text/javascript">
        document.getElementById('hideform').submit();
      </script>
      <?php
      }
      else {
        header("Location: /index.php");
      }
    }

  }
  else{
    $pErr = "Incorrect Password";
    // print_r($realpass);
    // print_r($enc);

    if(array_key_exists('redirect',$_POST)) {
        echo "<form action='login.php?p=$pErr' method='post' id='hideform'>";
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
        echo "</form>"
      ?>
      <script type="text/javascript">
        document.getElementById('hideform').submit();
      </script>
      <?php
    }
    else {
      header("Location: /users/login.php?p=$pErr");
    }
  }

    $db=null;

}
catch(PDOException $e) {
  echo 'Exception:'.$e->getMessage();
}
?>
