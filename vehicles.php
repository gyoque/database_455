<! DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/TimePicker/lib/site.css" />
    <link rel="stylesheet" type="text/css" href="/TimePicker/tablestuff.css" />
</head>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/TimePicker/navbar.php'); ?>
<center>
<title>Vehicles</title>
<h1>Vehicles</h1>
All vehicles listed are available in all our locations. 

<?php

    try
    {
    //open the sqlite database file
    $db = new PDO('sqlite:/var/www/html/database/carrental.db');

    // Set errormode to exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    //set up the table
    echo '<section>';
   	echo '<table border = "1">';
   	echo '<tr><td><b>Price Per Hour</b></td><td><b>Make model year</b></td><td><b>Transmission</b></td><td><b>Seats</b></td></tr>';

    	//select all vehicles
    	//$result = $db->query('SELECT * FROM Vehicle');

	$makes = $db->query("SELECT make FROM vehicle;"); //Get all makes owned
	$seats = $db->query("SELECT DISTINCT seats FROM vehicle;"); //Get all possible number of seats


//Filters
		$filMake = $filTrans = $filSeats = $filPrice = "";
		//Set Filters
		if(array_key_exists("filMake", $_POST) && $_POST['filMake'] != 'all') {
			$filMake = "AND make == '$_POST[filMake]'";
		}
		if(array_key_exists("filTrans", $_POST) && $_POST['filTrans'] != 'all') {
			$filTrans = "AND transmission == '$_POST[filTrans]'";
		}
		if(array_key_exists("filSeats", $_POST) && $_POST['filSeats'] != 'all') {
			$filSeats = "AND seats == $_POST[filSeats]";
		}
		if(array_key_exists("filPrice", $_POST) && $_POST['filPrice'] != 'all') {
			if($_POST['filPrice'] == 'asc'){
				$filPrice = "ORDER BY pricePerHour";
			}
			else {
				$filPrice = "ORDER BY pricePerHour DESC";
			}
		}

		//Select all available cars with search results
		$result = $db->query("	SELECT round(pricePerHour,2),* FROM vehicle WHERE 1==1
								$filMake $filTrans $filSeats $filPrice;");

		//Set up secondary filter
		echo "<section>";
		echo "<form action='$_SERVER[REQUEST_URI]' method=post>";
		echo "<b>Filter Vehicles by: </b>";
		//Make drop down
		echo "Make <select name='filMake'>";
		echo "<option selected='selected' value='all'>-Select All-</option>";
		foreach($makes as $tup) {
			echo "<option value=$tup[0]>$tup[0]</option>";
		}
		echo "</select>&nbsp; &nbsp;";
		//Transmission drop down
		echo "Transmission <select name='filTrans'>";
		echo "<option selected='selected' value='all'>-Select All-</option>";
		echo "<option value='Automatic'>Automatic</option>";
		echo "<option value='Manual'>Manual</option>";
		echo "</select>&nbsp; &nbsp;";
		//Seats drop down
		echo "Seats <select name='filSeats'>";
		echo "<option selected='selected' value='all'>-Select All-</option>";
		foreach($seats as $tup) {
			echo "<option value=$tup[0]>$tup[0]</option>";
		}
		echo "</select>&nbsp; &nbsp;";
		//Price arrangement
		echo "Sort Price <select name='filPrice'>";
		echo "<option selected='selected' value='all'>-Select All-</option>";
		echo "<option value='asc'>Lowest to Highest </option>";
		echo "<option value='des'>Highest to Lowest </option>";
		//Submit
		echo "<input type='submit' value=Submit>";
		echo "</form>";
		echo "</section>";



    //loop through each tuple in result set
   	foreach($result as $tuple) {

   	echo "<td>".$tuple['pricePerHour']."</td>";
   	echo "<td>".$tuple['make']." ".$tuple['model']." ".$tuple['year']."</td>";
   	echo "<td>".$tuple['transmission']."</td>";
   	echo "<td>".$tuple['seats']."</td>";
    echo "</tr>";
     }
    echo "</table>";
    echo "</section>";

   //disconnect from database
    $db = null;
}
catch(PDOException $e)
{
    echo 'Exception : '.$e->getMessage();
}
?>

</center>



</html>
