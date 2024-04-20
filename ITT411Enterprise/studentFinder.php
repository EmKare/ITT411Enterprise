<?php
	include "connect.php";
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h1>Search Students </h1>
    <?php
        $findquery="select * from Students where studentID='$_POST[search]'";
        $result=mysqli_query($connection,$findquery)or die('Error query not working');
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            { 
                $_SESSION['studentID'] = $row['studentID'];
            }
            header("Location: viewSingleStudent.php?id=$_SESSION[studentID]");
        }
        else
        {
            echo "STUDENT ".$_POST['search']." DOES NOT EXIST";
        }
    ?>        
    </body>
</html>