<?php
	include "connect.php";
    session_start();
    if(isset($_POST['submit'])){
        $query="delete from Retired_Lecturers where '$_GET[id]' = Retired_LecturerID";            
        $result= mysqli_query($connection,$query);
        if($result)
        {
            $query="insert into Active_Lecturers (Active_LecturerID) values('$_GET[id]')";  
            $result= mysqli_query($connection,$query);      
            if($result){
                $_SESSION["status"]="successful";}
                
            else{
                $_SESSION["status"]="unsuccessful";}
        }
        header("location:viewAllInactiveLecturers.php");
    }       
?>