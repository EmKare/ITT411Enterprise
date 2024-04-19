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
                #lecturerID{padding-left: 190px;}
                #department{padding-left: 129px;}
                #position{padding-left: 200px;}
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

        $setQuery="select * from Lecturers where lecturerID = $_GET[id] ;";
        $setQueryResult = mysqli_query($connection,$setQuery)or die('Error query not working');
        if($setQueryResult->num_rows>0)
        {
            while($row=$setQueryResult->fetch_assoc())
            {
                $_SESSION['lecturerID'] = $row['lecturerID'];
                $_SESSION['title'] = $row['title'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['lname'] = $row['lname'];
                $_SESSION['department'] = $row['department'];
                $_SESSION['position'] = $row['position'];
            }
        }
        $viewquery="select * from Lecturers, Course_Schedule, Courses where Course_Schedule.courseScheduleLecturerID = Lecturers.lecturerID and Courses.coursecode = Course_Schedule.courseScheduleCode and courseScheduleLecturerID = $_GET[id]";
        $result=mysqli_query($connection,$viewquery)or die('Error query not working');
        if($result->num_rows>0) 
        { 
    ?>
            <div>
                <h1>Student Profile</h1>
                <p>Full Name: <span id="name"><?php echo $_SESSION['title']." ".$_SESSION['fname']." ".$_SESSION['lname']; ?></span></p>
                <p>ID no: <span id="lecturerID"><?php echo $_SESSION['lecturerID']; ?></span></p>   
                <p>Department: <span id="department"><?php echo $_SESSION['department']; ?></span></p>
                <p>Role: <span id="position"><?php echo $_SESSION['position']; ?></span></p>        
            </div>
            <h2>Courses</h2>
    <?php
            echo"<table id='table1'>";
            echo"<tr><th>Course Code</th><th>Course Title</th><th>Semester</th><th>Year</th><th>Day</th><th>Time</th><th>Location</th></tr>";
            while($row=$result->fetch_assoc())
            { 
                $dotw = DOTW($row['courseScheduleDay']);
                $year = YEAR($row['courseScheduleYear']);
                $semester = SEMESTER($row['courseScheduleSemester']);
                $tod = TOD($row['courseScheduleTime']);
                echo"<tr><td>$row[courseScheduleCode]</td><td>$row[coursetitle]</td><td>$semester</td><td>$year</td><td>$dotw</td><td>$tod</td><td>$row[courseScheduleLocation]</td></tr>";
            } 
            echo"</table>";
        }
    ?>     
    </body>
</html>