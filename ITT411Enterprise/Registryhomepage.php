<?php 
session_start();
if (isset($_SESSION['registryPersonelle'])) {
 ?>
 
<!DOCTYPE >
<html>
<head>
	<title><?php echo $_SESSION['registryPersonelle'];?>'s Homepage</title>
     <style>
       .menu{
        background-color: #333;
        overflow: hidden;
        }

        .studentDrop, .lecturerDrop, .coursesDrop {
            float: left;
            overflow: hidden;
        }
        
        .studentDrop .studentbtn, .lecturerDrop .lecturerbtn, .coursesDrop .coursebtn
        {
            font-size: 16px;  
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        .active:hover{
            background-color: #ddd;
            color: #333;}


        .studentDropOptions, .lecturerDropOptions, .coursesDropOptions {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 100px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            }

        .studentDropOptions a, .lecturerDropOptions a, .coursesDropOptions a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
            }
            
        .studentDropOptions a:hover, .lecturerDropOptions a:hover,.coursesDropOptions a:hover{
            background-color: #ddd;
        }

        .studentDrop:hover .studentDropOptions, .lecturerDrop:hover .lecturerDropOptions,.coursesDrop:hover .coursesDropOptions, .active:hover {
            display:block;
        }

        .studentDrop:hover .studentbtn, .lecturerDrop:hover .lecturerbtn, .coursesDrop:hover .coursebtn {background-color: black;}

        .active{
            background-color: red;}

            .active{
            color:#f2f2f2;
            float: left;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 16px;
        }
        
     </style>
     <script>
        function viewAllStudents()
        {
            document.getElementById("workspace").innerHTML='<object type="text/html" data="viewAllStudents.php" style="width:100%; height:100%;"></object>'
        }
        function viewAllInactiveStudents()
        {
            document.getElementById("workspace").innerHTML='<object type="text/html" data="viewAllInactiveStudents.php" style="width:100%; height:100%;"></object>'
        }
        function searchStudents()
        {
            document.getElementById("workspace").innerHTML='<object type="text/html" data="searchStudent.php" style="width:100%; height:100%;"></object>'
        }
        function addStudent(){
            document.getElementById("workspace").innerHTML='<object type="text/html" data="addstudent.php" style="width:100%; height:100%;"></object>>'
        }
        function archiveStudent(){
            document.getElementById("workspace").innerHTML='<object type="text/html" data="archiveStudentsearch.php" style="width:100%; height:100%;"></object>>'
        }
        function unarchiveStudent(){
            document.getElementById("workspace").innerHTML='<object type="text/html" data="unarchiveStudentsearch.php" style="width:100%; height:100%;"></object>>'
        }
        function viewAllLecturers(){
            document.getElementById("workspace").innerHTML='<object type="text/html" data="viewAllLecturers.php" style="width:100%; height:100%;"></object>'
        }
        function viewAllInactiveLecturers(){
            document.getElementById("workspace").innerHTML='<object type="text/html" data="viewAllInactiveLecturers.php" style="width:100%; height:100%;"></object>'
        }
        function searchLecturers(){
            document.getElementById("workspace").innerHTML='<object type="text/html" data="searchLecturer.php" style="width:100%; height:100%;"></object>>'
        }
        function viewAllCourses(){
            document.getElementById("workspace").innerHTML='<object type="text/html" data="viewAllCourses.php" style="width:100%; height:100%;"></object>'
        }
        function searchCourses(){
            document.getElementById("workspace").innerHTML='<object type="text/html" data="searchCourse.php" style="width:100%; height:100%;"></object>>'
        }
        function personalinfo(){
            document.getElementById("workspace").innerHTML='<object type="text/html" data="studentpersonal.php" style="width:100%; height:100%;"></object>>'
        }
    </script>
</head>
<body>
    <div class="hpage">
        <h1><a href="Registryhomepage.php" style="text-decoration:none;color:black">Welcome <?php echo $_SESSION['registryPersonelle'];?></a></h1>   
        <div class="menu">
            <div class="studentDrop">
                <button class="studentbtn"> Students </button>
                <div class="studentDropOptions">
                    <a href="javascript:viewAllStudents()"> View Active</a>
                    <a href="javascript:viewAllInactiveStudents()"> View Inactive</a>
                    <a href="javascript:searchStudents()"> Search</a>
                    <a href="javascript:addStudent()"> Add </a>
                    <a href="javascript:archiveStudent()"> Archive </a>
                    <a href="javascript:unarchiveStudent()"> Un-Archive </a>
                </div>
            </div>
            <div class="lecturerDrop">
                <button class="lecturerbtn"> Lecturers </button>
                <div class="lecturerDropOptions">
                    <a href="javascript:viewAllLecturers()"> View Active</a>
                    <a href="javascript:viewAllInactiveLecturers()"> View Inactive</a>
                    <a href="javascript:searchLecturers()"> Search</a>
                </div>
            </div>
            <div class="coursesDrop">
                <button class="coursebtn"> Courses </button>
                <div class="coursesDropOptions">
                    <a href="javascript:viewAllCourses()"> View All</a>
                    <a href="javascript:searchCourses()"> Search</a>
                </div>
            </div>
            <a style="float:right" class="active" href="logoutUser.php">Logout</a>
        </div>          
     </div>

     <div id="workspace"></div>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
?>