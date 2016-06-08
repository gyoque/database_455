<!DOCTYPE html>
<html>
<head>
    <!-- Links to css and javascript for the time picker -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script type="text/javascript" src="TimePicker/jquery.timepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="TimePicker/jquery.timepicker.css" />

    <script type="text/javascript" src="TimePicker/lib/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="TimePicker/lib/bootstrap-datepicker.css" />

    <script type="text/javascript" src="TimePicker/lib/site.js"></script>
    <link rel="stylesheet" type="text/css" href="TimePicker/lib/site.css" />

    <!-- Prep the calendar -->
    <script>
        $(document).ready(function() {
            $("#datepicker").datepicker();
            $("#datepicker2").datepicker();
        });
    </script>
</head>
<?php include_once('TimePicker/navbar.php'); ?>

<!-- Login Signup Links-->
<section>
<p align="right">
<?php
    if(array_key_exists('userlogin', $_COOKIE)) {
        echo "Welcome, ".$_COOKIE['userlogin']." &nbsp; &nbsp;";
    }
    if(array_key_exists('adminlogin', $_COOKIE)){
	echo "Welcome, ".$_COOKIE['adminlogin']." &nbsp; &nbsp;";
    }
?>
</p>
</section>
<!-- Title -->
<center> <h1> David Chiu's Car Rentals </h1> </center>
<!-- Tabs -->
<body>

<center>
    <a href="about.php"> <big> <b> About </b> </big> </a> &nbsp;<big>|</big>&nbsp;
    <a href="locations.php"> <big> <b> Locations</b> </big> </a> &nbsp;<big>|</big>&nbsp;
    <a href="vehicles.php"> <big> <b> Vehicles </b> </big> </a>
</center>

</body>
<!-- Search -->
<body>
    <center>
    <br>
    <div style="text-align: center;">
    <div style="display: inline-block; text-align: left">
    <form action="/main/search.php" method="post">
        <!-- Start Date and Time -->
        <section>
            <h3>Make a Reservation: </h3>
            <font color = "red">
                <?php
                    if(array_key_exists("cmp", $_GET)) {
                        echo $_GET['cmp']."<br/>";
                    }
                ?>
            </font>
            Start Date: <br>
            <input id="datepicker" name="startdate" required>
            <font color = "red">
                <?php
                    if(array_key_exists("sd", $_GET)) {
                        echo $_GET['sd'];
                    }
                ?>
            </font>
            <br>

            Start Time: <br>
            <input id="scrollDefaultExample" type="text" class="time" name = "starttime" required/>
            <script>
                $(function() {
                    $('#scrollDefaultExample').timepicker({ 'scrollDefault': 'now' });
                });
            </script>
            <font color = "red">
                <?php
                    if(array_key_exists("st", $_GET)) {
                        echo $_GET['st'];
                    }
                ?>
            </font>
        </section>
        <!-- End Date and Time -->
        <section>
            End Date: <br>
            <input id="datepicker2" name="enddate" required>
            <font color = "red">
                <?php
                    if(array_key_exists("ed", $_GET)) {
                        echo $_GET['ed'];
                    }
                ?>
            </font>
            <br>

            End Time: <br>
            <input id="scrollDefaultExample2" type="text" class="time" name="endtime" required/>
            <script>
                $(function() {
                    $('#scrollDefaultExample2').timepicker({ 'scrollDefault': 'now' });
                });
            </script>
            <font color = "red">
                <?php
                    if(array_key_exists("et", $_GET)) {
                        echo $_GET['et'];
                    }
                ?>
            </font>
        </section>
        <!-- Location -->
        <section>
            Location: <br>
            <!-- <input type = "text" name = "city" placeholder = "city"/>
            <input type = "text" name = "state" placeholder = "state" style="width: 32px;"/> -->
            <select name="loc">
                <option value="Tacoma,WA">Tacoma, WA</option>
                <option value="Los Angeles,CA">Los Angeles, CA</option>
                <option value="Salem,OR">Salem, OR</option>
                <option value="Seattle,WA">Seattle, WA</option>
                <option value="Boston,MA">Boston, MA</option>
            </select>
            <font color = "red">
                <?php
                    if(array_key_exists("zcs", $_GET)) {
                        echo $_GET['zcs'];
                    }
                ?>
            </font>
        </section>
        <!-- Submit -->
	    <section>
	       <input type = "submit" name = "submit" value = "Search"/>
	    </section>
    </form>
    </div>
    </div>
    </center>
</div>
</body>
</html>
