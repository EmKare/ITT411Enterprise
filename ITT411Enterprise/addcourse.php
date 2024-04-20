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

        function DOTW($data)
        {
            if($data === 1){return "Monday";}
            if($data == 2){return "Tuesday";}
            if($data == 3){return "Wednesday";}
            if($data == 4){return "Thursday";}
            if($data == 5){return "Friday";}
            if($data == 6){return "Saturday";}
            if($data == 7){return "Sunday";}
        }

        function YEAR($data)
        {
            if($data == 1){return "1st";}
            if($data == 2){return "2nd";}
            if($data == 3){return "3rd";}
            if($data == 4){return "4th";}
        }

        function SEMESTER($data)
        {
            if($data == 1){return "1st";}
            if($data == 2){return "2nd";}
            if($data == 3){return "3rd";}
            if($data == 4){return "4th";}
        }

        function TOD($data)
        {
            if($data > 12){return strval($data - 12) . ":00 PM";}
            else if ($data == 12){return strval($data) . ":00 PM";}
            else{return strval($data) . ":00 AM";}
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
            ."<tr><th>Course Code</th><th>Course Title</th><th>Lecturer</th><th>Grade</th><th>Grade Award</th></tr>";
            while($row=$result->fetch_assoc())
            { 
                echo"<tr><td>$row[coursecode]</td><td>$row[coursetitle]</td><td>$row[title] $row[fname] $row[lname]</td><td>$row[grade]</td><td>$row[award]</td></tr>";
            }
            echo"</table></span>";
        }
        echo "<br><br><br><br>";
        $getcourses = "select enrolmentSectioncode, courseScheduleCode 
        from Students,Enrolment, Courses, Course_Schedule 
        where Enrolment.enrolmentStudentID = Students.studentID 
        and Course_Schedule.courseScheduleCode = Courses.coursecode 
        and Enrolment.enrolmentSectionCode = Course_Schedule.courseScheduleSection 
        and studentID = $_GET[id];";
        $getcoursesinfo = mysqli_query($connection,$getcourses)or die('Error query not working');
        if($getcoursesinfo->num_rows>0)
        {
            while($row=$getcoursesinfo->fetch_assoc())
            {
                $sectionsArray[] = $row['enrolmentSectioncode']; 
                $courseCodeArray[] = $row['courseScheduleCode'];
            }
        }
        else
        {} 
        $querystring  = "";
        if(sizeof($sectionsArray) > 0)  
        {
            foreach ($sectionsArray as $section)
            {
                $querystring = $querystring." and courseScheduleSection != ";
                $querystring =  $querystring.$section;
            }
        }  
        if(sizeof($courseCodeArray) > 0)  
        {
            foreach ($courseCodeArray as $coursecode)
            {
                $querystring = $querystring." and courseScheduleCode != '";
                $querystring =  $querystring.$coursecode."'";
            }
            //$querystring = preg_replace('/\W\w+\s*(\W*)$/', '$1', $querystring);
        }         
        $otherCourses = "select * from Course_Schedule, Courses, Lecturers 
        where Course_Schedule.courseScheduleCode = Courses.coursecode
        and Course_Schedule.courseScheduleLecturerID = Lecturers.lecturerID".$querystring;
        //echo $otherCourses;
        $result=mysqli_query($connection,$otherCourses)or die('Error query not working');
        if($result->num_rows>0) 
        { 
            echo "<span style='color:black;font-size:25px;'>".
            "<table id='table1'>"
            ."<tr><th>Course Code</th><th>Course Title</th><th>Credit</th><th>Level</th><th>Semester</th><th>Year</th><th>DOTW</th><th>Time</th><th>Location</th><th>Lecturer</th><th>-</th></tr>";
            while($row=$result->fetch_assoc())
            {   
                $dotw = DOTW($row['courseScheduleDay']);
                $year = YEAR($row['courseScheduleYear']);
                $semester = SEMESTER($row['courseScheduleSemester']);
                $tod = TOD($row['courseScheduleTime']);
                echo"<tr><td>$row[coursecode]</td><td>$row[coursetitle]</td><td>$row[coursecredits]</td>
                <td>$row[coursedegreelevel]</td><td>$semester</td><td>$year</td>
                <td>$dotw</td><td>$tod</td><td>$row[courseScheduleLocation]</td>
                <td>$row[title] $row[fname] $row[lname]</td><td><a href='addcourseToStudent.php?id=$row[courseScheduleSection]'>Add Course</a></td></tr>";
                $_SESSION['studentID'] = $_GET['id'];
            }
            echo"</table></span>";
        }
        ?>

    </body>
</html>