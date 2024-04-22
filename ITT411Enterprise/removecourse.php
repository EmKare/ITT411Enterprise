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

        function QUERY()
        {
            $data="select * from Students, Grades, Enrolment, Course_Schedule, Courses, Lecturers 
            where gradeScaleHigh >= enrolmentFinalGrade 
            and gradeScaleLow <= enrolmentFinalGrade 
            and Enrolment.enrolmentStudentID = Students.studentID 
            and Enrolment.enrolmentSectionCode = Course_Schedule.courseScheduleSection 
            and Course_Schedule.courseScheduleCode = Courses.coursecode 
            and Lecturers.lecturerID = Course_Schedule.courseScheduleLecturerID 
            and enrolmentStudentID = $_GET[id]";
            return $data;
        }

        echo "<h1>".$_SESSION['studentID']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        ."GPA: ".$_SESSION['GPA']."</h1>";
        $sectionsArray = array();
        $courseCodeArray = array();
        $result=mysqli_query($connection,QUERY()) or die('Error query not working');
        if($result->num_rows>0) 
        {
            echo "<h2>Courses for $_SESSION[fname] $_SESSION[lname]</h2>"
            ."<span style='color:black;font-size:25px;'>"
            ."<table id='table1'>"
            ."<tr><th>Course Code</th><th>Course Title</th><th>Lecturer</th><th>Grade</th><th>Grade Award</th><th>-</th></tr>";
            while($row=$result->fetch_assoc())
            { 
                echo"<tr><td>$row[coursecode]</td><td>$row[coursetitle]</td><td>$row[title] $row[fname] $row[lname]</td><td>$row[grade]</td><td>$row[award]</td><td>"
                ."<a href='removecourseFromStudent.php?id=$row[enrolmentNo]'>Remove Course</a>"            
                ."</td></tr>";
                $_SESSION['studentID'] = $_GET['id'];
            }
            echo"</table></span>";
        }
        else
        {
            echo "NO COURSES TO REMOVE";
        }
        ?>

    </body>
</html>