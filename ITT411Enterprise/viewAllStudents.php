<?php
	include "connect.php";
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View All Active Students</title>
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
        <h1> View All Active Students</h1>

        <?php
            $query="select * from Students, Registered_Students 
            where Registered_Students.Registered_studentID = Students.studentID"; 
            $result=mysqli_query($connection,$query)or die('Error query not working');
            if($result->num_rows>0)
            { 
                echo"<table id='table1'>";
                echo"<tr><th>Student ID</th><th>Full Name</th><th>Student Email</th><th>Address</th><th> Mobile </th><th> Home </th><th> Work </th><th>Program</th><th>-</th></tr>";
                while($row=$result->fetch_assoc())
                { 
                    echo"<tr><td><a href='viewSingleStudent.php?id=$row[studentID]'>$row[studentID]<a/></td><td>$row[fname] $row[mname] $row[lname]</td><td>$row[Semail]</td><td>$row[address]</td><td>$row[Mtele]</td><td>$row[Htele]</td><td>$row[Wtele]</td><td>$row[program]</td><td>";?>
                    <form action="archivestudent.php" method="POST"><input type ="submit" name="submit" value="archive student"></form>
                    <?php echo "</td></tr>";
                    $_SESSION['studentID'] = $row['studentID'];
                }
                echo"</table";
            }
        ?>
        
    </body>
</html>