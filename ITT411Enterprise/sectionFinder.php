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
        $coursecode = strtoupper($_POST['search']);
        $findquery="select * from Courses where coursecode='$coursecode'"; 
        $result=mysqli_query($connection,$findquery)or die('Error query not working');
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            { 
                $_SESSION['coursecode'] = $row['coursecode'];
            }         
            header("Location: viewSingleCourse.php?id=$_SESSION[coursecode]");
        }
        else
        {
            echo "NO SUCH COURSE FOUND IN DATABASE";
        }
    ?>        
    </body>
</html>