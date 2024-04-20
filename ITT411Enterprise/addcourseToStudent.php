<?php
	include "connect.php";
    session_start();
 
    $query="insert into Enrolment(enrolmentSectionCode, enrolmentStudentID) values ('$_GET[id]','$_SESSION[studentID]')";        
    $result= mysqli_query($connection,$query);
    if($result)
    {
        header("Refresh: 1; url=viewSingleStudent.php?id=$_SESSION[studentID]");
        header("location:viewSingleStudent.php?id=$_SESSION[studentID]"); 
    }          
?>