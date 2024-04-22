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
        <h1> View All Retired Lecturers</h1>

        <?php
            $query="select * from Lecturers, Retired_Lecturers 
            where Retired_Lecturers.Retired_LecturerID = Lecturers.lecturerID;"; 
            $result=mysqli_query($connection,$query)or die('Error query not working');
            if($result->num_rows>0)
            { 
                echo"<span style='color:black;font-size:25px;'><table id='table1'>"; 
                echo"<tr><th>Lecturer ID</th><th>Full Name</th><th> Department </th><th> Role </th><th>-</th></tr>";
                while($row=$result->fetch_assoc())
                {
                    echo"<tr><td><a href='viewSingleLecturer.php?id=$row[lecturerID]'>$row[lecturerID]<a/></td><td>$row[title] $row[fname] $row[lname]</td><td>$row[department]</td><td>$row[position]</td><td>";
                    echo "<form action='unretirelecturer.php?id=$row[Retired_LecturerID]' method='POST'><input type ='submit' name='submit' value='unretire lecturer'></form>";
                    echo "</td></tr>";
                }
                echo"</table></span>";
            }
            else
            {
                echo "<p><b>NO RETIRED LECTURER PRESENT</b></p>";
            }
        ?>        
    </body>
</html>