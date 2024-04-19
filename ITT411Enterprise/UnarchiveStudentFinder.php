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
        $findquery="select * from Archived_Students where Archived_studentID = '$_POST[unarchivesearch]'";
        $result=mysqli_query($connection,$findquery)or die('Error query not working');
        if($result->num_rows>0)
        {
            header("Location: viewSingleStudent.php?id='$_POST[unarchivesearch]'");
        }
        else
        {
            echo "<p style='color:red'><b>STUDENT ".$_POST['unarchivesearch']." IS AN ACTIVE STUDENT  </b></p>";
        }
    ?>        
    </body>
</html>