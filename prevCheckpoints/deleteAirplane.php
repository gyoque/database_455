<?php

     try
     {
         //open the sqlite database file
         $db = new PDO('sqlite:database/airport.db');

         // Set errormode to exceptions
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
         //delete tuple from planes
         $db-> exec("delete from planes where tail_no == $_GET[tailno]");
  
         //disconnect from database
         $db = null;
 	
	header("Location: /showAirplanes.php");

     }
     catch(PDOException $e)
     {
         echo 'Exception : '.$e->getMessage();
     } 

?>
