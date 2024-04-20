<?php
	include "connect.php";
    session_start();
    $query="delete from Enrolment where enrolmentNo ='$_GET[id]'";        
    $result= mysqli_query($connection,$query);
    if($result)
    {
        header("Refresh: 1; url=viewSingleStudent.php?id=$_SESSION[studentID]");
        header("location:viewSingleStudent.php?id=$_SESSION[studentID]"); 
    }          
?>