<?php
session_start();
    include("functions.php");
    include("connection.php");
    $_SESSION;
    $user_data = sessionStarter($conn);

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(!isset($_POST['submit'])){
            logOut();
            
        }
        if(!isset($_POST['submitButton'])){
            logOut();

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>main page</title>
</head>
<body>
    <div class="box-alert" id="alert">
		<div class = "alert">
			<p>YOU ARE LOGGED OUT DUE TO INACTIVITY</p>
			<form action="" method="POST">
                <input type="submit" class="alert-button" id="alert-button" name="submit" value="OK">
            </form>
		</div>
	</div>
    <div class="mainpage" id ="main">
        <div class="main">
            <p>Welcome to the main page</p>
            <br>
            <form action="" method="POST" class="cover">
                <input class="Button" type="submit" name="submitButton" id="" value= "Log Out" >
            </form>
        </div>
    </div>
    <script>
        const alertButton = document.getElementById("alert-button");
        const alertBox = document.getElementById("alert");
        const coverBox = document.getElementById("main");
        var timer = undefined;
        const events = ['click', 'mousemove', 'mousedown', 'keydown'];

        window.addEventListener("DOMContentLoaded", () =>{
            coverBox.style.display = "";
            alertBox.style.display = "none";
            logoutTimer();
        })
        events.forEach(event =>{
            window.addEventListener(event, ()=>{
                clearTimeout(timer);
                timer = undefined
                logoutTimer();
            })
        })

        function logoutTimer(){
            if(alertBox.style.display === "none"){
                timer = setTimeout(logout, 5000);
                console.log("timer active");
            }

        }

        function logout(){
            alertBox.style.display = "";
            coverBox.style.display = "none";
            
        }

    </script>
    
</body>

</html>