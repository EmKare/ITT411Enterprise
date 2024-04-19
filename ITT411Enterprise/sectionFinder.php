<?php
	include "connect.php";
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h1>Search Courses </h1>
    <?php
        $findquery="select * from Courses where coursecode='strtoupper($coursecode)'";
        $result=mysqli_query($connection,$findquery)or die('Error query not working');
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            { 
                $_SESSION['coursecode'] = $row['coursecode'];
            }
        } 
        header("Location: viewSingleCourse.php?id=$_SESSION[coursecode]");
    ?>        
    </body>
</html>