<?php 

session_start(); 
include "connect.php";

    $coursework = 0;
    $exam = 0;

    if(empty($_POST['coursework']))
    {
        $coursework = $_GET['coursework'];
    }
    else
    {
        $coursework = $_POST['coursework'];
    }
    if(empty($_POST['exam']))
    {
        $exam = $_GET['exam'];
    }
    else
    {
        $exam = $_POST['exam'];
    }

    $updateQuery = "update Enrolment set enrolmentCourseWorkGrade = $coursework, enrolmentFinalExamORProjectGrade = $exam 
    where enrolmentNo = $_GET[id]";
    $result=mysqli_query($connection,$updateQuery) or die('Error query not working');
    if($result)
    {
        header("Refresh: 1; url=viewSingleStudent.php?id=$_SESSION[studentID]");
        header("location:viewSingleStudent.php?id=$_SESSION[studentID]"); 
    }
?> 