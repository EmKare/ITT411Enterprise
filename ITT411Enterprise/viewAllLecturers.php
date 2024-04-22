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
        <h1> View All Active Lecturers</h1>

        <?php
            $query="select * from Lecturers, Active_Lecturers 
            where Active_Lecturers.Active_LecturerID = Lecturers.lecturerID;"; 
            $result=mysqli_query($connection,$query)or die('Error query not working');
            if($result->num_rows>0)
            { 
                echo"<span style='color:black;font-size:25px;'><table id='table1'>"; 
                echo"<tr><th>Lecturer ID</th><th>Full Name</th><th> Department </th><th> Role </th><th>-</th></tr>";
                while($row=$result->fetch_assoc())
                {
                    echo"<tr><td><a href='viewSingleLecturer.php?id=$row[Active_LecturerID]'>$row[Active_LecturerID]<a/></td><td>$row[title] $row[fname] $row[lname]</td><td>$row[department]</td><td>$row[position]</td><td>";
                    echo "<form action='retirelecturer.php?id=$row[Active_LecturerID]' method='POST'><input type ='submit' name='submit' value='retire lecturer'></form>";
                    echo "</td></tr>";                    
                }
                echo"</table></span>";
            }
            else
            {
                echo "<p><b>NO ACTIVE LECTURER PRESENT</b></p>";
            }
        ?>        
    </body>
</html>