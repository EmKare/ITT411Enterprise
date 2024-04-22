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

        function SET_FINAL($studentID)
        {
            $data="update Enrolment set enrolmentFinalGrade = (select sum(enrolmentCourseWorkGrade + enrolmentFinalExamORProjectGrade)) where enrolmentStudentID = $studentID;"; 
            return $data;
        }

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

        function SET_GPA($studentID)
        {
            $data = "update Students set GPA = (select round(sum(qualityPoint * coursecredits) / sum(coursecredits),2) 
            from Grades, Enrolment, Course_Schedule, Courses 
            where gradeScaleHigh >= enrolmentFinalGrade and gradeScaleLow <= enrolmentFinalGrade 
            and Course_Schedule.courseScheduleSection = Enrolment.enrolmentSectionCode 
            and Courses.coursecode = Course_Schedule.courseScheduleCode
            and enrolmentStudentID = $studentID) where studentID = $studentID;";
            return $data;
        }

        function ARCHIVED_OR_NOT()
        {
            $data = "select * from Registered_Students where Registered_studentID = $_GET[id]";
            return $data;
        }
        header("refresh: 10");

        $result=mysqli_query($connection,QUERY()) or die('Error query not working');
        if($result->num_rows>0)
        {
            //echo $result->num_rows." - ";
            $setFinal=mysqli_query($connection,SET_FINAL($_GET['id']))or die('Error query not working');
            if($setFinal)
            {
                //echo $setFinal." - ";
                $setGPA=mysqli_query($connection,SET_GPA($_GET['id']))or die('Error query not working');
                if($setGPA)
                {
                    //echo $setGPA." - ";
                }
            }
        }
        else
        {
            $setFinal=mysqli_query($connection,SET_FINAL($_GET['id']))or die('Error query not working');
            if($setFinal)
            {
                //echo $setFinal." - ";
                $setGPA=mysqli_query($connection,SET_GPA($_GET['id']))or die('Error query not working');
                if($setGPA)
                { 
                    //echo $setGPA." - ";
                    $result=mysqli_query($connection,QUERY()) or die('Error query not working');
                    if($result->num_rows>0)
                    {
                        //echo $result->num_rows." - ";
                        $setFinal=mysqli_query($connection,SET_FINAL($_GET['id']))or die('Error query not working');
                        if($setFinal)
                        {
                            //echo $setFinal." - ";
                            $setGPA=mysqli_query($connection,SET_GPA($_GET['id']))or die('Error query not working');
                            if($setGPA)
                            { 
                                //echo $setGPA; 
                            }
                        }
                    }
                }
            }
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
                
                if($result->num_rows>0)
                {
                    $_SESSION['GPA'] = $row['GPA'];
                }
                else
                {
                    $_SESSION['GPA'] = number_format("0",2);
                }
                $setStatus = mysqli_query($connection,ARCHIVED_OR_NOT())or die('Error query not working');
                if($setStatus->num_rows>0)
                {
                    $_SESSION['status'] = "Active";
                }
                else
                {
                    $_SESSION['status'] = "Inactive";
                }
            }
        }
        $result=mysqli_query($connection,QUERY()) or die('Error query not working');
        if($result->num_rows>0) 
        {
    ?>
            <div>
                <h1>Student Profile</h1>
                <p>Full Name: <span id="name"><?php echo $_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname']; ?></span></p>
                <p>Status: <span id="status"><?php echo $_SESSION['status']; ?></span></p>
                <p>ID no: <span id="studentID"><?php echo $_SESSION['studentID']; ?></span></p>   
                <p>Program: <span id="program"><?php echo $_SESSION['program']; ?></span></p>
                <p>GPA: <span id="gpa"><?php echo $_SESSION['GPA']; ?></span></p>        
            </div>            
    <?php 
            echo "<h2>Courses</h2>";
            $buttonresult=mysqli_query($connection,ARCHIVED_OR_NOT())or die('Error query not working');
            if($buttonresult->num_rows>0)
            {
                echo "<div style='display:inline-flex' >"
                ."<form action='addcourse.php?id=$_GET[id]' method='POST'><input type ='submit' name='submit' value='   add courses  '></form>"
                ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"          
                ."<form action='removecourse.php?id=$_GET[id]' method='POST'><input type ='submit' name='submit' value='   remove course  '></form>"
                ."</div><br><br>";
            }
            echo "<span style='color:black;font-size:25px;'><table id='table1'>"
            ."<tr><th>Course Code</th><th>Course Title</th><th>Lecturer</th><th>Coursework/60</th><th>Exam Score/40</th><th>Total Score/100</th><th>Grade</th><th>Grade Award</th><th>-</th></tr>";
            while($row=$result->fetch_assoc())
            { 
                echo"<tr><td><a href='viewSingleCourse.php?id=$row[courseScheduleCode]'>"
                ."$row[coursecode]</a></td><td>$row[coursetitle]</td>"
                ."<td><a href='viewSingleLecturer.php?id=$row[courseScheduleLecturerID]'>$row[title] $row[fname] $row[lname]</a></td>"
                ."<td>$row[enrolmentCourseWorkGrade]</td>"
                ."<td>$row[enrolmentFinalExamORProjectGrade]</td>"
                ."<td>$row[enrolmentFinalGrade]</td><td>$row[grade]</td>"
                ."<td>$row[award]</td><td><a href='editgrades.php?id=$row[enrolmentNo]'>update</a></td></tr>";
                $_SESSION['studentID'] = $_GET['id'];
            } 
            echo"</table></span>";
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
            if($result->num_rows>0)
            {
                echo "<form action='archivestudent.php?id=$_GET[id]' method='POST'><input type ='submit' name='submit' value='archive student'></form>";
            }
            else
            {
                echo "<form action='unarchivestudent.php?id=$_GET[id]' method='POST'><input type ='submit' name='submit' value='unarchive student'></form>";
            }
        }
