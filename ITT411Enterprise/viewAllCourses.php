<?php
	include "connect.php";
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View All Courses</title>
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
        <h1> View All Courses</h1>

        <?php
            $query="select * from Courses"; 
            $result=mysqli_query($connection,$query)or die('Error query not working');
            if($result->num_rows>0)
            {
                echo"<table id='table1'>";
                echo"<tr><th> Course Code </th><th> Course Title </th><th> Credits </th><th> Degree Level </th></tr>";
                while($row=$result->fetch_assoc())
                {
                    echo"<tr><td><a href='viewSingleCourse.php?id=$row[coursecode]'>$row[coursecode]<a/></td><td>$row[coursetitle]</td><td>$row[coursecredits]</td><td>$row[coursedegreelevel]</td></tr>";
                }
                echo"</table";
            }
        ?>        
    </body>
</html>