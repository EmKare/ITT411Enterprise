<?php
    define("database",'Registry_Department');
    define("user",''); #add your user if necessary
    define("password",''); #add your password if necessary
	
	$connection=mysqli_connect('localhost',user,password,database) or die('Error connecting to MYSQL');


