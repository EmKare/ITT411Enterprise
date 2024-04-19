<?php 

session_start(); 
include "connect.php";

if (isset($_POST['username']) && isset($_POST['uPassword'])) 
{
	function validate($data)
    {
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
    }

    $UserName = validate($_POST['username']);
    $PassWord = validate($_POST['uPassword']);

    if(empty($UserName)) {
		header("Location: registryLogin.php?error=Username is required");
	    exit();
	}else if(empty($PassWord)){
        header("Location: registryLogin.php?error=Password is required");
	    exit();
	}else{
		$login = "SELECT * from Registry_Login where registryUsername='$UserName' AND registryPassword='$PassWord'";
        $result = mysqli_query($connection, $login);
        if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['registryUsername'] === $UserName  && $row['registryPassword'] === $PassWord ) {
                $_SESSION['registryPersonelle'] = $row['registryPersonelle'];
            	header("Location: Registryhomepage.php");
		        exit();
            }else{
				header("Location: registryLogin.php?error=Incorrect Username or Password");
		        exit();
			}
		}else{
			header("Location: registryLogin.php?error=Incorrect Username or Password");
	        exit();
		}
	}
}
else
{
	header("Location: registryLogin.php");
	exit();
}
?>