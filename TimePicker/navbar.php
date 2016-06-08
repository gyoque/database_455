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
  <li><a href="/">Home</a></li>
  <li><a href="/about.php">About</a></li>
  <li><a href="/locations.php">Locations</a></li>
  <li><a href="/vehicles.php">Vehicles</a></li>
  <ul style="float:right;list-style-type:none;">
    <?php
      if(array_key_exists('userlogin',$_COOKIE)) {
        echo "<li><a href='/users/useraccount.php'>View Account </a></li>";
        echo "<li><a href='/users/signOut.php'> Sign Out </a></li>";
      }
      else if(array_key_exists('adminlogin',$_COOKIE)) {
        echo "<li><a href='/admin/index.php'>Admin Home </a></li>";
        echo "<li><a href='/users/signOut.php'> Sign Out </a></li>";
      }
      else {
        echo "<li><a href='/users/login.php'>Login</a></li>";
        echo "<li><a href='/users/signUp.php'>Sign Up</a></li>";
      }
    ?>
  </ul>
</ul>
</body>