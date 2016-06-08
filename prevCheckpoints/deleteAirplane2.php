<!-- checking are you sure -->

<html>
<body>

Are you sure?

<form action="showAirplanes.php" method="get">



<input type="submit" onclick="clicked('Yes');" value="Yes"> <br> 

<input type="submit" onclick="clicked('No');" value="No"> <br>


</form>

</html>
</body>


<?php
   
function clicked($ans)
{ if($ans=='Yes')
  {
	echo 'Hello world';

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
  }
  elseif($ans=='No')
  {
    header("Location: /showAirplanes.php");
  }
} 

?>

