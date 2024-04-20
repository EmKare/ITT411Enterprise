<?php
	include "connect.php";
    session_start();
    if(isset($_POST['submit'])){
        $query="delete from Active_Lecturers where '$_GET[id]' = Active_LecturerID";        
        $result= mysqli_query($connection,$query);
        if($result)
        {
            $query="insert into Retired_Lecturers (Retired_LecturerID) values ('$_GET[id]')";
            $result= mysqli_query($connection,$query);      
            if($result){
                $_SESSION["status"]="successful";}
                
            else{
                $_SESSION["status"]="unsuccessful";}
        }
        header("location:viewAllLecturers.php");        
    }       
?>