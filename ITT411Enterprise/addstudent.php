<!DOCTYPE html>
<?php
    session_start();
    include "connect.php";
?>
<html lang="en" dir="ltr">
    <head>        
        <meta charset="utf-8">
        <title>Add new Student</title>
       <style>
        .txt_field{font-size: 21px;}
        input[type="submit"],input[type="reset"]{border-radius: 10px;padding:3px 5px;margin-top: 5px;margin-bottom: 5px;margin-left: 10px;}
        input[type="text"],input[type="tel"]{border-radius: 20px;padding: 4px 5px;margin-bottom: 5px;margin-left: 10px;}
        input[type="date"]{border-radius: 20px;padding: 4px 5px;margin-bottom: 5px;}
        span{margin-left: 10px;padding-top: 3px;}
        .select{border-radius: 20px;padding: 4px 5px;margin-bottom: 5px;margin-left: 10px;}
       </style>
    </head>
    <body>
        <div class="center">
        <h1>Add New Student</h1>

        <form action="addStudentSave.php" method="POST">
            <div class="txt_field">

              <input type="text" name="fname" placeholder="First Name(s)"><br> 
              <input type="text" name="mname" placeholder="Middle Name(s)"><br> 
              <input type="text" name="lname" placeholder="Surname(s)"><br>

              <select class="select" name="program" id="year_code" required>
                  <option value="Psychology">Psychology</option>
                  <option value="Mathematics">Mathematics</option>
                  <option value="Law">Law</option>
                </select><br>

              <h3> Contact Details </h3>
              <input type="text" name="pemail" placeholder="Personal Email"><br>     

              <input type="text" name="address" placeholder="Address"><br>                
                
              <input type="tel" name="mtele" placeholder="Mobile Number"><br>
              <input type="tel" name="htele" placeholder="Home Number"><br>
              <input type="tel" name="wtele" placeholder="Work Number"><br>

              <h3> Next Of Kin Details </h3>
              <input type="text" name="nextofkin" placeholder="Next Of Kin"><br>
              <input type="text" name="nextofkincontact" placeholder="Kin number"><br>
              
            </div>
            <div>
              <input type="submit" name="submit" value="submit"/>
              <input type="reset" value="reset"/>
            </div>
              
          <?php
              if($_SESSION["status"]=="save")
                  echo "<br> Record added successfully!";
              else if ($_SESSION["status"] =="unsuccessful")
                  echo "<br> Record not added!";           
          ?>
          <br><br>
        </form>
        </div>
    </body>
</html>