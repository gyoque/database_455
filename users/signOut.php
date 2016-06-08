<?php
	setcookie('userlogin', Null, time()-3600, "/");
	setcookie('adminlogin', Null, time()-3600, "/");

	header("Location: /");

	
?>