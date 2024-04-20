<?php
	include "connect.php";
    session_start();

    if(isset($_POST['submit'])){
        $query="delete from Registered_Students where '$_GET[id]' = Registered_studentID";        
        $result= mysqli_query($connection,$query);
        if($result)
        {
            $query="insert into Archived_Students (Archived_studentID) values('$_GET[id]')";
            $result= mysqli_query($connection,$query);      
            if($result){
                $_SESSION["status"]="successful";}
                
            else{
                $_SESSION["status"]="unsuccessful";}
        }
        header("location:viewAllStudents.php");
    }       
?>