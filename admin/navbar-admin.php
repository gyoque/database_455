<head>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: rgba(255,255,255,0.0);
}

li {
    float: left;
}

li a {
    display: block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
</style>
</head>
<body>
<ul>
  <li><a href="/"><b>Website Home</b></a></li>
  <li><a href="/admin/"><b>Admin Home</b></a></li>
  <li><a href="/admin/editUsers.php">Users</a></li>
  <li><a href="/admin/editVehicles.php">Vehicles</a></li>
  <li><a href="/admin/editReservations.php"> Reservations</a></li>
  <li><a href="/admin/editAdmins.php">Admins</a></li>
  <ul style="float:center;list-style-type:none;">
  <li><a href="/admin/history.php">View History</a></li>
  <ul style="float:right;list-style-type:none;">
    <?php
       if(array_key_exists('adminlogin',$_COOKIE)) {
         echo "<li><a href='/users/signOut.php'> Sign Out </a></li>";
       }
       ?>

  </ul>
</ul>
</body>
