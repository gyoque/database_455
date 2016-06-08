<!DOCTYPE html>
<html>

<form action="query.php" method="post">

<?php
  //If a submit occurred
  if(isset($_POST['submitted'])){
    try{
      //Open database
      $db=new PDO("sqlite:database/airport.db");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      //Set up variables
      $query = $_POST['query'];
      $split = explode(' ',trim($query));
      $type = $split[0]; //Get the first word of the query
      
      //If a select, display what's selected
      if(strtolower($type) == 'select'){
        $values = $db->query("$query");
        foreach($values as $tuple) {
          for($i = 0; $i < count($tuple)/2; ++$i){	//Turns out theres 2 keys per value, one being the attribute name and the other being an index.
            echo "$tuple[$i]";
          }
          echo "<br />";
        }
      }
      //If not a select, execute the query
      else {
        $db->exec("$query");
        echo "Successful $type";
        echo "<br />";
      }
      
      //Close the database
      $db = null;
    }
    catch(PDOException $e){
      echo 'Exception : '.$e->getMessage();
    }
  }
?>

Input a query here:<br>
<input type="text" name = "query">
<br>
<input type = "Submit" name="submitted" value = "Submit Query">


</html>
