<?php
	include "connect.php";
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h1>Search Students</h1>
    <?php
        $findquery="select * from Registered_Students where Registered_studentID = '$_POST[archivesearch]'";
        $result=mysqli_query($connection,$findquery)or die('Error query not working');
        if($result->num_rows>0)
        {
            header("Location: viewSingleStudent.php?id='$_POST[archivesearch]'");
        }
        else
        {
            echo "<p style='color:red'><b>STUDENT ".$_POST['archivesearch']." NOT FOUND IN ACTIVE STUDENTS LIST </b></p>";
        }
    ?>        
    </body>
</html>