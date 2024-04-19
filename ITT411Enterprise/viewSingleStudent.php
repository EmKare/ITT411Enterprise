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

        function ARCHIVED_OR_NOT()
        {
            $data = "select * from Registered_Students where Registered_studentID = $_GET[id]";
            return $data;
        }


        $setQuery="select * from Students where studentID = $_GET[id] ;";
        $setQueryResult = mysqli_query($connection,$setQuery)or die('Error query not working');
        if($setQueryResult->num_rows>0)
        {
            while($row=$setQueryResult->fetch_assoc())
            {
                $_SESSION['studentID'] = $row['studentID'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['mname'] = $row['mname'];
                $_SESSION['lname'] = $row['lname'];
                $_SESSION['Semail'] = $row['Semail'];
                $_SESSION['Pemail'] = $row['Pemail'];
                $_SESSION['address'] = $row['address'];
                $_SESSION['Mtele'] = $row['Mtele'];
                $_SESSION['Htele'] = $row['Htele'];
                $_SESSION['Wtele'] = $row['Wtele'];
                $_SESSION['nextOfKin'] = $row['nextOfKin'];
                $_SESSION['nextOfKinContact'] = $row['nextOfKinContact'];
                $_SESSION['program'] = $row['program'];
                $_SESSION['GPA'] = $row['GPA'];
            }
        }

        $result=mysqli_query($connection,QUERY()) or die('Error query not working');

        if($result->num_rows<1)
        {
            $setFinalGrade="update Enrolment set enrolmentFinalGrade = (select sum(enrolmentCourseWorkGrade + enrolmentFinalExamORProjectGrade)) where enrolmentStudentID = $_SESSION[studentID];";
            $result=mysqli_query($connection,$setFinalGrade)or die('Error query not working');
            $result=mysqli_query($connection,QUERY())or die('Error query not working');
        }  

        if($result->num_rows>0) 
        {
    ?>
            <div>
                <h1>Student Profile</h1>
                <p>Full Name: <span id="name"><?php echo $_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname']; ?></span></p>
                <p>ID no: <span id="studentID"><?php echo $_SESSION['studentID']; ?></span></p>   
                <p>Program: <span id="program"><?php echo $_SESSION['program']; ?></span></p>
                <p>GPA: <span id="gpa"><?php echo $_SESSION['GPA']; ?></span></p>        
            </div>
            <h2>Courses</h2>
    <?php 
            echo"<table id='table1'>";
            echo"<tr><th>Course Code</th><th>Course</th><th>Lecturer</th><th>Coursework/60</th><th>Exam Score/40</th><th>Total Score/100</th><th>Grade</th><th>Grade Award</th></tr>";
            while($row=$result->fetch_assoc())
            { 
                echo"<tr><td>$row[coursecode]</td><td>$row[coursetitle]</td><td>$row[title] $row[fname] $row[lname]</td><td>$row[enrolmentCourseWorkGrade]</td><td>$row[enrolmentFinalExamORProjectGrade]</td><td>$row[enrolmentFinalGrade]</td><td>$row[grade]</td><td>$row[award]</td></tr>";
            } 
            echo"</table>";
    ?>  
            <h2>Contact</h2>
            <div>
                <p>Address: <span id="address"><?php echo $_SESSION['address']; ?></span></p> 
                <p>Student Email: <span id="Semail"><?php echo $_SESSION['Semail']; ?></span></p> 
                <p>Other Email: <span id="Pemail"><?php echo $_SESSION['Pemail']; ?></span></p>
                <p>Mobile: <span id="Mtele"><?php echo $_SESSION['Mtele']; ?></span></p> 
                <p>Home: <span id="Htele"><?php echo $_SESSION['Htele']; ?></span></p> 
                <p>Work: <span id="Wtele"><?php echo $_SESSION['Wtele']; ?></span></p>  
                <p>Next Of Kin: <span id="kin"><?php echo $_SESSION['nextOfKin']; ?></span></p> 
                <p>Contact: <span id="kinContact"><?php echo $_SESSION['nextOfKinContact']; ?></span></p> 
            </div>
    <?php
            $result=mysqli_query($connection,ARCHIVED_OR_NOT())or die('Error query not working');
            if($result)
            {
                ?>
                    <form action="archivestudent.php" method="POST"><input type ="submit" name="submit" value="archive student"></form>
                <?php
            }
            else
            {
                ?>
                    <form action="unarchivestudent.php" method="POST"><input type ="submit" name="submit" value="unarchive student"></form>
                <?php
            }
        }
//-------------------------------------------------------------------------------------------------------------------------------
        else
        {
            
    ?>
            <div>
                <h1>Student Profile</h1>
                <p>Full Name: <span id="name"><?php echo $_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname']; ?></span></p>
                <p>ID no: <span id="studentID"><?php echo $_SESSION['studentID']; ?></span></p>   
                <p>Program: <span id="program"><?php echo $_SESSION['program']; ?></span></p>
                <p>GPA: <span id="gpa"><?php echo $_SESSION['GPA']; ?></span></p>        
            </div>
            <h2>Courses</h2>
    <?php 
            echo"<table id='table1'>
            <tr><th>Course Code</th><th>Course</th><th>Lecturer</th><th>Coursework/60</th><th>Exam Score/40</th><th>Total Score/100</th><th>Grade</th><th>Grade Award</th></tr>
            <tr style='text-align:center;color:red'><td colspan='8'><b>".strtoupper($_SESSION['fname'])." ".strtoupper($_SESSION['lname'])." HAS NOT SELECTED ANY COUSES AS YET</b></td></tr></table>";
    ?>  
            <h2>Contact</h2>
            <div>
                <p>Address: <span id="address"><?php echo $_SESSION['address']; ?></span></p> 
                <p>Student Email: <span id="Semail"><?php echo $_SESSION['Semail']; ?></span></p> 
                <p>Other Email: <span id="Pemail"><?php echo $_SESSION['Pemail']; ?></span></p>
                <p>Mobile: <span id="Mtele"><?php echo $_SESSION['Mtele']; ?></span></p> 
                <p>Home: <span id="Htele"><?php echo $_SESSION['Htele']; ?></span></p> 
                <p>Work: <span id="Wtele"><?php echo $_SESSION['Wtele']; ?></span></p>  
                <p>Next Of Kin: <span id="kin"><?php echo $_SESSION['nextOfKin']; ?></span></p> 
                <p>Contact: <span id="kinContact"><?php echo $_SESSION['nextOfKinContact']; ?></span></p> 
            </div>
    <?php
            $result=mysqli_query($connection,ARCHIVED_OR_NOT())or die('Error query not working');
            if($result)
            {
                ?>
                    <form action="archivestudent.php" method="POST"><input type ="submit" name="submit" value="archive student"></form>
                <?php
            }
            else
            {
                ?>
                    <form action="unarchivestudent.php" method="POST"><input type ="submit" name="submit" value="unarchive student"></form>
                <?php
            }
        }
    ?>     
    </body>
</html>