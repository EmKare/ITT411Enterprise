<?php
	include "connect.php";
    session_start();
    
    if(isset($_POST['submit']))
    {
        echo $_GET['id'] ;
        //echo $_SESSION['Registered_number']."<br>".$_SESSION['studentID'];    
    }
