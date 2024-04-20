<?php
	
    include "connect.php";
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h1>Search Lecturers</h1>
    <?php
        $findquery="select * from Lecturers where lecturerID='$_POST[search]'";
        $result=mysqli_query($connection,$findquery)or die('Error query not working');
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            { 
                $_SESSION['lecturerID'] = $row['lecturerID'];
            }
            header("Location: viewSingleLecturer.php?id=$_SESSION[lecturerID]");
        }
        else
        {
            echo "LECTURER ".$_POST['search']." DOES NOT EXIST";
        }
    ?>        
    </body>
</html>