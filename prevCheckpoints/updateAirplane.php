<!DOCTYPE html>
<html>

<form action="showAirplanes.php" method="post">

tail_no <br>
<input type="integer" name="tailno" value="<?PHP echo $_GET['tailno']; ?>"><br>

<br>make<br>
<input type="text" name ="make" value="<?php echo $_GET['make']; ?>"><br>

<br>model<br>
<input type="text" name="model" value="<?php echo $_GET['model']; ?>"><br>

<br>capacity<br>
<input type="integer" name="capacity" value="<?php echo $_GET['capacity']; ?>"><br>

<br>mph<br>
<input type="integer" name="mph" value="<?php echo $_GET['mph']; ?>"><br>

<input type="Submit" name="update" value="Update">

<input type="hidden" name="original" value = "<?php echo $_GET['tailno']; ?>">

</html>
