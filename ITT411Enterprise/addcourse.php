<?php
	include "connect.php";
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
            <style>
                #table1, th, td 
                {
                    border: 1px solid black;                
                    border-collapse: collapse;
                    padding: 0.5rem;
                }
                h2{
                    font-size: 30px;
                    padding-top: 25px;
                }
                p
                {
                    width: 670px;
                    font-size: 25px;
                    border: 1px solid black;
                    border-radius: 5px;
                    overflow: hidden;
                    padding-left: 10px;
                }
                span
                {
                    font-size: 30px;
                    color:red;
                }
                #name{padding-left: 140px;}
                #status{padding-left: 185px;}
                #studentID{padding-left: 190px;}
                #program{padding-left: 161px;}
                #gpa{padding-left: 200px;}
                #address{padding-left: 162px;}
                #Semail{padding-left: 104px;}
                #Pemail{padding-left: 122px;}
                #Mtele{padding-left: 173px;}
                #Htele{padding-left: 184px;}
                #Wtele{padding-left: 190px;}
                #kin{padding-left: 120px;}
                #kinContact{padding-left: 166px;}
            </style>
    </head>
    <body>
        <?php
        echo $_SESSION['studentID']."- ".$_SESSION['fname']." ".$_SESSION['lname']."<br>GPA: ".$_SESSION['GPA'];

        echo "<h2>Courses</h2>"
        ."<div style='display:inline-flex' >"
        ."<form action='addcourse.php?id=$_GET[id]' method='POST'><input type ='submit' name='submit' value='   add courses  '>"
        ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"          
        ."</form><form action='archivestudent.php?id=$_GET[id]' method='POST'><input type ='submit' name='submit' value='    edit grades   '></form>"
        ."</div><br><br>"
        ."<span style='color:black;font-size:25px;'><table id='table1'>"
        ."<tr><th>Course Code</th><th>Course Title</th><th>Lecturer</th><th>Coursework/60</th><th>Exam Score/40</th><th>Total Score/100</th><th>Grade</th><th>Grade Award</th></tr>";
        while($row=$result->fetch_assoc())
        { 
            echo"<tr><td>$row[coursecode]</td><td>$row[coursetitle]</td><td>$row[title] $row[fname] $row[lname]</td><td>$row[enrolmentCourseWorkGrade]</td><td>$row[enrolmentFinalExamORProjectGrade]</td><td>$row[enrolmentFinalGrade]</td><td>$row[grade]</td><td>$row[award]</td></tr>";
        } 
        echo"</table></span>";

        ?>

    </body>
</html>