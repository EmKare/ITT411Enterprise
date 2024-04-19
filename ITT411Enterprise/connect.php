<?php
    define("database",'Registry_Department');
    define("user",'root'); #add your user if necessary
    define("password",'1234'); #add your password if necessary
	
	$connection=mysqli_connect('localhost',user,password,database) or die('Error connecting to MYSQL');


