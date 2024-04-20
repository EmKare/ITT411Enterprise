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
            and enrolmentNo = $_GET[id]";
            return $data;
        }

        echo $_SESSION['studentID']."- ".$_SESSION['fname']." ".$_SESSION['lname']."<br>GPA: ".$_SESSION['GPA'];
        $sectionsArray = array();
        $courseCodeArray = array();

        $result=mysqli_query($connection,QUERY()) or die('Error query not working');
        if($result->num_rows>0) 
        {
            echo "<h2>$_SESSION[studentID]'s Courses</h2>"
            ."<span style='color:black;font-size:25px;'>"
            ."<table id='table1'>"
            ."<tr><th>Course Code</th><th>Course Title</th><th>Lecturer</th><th>Coursework/60</th><th>Exam Score/40</th><th>-</th></tr>";
            while($row=$result->fetch_assoc())
            {
                echo"<tr><td>$row[coursecode]</td><td>$row[coursetitle]</td><td>$row[title] $row[fname] $row[lname]</td>"
                ."<td><form action='updateGrades.php?id=$_GET[id]&coursework=$row[enrolmentCourseWorkGrade]&exam=$row[enrolmentFinalExamORProjectGrade]' method='POST'><input type='number' name='coursework' min='0' max='60' step='.01' placeholder='$row[enrolmentCourseWorkGrade]'></td>"
                ."<td><input type='number' name='exam' min='0' max='40' step='.01' placeholder='$row[enrolmentFinalExamORProjectGrade]'></td>";
                $_SESSION['enrolmentNo'] = $_GET['id'];
                $_SESSION['enrolmentSectionCode'] = $row['enrolmentSectionCode'];
                $_SESSION['enrolmentCourseWorkGrade'] = $row['enrolmentCourseWorkGrade'];
                $_SESSION['enrolmentFinalExamORProjectGrade'] = $row['enrolmentFinalExamORProjectGrade'];
            }
            echo "<td>"
            ."<input type ='submit' name='submit' value='update grades'></form></td>"
            ."</tr></table></span>";
        }
        else
        {
            echo "NO COURSE GRADES TO EDIT";
        }
        
        ?>

    </body>
</html>