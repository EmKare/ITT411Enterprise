<!DOCTYPE html>
<?php
    include "connect.php";
    session_start();
?>
<html lang="en" dir="ltr">
    <head>        
        <meta charset="utf-8">
        <title>Search</title>
       <link rel="sty lesheet" href="style.css">
       <style>
            #search{border-radius: 8px;padding: 5px 6px;margin: 4px 0}
            P{font-size: 21px;}
            input[type="submit"]{border-radius: 10px;padding:3px 5px;margin-top: 5px;}
       </style>
    </head>
    <body>
        <div class="center">

        <h1>Search Students</h1>
            <form action="ArchiveStudentFinder.php" method="POST">
                <div>
                    <p>Search by Student ID</p>
                    <input type="text" name="archivesearch" id="search" value="" placeholder="Search..." required> 
                </div>              
                    <div>
                    <input type ="submit" name="submit" value="Search"/>
                </div><br><br>
            </form>
        </div>
    </body>
</html>