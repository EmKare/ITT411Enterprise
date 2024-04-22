<!DOCTYPE html>
<?php    
    session_start();
?>
<html>
    <head>
        <title>Registry Login</title>
        <style>
            body
            {
                margin: 0;
                padding: 0;
                font-family: sans-serif;   
                background-color: grey;
            }
            .loginbox
            {
                width: 320px;
                height: 420px;
                background: #c4ffe3;         
                top: 50%;
                left: 50%;
                position: absolute;
                transform: translate(-50%, -50%);
                box-sizing: border-box;  
                padding: 70px 30px;
                border-radius: 20px;
            }
            h1
            {
                color: blue;
                margin: 0;
                padding: 0 0 20px;
                text-align: center;
                font-size: 22px;
            }
            h2
            {
                color: red;
            }
            .loginbox p
            {
                margin: 0;
                padding: 0;
                font-weight: bold;
                color: blue;  
            }            
            .loginbox input
            {
                width: 100%;
                margin-bottom: 20px;
            }
            .loginbox input[type="text"], input[type="password"]
            {
                border: none;
                border-bottom: 1px solid #fff;
                background: transparent;
                outline: none;
                height: 40px;
                color: #000;
                font-size: 16px;
            }
            .loginbox input[type="submit"]
            {
                border: none;
                outline: none;
                height: 40px;
                background: #fb2525;
                color: #fff;
                font-size: 18px;
                border-radius: 20px;
            }
            .loginbox input[type="submit"]:hover,.already a:hover
            {
                cursor: pointer;
                background: #059c54;
                color: #000;
            }
            .fixed-element
            {
            position: fixed;
            top: 10px;
            right: 10px;
        }
        </style>
    </head>
    <body>
            <!--<a href="#" class="fixed-element">Registry</a>-->
        <div class="loginbox">
            
            <h1>Registry Login</h1>
            <form action="registryLoginCheck.php" method="POST">                    
                <p>Username</p>
                <input type="text" name="username" placeholder="Enter Username"> 
                <p>Password</p>
                <input type="password" name="uPassword" placeholder="Enter Password"> 
                <input type="submit" name="submit" value="Login">
                <?php if(isset($_GET['error'])) 
                {?>
                    <h2 class="error"><?php echo $_GET['error'];?></h2>
                <?php 
                }?>
            <br>
            </form>                       
        </div>   
    </body>
</html>