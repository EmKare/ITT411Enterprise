<?php
    include "connect.php";
    session_start();

    function EDIT_SEMAIL($fname)
    {        
        return strtolower(substr($fname,0,rand(1,strlen($fname))).rand(0,100)."@school.sch");
    }

    if(isset($_POST['submit'])){
        $semail = EDIT_SEMAIL($_POST['fname']);
        $query="insert into Students (fname,mname,lname,Semail,Pemail,address,Mtele,Htele,Wtele,nextOfKin,nextOfKinContact,program)
        values('$_POST[fname]','$_POST[mname]','$_POST[lname]','$semail','$_POST[pemail]','$_POST[address]','$_POST[mtele]','$_POST[htele]','$_POST[wtele]','$_POST[nextofkin]','$_POST[nextofkincontact]','$_POST[program]')";
        $result= mysqli_query($connection,$query);
        if($result)
        {
            $query ="select * from Students 
            where fname = '$_POST[fname]' 
            and mname = '$_POST[mname]' 
            and lname = '$_POST[lname]' 
            and Semail = '$semail' 
            and pemail = '$_POST[pemail]' 
            and address = '$_POST[address]' 
            and Mtele = '$_POST[mtele]' 
            and Htele = '$_POST[htele]' 
            and Wtele = '$_POST[wtele]' 
            and nextOfKin = '$_POST[nextofkin]' 
            and nextOfKinContact = '$_POST[nextofkincontact]' 
            and program = '$_POST[program]'
            ";
            $IDresult= mysqli_query($connection,$query);
            if($IDresult->num_rows>0)
            {
                while($row=$IDresult->fetch_assoc())
                {
                    $query="insert into Registered_Students (Registered_studentID) values('$row[studentID]')";
                    $RegResult= mysqli_query($connection,$query);
                    if($RegResult)
                        $_SESSION["status"]="save";
                    else
                        $_SESSION["status"]="unsuccessful";
                }
            }
        }
    }
?>