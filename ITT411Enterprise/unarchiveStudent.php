<?php
	include "connect.php";
    session_start();

    if(isset($_POST['submit'])){
        $query="delete from Archived_Students where '$_GET[id]' = Archived_studentID";        
        $result= mysqli_query($connection,$query);
        if($result)
        {
            $query="insert into Registered_Students (Registered_studentID) values('$_GET[id]')";
            $result= mysqli_query($connection,$query);      
            if($result){
                $_SESSION["status"]="successful";}
                
            else{
                $_SESSION["status"]="unsuccessful";}
        }
        header("location:viewAllInactiveStudents.php");
    }       
?>