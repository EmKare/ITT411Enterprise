<?php
	include "connect.php";
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View All Lecturers</title>
            <style>
                #table1, th, td
                {
                    border: 1px solid black;                
                    border-collapse: collapse;
                    padding: 0.5rem;
                }
            </style>
    </head>
    <body>
        <h1> View All Lecturers</h1>

        <?php
            $query="select * from Lecturers"; 
            $result=mysqli_query($connection,$query)or die('Error query not working');
            if($result->num_rows>0)
            { 
                echo"<table id='table1'>"; 
                echo"<tr><th>Lecturer ID</th><th>Full Name</th><th> Department </th><th> Role </th></tr>";
                while($row=$result->fetch_assoc())
                {
                    echo"<tr><td><a href='viewSingleLecturer.php?id=$row[lecturerID]'>$row[lecturerID]<a/></td><td>$row[title] $row[fname] $row[lname]</td><td>$row[department]</td><td>$row[position]</td></tr>";
                }
                echo"</table";
                $result -> free_result();
            }
        ?>
        
    </body>
</html>