//-------------------------------------------------------------------------------------------------------------------------------
        else
        {
            
    ?>
            <div>
                <h1>Student Profile</h1>
                <p>Full Name: <span id="name"><?php echo $_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname']; ?></span></p>
                <p>Status: <span id="status"><?php echo $_SESSION['status']; ?></span></p>
                <p>ID no: <span id="studentID"><?php echo $_SESSION['studentID']; ?></span></p>   
                <p>Program: <span id="program"><?php echo $_SESSION['program']; ?></span></p>
                <p>GPA: <span id="gpa"><?php echo $_SESSION['GPA']; ?></span></p>        
            </div>
            <h2>Courses</h2>
    <?php 
            echo "<div style='display:inline-flex' >"
            ."<form action='addcourse.php?id=$_GET[id]' method='POST'><input type ='submit' name='submit' value='   add courses  '></form>"
            ."</div><br><br>"
            ."<span style='color:black;font-size:25px;'><table id='table1'>
            <tr><th>Course Code</th><th>Course</th><th>Lecturer</th><th>Coursework/60</th><th>Exam Score/40</th><th>Total Score/100</th><th>Grade</th><th>Grade Award</th></tr>
            <tr style='text-align:center;color:red'><td colspan='8'><b>".strtoupper($_SESSION['fname'])." ".strtoupper($_SESSION['lname'])." HAS NOT SELECTED ANY COUSES AS YET</b></td></tr></table></span>";
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
            if($result->num_rows>0)
            {
                echo "<form action='archivestudent.php?id=$_GET[id]' method='POST'><input type ='submit' name='submit' value='archive student'></form>";
            }
            else
            {
                echo "<form action='unarchivestudent.php?id=$_GET[id]' method='POST'><input type ='submit' name='submit' value='unarchive student'></form>";
            }
        }
    ?>     
    </body>
</html>