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

        $setQuery="select * from Courses where coursecode = '$_GET[id]';";
        $setQueryResult = mysqli_query($connection,$setQuery)or die('Error query not working');
        $preReqCodeArray = array();
        $preReqTitleArray = array();
        if($setQueryResult->num_rows>0)
        {
            while($row=$setQueryResult->fetch_assoc())
            {
                $_SESSION['coursecode'] = $row['coursecode'];
                $_SESSION['coursetitle'] = $row['coursetitle'];
                $_SESSION['coursecredits'] = $row['coursecredits'];
                $_SESSION['coursedegreelevel'] = $row['coursedegreelevel'];
            }
            $prereq = "select prerequisite, (select Courses.coursetitle from Courses where Prerequisites.prerequisite = Courses.coursecode) 
            as 'Title' from Courses, Prerequisites where Prerequisites.coursecode = Courses.coursecode and Prerequisites.coursecode = '$_GET[id]'";
            $getprereq = mysqli_query($connection,$prereq)or die('Error query not working');
            if($getprereq->num_rows>0)
            {
                while($row=$getprereq->fetch_assoc())
                {
                    $preReqCodeArray[] = $row['prerequisite']; 
                    $preReqTitleArray[] = $row['Title'];
                }
            }
            else
            {}               
        }
        $viewquery="select * from Courses, Course_Schedule, Lecturers
        where Course_Schedule.courseScheduleCode = Courses.coursecode 
        and Lecturers.lecturerID = Course_Schedule.courseScheduleLecturerID
        and courseScheduleCode = '$_GET[id]'";
        $result=mysqli_query($connection,$viewquery)or die('Error query not working');
        if($result->num_rows>0) 
        { 
    ?>      <h1><?php echo  $_SESSION['coursecode'].": ".$_SESSION['coursetitle']; ?></h1>
            <div>Description here</div>
            <h2>Prerequisites</h2>
    <?php 
            if(sizeof($preReqCodeArray) > 0)
            {
                echo"<table id='table1'>";
                echo"<tr><th>Course Code</th><th>Course Title</th></tr>";
                $x = 0;
                foreach ($preReqCodeArray as $coursecode)
                {
                    echo"<tr><td>";echo $coursecode."</td><td>".$preReqTitleArray[$x]."</td></tr>";
                    $x += 1;
                }
                echo"</table>";
            }
            else
            {
                echo "NO PREREQUISITES REQUIRED";
            }
    ?>      <h2>Sections</h2>            
    <?php 
            echo"<table id='table1'>";
            echo"<tr><th>Day</th><th>Time</th><th>Classroom</th><th>Lecturer</th></tr>";
            while($row=$result->fetch_assoc())
            { 
                $dotw = DOTW($row['courseScheduleDay']);
                $year = YEAR($row['courseScheduleYear']);
                $semester = SEMESTER($row['courseScheduleSemester']);
                $tod = TOD($row['courseScheduleTime']);
                echo"<tr><td>$dotw</td><td>$tod</td><td>$row[courseScheduleLocation]</td><td>$row[title] $row[fname] $row[lname]</td></tr>";
            } 
            echo"</table>";
        }
    ?>        
    </body>
</html>